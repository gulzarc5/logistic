<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\City;
use Carbon\Carbon;
use App\Branch\Models\Docate;
use App\Branch\Models\Manifest;
use Auth;
use App\Branch\Models\DocateDetails;

class ManifestController extends Controller
{
    
    public function manifestList(){
        $city = City::select('id','name')->orderBy('name','asc')->get();
        return view('branch.outbound.manifest_list',compact('city'));
    }

    public function fetchDocate($origin,$destination){
       $count = Docate::where('docate.origin',$origin)
            ->where('docate_details.city',$destination)
            ->where('docate.status',1)
            ->join('docate_details','docate.id','=','docate_details.docate_id')->count();
        if($count>0){
            return 1;
        }else{
            return 2;
        }
    }

    public function fetchDocateDetails($docate_no){   
        $docate_data = Docate::select('docate.id as id','docate.no_of_box as packet','docate.actual_weight as actual_weight','receiver.name as receiver_name','origin_city.name as origin_city_name','destination_city.name as destination_city_name')
            ->where('docate.docate_id',$docate_no)
            ->join('docate_details as receiver','receiver.docate_id','=','docate.id')
            ->join('city as origin_city','origin_city.id','=','docate.origin')
            ->join('city as destination_city','destination_city.id','=','receiver.city')
            ->first();
        if(!(array)$docate_data){
            return 1;
        }else{
        return $docate_data;
        }
    }

    public function addManifestNo(Request $request){
       $docket_no = $request->input('docket_no');
        if(count($docket_no)>0){
            foreach($docket_no as $docket_no){
                    if($docket_no!=null){
                        $docket = Docate::where('docate_id',$docket_no)->first();
                        $city = City::where('id',$docket->origin)->first();
                        if($docket->status==1){
                            $this->generateManifestNo($city->name,$docket);
                        }
                    }
            }
        }
        return redirect()->back()->with('message',"Dockets Manifested");
    }

    private function generateManifestNo($city_name,$docate){
        $length = (5-strlen((string)$docate->id));
        $city_name = substr($city_name,0,3);
        
        $id = strtoupper($city_name);
        
        for ($i=0; $i < $length ; $i++) { 
            $id.="0";
        }
        $manifest = new Manifest(); 
        $manifest->branch_id = Auth::user()->id; 
        $manifest->docate_id = $docate->id;      
        $manifest->manifest_no=$id.$docate->id;
        $docate->status = 2;
        $docate->save();
        $manifest->save();
        return true;
    }
}
