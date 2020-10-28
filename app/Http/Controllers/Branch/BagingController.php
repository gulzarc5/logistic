<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\City;
use App\Branch\Models\Docate;
use App\Branch\Models\Manifest;
use App\Branch\Models\Baging;
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
                            ->join('city as origin_city','origin_city.id','=','docate.origin')
                            ->join('city as destination_city','destination_city.id','=','receiver.city')
                            ->join('docate_details','docate_details.id','=','docate.sender_id')
                            ->where('manifest.manifest_no',$manifest_no)
                            ->where('docate.status',2)
                            ->select('docate.*','origin_city.name as origin_city','destination_city.name as destination_city_name','receiver.name as receiver_name','docate_details.name as sender_name')
                            ->get();
        $count = Docate::where('docate.status','=',2)
                        ->where('manifest.manifest_no',$manifest_no)
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
            'docate_id'=>'required'
        ]);
        $docate_ids = $request->input('docate_id');
        $lock_no = $request->input('lock_no');
        $manifest_no = $request->input('manifest_number');
        $manifest = Manifest::where('manifest_no', $manifest_no)->first();
        $baging = new Baging();
        $baging->manifest_id = $manifest->id;
        $baging->lock_no = $lock_no ;
        $baging->save();
        if(count($docate_ids)>=0){
            foreach($docate_ids as $docate_id){
                $docate = Docate::where('id',$docate_id)->first();
                if($docate->status==2){
                    $docate->status = 3;
                    $docate->baging_id = $baging->id;
                    $docate->save();
                }
            }
        }
        return redirect()->back()->with('message',"baging done successfully");
    }

    
}
