<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pincode;
use Illuminate\Http\Request;

class PincodeController extends Controller
{
    public function pincodeList()
    {
        return view('admin.configuration.pincode.list');
    }
    public function pincodeListAjax()
    {
        return datatables()->of(Pincode::latest()->get())
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn ='<a href="'.route('admin.pincode.form',['id'=>$row->id]).'" class="btn btn-warning btn-sm">Edit</a>';
            if ($row->status == '1') {
                $btn .='<a href="'.route('admin.edit.status',['id'=>$row->id]).'" class="btn btn-danger btn-sm" >Disable</a>';
            } else {
                $btn .='<a href="'.route('admin.edit.status',['id'=>$row->id]).'" class="btn btn-primary btn-sm" >Enable</a>';
            }            
            return $btn;
        })
        ->addColumn('status_tab', function($row){
            if ($row->status == 1){
                return 'Enabled';
            } else {
                return 'Disabled';
            }
        })
        ->rawColumns(['action','status_tab'])
        ->make(true);
    }

    public function addPincode($id = null)
    {
        if ($id) {
            $pincode = Pincode::findOrFail($id);
            return view('admin.configuration.pincode.form',compact('pincode'));
        } else {
            return view('admin.configuration.pincode.form');
        }
    }
    public function submit(Request $request)
    {
        $this->validate($request, [
            'id' => 'nullable|numeric|exists:pincodes,id',
            'pincode' => 'required|numeric|digits:6',
            'area' => 'required|string|max:50',
        ]);
        $id = $request->input('id');
        if (isset($id)) {
            $pincode = Pincode::findOrFail($id);
            $pincode->pincode = $request->input('pincode');
            $pincode->area = $request->input('area');
            $pincode->save();
            return back()->with('message','Data Updated Successfully');
        } else {
            $pincode = new Pincode();
            $pincode->pincode = $request->input('pincode');
            $pincode->area = $request->input('area');
            $pincode->save();
            return back()->with('message','Data Updated Successfully');
        }   
    }
    public function status($id)
    {
        $pincode = Pincode::findOrFail($id);
        $pincode->status = $pincode->status == 1 ? 2 : 1;
        $pincode->save();
        return back();
    }
}
