<?php

namespace App\Http\Controllers\Backend;

use App\Models\Advice;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\AdviceExport;
use App\Imports\AdviceImport;
use App\Jobs\importAdviceJob;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Bus;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdviceRequest;
use Maatwebsite\Excel\Facades\Excel;

class AdviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account = getActiveAccount();
        $advices = Advice::where('account_id', $account->id)->orderBy('title','asc')->get();
        return view('advices.index', compact('advices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $account = getActiveAccount();
        $categories = Category::where('account_id', $account->id)->latest()->get();
        return view('advices.create', compact('categories'))->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdviceRequest $request)
    {
        try {
            $account = getActiveAccount();
            $validated = $request->validated();
            $advice = Advice::create([
                'uuid' => Str::uuid(),
                'account_id' => $account->id,
                'title' => $validated['advice_title'],
                'secondary_title' => $validated['secondary_title'],
            ]);
            $advice->categories()->attach($request->categories);
            return response()->json([
                'success' => 200,
                'message' => 'Advice Added Successfully',
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
        $categories = Category::where('account_id', $accounts->id)->get();
        $advice = Advice::where('uuid', $uuid)->firstOrFail();
        $adviceCategories = $advice->categories()->pluck('categories.id')->toArray();
        return view('advices.edit')->with(['advice' => $advice, 'categories' => $categories, 'adviceCategories' => $adviceCategories])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdviceRequest $request, $account, $uuid)
    {
        try {

            $validated = $request->validated();
            $advice = Advice::where('uuid', $uuid)->firstOrFail();
            $advice->update([
                'title' => $validated['advice_title'],
                'secondary_title' => $validated['secondary_title'],
            ]);
            $advice->categories()->sync($request->categories);
            return response()->json([
                'status' => 200,
                'message' => 'Advice updated successfully',
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
            $advice = Advice::where('uuid', $uuid)->firstOrFail();
            $advice->delete();
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Advice deleted successfully.',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception$e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getAdvices(Request $request)
    {
        $account = getActiveAccount();

        if ($request->ajax()) {
            $advices = Advice::where('account_id', $account->id)->orderBy('title','asc')->get();
            return DataTables::of($advices)
                ->addColumn('categories', function ($advice) {
                    return $advice->categories()->count();
                })->addColumn('products', function ($advice) {
                return $advice->categories()->count();
            })->addColumn('impressions', function ($advice) {
                return $advice->impressions;
            })->addColumn('action', function ($advice) {
                $action = '  <td class="nk-tb-col nk-tb-col-tools">
                        <ul class="nk-tb-actions gx-1">
                            <li>
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a data-toggle="modal" href=""  data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url=" ' . route('advices.edit', [currentAccount(), $advice->uuid]) . ' "><em class="icon ni ni-edit"></em><span >Edit Advice</span></a></li>
                                            <li><a href="javascript:void(0)" data-table="advices-table" class="delete"  data-url=" ' . route('advices.destroy', [currentAccount(), $advice->uuid]) . ' "><em class="icon ni ni-trash"></em><span>Delete Advice</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </td>';
                return $action;
            })->rawColumns(['categories', 'products', 'impressions', 'action'])->make(true);
        }
        return view('advices.index');
    }
    public function getCategories()
    {
        $account = getActiveAccount();
        $categories = Category::where('account_id', $account->id)->latest()->get();
        return view('advices.categories', compact('categories'))->render();
    }

    // Exporting advices to CSV
    public function exportAdvices()
    {
        $account = getActiveAccount();
        $products = Advice::where('account_id', $account->id)->latest()->select('id', 'title', 'impressions')->get()->toArray();
        return Excel::download(new AdviceExport($products), 'advices.csv');
    }

     // Importing products from CSV
     public function loadImportAdvicesModal(){
        return view('advices.import_advices');
    }

    public function importAdvices(Request $request)
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
                $batch->add(new importAdviceJob($data, $header, $account));
            }
            return $batch;
        }
        return "please upload csv file";
            // Excel::import(new AdviceImport, $request->file);
            // return redirect()->route('advices.index',currentAccount())->with('success', 'Products Imported Successfully');
    }
    
}
