<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\EnqueryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnquiryRequestController extends Controller
{

    public function cityList($state_id)
    {
        $city = City::where('state_id',$state_id)->where('status',1)->get();
        return $city;
    }
    public function list()
    {
        return view('admin.enquiry_request.list');
    }

    public function listAjax()
    {
        return datatables()->of(EnqueryRequest::latest()->get())
        ->addIndexColumn()
        ->addColumn('source_state', function($row){          
            return $row->sourceState->name;
        })
        ->addColumn('source_city', function($row){          
            return $row->sourceCity->name;
        })
        ->addColumn('destination_state', function($row){          
            return $row->destinationState->name;
        })
        ->addColumn('destination_city', function($row){          
            return $row->destinationCity->name;
        })
        ->addColumn('action', function($row){
            $btn ='<a href="'.route('admin.enqueryRequest.details',['id'=>$row->id]).'" class="btn btn-primary btn-sm">View</a>';          
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    public function details($id)
    {
        $user = EnqueryRequest::findOrFail($id);
        return view('admin.enquiry_request.details',compact('user'));
    }
    public function submit(Request $request)
    {
        $this->Validate($request, [
            'source_state' => 'required|numeric|exists:state,id',
            'source_city' => 'required|numeric|exists:city,id',
            'source_pin' => 'required|numeric|digits:6',
            'source_area' => 'required|string|max:50',
            'source_address' => 'required|string|max:100',
            'destination_state' => 'required|numeric|exists:state,id',
            'destination_city' => 'required|numeric|exists:city,id',
            'destination_pin' => 'required|numeric|digits:6',
            'destination_area' => 'required|string|max:50',
            'destination_address' => 'required|string|max:100',
            'description' => 'required|string|max:200',
        ]);

        $enquery = new EnqueryRequest();
        $enquery->source_state = $request->input('source_state');
        $enquery->source_city = $request->input('source_city');
        $enquery->source_pin = $request->input('source_pin');
        $enquery->source_area = $request->input('source_area');
        $enquery->source_address = $request->input('source_address');
        $enquery->destination_state = $request->input('destination_state');
        $enquery->destination_city = $request->input('destination_city');
        $enquery->destination_pin = $request->input('destination_pin');
        $enquery->destination_area = $request->input('destination_area');
        $enquery->destination_address = $request->input('destination_address');
        $enquery->description = $request->input('description');
        $enquery->save();
        $response = [
            'status' => true,
            'message' => "Request Send Successfully",
        ];
        return response()->json($response, 200);

    }
}
