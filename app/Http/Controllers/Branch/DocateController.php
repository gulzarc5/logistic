<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\City;
use App\State;
use App\Branch\Models\Docate;
use App\Branch\Models\DocateDetails;
use App\Branch\Models\Content;

class DocateController extends Controller
{
    public function addForm(){
        $city = City::where('status',1)->get();
        $state = State::where('status',1)->get();
        
        return view('branch.outbound.docate_entry',compact('city','state'));
    }

    public function addDocate(Request $request){
        
        $this->validate($request, [
            'origin'=>'required|numeric',
            'destination'=>'required',
            'payment_type'=>'required',
            'sender_name'=>'required',
            'sender_state'=>'required|numeric',
            'sender_city' =>'required|numeric',
            'sender_pin'=>'required|numeric',
            'sender_address'=>'required',
            'receiver_name'=>'required',
            'receiver_state'=>'required|numeric',
            'receiver_city'=>'required|numeric',
            'receiver_pin'=> 'required|numeric',
            'receiver_address'=> 'required',
            'box'=>'required',
            'actual_weight'=>'required',
            'chargeable_weight'=>'required',
            'invoice'=>'required',
            'content.*'=>'required',
            'length.*'=>'required',
            'breadth.*'=>'required',
            'height.*'=>'required',
            'total.*'=>'required'       
        ]);    
        $docate = new Docate();        
        $docate->payment_option =$request->input('payment_type');
        $docate->collecting_amount = $request->input('amount');
        $docate->origin = $request->input('origin');
        $docate->send_mode = $request->input('destination');
        $docate->no_of_box = $request->input('box');        
        $docate->actual_weight = $request->input('actual_weight');
        $docate->chargeable_weight = $request->input('chargeable_weight');
        $docate->invoice_value = $request->input('invoice');
        $docate->branch_id = 3;
        
        if($docate->save()){
            $this->srDetailsInsert($request,$docate);
            $this->generateDocateID($docate);

            $content = $request->input('content');
            
            $length = $request->input('length');
            $breadth = $request->input('breadth');
            $height = $request->input('height');
            $total = $request->input('total');

            for ($i=0; $i < count($content); $i++) { 
                $contents= new Content();
                $contents->content = $content[$i];
                $contents->length = $length[$i];
                $contents->breadth = $breadth[$i];
                $contents->height = $height[$i];
                $contents->total = $total[$i];
                $contents->save();
            }
            return redirect()->back()->with('message','Docate Added Successfully');
        }
    }

    private function srDetailsInsert($request,$docate){
        $docate_details = new DocateDetails();
        $docate_details->docate_id=$docate->id;
        $docate_details->name = $request->input('sender_name');
        $docate_details->state = $request->input('sender_state');
        $docate_details->city = $request->input('sender_city');
        $docate_details->pin = $request->input('sender_pin');
        $docate_details->address = $request->input('sender_address');
        $docate_details->save();
        if($docate_details->save()){
            $docate->sender_id = $docate_details->id;                
            $docate->save();
        }
        $docate_details = new DocateDetails();
        $docate_details->docate_id=$docate->id;
        $docate_details->state = $request->input('receiver_state');
        $docate_details->city = $request->input('receiver_city');
        $docate_details->name = $request->input('receiver_name');
        $docate_details->pin = $request->input('receiver_pin');
        $docate_details->address = $request->input('receiver_address');
        $docate_details->save();
        if($docate_details->save()){
            $docate->receiver_id = $docate_details->id;
            $docate->save();
        }
        return 1;
    }

    public function generateDocateID($docate){
        $length = (5-strlen((string)$docate->id));
        $id = 'D';
        
        for ($i=0; $i < $length ; $i++) { 
            $id.="0";
        }        
        $docate->docate_id=$id.$docate->id;
        $docate->save();
        return true;
    }

    public function cityList($state_id){
        
        $city = City::where('state_id',$state_id)->where('status',1)->get();
        return $city;

    }
}
