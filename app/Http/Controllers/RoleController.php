<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request){
        $roles = [];
        if($request->has('search')){
            $queryValue = $request->input('search');
            $roles = Role::query();
            foreach(Role::searchableFields() as $index => $attribute) {
                $roles = $index == 0 
                ? $roles->where($attribute, 'LIKE', '%' . $queryValue . '%')
                : $roles->orWhere($attribute, 'LIKE', '%' . $queryValue . '%');
            }
            $roles = $roles->paginate(config('constants.PAGE_LIMIT'));
        }
        else {
            $roles = Role::paginate(config('constants.PAGE_LIMIT'));
        }
        return view('role.index', ['roles' => $roles]);
    }

    public function create(){
        return view('role.form', [
            'type' => 'create',
            'role' => null
        ]);
    }

    public function store(Request $request){
        
        $validate = Validator::make($request->all(),
            [
                'role-name' => ['required', 'max:255'],
                'current-user-password' => ['required', 'sometimes', 'current_password']
            ]
        );

        if($validate->fails()){
            return back()
                ->with('errors', 'Incorrect user password.');
        }

        else {
            $role = Role::create(['name' => $request['role-name']]);
            $permissions = config('constants.PERMISSIONS');
            foreach($permissions as $permission){
                if($request->has($permission)){
                    $role->givePermissionTo($permission);
                }
                else {
                    if($role->hasPermissionTo($permission)){
                        $role->revokePermissionTo($permission);
                    }
                }
            }
            return redirect()
                ->route('roles.index')
                ->with('success', 'Role successfully created.');
        }
    }

    public function edit($id){

        $role = Role::findById($id);

        if(!$role) {

            return redirect()
                ->route('roles.index')
                ->with('error', 'Could not find entity with ID: ' . $id);
        }

        else return view('role.form', [
            'type' => 'update',
            'role' => $role
        ]);
    }

    public function update(Request $request, $id){

        $validate = Validator::make($request->all(),
            [
                'role-name' => ['required', 'max:255'],
                'current-user-password' => ['required', 'sometimes', 'current_password']
            ]
        );

        if($validate->fails()){
            return back()
                ->with('errors', 'Incorrect user password.');
        }

        else {
            $role = Role::findById($id);

            if(!$role){
                return redirect()
                    ->route('roles.index')
                    ->with('error', 'Could not find entity with ID: ' . $id);
            }
            else {
                $role->update(['name' => $request['role-name']]);
                $permissions = config('constants.PERMISSIONS');
                foreach($permissions as $permission){
                    if($request->has($permission)){
                        $role->givePermissionTo($permission);
                    }
                    else {
                        if($role->hasPermissionTo($permission)){
                            $role->revokePermissionTo($permission);
                        }
                    }
                }
                return redirect()
                    ->route('roles.index')
                    ->with('success', 'Role successfully created.');
            }
        }
    }

    public function destroy($id){

        $role = Role::findById($id);

        if(!$role){
            return redirect()
                ->route('roles.index')
                ->with('error', 'Could not find entity with ID: ' . $id);
        }
        else {
            $role->delete();
            return redirect()
                ->route('roles.index')
                ->with('success', 'Role successfully deleted.');
        }
    }
}
