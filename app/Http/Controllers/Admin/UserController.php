<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataReturn['roles'] = Role::select(['id','name'])->get();
        //filtering users based on roles with name & id,
        // $dataReturn['users'] = User::role('admin')->with('roles:id,name')->get();
        // $roleId = 1;
        // $dataReturn['users'] = User::whereHas('roles', function ($query) use ($roleId){
        //     $query->where('roles.id', $roleId);
        // })->with('roles:id,name')->get();
        return view('admin.users', $dataReturn);
    }

    public function getUsers(Request $request, $roleName)
    {
        if($request->ajax()){
            // return $roleName;
            $usersQuery = in_array($roleName, ['all','',null])
                ? User::with('roles:id,name')
                : User::role($roleName)->with('roles:id,name');

            return DataTables::of($usersQuery)
                ->addColumn('roles', function($user){
                    return implode(', ', $user->roles->pluck('name')->toArray());
                })
                ->addIndexColumn()
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        if($request->ajax()){
            $userStored = $this->userService->store($request->validated());
            if($userStored === true){
                return Response::json('Successfully Created!');
            }
            return Response::json($userStored);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        if($request->ajax()){
            $updatedUser = $this->userService->update($request->validated(), $id);

            if($updatedUser === true){
                return Response::json('Updated Successfully!');
            }
            return Response::json($updatedUser);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        if(request()->ajax()){
            $deletedUser = User::destroy($id);
            if($deletedUser){
                return Response::json('Successfully Deleted!');
            }
            return Response::json($deletedUser);
        }
    }
}
