<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\City;
use App\Branch\Models\Docate;
use App\Branch\Models\Manifest;
use Auth;

class ManifestController extends Controller
{
    
    public function manifestList(){
        $city = City::select('id','name')->orderBy('name','asc')->get();
        return view('branch.outbound.manifest_list',compact('city'));
    }

    public function fetchDocate($origin,$destination){
       $count = Docate::where('docate.origin',$origin)
        ->where('docate.status',1)
        ->join('docate_details','docate.id','=','docate_details.docate_id')
        ->where('docate_details.city',$destination)->count();
        if($count>0){
            return 1;
        }else{
            return 2;
        }
    }

    public function fetchDocateDetails($docate_no,$origin,$destination){      
        
        $docate_data = Docate::select('docate.id as id','docate.no_of_box as packet','docate.actual_weight as actual_weight','receiver.name as receiver_name','origin_city.name as origin_city_name','destination_city.name as destination_city_name')
            ->where('docate.docate_id',$docate_no)
            ->where('docate.origin',$origin)
            ->where('docate.status',1)
            ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
            ->join('city as origin_city','origin_city.id','=','docate.origin')
            ->join('city as destination_city','destination_city.id','=','receiver.city')
            ->where('receiver.city',$destination)
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
        $origin = $request->input('origin');
        $docate_nos = $request->input('docate_no');
        if(count($docate_nos)>0){
            $manifest_id = $this->generateManifestNo($origin);
            foreach($docate_nos as $docate_no){
                if(!empty($docate_no)){
                    $docate = Docate::where('docate_id',$docate_no)->first();
                    if($docate->status==1){
                        $docate->status = 2;
                        $docate->manifest_id = $manifest_id;
                        $docate->save();
                    }
                }
            }
        }
        return redirect()->back()->with('message',"Dockets Manifested");
    }

    private function generateManifestNo($origin){
        $manifest = new Manifest(); 
        $manifest->branch_id =Auth::user()->id; 
        $manifest->save();


        $city = City::where('id',$origin)->first();
        $length = (5-strlen((string)$manifest->id));
        $city_name = substr($city->name,0,3);
        
        $id = strtoupper($city_name);
        
        $id .= str_pad($id, $length, '0');

        $manifest->branch_id =Auth::user()->id; 
        $manifest->manifest_no=$id.$manifest->id;
        $manifest->save(); 

        return $manifest->id;
    }
}
