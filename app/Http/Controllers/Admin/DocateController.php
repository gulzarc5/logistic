<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Docate;
use App\DocateDetails;
use App\User;
use App\Content;
use App\City;
use App\State;
class DocateController extends Controller
{
    public function docateList(){
        $branches = User::where('user_role',3)->get();
        return view('admin.outbound.docate_list',compact('branches'));
    }

    public function docateListAjax(Request $request){
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $branch_id = $request->get('branch_id');
        $docate = Docate::OrderBy('id','desc');
        if (!empty($start_date) && !empty($end_date)) {
            $docate->whereDate('created_at','>=', $start_date)
                ->whereDate('created_at','<=', $end_date);
        }
        if ($branch_id) {
            $docate->where('branch_id',$branch_id);
        }
        return datatables()->of($docate->get())
            ->addIndexColumn()
            ->addColumn('origin', function ($docate) {
                return isset($docate->sender->cityName->name)?$docate->sender->cityName->name:'';
            })->addColumn('destination', function ($docate) {
                return isset($docate->receiver->cityName->name)?$docate->receiver->cityName->name:'';
            })->addColumn('payment_type_btn', function ($docate) {
                if($docate->payment_type == 'c'){
                    return "<button class='btn btn-xs btn-warning'>Credit</button>";
                }elseif($docate->payment_type == 'cod'){
                    return "<button class='btn btn-xs btn-primary'>To Pay</button>";
                }else{
                    return "<button class='btn btn-xs btn-success'>Cash</button>";
                }
            })->addColumn('status_tab', function ($row) {
                if ($row->courier_status == '1') {
                    $btn = '<button type="button" class="btn btn-xs  btn-warning">Booked</button>';
                } elseif ($row->courier_status == '2') {
                    $btn = '<button type="button" class="btn btn-xs btn-info">Manifested</button>';
                } elseif ($row->courier_status == '3') {
                    $btn = '<button type="button" class="btn btn-xs btn-primary">Begged</button>';
                }elseif ($row->courier_status == '4') {
                    $btn = '<button type="button" class="btn btn-xs btn-success">Sector Booked</button>';
                }elseif ($row->courier_status == '5' || $row->courier_status == '6') {
                    $btn = '<button type="button" class="btn btn-xs btn-warning">Pickup</button>';
                }elseif ($row->courier_status == '7') {
                    $btn = '<button type="button" class="btn btn-xs btn-info">DRS Prepared</button>';
                }elseif ($row->courier_status == '8') {
                    $btn = '<button type="button" class="btn btn-xs btn-success">Delivered</button>';
                }elseif ($row->courier_status == '9') {
                    $btn = '<button type="button" class="btn btn-xs btn-danger">Delivery Delayed</button>';
                }
                return $btn;
                
            })->addColumn('action', function ($docate){
                if($docate){
                    $btn = '<a href="' . route('admin.view_details', ['id' => $docate->id]) . '" class="btn btn-info btn-xs" target="_blank">View</a>';
                    if($docate->courier_status == 1){
                        $btn .= '<a href="' . route('admin.delete_docate', ['id' => $docate->id]) . '" class="btn btn-xs btn-danger" onclick="return confirm(\'Are You Sure To Delete ?\')">Delete</a>';
                    }
                    $btn .= '<a href="' . route('admin.edit_form', ['id' => $docate->id]) . '" class="btn btn-xs btn-primary"  target="_blank">Edit</a>';
                    return $btn;
                }else{
                    return null;
                }
            })->rawColumns(['action', 'status_tab','origin', 'destination','payment_type_btn'])
            ->make(true);
    }

    public function viewDetails($id){
        $docate_data = Docate::where('id',$id)->first();
        return view('admin.outbound.docate_details',compact('docate_data'));

    }

    public function deleteDocate($id){
        $docate = Docate::where('id',$id)->first();
        if($docate->courier_status ==1){
            $docate->delete();
            if($docate){
                $docate_details = DocateDetails::where('docate_id',$docate->id)->delete();
                $content = Content::where('docate_id',$id)->delete();
                if($content){
                    return redirect()->back();
                }

            }
        }else{
            return redirect()->back()->with('error','Docate Already Manifested cannot be deleted');
        }
    }

