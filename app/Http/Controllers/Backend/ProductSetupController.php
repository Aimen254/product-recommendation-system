<?php

namespace App\Http\Controllers\Backend;

use Schema;
use stdClass;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductSetup;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\ProductSetupValue;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\ProductSetupRequest;
use App\Http\Requests\UpdateProductSetupRequest;
use App\Models\McqIsMultipleAdviceLogic;

class ProductSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products_setup.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products_setup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductSetupRequest $request)
    {
        try {
            $validated = $request->validated();
            $account = getActiveAccount();
            $name = $validated['product_field_name'];
            $words = explode(' ', $name);
            $field = implode('_', array_map('ucfirst', $words));
            $field = ucfirst($field);
            $request->is_list == null ? $isList = "0" : $isList = "1";
            $productSetup = ProductSetup::create([
                'uuid' => Str::uuid(),
                'account_id' => $account->id,
                'field' => $field,
                'type' => $request->input('data_type'),
                'is_list' => $isList
            ]);

            function saveProductSetupValue($product_setup_id, $value, $list_values)
            {
                $productSetupValue = new ProductSetupValue();
                $productSetupValue->product_setup_id = $product_setup_id;
                $productSetupValue->value = $value;
                $productSetupValue->list_values = $list_values;
                $productSetupValue->save();
            }

            if ($request->data_type == "text") {
                foreach ($request->text as $text) {
                    if ($text != null && $isList == "1") {
                        saveProductSetupValue($productSetup->id, null, $text);
                    } else if ($text != null && $isList == "0") {
                        saveProductSetupValue($productSetup->id, $text, null);
                    }
                }
            } else if ($request->data_type == "numeric") {
                foreach ($request->number as $number) {
                    if ($number != null && $isList == "1") {
                        saveProductSetupValue($productSetup->id, null, $number);
                    } else if ($number != null && $isList == "0") {
                        saveProductSetupValue($productSetup->id, $number, null);
                    }
                }
            } else if ($request->data_type == "image") {
                $images = request()->image;
                foreach ($images as $file) {
                    if ($file != null && $isList == "1") {
                        $fileName = time() . $file->getClientOriginalName();
                        $file->storeAs('public/images', $fileName);
                        saveProductSetupValue($productSetup->id, null, $fileName);
                    } else if ($file != null && $isList == "0") {
                        $fileName = time() . $file->getClientOriginalName();
                        $file->storeAs('public/images', $fileName);
                        saveProductSetupValue($productSetup->id, $fileName, null);
                    }
                }
            }
            return response()->json([
                'status' => 200,
                'message' => 'Product field added successfully',
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
        $productFields = ProductSetup::where('uuid', $uuid)->firstOrFail();
        $productSetupValues = ProductSetup::with('productSetupValues')->where('id', $productFields->id)->firstOrFail();
        return view('products_setup.edit', compact('productFields', 'productSetupValues'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductSetupRequest $request, $account, $uuid)
    {
        try {
            $request->is_list == null ? $isList = "0" : $isList = "1";
            $productSetup = ProductSetup::where('uuid', $uuid)->firstOrFail();
            $name = $request->product_field_name;
            $words = explode(' ', $name);
            $field = implode('_', array_map('ucfirst', $words));
            $field = ucfirst($field);
            $productSetup->update([
                'field' =>  $field,
                'type' => $request->data_type,
                'is_list' => $isList
            ]);
            McqIsMultipleAdviceLogic::where('product_setup_id', $productSetup->id)->delete();
            $productSetup->productSetupValues()->delete();
            $productSetup->productSelectedValues()->delete();
            function updateProductSetupValue($product_setup_id, $value, $list_values)
            {
                $productSetupValue = new ProductSetupValue();
                $productSetupValue->product_setup_id = $product_setup_id;
                $productSetupValue->value = $value;
                $productSetupValue->list_values = $list_values;
                $productSetupValue->save();
            }

            if ($request->data_type == "text") {
                foreach ($request->text as $text) {
                    if ($text != null && $isList == "1") {
                        updateProductSetupValue($productSetup->id, null, $text);
                    } else if ($text != null && $isList == "0") {
                        updateProductSetupValue($productSetup->id, $text, null);
                    }
                }
            } else if ($request->data_type == "numeric") {
                foreach ($request->number as $number) {
                    if ($number != null && $isList == "1") {
                        updateProductSetupValue($productSetup->id, null, $number);
                    } else if ($number != null && $isList == "0") {
                        updateProductSetupValue($productSetup->id, $number, null);
                    }
                }
            } else if ($request->data_type == "image") {
                $images = request()->image;
                foreach ($images as $file) {
                    if ($file != null && $isList == "1") {
                        $fileName = time() . $file->getClientOriginalName();
                        $file->storeAs('public/images', $fileName);
                        updateProductSetupValue($productSetup->id, null, $fileName);
                    } else if ($file != null && $isList == "0") {
                        $fileName = time() . $file->getClientOriginalName();
                        $file->storeAs('public/images', $fileName);
                        updateProductSetupValue($productSetup->id, $fileName, null);
                    }
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Product field updated successfully',
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
            $productField = ProductSetup::where('uuid', $uuid)->firstOrFail();
            $productFieldValues = McqIsMultipleAdviceLogic::where('product_setup_id', $productField->id)->delete();
            $productField->delete();
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Product Field deleted successfully.',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function datatable(Request $request)
    {
        $account = getActiveAccount();
        $productSetup = ProductSetup::where('account_id', $account->id)->latest()->get();
        $columns = collect([]);
        $productsColumns = DB::select('DESCRIBE products');
        foreach ($productsColumns as $col) {
            $obj = new stdClass;
            $obj->field = $col->Field;
            $obj->type = $col->Type;
            $obj->uuid = '';
            $columns->push($obj);
        }
        $data = $columns->merge($productSetup);
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addColumn('field', function ($row) {
                    return $row->field;
                })->addColumn('type', function ($row) {
                    return $row->type;
                })->addColumn('action', function ($row) {
                    if ($row->uuid != '') {
                        $action = '  <td class="nk-tb-col nk-tb-col-tools">
                            <ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a data-toggle="modal" href="" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url=" ' . route('products_setup.edit', [currentAccount(), $row->uuid]) . ' "><em class="icon ni ni-edit"></em><span >Edit Field</span></a></li>
                                                <li><a href="javascript:void(0)" data-table="product-setup-table" class="delete"  data-url=" ' . route('products_setup.destroy', [currentAccount(), $row->uuid]) . ' "><em class="icon ni ni-trash"></em><span>Delete Field</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </td>';
                    } else {
                        $action = '<span class="badge badge-dim badge-danger float-right"><span>Unalterable</span></span>';
                    }
                    return $action;
                })->rawColumns(['field', 'type', 'action'])->make(true);
        }
    }
}
