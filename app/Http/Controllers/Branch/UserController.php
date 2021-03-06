<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\State;
use App\User;
use App\UserProfile;
use Auth;
use DataTables;

class UserController extends Controller
{
    public function addUserForm()
    {
        if (Auth::user()->hasRole('Branch')) {
            $branch_id = Auth::user()->id;
        }else{            
            $branch_id = Auth::user()->parent_id;
        }
        $role = Role::where('branch_id',$branch_id)->get();
        $states = State::where('status',1)->get();
        return view('branch.user.add_user_form',compact('role','states'));
    }

    public function addUser(Request $request)
    {
        if (Auth::user()->hasRole('Branch')) {
            $branch_id = Auth::user()->id;
        }else{            
            $branch_id = Auth::user()->parent_id;
        }

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

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'), 
            'password' => bcrypt('password'),
            'mobile' => $request->input('mobile'),
            'user_role' => $request->input('user_type'),
            'parent_id' => $branch_id,
        ]);
        if ($user) {
            $roles = $request->input('user_type');
            $user->attachRole($roles);
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
        return view('branch.user.user_list');
    }

    public function userListAjax(Request $request)
    {
        if (Auth::user()->hasRole('Branch')) {
            $branch_id = Auth::user()->id;
        }else{            
            $branch_id = Auth::user()->parent_id;
        }
        return datatables()->of(User::where('parent_id',$branch_id)->get())
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn ='<a href="'.route('branch.userDetails',['user_id'=>encrypt($row->id)]).'" class="btn btn-success btn-sm" target="_blank">View</a>';
            if (Auth::user()->hasPermission('edit-user')) {                
                $btn .='<a href="#" class="btn btn-warning btn-sm">Edit</a>';
            
                if ($row->status == '1') {
                    $btn .='<a href="'.route('branch.userStatus',['user_id'=>encrypt($row->id),'status'=>2]).'" class="btn btn-danger btn-sm" >Disable</a>';
                } else {
                    $btn .='<a href="'.route('branch.userStatus',['user_id'=>encrypt($row->id),'status'=>1]).'" class="btn btn-primary btn-sm" >Enable</a>';
                }    
            }        
            return $btn;
        })->addColumn('role', function($row){          
            return $row->role->display_name;
        })->addColumn('status_tab', function($row){
            if ($row->status == 1){
                return '<a class="btn btn-primary btn-sm">Enabled</a>';
            } else {
                return '<a class="btn btn-danger btn-sm">Disabled</a>';
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
        return view('branch.user.user_details',compact('user'));
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


}
