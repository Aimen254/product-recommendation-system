<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductSetup;
use Illuminate\Http\Request;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use App\Jobs\exportProductsJob;
use App\Jobs\importProductsCsv;
use App\Models\ProductSetupValue;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\ProductProductSetup;
use Illuminate\Support\Facades\Bus;
use App\Http\Controllers\Controller;
use App\Models\ProductSelectedValue;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index ', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $account = getActiveAccount();
        $productSetupFields = ProductSetup::where('account_id', $account->id)->get();
        $productSetupGroups = [];
        foreach ($productSetupFields as $field) {
            $productSetupValues = $field->productSetupValues;
            $fieldValues = [];
            foreach ($productSetupValues as $value) {
                $fieldValue = $field->is_list == 1 ? $value->list_values : $value->value;
                if (!empty($fieldValue)) {
                    $fieldValues[$value->id] = $fieldValue;
                }
            }
            $fieldName = $field->field;
            if (!empty($fieldValues) && !empty($fieldName)) {
                $productSetupGroups[] = compact('fieldName', 'fieldValues');
            }
        }
        return view('products.create', compact('productSetupGroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $account = getActiveAccount();
            $validated = $request->validated();
            $inputNames = $request->keys();
            $productSetup = ProductSetup::whereIn('field', $inputNames)->get();
            $product = Product::create([
                'title' => $validated['product_title'],
                'uuid' => Str::uuid(),
                'account_id' => $account->id,
                'description' => $validated['product_description'],
                'url' => $validated['product_url'],
                'code' => rand(10000, 99999),
            ]);

            foreach ($productSetup as $setup) {
                $name = $setup->field;
                $values = $request->input($name);

                if ($values != null) {
                    foreach ($values as $value) {
                        $productSelectedValue = new ProductSelectedValue();
                        $productSelectedValue->product_id = $product->id;
                        $productSelectedValue->product_setup_id = $setup->id;
                        $productSelectedValue->value_id = $value;
                        $productSelectedValue->save();
                    }
                }
            }
            // store main product image
            $file = $request->file('img');
            if ($file == '') {
                $product->update(['image' => 'bg.jpg']);
            } else {
                $product->update(['image' => time() . $file->getClientOriginalName()]);
                $file->storeAs('public/images', time() . $file->getClientOriginalName());
                // $product->update(['image' => 'storage/images/'.time() . $file->getClientOriginalName()]);
                // $file->storeAs('public/images', time() . $file->getClientOriginalName());
            }
            return response()->json([
                'success' => 200,
                'message' => 'Product Added Successfully',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($account, $uuid)
    {
        $account = getActiveAccount();
        $product = Product::with('productSelectedValues')->where('uuid', $uuid)->firstOrFail();
        $productSelectedValues = $product->productSelectedValues;
        $productSetupFields = ProductSetup::where('account_id', $account->id)->get();
        $productSetupGroups = [];
        foreach ($productSetupFields as $field) {
            $productSetupValues = $field->productSetupValues;
            $fieldValues = [];
            foreach ($productSetupValues as $value) {
                $fieldValue = $field->is_list == 1 ? $value->list_values : $value->value;
                if (!empty($fieldValue)) {
                    $fieldValues[$value->id] = $fieldValue;
                }
            }
            $fieldName = $field->field;
            if (!empty($fieldValues) && !empty($fieldName)) {
                $productSetupGroups[] = compact('fieldName', 'fieldValues');
            }
        }

        return view('products.edit', compact('product', 'productSelectedValues', 'productSetupGroups'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $account, $uuid)
    {
        try {
            $account = getActiveAccount();
            $validated = $request->validated();
            $inputNames = $request->keys();
            $productSetup = ProductSetup::whereIn('field', $inputNames)->get();
            $product = Product::where('uuid', $uuid)->firstOrFail();
            $product->update([
                'title' => $validated['product_title'],
                'description' => $validated['product_description'],
                'url' => $validated['product_url'],
            ]);
            $product->productSelectedValues()->delete();
            foreach ($productSetup as $setup) {
                $name = $setup->field;
                $values = $request->input($name);

                if ($values != null) {
                    foreach ($values as $value) {
                        $productSelectedValue = new ProductSelectedValue();
                        $productSelectedValue->product_id = $product->id;
                        $productSelectedValue->product_setup_id = $setup->id;
                        $productSelectedValue->value_id = $value;
                        $productSelectedValue->save();
                    }
                }
            }
            // update main product image
            if ($request->has('img')) {
                $file = $request->file('img');
                $file->storeAs('public/images', time() . $file->getClientOriginalName());
                Product::where('uuid', $uuid)->update(['image' => time() . $file->getClientOriginalName()]);
                // $file->storeAs('public/images', time() . $file->getClientOriginalName());
                // Product::where('uuid', $uuid)->update(['image' => 'storage/images/'.time() . $file->getClientOriginalName()]);
            }

            return response()->json([
                'status' => 200,
                'message' => 'Product updated successfully',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($account, $uuid)
    {
        try {
            $product = Product::where('uuid', $uuid)->firstOrFail();
            if (Storage::exists('public/images/' . $product->image)) {
                Storage::delete('public/images/' . $product->image);
            }
            $product->delete();
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Product deleted successfully.',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getProducts(Request $request)
    {
        $account = getActiveAccount();

        if ($request->ajax()) {
            $data = Product::where('account_id', $account->id)->latest()->get();
            return DataTables::of($data)
                ->addColumn('title', function ($row) {
                    if (Str::contains($row->image, 'http')) {
                        $path = $row->image;
                    } else {
                        $path = asset('storage/images/' . $row->image);
                    }
                    $title = '
                    <td class="nk-tb-col">
                        <a  class="project-title">
                        <div class="user-avatar sq bg-lighter"><img class="rounded" src="' . $path . '" alt=""></div>
                            <div class="project-info">
                                <h6 class="title" data-toggle="modal" href="" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url=" ' . route('products.edit', [currentAccount(), $row->uuid]) . ' ">' . $row->title . '</h6>
                            </div>
                        </a>
                    </td>';
                    return $title;
                })->addColumn('description', function ($row) {
                    return addEllipsis($row->description, $max = 50);
                })->addColumn('url', function ($row) {
                    return '<a href="' . $row->url . '" target="_blank"><em class="icon ni ni-link"></a>';
                })->addColumn('code', function ($row) {
                    return $row->uuid;
                })->addColumn('impressions', function ($row) {
                    return $row->impressions;
                })->addColumn('action', function ($row) {
                    $action = '  <td class="nk-tb-col nk-tb-col-tools">
                        <ul class="nk-tb-actions gx-1">
                            <li>
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a data-toggle="modal" href="" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url=" ' . route('products.edit', [currentAccount(), $row->uuid]) . ' "><em class="icon ni ni-edit"></em><span >Edit Product</span></a></li>
                                            <li><a href="javascript:void(0)" data-table="products-table" class="delete"  data-url=" ' . route('products.destroy', [currentAccount(), $row->uuid]) . ' "><em class="icon ni ni-trash"></em><span>Delete Product</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </td>';
                    return $action;
                })->rawColumns(['code', 'title', 'description', 'url', 'action'])->make(true);
        }
    }

    // Exporting Products to CSV
    public function exportProducts()
    {
        $account = getActiveAccount();
        $products = Product::where('account_id', $account->id)->latest()->select('id', 'title', 'description', 'url', 'image')->get()->toArray();
        foreach ($products as $product) {
            if (Str::contains($product['image'], 'http')) {
                $path = $product['image'];
            } else {
                $path = asset('storage/images/') . $product['image'];
            }
            $items[] = [
                'title' => $product['title'],
                'category id' => 1,
                'description' => $product['description'],
                'url' => $product['url'],
                'image' => $path
            ];
        }
        return Excel::download(new ProductExport($items), 'products.csv');
        // dispatch(new exportProductsJob($products));
    }

    // Importing products from CSV
    public function loadImportProductsModal()
    {
        return view('products.import_products');
    }

    public function importProducts(Request $request)
    {
        $account = getActiveAccount();
        if ($request->has('file')) {
            $csv    = file($request->file);
            $chunks = array_chunk($csv, 10000);
            $header = [];
            $batch  = Bus::batch([])->dispatch();

            foreach ($chunks as $key => $chunk) {
                $data = array_map('str_getcsv', $chunk);
                if ($key == 0) {
                    $header = $data[0];
                    unset($data[0]);
                }
                $batch->add(new importProductsCsv($data, $header, $account));
            }
            return $batch;
        }
        return "please upload csv file";
        // Excel::import(new ProductImport, $request->file);
        // return redirect()->route('products.index',currentAccount())->with('success', 'Products Imported Successfully');
    }

    public function loadUploadImagesModal()
    {
        return view('products.upload_images');
    }

    public function uploadImages(Request $request)
    {
        dd($request->images);
        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $image->storeAs('public/images', $image->getClientOriginalName());
            }
        }
    }
}
