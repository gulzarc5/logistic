<?php

namespace App\Http\Controllers\Branch;

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
        if (Auth::user()->hasRole('Branch')) {
            $branch_id = Auth::user()->id;
        }else{            
            $branch_id = Auth::user()->parent_id;
        }
        $role = Role::where('branch_id',$branch_id)->get();
        return view('branch.roles.role_list',compact('role'));
    }

    
    public function addRoleForm(Request $request)
    {
       $permission = Permission::Where('is_branch',2)->get();
       return view('branch.roles.add_role_form',compact('permission'));
    }

    
    public function addRole(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'd_name' => 'required',
            'description' => 'required',
        ]);
        
        if (Auth::user()->hasRole('Branch')) {
            $branch_id = Auth::user()->id;
        }else{            
            $branch_id = Auth::user()->parent_id;
        }
        
        $role = Role::firstOrCreate([
            'display_name' => $request->name,
            'name' => ucwords(str_replace('_', ' ', $request->d_name).$branch_id),
            'description' => $request->description,
            'branch_id' => $branch_id,
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

        if (Auth::user()->hasRole('Branch')) {
            $branch_id = Auth::user()->id;
        }else{            
            $branch_id = Auth::user()->parent_id;
        }


        $role = Role::where('id',$id)->first();
        $permission = Permission::where('is_branch',2)->get();
 
        return view('branch.roles.edit_role',compact('role','permission'));
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

        $role = Role::where('id',$id)->first();

        // foreach ($role->permissions as  $value) {
        //     dd($value);
        // }
        return view('branch.roles.view_role_permissions',compact('role'));
    }

}
