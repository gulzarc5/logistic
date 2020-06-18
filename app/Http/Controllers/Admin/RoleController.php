<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use Artisan;
use Auth;

class RoleController extends Controller
{
    public function roleList()
    {
        $role = Role::whereNull('branch_id')->get();
        return view('admin.roles.role_list',compact('role'));
    }

    public function addRoleForm(Request $request)
    {
       $permission = Permission::get();

    //    Permission::create([
    //         'name' => 'docate-entry-list',
    //         'display_name' => 'Docate Entry List', // optional
    //         'description' => 'Docate Entry List', // optional
    //     ]);

       return view('admin.roles.add_role_form',compact('permission'));
    }

    public function addRole(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required|unique:roles,name',
            'd_name' => 'required',
            'description' => 'required',
        ]);
        
        $role = Role::firstOrCreate([
            'display_name' => $request->name,
            'name' => ucwords(str_replace('_', ' ', $request->d_name)),
            'description' => $request->description,
        ]);

        $permissions = $request->input('permission');

        $role->permissions()->sync($permissions);

        return redirect()->back()->with('message','User Role Created Successfully');
    }

    public function editRole($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $role = Role::where('id',$id)->first();
        $permission = Permission::get();
 
        return view('admin.roles.edit_role',compact('role','permission'));
    }

    public function updateRole(Request $request,$id)
    {
        $this->validate($request, [
            'name'   => 'required',
            'd_name' => 'required',
            'description' => 'required',
        ]);

        $check = Role::where('name',$request->name);
        if ($check->count() > 0) {
            $check = $check->first();
            if ($check->id != $id) {                
                return redirect()->back()->with('error','Please Change The Role Name ! The Name Already Exist');
            }
        } 
        

        $role = Role::where('id',$id)->update([
            'display_name' => $request->d_name,
            'name' => ucwords(str_replace('_', ' ', $request->name)),
            'description' => $request->description,
        ]);

        $permissions = $request->input('permission');
        $role = Role::where('id',$id)->first();
        $role->permissions()->sync($permissions);
        Artisan::call('cache:clear');
        return redirect()->back()->with('message','User Role Updated Successfully');

    }

    public function viewRolePermissions($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $role = Role::where('id',$id)->whereNull('branch_id')->first();

        // foreach ($role->permissions as  $value) {
        //     dd($value);
        // }
        return view('admin.roles.view_role_permissions',compact('role'));
    }
}
