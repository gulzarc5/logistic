<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Docate;
use App\DocateHistory;
use App\SectorBooking;
use App\SectorDetails;
use App\inbound;;
use DB;
use Carbon\Carbon;
use Auth;

class InboundController extends Controller
{
    public function sectorPickupForm(){
        return view('branch.inbound.sector_pickup_form');
    }
    
    public function fetchAddForm($cd_no){
        $data = Docate::join('sector_booking','sector_booking.id','=','docate.sector_id')
                        ->join('docate_details as sender','sender.id','=','docate.sender_id')
                        ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                        ->where('sector_booking.cd_no',$cd_no)
                        ->where('sector_booking.branch_id',Auth::user()->id)
                        ->where('docate.courier_status',4)
                        ->select('docate.*','sector_booking.id as sector_booking_id','sender.name as sender_name','receiver.name as receiver_name','sector_booking.cd_no as cd_no')
                        ->get();
        
        if(count($data)>0){
            return $data;

        }else{
            return 2;
        }

    }

    public function sectorPickupDone(Request $request){
        try {
            DB::transaction(function () use ($request) {
               
                $docate_ids = $request->input('docate_id');
                foreach($docate_ids as $docates){
                  
                    $docate = Docate::where('id',$docates)->where('branch_id',Auth::user()->id)->first();
                  
                    $sector = SectorBooking::where('cd_no',$request->input('cd_no'))->first();
                  

                    if($docate->courier_status = 4){
                        $inbound = new Inbound();
                        $inbound->cd_no = $request->input('cd_no');
                        $inbound->docate_no = $docate->docate_id;
                        $inbound->status = 1;
                        $inbound->save();
                        $docate->courier_status =5;
                        $docate->status = 5;
                        $docate->save();
                        if($docate){
                            $docate_history = new DocateHistory();
                            $docate_history->docate_id = $docate->docate_id;
                            $docate_history->type=5;
                            $docate_history->data_id = $docate->id;
                            $docate_history->comments = "Sector Pick Up Done";
                            $docate_history->save();
                            $sector_details = new SectorDetails();
                            $sector_details->status=2;
                            $sector_details->sector_id=$sector->id;
                            $sector_details->baging_id=$sector->bagging_id;
                            $sector_details->save();
                            
                        }
                    }
            }
            
            
            });
            return redirect()->back()->with('message','Sector Pickup Done Successfully');
           
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Something went Wrong! Try after sometime!');
            }
    }

    public function drsPreparedForm(){
       return view('branch.inbound.drs_prepared_form');
    }

    public function fetchDrsPreparedForm($cd_no){
        $data = Docate::join('inbound','inbound.docate_no','=','docate.docate_id')
                        ->join('sector_booking','sector_booking.id','=','docate.sector_id')
                        ->join('docate_details as sender','sender.id','=','docate.sender_id')
                        ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                        ->where('sector_booking.cd_no',$cd_no)
                        ->where('sector_booking.branch_id',Auth::user()->id)
                        ->where(function($q){
                            $q->where('docate.courier_status',5)
                            ->orWhere('docate.courier_status',9);
                        })
                        ->where(function($q){
                            $q->where('inbound.status',1)
                            ->orWhere('inbound.status',4);
                        })
                        ->select('docate.*','sector_booking.id as sector_booking_id','sender.name as sender_name','receiver.address as receiver_address','receiver.name as receiver_name','sector_booking.cd_no as cd_no')
                        ->get();
        
        if(count($data)>0){
            return $data;

        }else{
            return 2;
        }

    }

    public function drsPreparedDone(Request $request){
        $this->validate($request, [
            'de_name'   => 'required',
            'de_date'   => 'required',
            'de_time'   => 'required',
            'vehicle_no'   => 'required',
        ]);
        try {
            DB::transaction(function () use ($request) {
               
                $docate_ids = $request->input('docate_id');
                foreach($docate_ids as $docates){
                    $docate = Docate::where('id',$docates)->where('branch_id',Auth::user()->id)->first();
                    $sector = SectorBooking::where('cd_no',$request->input('cd_no'))->first();
                    if($docate->courier_status = 5 || $docate->courier_status = 9){
                        $inbound = Inbound::where('cd_no',$request->input('cd_no'))->first();
                       
                        $inbound->status = 2;
                        $inbound->de_name = $request->input('de_name');
                        $inbound->vehicle_no = $request->input('vehicle_no');
                        $inbound->drs_date = $request->input('de_date');
                        $inbound->drs_time = $request->input('de_time');
                        $inbound->save();
                        if($inbound->save()){
                            $id = str_pad(Auth::user()->name, 5, '0',STR_PAD_LEFT);
                            $inbound->drs_no = $id.$inbound->id;
                            $inbound->save();
                        }
                       
                        $docate->courier_status =7;
                        $docate->status = 6;
                        $docate->save();
                        if($docate){
                            $docate_history = new DocateHistory();
                            $docate_history->docate_id = $docate->docate_id;
                            $docate_history->type=7;
                            $docate_history->data_id = $docate->id;
                            if($docate->courier_status = 5){
                            $docate_history->comments = "Drs Prepared";
                            }else{
                                if($docate->courier_status = 9){
                                $docate_history->comments = "Drs Reprepared";
                                }
                            }
                            $docate_history->save();
                         

                        }
                    }
            }
            
            
            });
            return redirect()->back()->with('message','Drs Prepared Successfully');
           
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Something went Wrong! Try after sometime!');
            }
    }

