<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\State;
use App\City;
use App\ServiceArea;

class ConfigurationController extends Controller
{
    public function stateList()
    {
        $state = State::get();
        return view('admin.configuration.state.state_list',compact('state'));
    }

    public function stateStatus($id,$status)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        State::where('id',$id)->update([
            'status' => $status,
        ]);
        return redirect()->back();
    }

    public function addStateForm()
    {
        return view('admin.configuration.state.state_add_form');
    }

    public function addState(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
        ]);

        State::create([
            'name' => $request->input('name'),
            'status' => 1,
        ]);
        return redirect()->back()->with('message','State Added Successfully');
    }

    public function stateEdit($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $state = State::where('id',$id)->first();
        return view('admin.configuration.state.state_edit_form',compact('state'));
    }

    public function stateUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name'   => 'required',
        ]);
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        State::where('id',$id)->update([
            'name' => $request->input('name'),
        ]);
        return redirect()->back()->with('message','State Updated Successfully');
    }

    public function cityList()
    {
        return view('admin.configuration.city.city_list');
    }

    public function cityListAjax(Request $request)
    {
        return datatables()->of(City::get())
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn ='<a href="'.route('admin.city_edit',['id'=>encrypt($row->id)]).'" class="btn btn-warning btn-sm">Edit</a>';
            if ($row->status == '1') {
                $btn .='<a href="'.route('admin.city_status',['id'=>encrypt($row->id),'status'=>2]).'" class="btn btn-danger btn-sm" >Disable</a>';
            } else {
                $btn .='<a href="'.route('admin.city_status',['id'=>encrypt($row->id),'status'=>1]).'" class="btn btn-primary btn-sm" >Enable</a>';
            }            
            return $btn;
        })->addColumn('state', function($row){          
            return $row->state->name;
        })->addColumn('status_tab', function($row){
            if ($row->status == 1){
                return '<a class="btn btn-primary btn-sm">Enabled</a>';
            } else {
                return '<a class="btn btn-danger btn-sm">Disabled</a>';
            }
        })
        ->rawColumns(['action','status_tab','state'])
        ->make(true);
    }

    public function cityStatus($id,$status)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        City::where('id',$id)->update([
            'status' => $status,
        ]);
        return redirect()->back();
    }

    public function addCityForm()
    {
        $states = State::where('status',1)->orderBy('name')->get();
        return view('admin.configuration.city.city_add_form',compact('states'));
    }

    public function addCity(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'state'   => 'required',
        ]);

        City::create([
            'name' => $request->input('name'),
            'state_id' => $request->input('state'),
        ]);
        return redirect()->back()->with('message','City Added Successfully');
    }

    public function cityEdit($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $states = State::where('status',1)->get();
        $city = City::where('id',$id)->first();
        return view('admin.configuration.city.city_edit_form',compact('city','states'));
    }

    public function cityUpdate(Request $request, $id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $this->validate($request, [
            'name'   => 'required',
            'state'   => 'required',
        ]);

        City::where('id',$id)->update([
            'name' => $request->input('name'),
            'state_id' => $request->input('state'),
        ]);
        return redirect()->back()->with('message','City Updated Successfully');
    }

    public function cityListWithState($state_id)
    {
       $city = City::where('state_id',$state_id)->where('status',1)->orderBy('name','asc')->get();
       return $city;
    }


    public function serviceAreaList()
    {
        return view('admin.configuration.service_area.service_area_list');
    }

    public function serviceAreaListAjax(Request $request)
    {
        return datatables()->of(ServiceArea::get())
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn ='<a href="'.route('admin.serviceArea_edit',['id'=>encrypt($row->id)]).'" class="btn btn-warning btn-sm">Edit</a>';
            if ($row->status == '1') {
                $btn .='<a href="'.route('admin.serviceArea_status',['id'=>encrypt($row->id),'status'=>2]).'" class="btn btn-danger btn-sm" >Disable</a>';
            } else {
                $btn .='<a href="'.route('admin.serviceArea_status',['id'=>encrypt($row->id),'status'=>1]).'" class="btn btn-primary btn-sm" >Enable</a>';
            }            
            return $btn;
        })->addColumn('state', function($row){          
            return $row->state->name;
        })->addColumn('city', function($row){          
            return $row->city->name;
        })->addColumn('status_tab', function($row){
            if ($row->status == 1){
                return '<a class="btn btn-primary btn-sm">Enabled</a>';
            } else {
                return '<a class="btn btn-danger btn-sm">Disabled</a>';
            }
        })
        ->rawColumns(['action','status_tab','state'])
        ->make(true);
    }

    public function addServiceAreaForm()
    {
        $states = State::where('status',1)->orderBy('name')->get();
        return view('admin.configuration.service_area.service_area_add_form',compact('states'));
    }

    public function addServiceArea(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'state'   => 'required',
            'city'   => 'required',
            'pin'   => 'required',
        ]);

        ServiceArea::create([
            'area_name' => $request->input('name'),
            'state_id'   => $request->input('state'),
            'city_id'   => $request->input('city'),
            'pin'   => $request->input('pin'),
        ]);
        return redirect()->back()->with('message','Service Area Added Successfully');
    }

    
    public function serviceAreaStatus($id,$status)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        ServiceArea::where('id',$id)->update([
            'status' => $status,
        ]);
        return redirect()->back();
    }


    public function serviceAreaEdit($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $states = State::where('status',1)->get();
        $serviceArea = ServiceArea::where('id',$id)->first();
        $city = null;
        if (!empty($serviceArea->state_id)) {
            $city = City::where('state_id',$serviceArea->state_id)->get();
        }
        return view('admin.configuration.service_area.service_area_edit_form',compact('city','states','serviceArea'));
    }

    public function serviceAreaUpdate(Request $request, $id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $this->validate($request, [
            'name'   => 'required',
            'state'   => 'required',
            'city'   => 'required',
            'pin'   => 'required',
        ]);

        ServiceArea::where('id',$id)->update([
            'area_name' => $request->input('name'),
            'state_id'   => $request->input('state'),
            'city_id'   => $request->input('city'),
            'pin'   => $request->input('pin'),
        ]);

        return redirect()->back()->with('message','Service Area Updated Successfully');
    }

}
