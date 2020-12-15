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
use Auth;
use App\Services\BranchService;

class SectorPickUpController extends Controller
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
        $data = Docate::where('docate.courier_status',4)
            ->join('sector_booking','sector_booking.id','=','docate.sector_id')
            ->join('docate_details as sender','sender.id','=','docate.sender_id')
            ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
            ->where('sector_booking.cd_no',$cd_no)
            ->where('sector_booking.branch_id',$this->branch_id)
            ->select('docate.*','sector_booking.id as sector_booking_id','sender.name as sender_name','receiver.name as receiver_name','sector_booking.cd_no as cd_no')
            ->get();
        if($data){
            return $data;
        }else{
            return 2;
        }
    }

    public function sectorPickupDone(Request $request){
        $this->validate($request, [
            'docate_id'   => 'required|array|min:1'
        ]);
        try {
            DB::transaction(function () use ($request) {
                $docate_ids = $request->input('docate_id');
                foreach($docate_ids as $docates){
                    if (!empty($docates)) {
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
                                
                                $sector_details = new SectorDetails();
                                $sector_details->status=2;
                                $sector_details->sector_id=$sector->id;
                                $sector_details->baging_id=$sector->bagging_id;
                                $sector_details->save();
                                
                            }
                        }
                    }
                }
            });
            return redirect()->back()->with('message','Sector Pickup Done Successfully');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went Wrong! Try after sometime!');
        }
    }

    
}
