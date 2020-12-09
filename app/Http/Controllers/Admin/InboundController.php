<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Inbound;
use App\Docate;
use App\SectorDetails;
use Auth;
class InboundController extends Controller
{
    public function sectorPickupList(){
        $branches = User::where('user_role',3)->get();
        return view('admin.inbound.pickup_list',compact('branches'));
    }

    public function sectorPickupListAjax(Request $request){
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $branch_id = $request->get('branch_id');
        $inbound = Inbound::OrderBy('id','desc');
        if (!empty($start_date) && !empty($end_date)) {
            $inbound->whereDate('created_at','>=', $start_date)
                ->whereDate('created_at','<=', $end_date);
        }
        if ($branch_id) {
            $inbound->where('branch_id',$branch_id);
        }
        return datatables()->of($inbound->get())
            ->addIndexColumn()
            ->addColumn('action', function ($inbound) {
                if($inbound->status == 1){
                    return $btn = '<a  href = "'. route ('admin.remove_from_pickup',['id'=>$inbound->id]) .'" class="btn btn-danger btn-sm">Remove</a>';
                }else if($inbound->status ==2){
                    return $btn = '<a   disabled class="btn btn-primary btn-sm">Drs Prepared</a>';
                }else if($inbound->status ==3){
                    return $btn = '<a   disabled disabled class="btn btn-primary btn-sm">Drs Closed</a>';
                }else{
                    return $btn = '<a   disabled class="btn btn-danger btn-sm">Negative Status</a>';
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function removeFromPickup($id){
        $inbound = Inbound::where('id',$id)->first();
        $docate = Docate::where('docate_id',$inbound->docate_no)->first();
        $docate->courier_status = 4;
        $docate->status = 4;
        
        if($docate->save()){
            $sector_details = SectorDetails::where('docate_id',$docate->id)->first();
            $sector_details->status =1;
            $sector_details->save();
            
        }
        if($sector_details){
            $inbound->delete();
            return redirect()->back();
        }

    }

    public function editPickupForm(){
        
        return view('admin.inbound.edit_sector_pickup_form');
    }

    public function fetchPickupForm($cd_no){
        $data = Docate::join('sector_booking','sector_booking.id','=','docate.sector_id')
                        ->join('docate_details as sender','sender.id','=','docate.sender_id')
                        ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                        ->where('sector_booking.cd_no',$cd_no)
                        ->select('docate.*','sector_booking.id as sector_booking_id','sender.name as sender_name','receiver.name as receiver_name','sector_booking.cd_no as cd_no')
                        ->get();
        
        if(count($data)>0){
            return $data;

        }else{
            return 2;
        }

    }

    public function pickupOperation($docate_id,$status){
        $docate = Docate::where('id',$docate_id)->first();
       
        if($status == 1){
            $docate->courier_status = 4;
            $docate->status = 4;
            $docate->save();
            $inbound = Inbound::where('docate_no',$docate->docate_id)->first();
            $inbound->delete();
            $sector_details = SectorDetails::where('docate_id',$docate->id)->first();
            $sector_details->status =1;
            $sector_details->save();
            
        }else{
            $docate->courier_status = 5;
            $docate->status = 5;
            $docate->save();
           
            $sector_details = SectorDetails::where('docate_id',$docate->id)->first();
            $sector_details->status =2;
            $sector_details->save();
            $inbound_new = new Inbound();
            $inbound_new->cd_no = $sector_details->sector->cd_no;
            $inbound_new->docate_no = $docate->docate_id;
            $inbound_new->branch_id = $sector_details->sector->branch_id;
            $inbound_new->status =1;
            $inbound_new->save();

        }
    }

    public function drsPreparedList(){
        $branches = User::where('user_role',3)->get();
        return view('admin.inbound.drs_prepared_list',compact('branches'));
    }

    public function drsPreparedListAjax(Request $request){
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $branch_id = $request->get('branch_id');
        $inbound = Inbound::OrderBy('id','desc');
        if (!empty($start_date) && !empty($end_date)) {
            $inbound->whereDate('created_at','>=', $start_date)
                ->whereDate('created_at','<=', $end_date);
        }
        if ($branch_id) {
            $inbound->where('branch_id',$branch_id);
        }
        return datatables()->of($inbound->get())
            ->addIndexColumn()
            ->addColumn('action', function ($inbound) {
                if($inbound->status == 2){
                    return $btn = '<a  href = "'. route ('admin.remove_from_drs_prepared',['id'=>$inbound->id]) .'" class="btn btn-danger btn-sm">Remove</a>';
                }else if($inbound->status ==1){
                    return $btn = '<a   disabled class="btn btn-primary btn-sm">Pick Up</a>';
                }else if($inbound->status ==3){
                    return $btn = '<a   disabled disabled class="btn btn-primary btn-sm">Drs Closed</a>';
                }else{
                    return $btn = '<a   disabled class="btn btn-danger btn-sm">Negative Status</a>';
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function removeFromDrsPrepared($id){
        $inbound = Inbound::where('id',$id)->first();
        $inbound->status = 1;
        $inbound->de_name = null;
        $inbound->drs_date = null;
        $inbound->drs_time = null;
        $inbound->drs_no = null;
        $inbound->vehicle_no = null;
        $inbound->save();

        $docate = Docate::where('docate_id',$inbound->docate_no)->first();
        $docate->status = 5;
        $docate->courier_status = 5;
        $docate->save();
        
        return redirect()->back();

    }

    public function editDrsPreparedForm(){
        $inbound = Inbound::get();
        return view('admin.inbound.edit_drs_prepared_form');                
    }

    

}
