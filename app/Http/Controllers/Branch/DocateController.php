<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\City;
use App\State;
use App\Docate;
use App\DocateDetails;
use App\Content;
use App\DocateHistory;
use Carbon\Carbon;
use DB;
use Auth;
class DocateController extends Controller
{
    public function addForm(){
        $city = City::where('status',1)->get();
        $state = State::where('status',1)->get();
        
        return view('branch.outbound.docate_entry',compact('city','state'));
    }

    public function addDocate(Request $request){
        
        
        $this->validate($request, [
            'cn_no'=>'required',
            'mode'=>'required',
            'pickup_date'=>'required|date',
            'pickup_time'=>'required',
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
            'invoice_no'=>'required',
            'content'=>'required|array|min:1',
            'length'=>'required|array|min:1',
            'breadth'=>'required|array|min:1',
            'height'=>'required|array|min:1',
            'total'=>'required|array|min:1'
        ]);   
        
       
    try {
        $docate_id = '';
        DB::transaction(function () use ($request, & $docate_id) {    
        $docate = new Docate();        
        $docate->payment_option =$request->input('payment_type');
        if(!empty($request->input('amount'))){
            $docate->collecting_amount = $request->input('amount');
        }
        $cn_no = $request->input('cn_no');
        $docate->send_mode = $request->input('mode');
        $docate->no_of_box = $request->input('box');        
        $docate->actual_weight = $request->input('actual_weight');
        $docate->chargeable_weight = $request->input('chargeable_weight');
        $docate->invoice_value = $request->input('invoice');
        $docate->invoice_no = $request->input('invoice_no');
        $docate->branch_id = Auth::user()->id;
        $docate->pickup_date =$request->input('pickup_date');
        $docate->pickup_time = $request->input('pickup_time');
        $docate->save();

            $this->srDetailsInsert($request,$docate);
            $this->generateDocateID($docate,$cn_no);
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
            $docate_id = $docate->id;
    
        });
        return redirect()->route('branch.docate_info',$docate_id);
    }catch (\Exception $e) {
        return redirect()->back()->with('error', 'Something went Wrong! Try after sometime!');
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

    public function generateDocateID($docate,$cn_no){
        $docate->docate_id=$cn_no;
        $docate->save();
        $docate_history = new DocateHistory();
        $docate_history->docate_id = $docate->docate_id;
        $docate_history->data_id = $docate->id;
        $docate_history->type=1;
        $docate_history->comments = "Docate Booked";
        $docate_history->save();
        return true;
    }

    public function cityList($state_id){
        
        $city = City::where('state_id',$state_id)->where('status',1)->get();
        return $city;

    }

    public function docateInfo($docate_id){
        $docate_data = Docate::where('docate.id',$docate_id)
                        ->where('branch_id',Auth::user()->id)
                        ->join('docate_details','docate_details.docate_id','=','docate.id')
                        ->join('docate_details as sender_details','sender_details.id','=','docate.sender_id')
                        ->join('docate_details as receiver_details','receiver_details.id','=','docate.receiver_id')
                        ->join('city as origin','origin.id','=','sender_details.city')
                        ->join('city as destination','destination.id','=','receiver_details.city')
                        ->join('city as sender_city','sender_city.id','=','sender_details.city')
                        ->join('city as receiver_city','receiver_city.id','=','receiver_details.city')
                        ->join('state as sender_state','sender_state.id','=','sender_details.state')
                        ->join('state as receiver_state','receiver_state.id','=','receiver_details.state')
                        ->select('docate.*','origin.name as origin_city','destination.name as destination_city','sender_details.pin as sender_pin','sender_details.address as sender_address','receiver_details.pin as receiver_pin','receiver_details.address as receiver_address','sender_details.name as sender_name','receiver_details.name as receiver_name','sender_city.name as sender_city','receiver_city.name as receiver_city','sender_state.name as sender_state','receiver_state.name as receiver_state')
                        ->first();
                          
        return view('branch.outbound.docate_info',compact('docate_data'));
    }

    public function checkDocate($cn_no){
        $check_docate = Docate::where('docate_id',$cn_no)->count();
        if($check_docate>0){
            return 1;
        }else{
            return 2;
        }
    }
}
