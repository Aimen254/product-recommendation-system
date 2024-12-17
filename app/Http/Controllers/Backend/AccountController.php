<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Models\Account;
use App\Models\Category;
use App\Models\Product;
use App\Models\Project;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class AccountController extends Controller
{
    function __construct()
    {
        $this->middleware('can:add accounts', ['only' => ['create', 'store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('accounts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $request)
    {
        try {
            $validated = $request->validated();

            $account = Account::create([
                'uuid' => Str::uuid(),
                'name' => $validated['name'],
                'max_users' => $validated['max_users'],
                'status' => $request->status ? 'active' : 'inactive',
            ]);
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Account created successfully.',
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
    public function show($uuid)
    {
        if (\Auth::user()->hasRole('Super Admin'))
            $account = Account::where('uuid', $uuid)->firstOrFail();
        else
            $account =  \Auth::user()->accounts()->where('uuid', $uuid)->firstOrFail();
        $projects  = Project::where('account_id', $account->id)->latest()->take(5)->get();
        $products = Product::where('account_id', $account->id)->latest()->take(5)->get();
        $categories = Category::where('account_id', $account->id)->latest()->take(5)->get();
        $users = $account->users()->take(5)->latest()->get();
        return view('accounts.show', compact('account', 'projects', 'products', 'categories', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $account = Account::where('uuid', $uuid)->firstOrFail();
        return view('accounts.edit', compact('account'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccountRequest $request, Account $account)
    {
        try {
            $validated = $request->validated();

            $account->update([
                'name' => $validated['name'],
                'max_users' => $validated['max_users'],
                'status' => $request->status ? 'active' : 'inactive',
            ]);
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Account updated successfully.',
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
    public function destroy($uuid)
    {
        try {

            $account = Account::where('uuid', $uuid)->firstOrFail();
            $setting = Setting::where('account_id',  $account->id)->firstOrFail();
            if (Storage::exists('public/images/' . $setting->logo) && Storage::exists('public/images/' . $setting->favicon)) {
                Storage::delete('public/images/' . $setting->logo);
                Storage::delete('public/images/' . $setting->favicon);
            }
            $account->delete();
            $setting->delete();
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Account deleted successfully.',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getAccounts(Request $request)
    {
        if ($request->ajax()) {
            $accounts = Account::latest()->get();
            return view('accounts.accounts_data', compact('accounts'))->render();
        }
    }
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $user = \Auth::user();

            $data = $user->hasRole('Super Admin') ? Account::latest()->get() : $user->accounts;
            return DataTables::of($data)
                ->addColumn('name', function ($row) {
                    $name = '
                <td class="nk-tb-col">
                    <a href="' . route('accounts.show', $row->uuid) . '" class="project-title">
                        <div class="project-info">
                            <h6 class="title">' . $row->name . '</h6>
                        </div>
                    </a>
                </td>';
                    return $name;
                })
                ->addColumn('users', function ($data) {
                    return $data->users->count();
                })
                ->addColumn('status', function ($data) {
                    if ($data->status == "active") {
                        $bage_color = "badge-success";
                    } elseif ($data->status == "inactive") {
                        $bage_color = "badge-danger";
                    }

                    $status = ' <span class="m-auto badge badge-dim ' . $bage_color . '"><span>' . $data->status . '</span></span>';
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $action = '  <td class="nk-tb-col nk-tb-col-tools">
                        <ul class="nk-tb-actions gx-1">
                            <li>
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a data-toggle="modal" href="" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url=" ' . route('accounts.edit', $row->uuid) . ' "><em class="icon ni ni-edit"></em><span >Edit Account</span></a></li>
                                            <li><a href="javascript:void(0)" data-table="accounts-table" class="delete"  data-url=" ' . route('accounts.destroy', $row->uuid) . ' "><em class="icon ni ni-trash"></em><span>Delete Account</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </td>';
                    return $action;
                })->rawColumns(['action', 'status', 'name'])->make(true);
        }
    }
}
