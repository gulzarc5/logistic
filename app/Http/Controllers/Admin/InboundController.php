<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Inbound;
use App\Docate;
use App\SectorDetails;
use App\Drs;
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
            $inbound->where('branch_id',$branch_id)->where('status',1);
        }
        return datatables()->of($inbound->get())
            ->addIndexColumn()
            ->addColumn('status', function ($inbound) {
                if($inbound->status == 1){
                    return $btn = '<a   class="btn btn-danger btn-sm">Picked Up</a>';
                }else if($inbound->status ==2){
                    return $btn = '<a   disabled class="btn btn-primary btn-sm">Drs Prepared</a>';
                }else if($inbound->status ==3){
                    return $btn = '<a   disabled disabled class="btn btn-primary btn-sm">Drs Closed</a>';
                }else{
                    return $btn = '<a   disabled class="btn btn-danger btn-sm">Negative Status</a>';
                }
            })
            ->rawColumns(['status'])
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

        return 1;

    }

    public function editPickupForm(){
        
        return view('admin.inbound.edit_sector_pickup_form');
    }

    public function fetchPickupForm($cd_no){
        $data = Docate::join('sector_booking','sector_booking.id','=','docate.sector_id')
                        ->join('docate_details as sender','sender.id','=','docate.sender_id')
                        ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                        ->where('sector_booking.cd_no',$cd_no)
                        ->where(function($q){
                            $q->where('docate.courier_status',4)
                            ->orWhere('docate.courier_status',5);
                        })
                        ->select('docate.*','sector_booking.id as sector_booking_id','sender.name as sender_name','receiver.name as receiver_name','sector_booking.cd_no as cd_no')
                        ->get();
        
        if(count($data)>0){
            return $data;

        }else{
            return 2;
        }

    }

    public function pickupOperation($docate_id){
        $docate = Docate::where('id',$docate_id)->first();
        $inbound = Inbound::where('docate_no',$docate->docate_id)->first();
        if(!empty($inbound)){
            $docate->courier_status = 4;
            $docate->status = 4;
            $docate->save();
          
            $inbound->delete();
            $sector_details = SectorDetails::where('docate_id',$docate->id)->first();
            $sector_details->status =1;
            $sector_details->save();
            return 1;
            
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
            return 2;
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
        $drs = Drs::OrderBy('id','desc');
        if (!empty($start_date) && !empty($end_date)) {
            $drs->whereDate('created_at','>=', $start_date)
                ->whereDate('created_at','<=', $end_date);
        }
        if ($branch_id) {
            $drs->where('branch_id',$branch_id);
        }
        return datatables()->of($drs->get())
            ->addIndexColumn()
            ->addColumn('total_no_of_docates', function ($drs) {
                return $drs->docatesCount();
            })
            ->addColumn('drs_status', function ($drs) {
                if($drs->status == 1){
                    $btn = '<a class="btn  btn-primary btn-xs">Open</a>';
                }else{
                    $btn = '<a class="btn  btn-success btn-xs">Closed</a>';
                }
                return $btn;
            })
            ->addColumn('action', function ($drs) {
                if($drs->status == 1){
                    $btn = '<a  target="_blank" href = "'. route('admin.drs_prepared_edit_form',['id'=>$drs->id]) .'" class="btn btn-success btn-sm">Edit</a>';
                    $btn .= '<a  href = "'. route ('admin.remove_drs',['id'=>$drs->id]) .'" class="btn btn-danger btn-sm">Remove</a>';
                    return $btn;
                }else{
                    return  $btn = '<a  target="_blank"  class="btn btn-success btn-sm">Already Delivered</a>';
                }
                
            })
            ->rawColumns(['action','drs_status'])
            ->make(true);
    }

    public function removeFromDrsPrepared($id){
        $inbound = Inbound::where('id',$id)->first();
        $inbound->status = 1;
        $inbound->drs_id = null;
        $inbound->save();

        $docate = Docate::where('docate_id',$inbound->docate_no)->first();
        $docate->status = 5;
        $docate->courier_status = 5;
        $docate->save();
        
        return redirect()->back();

    }

    public function removeDrs($id){
        $drs = Drs::where('id',$id)->delete();
        $inbound = Inbound::where('drs_id',$drs->id)->get();
        foreach($inbound as $values){
            $values->status = 1;
            $values->drs_id = null;
            $values->save();
            $docate = Docate::where('docate_id',$values->docate_no)->first();
            $docate->courier_status = 5;
            $docate->status = 5;
            $docate->save();

        }
        return redirect()->back();
    }

    public function editDrsPreparedForm($id){
        $inbound = Inbound::where('drs_id',$id)->get();
        $drs = Drs::where('id',$id)->first();
        return view('admin.inbound.edit_drs_prepared_form',compact('inbound','drs'));                
    }

    public function fetchDrsPreparedForm($docate_id){
        $data = Docate::join('inbound','inbound.docate_no','=','docate.docate_id')
            ->join('sector_booking','sector_booking.id','=','docate.sector_id')
            ->join('docate_details as sender','sender.id','=','docate.sender_id')
            ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
            ->where('docate.docate_id',$docate_id)
            
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

    public function updateDrsPrepared(Request $request,$id){
        
        $this->validate($request, [
            'de_name'   => 'required',
            'de_date'   => 'required',
            'de_time'   => 'required',
            'vehicle_no'   => 'required',
        ]);
        $drs = Drs::where('id',$id)->first();
        $drs->de_name = $request->input('de_name');
        $drs->drs_date = $request->input('de_date');
        $drs->drs_time = $request->input('de_time');
        $drs->vehicle_no = $request->input('vehicle_no');
        $drs->save();
        $docate_ids = $request->input('docate_no');
        foreach($docate_ids as $docatess){
            if(!empty($docatess)){
                $docate =Docate::where('docate_id',$docatess)->first();
                
                $inbound = Inbound::where('docate_no',$docatess)->first();
            
                $inbound->drs_id = $drs->id;
                $inbound->status = 2;
                $inbound->save();

                $docate->courier_status = 7;
                $docate->status = 6;
                $docate->save();
            }
        }
        return redirect()->back()->with('message','Drs Prepared Updated Successfully');

    }

    public function drsCloseList(){
        $branches = User::where('user_role',3)->get();
        return view('admin.inbound.drs_close_list',compact('branches'));

    }

    public function drsCloseListAjax(Request $request){
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $branch_id = $request->get('branch_id');
        $inbound = Inbound::OrderBy('id','desc');
        if (!empty($start_date) && !empty($end_date)) {
            $inbound->whereDate('created_at','>=', $start_date)
                ->whereDate('created_at','<=', $end_date);
        }
        if ($branch_id) {
            $inbound->where('branch_id',$branch_id)->where('status',3);
        }
        return datatables()->of($inbound->get())
            ->addIndexColumn()
            ->addColumn('drs_no',function ($inbound){
                return $inbound->drs->drs_no;
            })
            ->rawColumns(['drs_no'])
            ->make(true);
    }

    public function editDrsCloseForm(){
        return view('admin.inbound.edit_drs_close_form');
    }

    public function fetchDrsCloseForm($drs_no){
        $data = Docate::join('inbound','inbound.docate_no','=','docate.docate_id')
                        ->join('sector_booking','sector_booking.id','=','docate.sector_id')
                        ->join('docate_details as sender','sender.id','=','docate.sender_id')
                        ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                        ->join('drs','drs.id','=','inbound.drs_id')
                        ->where('drs.drs_no',$drs_no)
                        
                        ->where(function($q){
                            $q->where('docate.courier_status',7)
                            ->orWhere('docate.courier_status',8);
                        })
                        ->select('docate.*','inbound.received_by as received_by','inbound.delivery_time as delivery_time','inbound.delivery_date as delivery_date','sector_booking.id as sector_booking_id','sender.name as sender_name','receiver.address as receiver_address','receiver.name as receiver_name','sector_booking.cd_no as cd_no')
                        ->get();

        
        
        if(count($data)>0){
            return $data;

        }else{
            return 2;
        }

    }

    public function drsCloseOperation(){

    }



    

}
