<?php

namespace App\Http\Controllers\branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Docate;
use App\SectorBooking;
use App\Manifest;
use App\City;
use App\DocateHistory;
use App\SectorDetails;
use App\BagingDetails;
use App\Baging;
use DB;
use Auth;
class SectorBookingController extends Controller
{
    public function sectorBookingList(){
     
        $city = City::where('status',1)->get();
        return view('branch.outbound.sector_booking_list',compact('city'));
    }

    public function fetchAddForm($manifest_no){        
        $manifest_items = Docate::join('manifest','manifest.id','=','docate.manifest_id')
            ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
            ->join('docate_details','docate_details.id','=','docate.sender_id')
            ->join('baging','baging.id','=','docate.baging_id')
            ->where('manifest.manifest_no',$manifest_no)
            ->where('docate.courier_status',3)
            ->select('docate.*','baging.lock_no as lock_no','receiver.name as receiver_name','docate_details.name as sender_name')
            ->get();
            
        $count = Docate::where('docate.courier_status',3)
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
            'origin'=>'required',
            'destination'   => 'required',
            'coloader_name'=>'required',
            'date'=>'required',
            'time'   => 'required',
            'arr_date'=>'required',
            'arr_time'=>'required',
            'dep_date'=> 'required',
            'dep_time'=> 'required',            
            'vehicle_no'=>'required',
            'cd_no'=>'required',
            'manifest_number'=>'required',
        ]);
        
    try {
        $sector_id =null;
        DB::transaction(function () use ($request, & $sector_id) {
            $manifest_id = Manifest::where('manifest_no',$request->input('manifest_number'))->where('branch_id',Auth::user()->id)->first();
            $baging_id = Baging::where('manifest_id',$manifest_id->id)->where('branch_id',Auth::user()->id)->first();
            $sector = new SectorBooking();
            $sector->manifest_id = $manifest_id->id;
            $sector->booked_by = $request->input('booked_by');
            $sector->co_loader_name = $request->input('coloader_name');
            $sector->book_date = $request->input('date');
            $sector->origin = $request->input('origin');
            $sector->destination = $request->input('destination');
            $sector->book_time = $request->input('time');
            $sector->arr_date = $request->input('arr_date');
            $sector->arr_time = $request->input('arr_time');
            $sector->dep_date = $request->input('dep_date');
            $sector->dep_time= $request->input('dep_time');
            $sector->bagging_id=$baging_id->id;
            $sector->mode = $request->input('mode');
            $sector->vehicle_no = $request->input('vehicle_no');
            $sector->cd_no = $request->input('cd_no');
            $sector->branch_id = Auth::user()->id;
            $origin_city = $request->input('origin_city');
            $docate_ids = $request->input('docate_id');
            $sector_details =  new SectorDetails();
        
            $sector_details->baging_id = $baging_id->id;
            $sector_details->status = 1;
        
            if($sector->save()){
                $sector_details->sector_id=$sector->id;
                $sector_details->save();
                foreach($docate_ids as $docates){
                  
                    $docate = Docate::where('id',$docates)->where('branch_id',Auth::user()->id)->first();
                    
                    if($docate->courier_status = 3){
                        $docate_history = new DocateHistory();
                        $baging_details =  new BagingDetails();
                        $docate->status =4;
                        $docate->courier_status = 4;
                        $docate->sector_id=$sector->id;
                        $docate->save();
                        $docate_history->type= 4;
                        $docate_history->data_id = $docate->id;
                        $docate_history->docate_id = $docate->docate_id;
                        $docate_history->comments = "Docate Sector Booked";
                        $docate_history->save();
                        $baging_details->docate_id = $docate->id;
                        $baging_details->status =2;
                        
                        $baging_details->baging_id =  $baging_id->id;
                        $baging_details->save();
                        
                    }
                }
                $id = $this->generateSystemNo($origin_city,$sector->id);
                $sector->auto_generate_no = $id;
                $sector->save();
            }
            $sector_id = $sector->id;
            
        });
        return redirect()->route('branch.sector_info',$sector_id);
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Something went Wrong! Try after sometime!');
    }

    }

    private function generateSystemNo($origin,$sector_id){
        $origin = substr($origin,0,3);        
        $origin = strtoupper($origin);
        $id = str_pad($sector_id, 5, '0',STR_PAD_LEFT);
        $id = $origin.$id;
        return $id;
    }

    public function sectorInfo($sector_id){
        $sector_data = Docate::where('docate.sector_id',$sector_id)
                        ->where('docate.branch_id',Auth::user()->id)
                        ->join('manifest','manifest.id','=','docate.manifest_id')
                        ->join('sector_booking','sector_booking.manifest_id','=','manifest.id')
                        ->join('docate_details as receiver','receiver.id','=','docate.receiver_id')
                        ->join('docate_details as sender','sender.id','=','docate.sender_id')
                        ->join('city as origin_city','origin_city.id','=','sector_booking.origin')
                        ->join('city as destination_city','destination_city.id','=','sector_booking.destination')
                        ->select('docate.docate_id as docate_id','manifest.manifest_no as manifest_no','docate.actual_weight as actual_weight','docate.no_of_box as no_of_box','sector_booking.*','manifest.manifest_no as manifest_no ','origin_city.name as origin_city_name','destination_city.name as destination_city_name','receiver.name as receiver_name','sender.name as sender_name')
                        ->get();
        
        return view('branch.outbound.sector_info',compact('sector_data','sector_id'));
    }
}

