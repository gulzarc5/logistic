<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\City;
use App\Docate;
use App\Manifest;
use App\Baging;
use App\ManifestDetails;
use App\DocateHistory;
use App\DocateDetails;
use App\BagingDetails;
use Carbon\Carbon;
use DB;
use Auth;
class BagingController extends Controller
{
    public function bagingList(){
        $city= City::where('status',1)->get();
        return view('branch.outbound.baging_list',compact('city'));
    }

    public function fetchAddForm($manifest_no){
        $manifest_items = Docate::join('manifest','manifest.id','=','docate.manifest_id')
                            ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                            ->join('docate_details as sender','sender.id','=','docate.sender_id')
                            ->where('docate.branch_id',Auth::user()->id)
                            ->where('manifest.manifest_no',$manifest_no)
                            ->where(function($q){
                                $q->where('docate.courier_status',2)
                                ->orWhere('docate.courier_status',6);
                            })
                            ->select('docate.*','receiver.name as receiver_name','sender.name as sender_name')
                            ->get();
        $count = Docate::where('docate.status','=',2)
                        ->where('manifest.manifest_no',$manifest_no)
                        ->where('docate.branch_id',Auth::user()->id)
                        ->join('manifest','manifest.id','=','docate.manifest_id')
                        ->join('docate_details','docate.id','=','docate_details.docate_id')->count();
        if($count>0){
            return $manifest_items;
        }else{
            return 2;
        }
            
    }


    public function addBagingNo(Request $request){
        $this->validate($request, [
            'lock_no'=> 'required',
            'manifest_number'=>'required',
            'docate_id'=>'required',
            'origin'=>'required',
            'destination'=>'required'
        ]);

    try {
        $baging_id ='';
        DB::transaction(function () use ($request,& $baging_id) {
        $docate_ids = $request->input('docate_id');
        $lock_no = $request->input('lock_no');
        $manifest_no = $request->input('manifest_number');
        $manifest = Manifest::where('manifest_no', $manifest_no)->where('branch_id',Auth::user()->id)->first();
        $manifest_details = ManifestDetails::where('manifest_id',$manifest->id)->first();
        if($manifest_details->status ==1){
            $manifest_detail =  new ManifestDetails();
            $manifest_detail->status=2;
            $manifest_detail->manifest_id = $manifest->id;
             $manifest_detail->save();
         }
       
        $baging = new Baging();
        $baging->manifest_id = $manifest->id;
        $baging->branch_id = Auth::user()->id;
        $baging->origin =$request->input('origin') ;
        $baging->destination=$request->input('destination');
        $baging->date=Carbon::today()->toDateString();
        $baging->lock_no = $lock_no ;
        $baging->save();
       
        if(count($docate_ids)>=0){
            foreach($docate_ids as $docate_id){
                $docate = Docate::where('id',$docate_id)->where('branch_id',Auth::user()->id)->first();
                $docate_history = new DocateHistory();
                $baging_details = new BagingDetails();
                $baging_details->docate_id = $docate_id;
                $baging_details->baging_id = $baging->id;
                $baging_details->status = 1;
                $baging_details->save();
               
                if($docate->courier_status==2){
                    $docate->status = 3;
                    $docate->courier_status = 3;
                    $docate->baging_id = $baging->id;
                    $docate->save();
                    $docate_history->docate_id = $docate->docate_id;
                    $docate_history->type=3;
                    $docate_history->data_id = $docate->id;
                    $docate_history->comments = "Docates Bagged";
                    $docate_history->save();
                }else{
                    if($docate->status == 6){
                        $docate->status = 3;
                        $docate->courier_status = 3;
                        $docate->baging_id = $baging->id;
                        $docate->save();
                        $docate_history->docate_id = $docate->docate_id;
                        $docate_history->type=3;
                        $docate_history->data_id = $docate->id;
                        $docate_history->comments = "Docates Rebagged at interim location";
                        $docate_history->save();
                    }

                }
            }
        }
        
        $baging_id=$baging->id;
       
    
    });
    return redirect()->route('branch.bag_info',$baging_id);
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Something went Wrong! Try after sometime!');
    }

    }
    
    public function bagInfo($baging_id){
        $baged_data = Docate::where('docate.baging_id',$baging_id)
                        ->where('docate.branch_id',Auth::user()->id)
                        ->join('baging','baging.id','=','docate.baging_id')
                        ->join('manifest','manifest.id','=','baging.manifest_id')
                        ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                        ->join('city as origin_city','origin_city.id','=','baging.origin')
                        ->join('city as destination_city','destination_city.id','=','baging.destination')
                        ->join('docate_details','docate_details.id','=','docate.sender_id')
                        ->select('docate.*','baging.*','manifest.*','origin_city.name as origin_city_name','destination_city.name as destination_city_name','receiver.name as receiver_name','docate_details.name as sender_name')
                        ->get();
        
        return view('branch.outbound.bag_info',compact('baged_data','baging_id'));
    }
}
