<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Docate;
use App\DocateHistory;
use App\Contact;
class TrackingController extends Controller
{
   public function trackingDetails(Request $request){
      
       $track_id = $request->input('track_id');
      $docate_details = Docate::where('docate_id',$track_id)->first(); 
      $tracking_history = DocateHistory::where('docate_id',$track_id)->get();
       return view('web.tracking.trackingdetails',compact('docate_details','tracking_history'));

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
   
}
