<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\CategoryExport;
use App\Imports\CategoryImport;
use App\Jobs\importCategoryJob;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Bus;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoriesRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account = getActiveAccount();
        $categories = Category::where('account_id', $account->id)->latest()->get();
        return view('categories.index ', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $account = getActiveAccount();
        $products = Product::where('account_id', $account->id)->orderBy('title','asc')->get();
        return view('categories.create', compact('products'))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $account = getActiveAccount();
            $validated = $request->validated();
            $category = Category::create([
                'uuid' => Str::uuid(),
                'account_id' => $account->id,
                'title' => $validated['category_title'],
                'secondary_title' => $validated['category_secondary_title'],
                'description' => $validated['category_description'],
            ]);
            $category->products()->attach($request->products);

            return response()->json([
                'success' => 200,
                'message' => 'Category Added Successfully',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception$e) {
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
        $accounts = getActiveAccount();
        $products = Product::where('account_id', $accounts->id)->get();
        $category = Category::where('uuid', $uuid)->firstOrFail();
        $categoryProducts = $category->products()->pluck('products.id')->toArray();
        return view('categories.edit')->with([
            'category' => $category,
            'products' => $products,
            'categoryProducts' => $categoryProducts])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriesRequest $request, $account, $uuid)
    {
        try {
            $validated = $request->validated();
            $category = Category::where('uuid', $uuid)->firstOrFail();
            $category->update([
                'title' => $validated['category_title'],
                'secondary_title' => $validated['category_secondary_title'],
                'description' => $validated['category_description'],
            ]);
            $category->products()->detach($request->products);
            $category->products()->sync($request->products);
            return response()->json([
                'status' => 200,
                'message' => 'Category updated successfully',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception$e) {
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
            $category = Category::where('uuid', $uuid)->firstOrFail();
            $category->delete();
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Category deleted successfully.',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception$e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getCategories(Request $request)
    {
        $account = getActiveAccount();

        if ($request->ajax()) {
            $data = Category::where('account_id', $account->id)->latest()->get();
            return DataTables::of($data)->addColumn('title', function ($row) {
                return $row->title;
            })->addColumn('description', function ($row) {
                return addEllipsis($row->description, $max = 50);
            })->addColumn('products', function ($row) {
                return $row->products()->count();
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
                                            <li><a data-toggle="modal" href=""  data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url=" ' . route('categories.edit', [currentAccount(), $row->uuid]) . ' "><em class="icon ni ni-edit"></em><span >Edit Category</span></a></li>
                                            <li><a href="javascript:void(0)" data-table="categories-table" class="delete"  data-url=" ' . route('categories.destroy', [currentAccount(), $row->uuid]) . ' "><em class="icon ni ni-trash"></em><span>Delete Category</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </td>';
                return $action;
            })->rawColumns(['title' , 'description', 'products', 'impressions', 'action'])->make(true);
        }
        return view('categories.index');
    }
    public function getProducts()
    {
        $account = getActiveAccount();
        $products = Product::where('account_id', $account->id)->latest()->get();
        return view('categories.products', compact('products'))->render();
    }

     // Exporting Categories to CSV
     public function exportCategories()
     {
         $account = getActiveAccount();
         $products = Category::where('account_id', $account->id)->latest()->select('id','title','description')->get()->toArray();
         return Excel::download(new CategoryExport($products), 'categories.csv');
     }

       // Importing products from CSV
    public function loadImportCategoriesModal(){
        return view('categories.import_categories');
    }

    public function importCategories(Request $request)
    {
        $account = getActiveAccount();
        if( $request->has('file') ) {
            $csv    = file($request->file);
            $chunks = array_chunk($csv,1000);
            $header = [];
            $batch  = Bus::batch([])->dispatch();

            foreach ($chunks as $key => $chunk) {
            $data = array_map('str_getcsv', $chunk);
                if($key == 0){
                    $header = $data[0];
                    unset($data[0]);
                }
                $batch->add(new importCategoryJob($data, $header, $account));
            }
            return $batch;
        }
        return "please upload csv file";
            // Excel::import(new CategoryImport, $request->file);
            // return redirect()->route('categories.index',currentAccount())->with('success', 'Products Imported Successfully');
    }
}
