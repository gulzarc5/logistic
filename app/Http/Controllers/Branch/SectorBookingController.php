<?php

namespace App\Http\Controllers\branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch\Models\Docate;
use App\Branch\Models\SectorBooking;
use App\Branch\Models\Manifest;
use Auth;
class SectorBookingController extends Controller
{
    public function sectorBookingList(){
        $modes = Docate::select('send_mode')->get();
        return view('branch.outbound.sector_booking_list',compact('modes'));
    }

    public function fetchAddForm($manifest_no){
        
        $manifest_items = Docate::join('manifest','manifest.id','=','docate.manifest_id')
                            ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                            ->join('city as origin_city','origin_city.id','=','docate.origin')
                            ->join('city as destination_city','destination_city.id','=','receiver.city')
                            ->join('docate_details','docate_details.id','=','docate.sender_id')
                            ->where('manifest.manifest_no',$manifest_no)
                            ->where('docate.status',3)
                            ->select('docate.*','origin_city.name as origin_city','destination_city.name as destination_city_name','receiver.name as receiver_name','docate_details.name as sender_name')
                            ->get();
        $count = Docate::where('docate.status','=',3)
                        ->where('manifest.manifest_no',$manifest_no)
                        ->join('manifest','manifest.id','=','docate.manifest_id')
                        ->join('docate_details','docate.id','=','docate_details.docate_id')->count();
        if($count>0){
            return $manifest_items;
        }else{
            return 2;
        }
            
    }

    public function sectorBook(Request $request){
        
        $this->validate($request, [
           
            'booked_by'=>'required',
            'coloader_name'=>'required',
            'date'=>'required',
            'time'   => 'required',
            'arr_date'=>'required',
            'arr_time'=>'required',
            'dep_date'=> 'required',
            'dep_time'=> 'required',
            'mode'=>'required',
            'vehicle_no'=>'required',
            'cd_no'=>'required',
        ]);
        
        
        $manifest_id = Manifest::where('manifest_no',$request->input('manifest_number'))->first();
        $sector = new SectorBooking();
        $sector->manifest_id = $manifest_id->id;
        $sector->booked_by = $request->input('booked_by');
        $sector->co_loader_name = $request->input('coloader_name');
        $sector->date = $request->input('date');
        $sector->time = $request->input('time');
        $sector->arr_date = $request->input('arr_date');
        $sector->arr_time = $request->input('arr_time');
        $sector->dep_date = $request->input('dep_date');
        $sector->dep_time= $request->input('dep_time');
        $sector->mode = $request->input('mode');
        $sector->vehicle_no = $request->input('vehicle_no');
        $sector->cd_no = $request->input('cd_no');
        $sector->branch_id = Auth::user()->id;
        $origin_city = $request->input('origin_city');
        $docate_ids = $request->input('docate_id');
       
        if($sector->save()){
            foreach($docate_ids as $docate){
                $docate = Docate::where('id',$docate)->update([
                    'status'=>4,
                    'sector_id'=>$sector->id
                ]);
            }
            $id = $this->generateSystemNo($origin_city,$sector->id);
            $sector->auto_generate_no = $id;
            $sector->save();
        }
        return redirect()->back()->with('message','Sector Booked Successfully');

    }

    private function generateSystemNo($origin,$sector_id){
        $origin = substr($origin,0,3);        
        $origin = strtoupper($origin);
        $id = str_pad($sector_id, 5, '0',STR_PAD_LEFT);
        $id = $origin.$id;
        return $id;
    }
}

