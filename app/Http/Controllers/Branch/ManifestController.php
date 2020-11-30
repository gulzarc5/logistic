<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\City;
use App\Docate;
use App\Manifest;
use App\DocateHistory;
use App\ManifestDetails;
use App\DocateDetails;
use DB;
use Auth;

class ManifestController extends Controller
{
    
    public function manifestList(){
        $city = City::select('id','name')->orderBy('name','asc')->get();
        return view('branch.outbound.manifest_list',compact('city'));
    }

    

    public function fetchDocateDetails($docate_no){      
        
        $docate_data = Docate::select('docate.id as id','docate.no_of_box as packet','docate.actual_weight as actual_weight','receiver.name as receiver_name','origin_city.name as origin_city_name','destination_city.name as destination_city_name')
            ->where('docate.docate_id',$docate_no)
            ->where('docate.branch_id',Auth::user()->id)
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

    public function addManifestNo(Request $request){
        $this->validate($request, [
            'docate_no'   => 'required',
            'destination'   => 'required',
            'origin'   => 'required',
        ]);
    try {
        $manifest_id ='';
        DB::transaction(function () use ($request ,& $manifest_id) {
            $origin = $request->input('origin');
            $docate_nos = $request->input('docate_no');
            $destination = $request->input('destination');
            if(count($docate_nos)>0){
                $manifest_id = $this->generateManifestNo($origin,$destination);
                foreach($docate_nos as $docate_no){
                    if(!empty($docate_no)){
                        $docate = Docate::where('docate_id',$docate_no)->where('branch_id',Auth::user()->id)->first();
                        
                        $docate_history = new DocateHistory();
                        if($docate->courier_status==1){
                            $docate->status = 2;
                            $docate->courier_status = 2;
                            $docate->manifest_id = $manifest_id;
                            $docate->save();
                            
                            $docate_history->data_id = $docate->id;
                            $docate_history->type =2;
                            $docate_history->docate_id = $docate->docate_id;
                            $docate_history->data_id = $docate->id;
                            $docate_history->comments = "Docate Manifested";
                            $docate_history->save();
                        }else{
                            if($docate->courier_status==5){
                                $docate->courier_status = 6;
                                $docate->manifest_id = $manifest_id;
                                $docate->save();
                                $docate_history->type=6;
                                $docate_history->docate_id = $docate->docate_id;
                                $docate_history->data_id = $docate->id;
                                $docate_history->comments = "Docate Remanifested";
                                $docate_history->save();

                            }
                        }
                        
                    }
                }
                $manifest_id = $docate->manifest_id;
            }
            
        });
    return redirect()->route('branch.manifest_info',$manifest_id);
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Something went Wrong! Try after sometime!');
    }

}

    private function generateManifestNo($origin,$destination){
        $manifest = new Manifest(); 
        $manifest->branch_id =Auth::user()->id; 
        $manifest->save();
        $manifest_details = new ManifestDetails();
        $manifest_details->status = 1;
        $manifest_details->manifest_id = $manifest->id;
        $manifest_details->save();

        $city = City::where('id',$origin)->first();
       
        $city_name = substr($city->name,0,3);
        
        $city_name = strtoupper($city_name);
        
        $id = str_pad($manifest->id, 5, '0',STR_PAD_LEFT);

        
        $manifest->origin = $origin;
        $manifest->destination = $destination;
        $manifest->manifest_no=$city_name.$id;
        $manifest->save(); 

        return $manifest->id;
    }

    public function manifestInfo($manifest_id){
        $manifest_data = Docate::where('docate.manifest_id',$manifest_id)
                        ->where('docate.branch_id',Auth::user()->id)
                        ->join('manifest','manifest.id','=','docate.manifest_id')
                        ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                        ->join('city as origin_city','origin_city.id','=','manifest.origin')
                        ->join('city as destination_city','destination_city.id','=','manifest.destination')
                        ->join('docate_details','docate_details.id','=','docate.sender_id')
                        ->select('docate.*','manifest.*','origin_city.name as origin_city_name','destination_city.name as destination_city_name','receiver.name as receiver_name','docate_details.name as sender_name')
                        ->get();
        $manifest = Manifest::where('id',$manifest_id)->where('branch_id',Auth::user()->id)->first(); 
        $manifest_no = $manifest->manifest_no;                 
        return view('branch.outbound.manifest_info',compact('manifest_data','manifest_no'));
    }

}
