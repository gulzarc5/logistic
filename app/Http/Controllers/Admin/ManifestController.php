<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch\Models\Docate;
use App\Branch\Models\Manifest;
use App\User;
class ManifestController extends Controller
{
    public function manifestList(){
        $branches = User::where('user_role',3)->get();
        return view('admin.outbound.manifest_list',compact('branches'));
    }
    public function manifestListAjax($start_date,$end_date,$branch_id){
        if($start_date==1 and $end_date==1 and $branch_id!=0){
             $manifest = Manifest::join('docate','docate.manifest_id','=','manifest.id')
            ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
             ->join('city as destination','destination.id','=','receiver.city')
             ->join('city as origin','origin.id','=','docate.origin')
             ->join('users as user','user.id','=','docate.branch_id')
             ->where('user.user_role',3)
             ->where('manifest.branch_id',$branch_id)
             ->select('docate.*','manifest.manifest_no as manifest_id','destination.name as destination','origin.name as origin','user.name as username')
             ->get();
             
        }else if(!empty($start_date) && !empty($end_date) && $branch_id!=0){
            $manifest = Manifest::join('docate','docate.manifest_id','=','manifest.id')
                    ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                     ->join('city as destination','destination.id','=','receiver.city')
                     ->join('city as origin','origin.id','=','docate.origin')
                     ->join('users as user','user.id','=','docate.branch_id')
                     ->where('user.user_role',3)
                     ->whereDate('manifest.created_at','<=', $start_date)
                     ->whereDate('manifest.created_at','>=', $end_date)
                     ->where('manifest.branch_id',$branch_id)
                     ->select('docate.*','manifest.manifest_no as manifest_id','destination.name as destination','origin.name as origin','user.name as username')
                     ->get();
        }else{
            if(!empty($start_date) && !empty($end_date) && $branch_id==0 ){
                 $manifest = Manifest::join('docate','docate.manifest_id','=','manifest.id')
                 ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                 ->join('city as destination','destination.id','=','receiver.city')
                 ->join('city as origin','origin.id','=','docate.origin')
                 ->join('users as user','user.id','=','docate.branch_id')
                 ->where('user.user_role',3)
                 ->whereDate('manifest.created_at','>=', $start_date)
                 ->whereDate('manifest.created_at','<=', $end_date)
                 ->select('docate.*','manifest.manifest_no as manifest_id','destination.name as destination','origin.name as origin','user.name as username')
                 ->get();
            }
        }
        return datatables()->of($manifest)
          ->addIndexColumn()
          ->addColumn('manifest_id', function ($manifest) {
            if($manifest){
                 return $manifest->manifest_id;
            }else{
                 return null;
            }
            })->addColumn('origin', function ($manifest) {
                if($manifest){
                    return $manifest->origin;
                }else{
                    return null;
                }
            })->addColumn('destination', function ($manifest) {
                if($manifest){
                    return $manifest->destination;
                }else{
                    return null;
                }
            })->addColumn('payment_type', function ($manifest) {
                if($manifest){
                    return $manifest->payment_option;
                }else{
                    return null;
                }
            })->addColumn('branch_id', function ($manifest) {
                if($manifest){
                    return $manifest->username;
                }else{
                    return null;
                }
            }) ->addColumn('action', function ($manifest){
                if($manifest){
                    $btn = '<a href="' . route('admin.view_manifest', ['id' => $manifest->id]) . '" class="btn btn-info btn-sm" target="_blank">View</a>';
                    return $btn;
                }else{
                    return null;
                }
            })->rawColumns(['action','manifest_id', 'origin', 'destination','payment_type','branch_id'])
            ->make(true);
    }


}