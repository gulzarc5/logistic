<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\State;
use App\City;
use App\UserProfile;
use App\Permission;
use Auth;
use DataTables;
use Hash;
use Artisan;

class UserController extends Controller
{
    public function addUserForm()
    {
        $role = Role::where('name','!=','admin')->get();
        $states = State::where('status',1)->get();
        $branch = User::where('user_role',3)->get();
        $permission = Permission::get();
        return view('admin.user.add_user_form',compact('role','states','branch','permission'));
    }

    public function addUser(Request $request)
    {

        $this->validate($request, [
            'name'   => 'required',
            'user_type'   => 'required',
            'branch'   => 'required_if:user_type,2',
            'email'   => 'required|email|unique:users,email',
            'mobile'   => 'required|string|unique:users,mobile',
            'state'   => 'required',
            'city'   => 'required',
            'pin'   => 'required',
            'address'   => 'required',
            'password'=> 'required|same:password_confirmation|min:8',
            'permission' => 'required|array|min:1',
        ]);
        
        $parent_id = 1;
        if ($request->input('user_type') == '2') {
            $parent_id = $request->input('branch');
        }
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'), 
            'password' => Hash::make($request->input('password')),
            'mobile' => $request->input('mobile'),
            'user_role' => $request->input('user_type'),
            'parent_id' => $parent_id,
        ]);
        
        if ($user) {
            $roles = $request->input('user_type');
            $permission = $request->input('permission'); // array of permission
            $user->attachRole($roles);
            // dd($permission);
            $user->syncPermissions($permission);
            UserProfile::create([
                'user_id' => $user->id,
                'state_id' => $request->input('state'),
                'city_id' => $request->input('city'), 
                'pin' =>  $request->input('pin'),
                'address' =>  $request->input('address'), 
                'gender' =>  $request->input('gender'),
            ]);
            return redirect()->back()->with('message','User Added Successfully');
        } else {           
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
        
    }
    
    public function userList()
    {
        return view('admin.user.user_list');
    }

    public function userListAjax(Request $request)
    {
        return datatables()->of(User::whereNotNull('parent_id')->get())
        ->addIndexColumn()
        ->addColumn('action', function($row){

            $btn ='<a href="'.route('admin.userDetails',['user_id'=>encrypt($row->id)]).'" class="btn btn-success btn-xs" target="_blank">View</a>';  
            $btn .='<a target="_blank" href="'.route('admin.edit_user_form',['id'=>$row->id]).'" class="btn btn-warning btn-sm">Edit</a>';           
            $btn .='<a href="'.route('admin.edit_user_permission',['id'=>encrypt($row->id)]).'" class="btn btn-primary btn-xs">Edit Permissions</a>';
        
            if ($row->status == '1') {
                $btn .='<a href="'.route('admin.userStatus',['user_id'=>encrypt($row->id),'status'=>2]).'" class="btn btn-danger btn-xs" >Disable</a>';
            } else {
                $btn .='<a href="'.route('admin.userStatus',['user_id'=>encrypt($row->id),'status'=>1]).'" class="btn btn-primary btn-xs" >Enable</a>';
            }   
            $btn .='<a target="_blank" href="'.route('admin.reset_password_form',['user_id'=>$row->id]).'" class="btn btn-warning btn-sm">Change Password</a>';        
            return $btn;
        })->addColumn('role', function($row){          
            return $row->role->display_name;
        })->addColumn('status_tab', function($row){
            if ($row->status == 1){
                return '<a class="btn btn-primary btn-xs">Enabled</a>';
            } else {
                return '<a class="btn btn-danger btn-xs">Disabled</a>';
            }
        })
        ->rawColumns(['action','status_tab','role'])
        ->make(true);
    }

    public function userDetails($user_id)
    {
        try {
            $user_id = decrypt($user_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $user = User::where('id',$user_id)->first();
        return view('admin.user.user_details',compact('user'));
    }

    public function userStatus($user_id,$states)
    {
        try {
            $user_id = decrypt($user_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        User::where('id',$user_id)->update([
            'status' => $states,
        ]);
        return redirect()->back();
    }

    public function editUserPermission($user_id)
    {
        try {
            $user_id = decrypt($user_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $user = User::where('id',$user_id)->first();
        $permission = Permission::get();
        return view('admin.user.edit_permission',compact('user','permission'));
    }

    public function updateUserPermission(Request $request,$user_id)
    {
        $this->validate($request, [
            'permission' => 'required|array|min:1',
        ]);
        $permissions = $request->input('permission');
        $user = User::findOrFail($user_id);
        $user->permissions()->sync($permissions);
        Artisan::call('cache:clear');

        return redirect()->back()->with('message','Permission Updated Successfully');
    }


    public function editUserForm($id){
        $role = Role::where('name','!=','admin')->get();
        $states = State::where('status',1)->get();
        $user_details  = User::where('id',$id)->first();
        $city = null;
        if (isset($user_details->userProfile->city->state->id) && !empty($user_details->userProfile->city->state->id)) {
            $city = City::where('state_id',$user_details->userProfile->city->state->id)->where('status',1)->get();
        }
        return view('admin.user.user_edit_form',compact('user_details','role','states','city'));

    }

    public function updateUser(Request $request,$id){
        $this->validate($request, [
            'name'   => 'required',
            'user_type'   => 'required',
            'email'   => 'required|email|unique:users,email',
            'mobile'   => 'required|string|unique:users,mobile',
            'state'   => 'required',
            'city'   => 'required',
            'pin'   => 'required',
            'address'   => 'required',
           
        ]);
        $user  = User::where('id',$id)->first();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->mobile =$request->input('mobile');
        $user->user_role =$request->input('user_type');
        if($user->save()){
            $user_profile = UserProfile::where('user_id',$user->id)->first();
            $user_profile->state_id = $request->input('state');
            $user_profile->city_id = $request->input('city');
            $user_profile->address = $request->input('address');
            $user_profile->pin = $request->input('pin');
            $user_profile->gender = $request->input('gender');
            $user_profile->save();
            
        }
        if($user_profile){
            return redirect()->back()->with('message','User Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');

        }
    }

    public function resetPasswordForm($user_id){
        return view('admin.user.reset_password',compact('user_id'));
    }

    public function changePassword(Request $request,$user_id){
        $this->validate($request, [
            'new_password' => ['required', 'string', 'min:8', 'same:confirm_password'],
        ]);
        $user = User::where('id',$user_id)->first();
        User::where('id',$user_id)->update([
            'password'=>Hash::make($request->input('new_password')),
        ]);
           
        return redirect()->back()->with('message','Password Updated Successfully');
       
        
       
    }
}
