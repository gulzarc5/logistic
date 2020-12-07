<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Inbound;
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
           ->addColumn('action', function ($inbound){
                if($inbound){
                    $btn = '<a href="' . route('admin.view_details', ['id' => $inbound->id]) . '" class="btn btn-info btn-sm" target="_blank">View</a>';
                    if($inbound->status == 1){
                        $btn .= '<a href="' . route('admin.delete_manifest', ['id' => $inbound->id]) . '" class="btn btn-danger" >Delete</a>';
                        $btn .= '<a href="' . route('admin.edit_form', ['id' => $inbound->id]) . '" class="btn btn-primary"  target="_blank">Edit</a>';
                    }
                   
                    return $btn;
                }else{
                    return null;
                }
            })->rawColumns(['action'])
            ->make(true);
    }

    public function deletePickup($id){
        

    }
}
