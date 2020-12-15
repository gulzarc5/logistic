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
use App\Drs;
use Carbon\Carbon;
use Auth;
use App\Services\BranchService;

class InboundController extends Controller
{
    protected $branch_id;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->branch_id = BranchService::branchId();
            return $next($request);
        });
    }

    public function sectorPickupForm(){
        return view('branch.inbound.sector_pickup_form');
    }
    
    public function fetchAddForm($cd_no){
        $data = Docate::join('sector_booking','sector_booking.id','=','docate.sector_id')
            ->join('docate_details as sender','sender.id','=','docate.sender_id')
            ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
            ->where('sector_booking.cd_no',$cd_no)
            ->where('sector_booking.branch_id',$this->branch_id)
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
                  
                    $docate = Docate::where('id',$docates)->where('branch_id',$this->branch_id)->first();
                  
                    $sector = SectorBooking::where('cd_no',$request->input('cd_no'))->first();
                    if($docate->courier_status == 4){
                        $inbound = new Inbound();
                        $inbound->cd_no = $request->input('cd_no');
                        $inbound->docate_no = $docate->docate_id;
                        $inbound->status = 1;
                        $inbound->branch_id = $this->branch_id;
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
                            $sector_details = SectorDetails::where('sector_id',$sector->id)->where('docate_id',$docates)->first();
                            $sector_details->status=2;
                            $sector_details->docate_id = $docates;
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

    public function fetchDrsPreparedForm($docate_id){        
        $data = Docate::join('inbound','inbound.docate_no','=','docate.docate_id')
            ->join('sector_booking','sector_booking.id','=','docate.sector_id')
            ->join('docate_details as sender','sender.id','=','docate.sender_id')
            ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
            ->where('docate.docate_id',$docate_id)
            ->where('sector_booking.branch_id',$this->branch_id)
            ->where(function($q){
                $q->where('docate.courier_status',5)
                ->orWhere('docate.courier_status',9);
            })
            ->select('docate.*','sector_booking.id as sector_booking_id','sender.name as sender_name','receiver.address as receiver_address','receiver.name as receiver_name','sector_booking.cd_no as cd_no')
            ->first();
        
        if($data){
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
                $docate_ids = $request->input('docate_no');

                $drs = new Drs();              
                $drs->de_name = $request->input('de_name');
                $drs->branch_id = $this->branch_id;
                $drs->vehicle_no = $request->input('vehicle_no');
                $drs->drs_date = $request->input('de_date');
                $drs->status =1;
                $drs->drs_time = $request->input('de_time');
                if($drs->save()){
                    $branch = substr(Auth::user()->name,0,2);
                    $id = str_pad($branch, 5, '0',STR_PAD_RIGHT);
                    $drs->drs_no = $id.$drs->id;
                    $drs->save();
                }
               
                foreach($docate_ids as $docatess){
                    if(!empty($docatess)){
                        $docate = Docate::where('docate_id',$docatess)->where('branch_id',$this->branch_id)->first();
                        
                        if($docate->courier_status == 5 || $docate->courier_status == 9){
                            $inbound = Inbound::where('docate_no',$docate->docate_id)->first();
                            $inbound->status = 2;
                            $inbound->drs_id = $drs->id;
                            $inbound->save();
                            
                        
                            $docate->courier_status =7;
                            $docate->status = 6;
                            $docate->save();
                            if($docate){
                                $docate_history = new DocateHistory();
                                $docate_history->docate_id = $docate->docate_id;
                                $docate_history->type=7;
                                $docate_history->data_id = $docate->id;
                                $docate_history->comments = "Out for delivery";
                                $docate_history->save();
                            }
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
        $data = Docate::where('drs.drs_no',$drs_no)
            ->join('inbound','inbound.docate_no','=','docate.docate_id')
            ->join('sector_booking','sector_booking.id','=','docate.sector_id')
            ->join('docate_details as sender','sender.id','=','docate.sender_id')
            ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
            ->join('drs','drs.id','=','inbound.drs_id')
            ->where('sector_booking.branch_id',$this->branch_id)
            ->where('docate.courier_status',7)
            ->select('docate.*','sector_booking.id as sector_booking_id','sender.name as sender_name','receiver.address as receiver_address','receiver.name as receiver_name','sector_booking.cd_no as cd_no')
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
      
        try{
            DB::transaction(function () use ($request) {
                $docate_ids = $request->input('docate_id');
                for($i=0;$i<count($docate_ids);$i++){
                    if(!empty($docate_ids[$i])){
                       
                        $docate = Docate::where('id',$docate_ids[$i])->where('branch_id',$this->branch_id)->first();
                        $sector = SectorBooking::where('cd_no',$request->input('cd_no'))->first();
                       
                        if($docate->courier_status == 7){
                            $docate->courier_status =8;
                            $docate->status = 7;
                            $docate->save();
                            if($docate){
                                $docate_history = new DocateHistory();
                                $docate_history->docate_id = $docate->docate_id;
                                $docate_history->type=8;
                                $docate_history->data_id = $docate->id;
                                $docate_history->comments = "Delivered";
                                $docate_history->save();
                                $inbound = Inbound::where('docate_no',$docate->docate_id)->first();
                                if($inbound->status == 2){
                                    $inbound->status = 3;
                                    $inbound->received_by = $request->input('received_by')[$i];
                                    $inbound->delivery_date = $request->input('del_date')[$i];
                                    $inbound->delivery_time = $request->input('del_time')[$i];
                                    $inbound->save();
                                    $drs = Drs::where('id',$inbound->drs_id)->first();
                                    $inbound_cnt = Inbound::where('status',3)->where('drs_id',$drs->id)->count();
                                    $docates_cnt =  Inbound::where('drs_id',$drs->id)->count();
                                    if($inbound_cnt == $docates_cnt ){
                                            $drs->status =2;
                                            $drs->drs_close_date_time = Carbon::now();
                                            $drs->save();
                                    }
                                }
                            
                                
                            

                            }
                        }
                    }
                }
            });
        return redirect()->back()->with('message','Drs Closed Successfully');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went Wrong! Try after sometime!');
        }
    }

    public function negativeStatusForm(){
        return view('branch.inbound.negative_status_form');
    }

    public function fetchDetails($drs_no){
        $data = Docate::where('drs.drs_no',$drs_no)
            ->join('inbound','inbound.docate_no','=','docate.docate_id')
            ->join('sector_booking','sector_booking.id','=','docate.sector_id')
            ->join('docate_details as sender','sender.id','=','docate.sender_id')
            ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
            ->join('drs','drs.id','=','inbound.drs_id')
            
            ->where('sector_booking.branch_id',$this->branch_id)
            ->where('docate.courier_status',7)
            ->where('inbound.status',2)
            ->select('docate.*','sender.name as sender_name','receiver.address as receiver_address','receiver.name as receiver_name','sector_booking.cd_no as cd_no')
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
                for($i =0;$i<count($docate_ids);$i++){
                    $docate = Docate::where('id',$docate_ids[$i])->where('branch_id',$this->branch_id)->first();
                    $sector = SectorBooking::where('cd_no',$request->input('cd_no'))->first();
                    if($docate->courier_status == 7){
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
                            $inbound = Inbound::where('docate_no',$docate->docate_id)->first();
                            if($inbound->status == 2){
                                $inbound->status = 4;
                                $inbound->negative_status_data_time =Carbon::now();
                                $inbound->negative_status = $request->input('neg_status')[$i];
                                $inbound->drs_id = null;
                                $inbound->save();
                              
                            }
                            $drs = Drs::where('id',$inbound->drs_id)->delete();
                         

                        }
                    }
                }
            });
        
        return redirect()->back()->with('message','Drs Cancelled Successfully');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went Wrong! Try after sometime!');
        }
    }


}
