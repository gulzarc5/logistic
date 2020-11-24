<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Docate;

class ReportController extends Controller
{
    public function reportForm(){
        return view('branch.outbound.report_form');
    }

    public function fetchAllEntries(Request $request){
        $type= $request->input('report_type');
        if($type =1){
            $docate_data = Docate::select('docate.*','receiver.name as receiver_name','sender.name as sender_name','origin_city.name as origin_city_name','destination_city.name as destination_city_name')
                            ->where('docate.status',1)
                            ->where('branch_id',Auth::user()->id)
                            ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                            ->join('docate_details as sender','sender.id','=','docate.sender_id')
                            ->join('city as origin_city','origin_city.id','=','sender.city')
                            ->join('city as destination_city','destination_city.id','=','receiver.city')
                            ->get();
           
            return view('branch.outbound.report_form',compact('docate_data'));
        }elseif($type=2){
            $manifest_data = Docate::where('branch_id',Auth::user()->id)
                            ->join('manifest','manifest.id','=','docate.manifest_id')
                            ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                            ->join('city as origin_city','origin_city.id','=','manifest.origin')
                            ->join('city as destination_city','destination_city.id','=','manifest.destination')
                            ->join('docate_details','docate_details.id','=','docate.sender_id')
                            ->where(function($q){
                                $q->where('docate.courier_status',2)
                                ->orWhere('docate.courier_status',6);
                            })
                            ->select('docate.*','manifest.*','origin_city.name as origin_city_name','destination_city.name as destination_city_name','receiver.name as receiver_name','docate_details.name as sender_name')
                            ->get();
            

                           
                                    
            return view('branch.outbound.report_form',compact('manifest_data'));
                        
        }elseif($type=3){
            $baged_data = Docate::where('branch_id',Auth::user()->id)
                        ->join('manifest','manifest.id','=','docate.manifest_id')
                        ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                        ->join('baging','baging.manifest_id','=','manifest.id')
                        ->join('city as origin_city','origin_city.id','=','baging.origin')
                        ->join('city as destination_city','destination_city.id','=','baging.destination')
                        ->join('docate_details','docate_details.id','=','docate.sender_id')
                        ->where('docate.courier_status',3)
                        ->select('docate.*','baging.lock_no as lock_no','origin_city.name as origin_city','destination_city.name as destination_city_name','receiver.name as receiver_name','docate_details.name as sender_name','manifest.manifest_no as manifest_no')
                        ->get();
                        
            return view('branch.outbound.report_form',compact('baged_data'));
        }else{
            $sector_data = Docate::where('branch_id',Auth::user()->id)
                        ->join('manifest','manifest.id','=','docate.manifest_id')
                        ->join('sector_booking','sector_booking.manifest_id','=','manifest.id')
                        ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                        ->join('city as origin_city','origin_city.id','=','sector_booking.origin')
                        ->join('city as destination_city','destination_city.id','=','sector_booking.destination')
                        ->join('docate_details','docate_details.id','=','docate.sender_id')
                        ->where('docate.status',4)
                        ->select('docate.*','sector_booking.*','origin_city.name as origin_city','destination_city.name as destination_city_name','receiver.name as receiver_name','docate_details.name as sender_name','manifest.manifest_no as manifest_no')
                        ->get();
                
            return view('branch.outbound.report_form',compact('sector_data'));
        }


       

    }
}

