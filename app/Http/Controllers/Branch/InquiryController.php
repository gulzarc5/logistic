<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Docate;
use Auth;
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
                        ->where('docate.branch_id',Auth::user()->id)
                        ->join('docate_details','docate.id','=','docate_details.docate_id')
                        ->join('docate_details as sender_details','docate.sender_id','=','sender_details.id')
                        ->join('city as origin_city','origin_city.id','sender_details.city')
                        ->join('docate_details as receiver_details','docate.receiver_id','=','receiver_details.id')
                        ->join('state as sender_state','sender_state.id','=','sender_details.state')
                        ->join('city as receiver_city','receiver_city.id','=','receiver_details.city')
                        ->join('state as receiver_state','receiver_state.id','=','receiver_details.state')
                        ->select('docate.*','origin_city.name as origin_city','sender_details.name as sender_name','sender_details.pin as sender_pin','sender_state.name as sender_state','sender_details.address as sender_address','receiver_details.name as receiver_name','receiver_city.name as receiver_city','receiver_details.pin as receiver_pin','receiver_state.name as receiver_state','receiver_details.address as receiver_address')
                        ->first();
        
        $manifest_data = Docate::where('docate.docate_id',$docate_id)
                        ->where('docate.branch_id',Auth::user()->id)
                        ->join('manifest','manifest.id','=','docate.manifest_id')
                        ->join('docate_details as receiver_name','receiver_name.id','=','docate.receiver_id')
                        ->join('city as origin_city','origin_city.id','=','manifest.origin')
                        ->join('city as destination_city','destination_city.id','=','manifest.destination')
                        ->select('docate.*','manifest.created_at as date','manifest.manifest_no as manifest_no','origin_city.name as origin_city','receiver_name.name as receiver_name','destination_city.name as destination_city')
                        ->first();
        $baging_data = Docate::where('docate.docate_id',$docate_id)
                        ->where('docate.branch_id',Auth::user()->id)
                        ->join('manifest','manifest.id','=','docate.manifest_id')
                        ->join('baging','baging.manifest_id','=','manifest.id')
                        ->join('docate_details as receiver_name','receiver_name.id','=','docate.receiver_id')
                        ->join('city as origin_city','origin_city.id','=','baging.origin')
                        ->join('city as destination_city','destination_city.id','=','baging.destination')
                        ->select('docate.*','baging.created_at as date','baging.lock_no as lock_no','origin_city.name as origin_city','receiver_name.name as receiver_name','destination_city.name as destination_city','manifest.manifest_no as manifest_no as manifest_no','manifest.created_at as created_data')
                        ->first();
        $sector_data = Docate::where('docate.docate_id',$docate_id)
                        ->where('docate.branch_id',Auth::user()->id)
                        ->join('manifest','manifest.id','=','docate.manifest_id')
                        ->join('baging','baging.manifest_id','=','manifest.id')
                        ->join('sector_booking as sector_manifest','sector_manifest.manifest_id','=','manifest.id')
                        ->join('sector_booking as sector_baging','sector_baging.bagging_id','=','baging.id')
                        ->join('docate_details as receiver_name','receiver_name.id','=','docate.receiver_id')
                        ->join('city as origin_city','origin_city.id','=','sector_baging.origin')
                        ->join('city as destination_city','destination_city.id','=','sector_baging.destination')
                        ->select('manifest.manifest_no as manifest_no','sector_baging.book_date as date','sector_baging.*','docate.*','destination_city.name as destination','origin_city.name as origin')
                        ->first();
        
        return view('branch.outbound.inquiry_form',compact('docate_data','manifest_data','baging_data','sector_data'));
      
        
    }

   

}