    public function drsClosedForm(){
        return view('branch.inbound.drs_close_form');
     }

     public function fetchDrsCloseForm($drs_no){
        $data = Docate::join('inbound','inbound.docate_no','=','docate.docate_id')
                        ->join('sector_booking','sector_booking.id','=','docate.sector_id')
                        ->join('docate_details as sender','sender.id','=','docate.sender_id')
                        ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                        ->where('inbound.drs_no',$drs_no)
                        ->where('sector_booking.branch_id',Auth::user()->id)
                        ->where('docate.courier_status',7)
                        ->select('docate.*','inbound.*','sector_booking.id as sector_booking_id','sender.name as sender_name','receiver.address as receiver_address','receiver.name as receiver_name','sector_booking.cd_no as cd_no')
                        ->get();

        
        
        if(count($data)>0){
            return $data;

        }else{
            return 2;
        }

    }

    public function drsCloseDone(Request $request){
        
        $this->validate($request, [
            'received_by'   => 'required',
            'del_date'   => 'required',
            'del_time'   => 'required',
            
        ]);
       
        try {
            DB::transaction(function () use ($request) {
               
                $docate_ids = $request->input('docate_id');
                foreach($docate_ids as $docates){
                    $docate = Docate::where('id',$docates)->where('branch_id',Auth::user()->id)->first();
                    $sector = SectorBooking::where('cd_no',$request->input('cd_no'))->first();
                    if($docate->courier_status = 7){
                       
                        $docate->courier_status =8;
                        $docate->status = 7;
                        $docate->save();
                        if($docate){
                            $docate_history = new DocateHistory();
                            $docate_history->docate_id = $docate->docate_id;
                            $docate_history->type=8;
                            $docate_history->data_id = $docate->id;
                            $docate_history->comments = "Drs Closed";
                            $docate_history->save();
                            $inbound = Inbound::where('drs_no',$request->input('drs_no'))->first();
                            if($inbound->status = 2){
                                $inbound->status = 3;
                                $inbound->received_by = $request->input('received_by');
                              
                                $inbound->delivery_date = $request->input('del_date');
                                $inbound->delivery_time = $request->input('del_time');
                                $inbound->save();
                            }
                         

                        }
                    }
            }
            
            
            });
            return redirect()->back()->with('message','Drs Closed Successfully');
           
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Something went Wrong! Try after sometime!');
            }
    }

    public function negativeStatusForm(){
        return view('branch.inbound.negative_status_form');
    }

    public function fetchDetails($drs_no){

        $data = Docate::join('inbound','inbound.docate_no','=','docate.docate_id')
                        ->join('sector_booking','sector_booking.id','=','docate.sector_id')
                        ->join('docate_details as sender','sender.id','=','docate.sender_id')
                        ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                        ->where('inbound.drs_no',$drs_no)
                        ->where('sector_booking.branch_id',Auth::user()->id)
                        ->where('docate.courier_status',7)
                        ->where('inbound.status',2)
                        ->select('docate.*','inbound.*','sender.name as sender_name','receiver.address as receiver_address','receiver.name as receiver_name','sector_booking.cd_no as cd_no')
                        ->get();

        if(count($data)>0){
            return $data;
        }else{
            return 2;
        }


    }

    public function negativeStatusDone(Request $request){
        
        $this->validate($request, [
           'neg_status'=>'required'
            
        ]);
       
        try {
            DB::transaction(function () use ($request) {
               
                $docate_ids = $request->input('docate_id');
                foreach($docate_ids as $docates){
                    $docate = Docate::where('id',$docates)->where('branch_id',Auth::user()->id)->first();
                    $sector = SectorBooking::where('cd_no',$request->input('cd_no'))->first();
                    if($docate->courier_status = 7){
                       
                        $docate->courier_status =9;
                        $docate->status = 8;
                        $docate->save();
                        if($docate){
                            $docate_history = new DocateHistory();
                            $docate_history->docate_id = $docate->docate_id;
                            $docate_history->type=9;
                            $docate_history->data_id = $docate->id;
                            $docate_history->comments = "Drs Not Delivered";
                            $docate_history->save();
                            $inbound = Inbound::where('drs_no',$request->input('drs_no'))->first();
                            if($inbound->status = 2){
                                $inbound->status = 4;
                                $inbound->negative_status_data_time = Carbon\Carbon::now();
                                $inbound->negative_status = $request->input('neg_status');
                                $inbound->save();
                            }
                         

                        }
                    }
            }
            
            
            });
            return redirect()->back()->with('message','Drs Cancelled Successfully');
           
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Something went Wrong! Try after sometime!');
            }
    }


}