    public function editForm($id){
        $docate_details = Docate::where('id',$id)->first();
        $sender_city = null;
        $receiver_city = null;
        if (isset($docate_details->sender->cityName->state->id) && !empty($docate_details->sender->cityName->state->id)) {
            $sender_city = City::where('state_id',$docate_details->sender->cityName->state->id)->where('status',1)->get();
        }
        if (isset($docate_details->receiver->cityName->state->id) && !empty($docate_details->receiver->cityName->state->id)) {
            $receiver_city = City::where('state_id',$docate_details->receiver->cityName->state->id)->where('status',1)->get();
        }
        $state = State::get();
        
        $content_count = Content::where('docate_id',$id)->count();
        return view('admin.outbound.docate_edit_form',compact('docate_details','sender_city','state','content_count','receiver_city'));
    }

    public function cityList($state_id){        
        $city = City::where('state_id',$state_id)->where('status',1)->get();
        return $city;
    }

    public function updateDocate(Request $request,$id){
       $this->validate($request, [
            'mode'=>'required',
            'payment_type'=>'required',
            'pickup_date'=>'required|date',
            'pickup_time'=>'required',
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
            'invoice_value'=>'required',
            'invoice_no'=>'required',
            'content'=>'required|array|min:1',
            'content_id'=>'required|array|min:1',
            'length'=>'required|array|min:1',
            'breadth'=>'required|array|min:1',
            'height'=>'required|array|min:1',
            'total'=>'required|array|min:1'
        ]);
         
        $docate = Docate::findOrFail($id);
        $docate->send_mode = $request->input('mode');
        $docate->payment_option = $request->input('payment_type');
        $docate->pickup_date = $request->input('pickup_date');
        $docate->pickup_time= $request->input('pickup_time');
        if(!empty($request->input('collecting_amount'))){
            $docate->collecting_amount = $request->input('collecting_amount');
        }
        $docate->actual_weight = $request->input('actual_weight');
        $docate->chargeable_weight = $request->input('chargeable_weight');
        $docate->invoice_value = $request->input('invoice_value');
        $docate->invoice_no = $request->input('invoice_no');
        if($docate->save()){
            $receiver_details = DocateDetails::where('id',$docate->receiver_id)->first();
            if ($receiver_details) {
                $receiver_details->state = $request->input('receiver_state');
                $receiver_details->city = $request->input('receiver_city');
                $receiver_details->name = $request->input('receiver_name');
                $receiver_details->pin = $request->input('receiver_pin');
                $receiver_details->address = $request->input('receiver_address');
                $receiver_details->save();
            }
            $sender_details = DocateDetails::where('id',$docate->sender_id)->first();
            if ($sender_details) {
                $sender_details->state = $request->input('sender_state');
                $sender_details->city = $request->input('sender_city');
                $sender_details->name = $request->input('sender_name');
                $sender_details->pin = $request->input('sender_pin');
                $sender_details->address = $request->input('sender_address');
                $sender_details->save();
            }
            $content = $request->input('content');
            $length = $request->input('length');
            $breadth = $request->input('breadth');
            $height = $request->input('height');
            $total = $request->input('total');
            $content_id = $request->input('content_id'); 
            $number_of_box = $docate->no_of_box;
            
            for ($i=0; $i < count($content); $i++) {
                if(isset($content_id[$i]) && !empty($content_id[$i])){
                    $contents = Content::where('id',$content_id[$i])->first();
                    if ($contents) {
                        $contents->content = $content[$i];
                        $contents->length = $length[$i];
                        $contents->breadth = $breadth[$i];
                        $contents->height = $height[$i];
                        $contents->total = $total[$i];
                        $contents->save();
                    }            
                }else{
                    $contents =  new Content();
                    $contents->docate_id = $docate->id;
                    $contents->content = $content[$i];
                    $contents->length = $length[$i];
                    $contents->breadth = $breadth[$i];
                    $contents->height = $height[$i];
                    $contents->total = $total[$i];
                    $contents->save();
                    $number_of_box++;
                }
            }
            $docate->no_of_box = $number_of_box;
            $docate->save();
        }           
        return redirect()->back()->with('message','Docate Details Updated Successfully');
    }

    public function removeContent($content_id){
        $content = Content::where('id',$content_id)->first();
        $docate = Docate::where('id',$content->docate_id)->first();
        $docate->no_of_box = $docate->no_of_box -1;
        $docate->save();
        $content->delete();
        return 1;
    }

    

    

   
    
}
