<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Docate;
use App\DocateHistory;
use App\Contact;
use App\Partner;
use App\Freight;
use App\PartnerFreight;
class TrackingController extends Controller
{
   public function trackingDetails(Request $request){
      
       $track_id = $request->input('track_id');
      $docate_details = Docate::where('docate_id',$track_id)->first(); 
      $tracking_history = DocateHistory::where('docate_id',$track_id)->get();
       return view('web.tracking.trackingdetails',compact('docate_details','tracking_history'));

   }

   public function deliveryExecutive(){
       $freight= Freight::get();
       return view('web.delivery.delivery-executive',compact('freight'));
   }

   public function franchise(){
    $freight= Freight::get();
    return view('web.franchise.franchise',compact('freight'));

   }
   public function addContacts(Request $request){
      
    $this->validate($request, [
        'name'=>'required',
        'email' =>'required',
        'message'=>'required'
    ]);
   
    $contact = new Contact();
    $contact->name = $request->input('name');
    $contact->email = $request->input('email');
    $contact->subject = $request->input('subject');
    $contact->phone = $request->input('phone');
    $contact->message = $request->input('message');
    $contact->save();
    if($contact->save()){
        return redirect()->back();
    }

    }

    public function addPartner(Request $request,$type){
        
        $this->validate($request, [
            'first_name'=>'required',
            'last_name'=>'required',
            'email_address'=>'required',
            'phone'=>'required|numeric',
            'city'=>'required',
            'state'   => 'required',
            'bike'=>'required|numeric',
            'special_info'=>'required',
            'freight_type'=>'array'
        ]);
        
        $partner = new Partner();
        $partner->partner_type = $type;
        $partner->first_name=$request->input('first_name');
        $partner->last_name = $request->input('last_name');
        $partner->email_address = $request->input('email_address');
        $partner->phone = $request->input('phone');
        $partner->city = $request->input('city');
        $partner->state = $request->input('state');
        $partner->bike = $request->input('bike');
        $partner->special_info = $request->input('special_info');
        
        if($partner->save()){
            $freight_type=$request->input('freight_type');
           foreach ($freight_type as $data){
               $partner_freight=new PartnerFreight();
               $partner_freight->partner_id=$partner->id;
               $partner_freight->freight_id=$data;
               $partner_freight->save();
           }
        }

        return redirect()->back();
   
    }
}
