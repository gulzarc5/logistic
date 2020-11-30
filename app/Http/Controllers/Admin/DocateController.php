<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Docate;
use App\User;
class DocateController extends Controller
{
    public function docateList(){
        $branches = User::where('user_role',3)->get();
        return view('admin.outbound.docate_list',compact('branches'));
    }

    public function docateListAjax($start_date,$end_date,$branch_id){
           if($start_date==1 and $end_date==1 and $branch_id!=0){
                $docate = Docate::join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                ->join('city as destination','destination.id','=','receiver.city')
                ->join('city as origin','origin.id','=','docate.origin')
                ->join('users as user','user.id','=','docate.branch_id')
                ->where('user.user_role',3)
                ->where('branch_id',$branch_id)
                ->select('docate.*','destination.name as destination','origin.name as origin','user.name as username')
                ->get();
                
            }else if(!empty($start_date) && !empty($end_date) && $branch_id!=0){
                $docate = Docate::join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                        ->join('city as destination','destination.id','=','receiver.city')
                        ->join('city as origin','origin.id','=','docate.origin')
                        ->join('users as user','user.id','=','docate.branch_id')
                        ->where('user.user_role',3)
                        ->whereDate('docate.created_at','<=', $start_date)
                        ->whereDate('docate.created_at','>=', $end_date)
                        ->where('branch_id',$branch_id)
                        ->select('docate.*','destination.name as destination','origin.name as origin','user.name as username')
                        ->get();
            }else{
                if(!empty($start_date) && !empty($end_date) && $branch_id==0 ){
                    $docate = Docate::join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                        ->join('city as destination','destination.id','=','receiver.city')
                        ->join('city as origin','origin.id','=','docate.origin')
                        ->join('users as user','user.id','=','docate.branch_id')
                        ->where('user.user_role',3)
                        ->whereDate('docate.created_at','>=', $start_date)
                        ->whereDate('docate.created_at','<=', $end_date)
                        ->select('docate.*','destination.name as destination','origin.name as origin','user.name as username')
                        ->get();
                    }
            }
            return datatables()->of($docate)
                ->addIndexColumn()
                ->addColumn('docate_id', function ($docate) {
                    if($docate){
                        return $docate->docate_id;
                    }else{
                        return null;
                    }
                })->addColumn('origin', function ($docate) {
                    if($docate){
                        return $docate->origin;
                    }else{
                        return null;
                    }
                })->addColumn('destination', function ($docate) {
                    if($docate){
                        return $docate->destination;
                    }else{
                        return null;
                    }
                })->addColumn('payment_type', function ($docate) {
                    if($docate){
                        return $docate->payment_option;
                    }else{
                        return null;
                    }
                })->addColumn('branch_id', function ($docate) {
                    if($docate){
                        return $docate->username;
                    }else{
                        return null;
                    }
                }) ->addColumn('action', function ($docate){
                    if($docate){
                        $btn = '<a href="' . route('admin.view_docate', ['id' => $docate->id]) . '" class="btn btn-info btn-sm" target="_blank">View</a>';
                        return $btn;
                    }else{
                        return null;
                    }
                })->rawColumns(['action','docate_id', 'origin', 'destination','payment_type','branch_id'])
                ->make(true);
    }

    public function viewDetails($id){
        $docate_data = Docate::where('id',$id)->first();
        return view('admin.outbound.docate_details');

    }
    
}
