<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\SectorBooking;
use App\SectorDetails;
use App\Docate;
use App\City;
use App\ManifestDetails;
class SectorBookingController extends Controller
{
    public function sectorList(){
        $branches = User::where('user_role',3)->get();
        return view('admin.outbound.sector_list',compact('branches'));
    }

    public function sectorListAjax(Request $request){
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $branch_id = $request->get('branch_id');
        $sector = SectorBooking::OrderBy('id','desc');
        if (!empty($start_date) && !empty($end_date)) {
            $sector->whereDate('created_at','>=', $start_date)
                ->whereDate('created_at','<=', $end_date);
        }
        if ($branch_id) {
            $sector->where('branch_id',$branch_id);
        }
            return datatables()->of($sector->get())
            ->addIndexColumn()
            ->addColumn('origin', function ($sector) {
                return isset($sector->originName->name)?$sector->originName->name:'';
            })->addColumn('destination', function ($sector) {
                return isset($sector->destinationName->name)?$sector->destinationName->name:'';
            })->addColumn('manifest_id', function ($sector) {
                return isset($sector->manifest->manifest_no)?$sector->manifest->manifest_no:'';
            })->addColumn('branch', function ($sector) { 
                return $sector->branch->name;
            })->addColumn('date', function ($sector) { 
                return $sector->created_at->format('d/m/y');
            })->addColumn('action', function ($sector){
                if($sector->id){
                    $btn = '<a href="' . route('admin.view_sector', ['id' => $sector->id]) . '" class="btn btn-info btn-sm" target="_blank">View</a>';
                    if($sector->sectorBookedCount()==0){
                        $btn .= '<a href="' . route('admin.delete_sector', ['id' => $sector->id]) . '" class="btn btn-danger" onclick="return confirm(\'Are You Sure To Delete ??\')">Delete</a>';
                        $btn .= '<a href="' . route('admin.sector_edit_form', ['id' => $sector->id]) . '" class="btn btn-primary" target="_blank">Edit</a>';
                    }
                    return $btn;
                }else{
                    return null;
                }
            })->rawColumns(['action','manifest_id', 'date','origin','branch', 'destination'])
            ->make(true);
    }

    public function deleteSector($id){
        $sector = SectorBooking::where('id',$id)->first();
        $docates = Docate::where('sector_id',$id)->get();
       
        $sector_details = SectorDetails::where('sector_id',$id)->where('baging_id',$sector->bagging_id)->delete();
        foreach($docates as $docate){
            if($docate->courier_status ==4){
                $docate->courier_status = 3;
                $docate->status = 3;
                $docate->sector_id = null;
                $docate->save();
            }
            $sector->delete();
        }
        return redirect()->back();

    }

    public function editSectorForm($id){
        $city = City::get();
        $sector = SectorBooking::where('id',$id)->first();
        $sector_details = SectorDetails::where('sector_id',$id)->get();
        return view('admin.outbound.sector_edit_form',compact('city','sector','sector_details'));
    }

    public function updateSector(Request $request,$sector_id){
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
           
            'mode'=>'required',
        ]);

        $sector = SectorBooking::where('id',$sector_id)->first();
        $sector->origin = $request->input('origin') ;
        $sector->destination = $request->input('destination');
        $sector->booked_by = $request->input('booked_by') ;
        $sector->arr_date = $request->input('arr_date') ;
        $sector->arr_time = $request->input('arr_time') ;
        $sector->dep_time = $request->input('dep_time') ;
        $sector->dep_date = $request->input('dep_date') ;
        $sector->vehicle_no = $request->input('vehicle_no');
        $sector->cd_no = $request->input('cd_no');
        $sector->mode = $request->input('mode');
        $sector->co_loader_name = $request->input('coloader_name') ;
        $sector->book_date = $request->input('date') ;
        $sector->book_time = $request->input('time');
        if($sector->save()){
            return redirect()->back()->with('message','Sector Booking Details Updated Successfully');
        }else{
            return redirect()->back()->with('errot','Something Went Wrong!');
        }

    }

    public function viewSector($id){
        $sector_details = SectorDetails::where('sector_id',$id)->first();
        return view('admin.outbound.sector_details',compact('sector_details'));
    }
}
