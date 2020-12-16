<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Docate;
use App\Manifest;
use App\User;
use App\ManifestDetails;
use App\City;
use App\DocateHistory;
class ManifestController extends Controller
{
    public function manifestList(){
        $branches = User::where('user_role',3)->get();
        return view('admin.outbound.manifest_list',compact('branches'));
    }

    public function manifestListAjax(Request $request){
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $branch_id = $request->get('branch_id');
        $manifest = Manifest::OrderBy('id','desc');
        if (!empty($start_date) && !empty($end_date)) {
            $manifest->whereDate('created_at','>=', $start_date)
                ->whereDate('created_at','<=', $end_date);
        }
        if ($branch_id) {
            $manifest->where('branch_id',$branch_id);
        }
        return datatables()->of($manifest->get())
            ->addIndexColumn()
            ->addColumn('origin', function ($manifest) {
                return isset($manifest->originName->name)?$manifest->originName->name:'';
            })->addColumn('destination', function ($manifest) {
                return isset($manifest->destinationName->name)?$manifest->destinationName->name:'';
            })->addColumn('total_no_docates', function ($manifest) {
                return isset($manifest->totalDocateCount)?$manifest->totalDocateCount->count():0;
            })->addColumn('branch', function ($manifest) { 
                return $manifest->branch->name;
            })->addColumn('date', function ($manifest) { 
                return $manifest->created_at->format('d/m/y');
            })->addColumn('action', function ($manifest){
                if($manifest){
                    $btn = '<a href="' . route('admin.view_manifest', ['id' => $manifest->id]) . '" class="btn btn-info btn-sm" target="_blank">View</a>';
                    if($manifest->manifestBagedCount()==0){
                        $btn .= '<a href="' . route('admin.delete_manifest', ['id' => $manifest->id]) . '" class="btn btn-danger" onclick="return confirm(\'Are You Sure To Delete ??\')">Delete</a>';
                        $btn .= '<a href="' . route('admin.manifest_edit_form', ['id' => $manifest->id]) . '" class="btn btn-primary" target="_blank">Edit</a>';
                    }
                    return $btn;
                }else{
                    return null;
                }
            })->rawColumns(['action','total_no_docates', 'date','origin','branch', 'destination'])
            ->make(true);
    }

    public function deleteManifest($id){
        $manifest = Manifest::where('id',$id)->first();
        $docates = Docate::where('manifest_id',$manifest->id)->get();
        $manifest_details = ManifestDetails::where('manifest_id',$id)->delete();
        foreach($docates as $docate){
            if($docate->courier_status ==2){
                $docate->courier_status = 1;
                $docate->status = 1;
                $docate->manifest_id = null;
                $docate->save();
            }
        }
        $manifest->delete();
        return redirect()->back();
    }

    public function editForm($id){
        $city = City::get();
        $manifest_details = ManifestDetails::where('manifest_id',$id)->get();
        $manifest = Manifest::where('id',$id)->first();
        return view('admin.outbound.manifest_edit_form',compact('city','manifest_details','manifest'));
    }

    public function deleteDocateFromManifest($id){
       
        $manifest_details = ManifestDetails::where('id',$id)->first();
        
        $docate = Docate::where('id',$manifest_details->docate_id)->first();
        if($manifest_details->status ==1){
            $manifest_details->delete();
        }
        if($docate->courier_status ==2){
            $docate->courier_status = 1;
            $docate->status = 1;
            $docate->manifest_id = null;
            $docate->save();
        } 
        return redirect()->back();
    }

    public function fetchDocateDetails($docate_no){      
        
        $docate_data = Docate::select('docate.id as id','docate.no_of_box as packet','docate.actual_weight as actual_weight','receiver.name as receiver_name','origin_city.name as origin_city_name','destination_city.name as destination_city_name')
            ->where('docate.docate_id',$docate_no)
        
            ->where(function($q){
                $q->where('docate.courier_status',1)
                ->orWhere('docate.courier_status',5);
            })
            ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
            ->join('docate_details as sender','sender.id','=','docate.sender_id')
            ->join('city as origin_city','origin_city.id','=','sender.city')
            ->join('city as destination_city','destination_city.id','=','receiver.city')
            ->first();
            
        if($docate_data){
            return $docate_data;
        }else{
            return 1;
        }
    }

    public function updateManifest(Request $request,$manifest_id){
       
       $origin = $request->input('origin');
       $destination = $request->input('destination');
        $manifest_details_id = $request->input('manifest_details_id');
        $docate = $request->input('docate_no');
        $manifest = Manifest::where('id',$manifest_id)->first();
        $manifest->origin = $origin;
        $manifest->destination = $destination;
        $manifest->save();
        foreach($docate as $docates){
            if(!empty($docates)){
                $docate_details = Docate::where('docate_id',$docates)->first();
                if($docate_details->courier_status==1){
                    $docate_details->courier_status =2;
                    $docate_details->status =2;
                    $docate_details->manifest_id = $manifest_id;
                    $docate_details->save();
                   
                    $docate_history =  new DocateHistory();
                    $docate_history->type =2;
                    $docate_history->docate_id = $docate_details->docate_id;
                    $docate_history->data_id = $docate_details->id;
                    $docate_history->comments ="Docate Manifested";
                    $docate_history->save();
                    foreach($manifest_details_id as $details){
                        if(empty($details)){
                            $manifest_details =  new ManifestDetails();
                            $manifest_details->docate_id = $docate_details->id;
                            $manifest_details->manifest_id = $manifest_id;
                            $manifest_details->status = 1;
                            $manifest_details->save();
                        }
                    }
                }
            }
        }
        return redirect()->back()->with('message','Manifest Details Updated Successfully');
    }

    public function viewManifest($id){
        $manifest_details = ManifestDetails::where('manifest_id',$id)->get();
        return view('admin.outbound.manifest_details',compact('manifest_details'));
    }


}