<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch\Models\Docate;

class InquiryController extends Controller
{
    public function showInquiryForm(){
        return view('branch.outbound.inquiry_form');
    }

    public function detailsForm(){
        return view('branch.outbound.inquiry_form');
    }
    public function getDetails(Request $request){
        $docate_id = $request->input('docate_id');
        $docate_data = Docate::where('docate.docate_id',$docate_id)
                        ->join('city as origin_city','origin_city.id','docate.origin')
                        ->join('docate_details','docate.id','=','docate_details.docate_id')
                        ->join('docate_details as sender_details','docate.sender_id','=','sender_details.id')
                        ->join('docate_details as receiver_details','docate.receiver_id','=','receiver_details.id')
                        ->join('city as sender_city','sender_city.id','=','sender_details.city')
                        ->join('state as sender_state','sender_state.id','=','sender_details.state')
                        ->join('city as receiver_city','receiver_city.id','=','receiver_details.city')
                        ->join('state as receiver_state','receiver_state.id','=','receiver_details.state')
                        ->select('docate.*','origin_city.name as origin_city','sender_details.name as sender_name','sender_city.name as sender_city','sender_details.pin as sender_pin','sender_state.name as sender_state','sender_details.address as sender_address','receiver_details.name as receiver_name','receiver_city.name as receiver_city','receiver_details.pin as receiver_pin','receiver_state.name as receiver_state','receiver_details.address as receiver_address')
                        ->first();
        
        $manifest_data = Docate::where('docate.docate_id',$docate_id)
                        ->join('manifest','manifest.id','=','docate.manifest_id')
                        ->join('docate_details as receiver_name','receiver_name.id','=','docate.receiver_id')
                        ->join('city as origin_city','origin_city.id','=','docate.origin')
                        ->join('city as destination_city','destination_city.id','=','receiver_name.city')
                        ->select('docate.*','manifest.created_at as date','manifest.manifest_no as manifest_no','origin_city.name as origin_city','receiver_name.name as receiver_name','destination_city.name as destination_city')
                        ->first();
        $baging_data = Docate::where('docate.docate_id',$docate_id)
                        ->join('baging','baging.id','=','docate.baging_id')
                        ->join('manifest','manifest.id','baging.manifest_id')
                        ->join('docate_details as receiver_name','receiver_name.id','=','docate.receiver_id')
                        ->join('city as origin_city','origin_city.id','=','docate.origin')
                        ->join('city as destination_city','destination_city.id','=','receiver_name.city')
                        ->select('docate.*','baging.created_at as date','baging.lock_no as lock_no','origin_city.name as origin_city','receiver_name.name as receiver_name','destination_city.name as destination_city','manifest.manifest_no as manifest_no as manifest_no','manifest.created_at as created_data')
                        ->first();
        $sector_data = Docate::where('docate.docate_id',$docate_id)
                        ->join('sector_booking','sector_booking.id','=','docate.sector_id')
                        ->join('docate_details as receiver_name','receiver_name.id','=','docate.receiver_id')
                        ->join('city as origin_city','origin_city.id','=','docate.origin')
                        ->join('city as destination_city','destination_city.id','=','receiver_name.city')
                        ->join('manifest','manifest.id','=','sector_booking.manifest_id')
                        ->select('manifest.manifest_no as manifest_no','sector_booking.date as date','sector_booking.*','docate.*','destination_city.name as destination','origin_city.name as origin')
                        ->first();
        
        return view('branch.outbound.inquiry_form',compact('docate_data','manifest_data','baging_data','sector_data'));
      
        
    }

   

}
