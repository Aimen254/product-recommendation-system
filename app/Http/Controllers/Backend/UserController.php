<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Account;
use App\Mail\resetPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('can:edit users', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete users', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('users.index ', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $users = User::all();
        return view('users.create', compact('roles', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $password = Str::uuid();
            $validated = $request->validated();
            $user = \Auth::user();
            $account = getActiveAccount();
            if ($account->users->count() == $account->max_users) {
                return response()->json([
                    'success' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => 'Account ' . $account->max_users . ' max users limit reached',
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }

            $user = User::create([
                'uuid' => Str::uuid(),
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'password' => Hash::make($password),
                'status' => 'active',
            ]);

            \Auth::user()->hasRole('Super Admin') ? $user->assignRole($request->role) : $user->assignRole('Admin');

            $user->accounts()->attach($account->id);
            $email_list['email'] = $validated['email'];
            $data = array(
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'password' => $password,
            );
            dispatch(new \App\Jobs\SendEmailJob($data));
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'User Added successfully.',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function loadNewUsersForm()
    {
        $users = User::latest()->get();
        $roles = Role::all();
        return view('users.partials.new_user', compact('users', 'roles'))->render();
    }

    public function loadExistingUsersForm()
    {
        $users = User::whereNotIn('id', getActiveAccount()->users->pluck('id'))->get();
        return view('users.partials.existing_user', compact('users'))->render();
    }

    // Adding From Existing Users
    public function addExistingUser(Request $request)
    {
        try {
            $user = User::where('id', $request->user_id)->first();
            $account = getActiveAccount();
            if ($account->users->count() == $account->max_users) {
                return response()->json([
                    'success' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => 'Account ' . $account->max_users . ' max users limit reached',
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
            $user->accounts()->where('account_id', getActiveAccount()->id)->attach(getActiveAccount()->id);
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'User Added successfully.',
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
    public function show($account, $uuid)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($account, $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        $roles = Role::all();
        return view('users.edit')->with([
            'user' => $user,
            'roles' => $roles
        ])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $account, $uuid)
    {
        try {
            $validated = $request->validated();
            $user = User::where('uuid', $uuid)->first();
            $user->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
            ]);
            $user->syncRoles($request->role);

            return response()->json([
                'status' => 200,
                'message' => 'User updated successfully',
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
            $user = User::where('uuid', $uuid)->firstOrFail();
            $user->accounts()->where('account_id', getActiveAccount()->id)->detach(getActiveAccount()->id);
            $user->delete();
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'User deleted successfully.',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $account = getActiveAccount();
            $users = $account->users;
            return DataTables::of($users)
                ->addColumn('username', function ($users) {
                    $username = '<td>' . $users->first_name . " " . $users->last_name . '</td>
                    ';
                    return $username;
                })->addColumn('role', function ($users) {
                    $role = $users->getRoleNames()[0];
                    return $role;
                })
                // ->addColumn('status', function ($users) {
                //     $is_checked = ($users->status == 'active') ? 'checked' : '';
                //     $status = '<div class="form-group">
                //         <div class="custom-control custom-switch">
                //             <input type="checkbox" class="changeStatus custom-control-input" name="status" value="' . $users->uuid . '" id="site-off" ' . $is_checked . '>
                //             <label class="custom-control-label" for="site-off"></label>
                //         </div>
                //     </div>';
                //     return $status;
                // })
                ->addColumn('action', function ($users) {
                    $action = '<td class="nk-tb-col nk-tb-col-tools">
                        <ul class="nk-tb-actions gx-1">
                            <li>
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            <input type="hidden" id="edit_delete_id" value="' . $users->id . '">
                                            <li><a data-toggle="modal" href="" data-act="ajax-modal" data-complete-location="true" data-method="get" data-action-url=" ' . route('users.edit', [currentAccount(), $users->uuid]) . ' "><em class="icon ni ni-edit"></em><span >Edit User</span></a></li>
                                            <li><a href="javascript:void(0)" data-table="user-table" class="delete"  data-url=" ' . route('users.destroy', [currentAccount(), $users->uuid]) . ' "><em class="icon ni ni-trash"></em><span>Delete User</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </td>';
                    if (Auth::user()->hasRole('Super Admin')) {
                        return $action;
                    } else {
                        return '';
                    }
                })->rawColumns(['username', 'role', 'action'])->make(true);
        }
    }

    public function activate(Request $request)
    {
        User::where('uuid', $request->uuid)->update(['status' => 'active']);
        return response()->json([
            'status' => 200,
            'message' => 'User activated Successfully',
        ]);
    }

    public function deactivate(Request $request)
    {
        User::where('uuid', $request->uuid)->update(['status' => 'inactive']);
        return response()->json([
            'status' => 200,
            'message' => 'User deactivated Successfully',
        ]);
    }
}
