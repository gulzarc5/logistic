<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Docate;
use App\Inbound;
use App\DocateHistory;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Docates;
class ReportController extends Controller
{
    public function reportForm(){
        return view('branch.outbound.report_form');
    }

    public function fetchAllEntries(Request $request){
       $start_date = $request->get('start_from');
       $end_date = $request->get('end_from');
       $date_start = date('Y-m-d', strtotime($start_date));
       $date_end = date('Y-m-d', strtotime($end_date));
       $types = $request->get('type');
      
        if($types=="Y"){
            
            $docate_data = Docate::whereBetween('created_at', [$date_start, $date_end])
                ->orderBy('id','desc');
                
            return datatables()->of($docate_data->get())
            ->addIndexColumn()
            ->addColumn('origin_city', function ($row) {
                if (isset($row->sender->cityName->name)) {
                    return $row->sender->cityName->name;
                } else {
                    return null;
                }
            })->addColumn('destination_city', function ($row) {
                if (isset($row->receiver->cityName->name)) {
                    return $row->receiver->cityName->name;
                } else {
                    return null;
                }
            })->addColumn('action', function ($row) {
                return $btn = '<a target="_blank" href="' . route('branch.view_details', ['id' => $row->id]) . '" class="btn btn-primary">View</a>';
            })->rawColumns(['origin_city', 'destination_city','action'])
            ->make(true);
                                
        }else{
            
            $inbound_docates = Inbound::whereBetween('created_at', [$date_start, $date_end])
                ->orderBy('id','desc');
                
            
            return datatables()->of($inbound_docates->get())
                ->addIndexColumn()
                ->addColumn('docate_id', function ($row) {
                    if (isset($row->docate_no)) {
                        return $row->docate_no;
                    } else {
                        return null;
                    }
                })->addColumn('no_of_box', function ($row) {
                    
                    if (isset($row->docate->no_of_box)) {
                        return $row->docate->no_of_box;
                    } else {
                        return null;
                    }
                })->addColumn('actual_weight', function ($row) {
                    if (isset($row->docate->actual_weight)) {
                        return $row->docate->actual_weight;
                    } else {
                        return null;
                    }
                })
                ->addColumn('origin_city', function ($row) {
                    if (isset($row->docate->sender->cityName->name)) {
                        return $row->docate->sender->cityName->name;
                    } else {
                        return null;
                    }
                })->addColumn('destination_city', function ($row) {
                    if (isset($row->docate->receiver->cityName->name)) {
                        return $row->docate->receiver->cityName->name;
                    } else {
                        return null;
                    }
                })->addColumn('pickup_date', function ($row) {
                    if (isset($row->docate->pickup_date)) {
                        return $row->docate->pickup_date;
                    } else {
                        return null;
                    }
                })->addColumn('pickup_time', function ($row) {
                    if (isset($row->docate->pickup_time)) {
                        return $row->docate->pickup_time;
                    } else {
                        return null;
                    }
                })->addColumn('action', function ($row) {
                    return $btn = '<a target="_blank" href="' . route('branch.view_details', ['id' => $row->id]) . '" class="btn btn-primary">View</a>';
                 })->rawColumns(['origin_city','action','actual_weight','no_of_box','docate_id','destination_city','pickup_date','pickup_time'])
                ->make(true);
        }
           
       
    }

    public function viewDetails($id){
       
        $docate_data = Docate::where('docate.id',$id)
                        ->where('docate.branch_id',Auth::user()->id)
                        ->join('docate_details','docate.id','=','docate_details.docate_id')
                        ->join('docate_details as sender_details','docate.sender_id','=','sender_details.id')
                        ->join('city as origin_city','origin_city.id','sender_details.city')
                        ->join('docate_details as receiver_details','docate.receiver_id','=','receiver_details.id')
                        ->join('state as sender_state','sender_state.id','=','sender_details.state')
                        ->join('city as receiver_city','receiver_city.id','=','receiver_details.city')
                        ->join('state as receiver_state','receiver_state.id','=','receiver_details.state')
                        ->select('docate.*','origin_city.name as origin_city','sender_details.name as sender_name','sender_details.pin as sender_pin','sender_state.name as sender_state','sender_details.address as sender_address','receiver_details.name as receiver_name','receiver_city.name as receiver_city','receiver_details.pin as receiver_pin','receiver_state.name as receiver_state','receiver_details.address as receiver_address')
                        ->first();
        
        $manifest_data = Docate::where('docate.id',$id)
                        ->where('docate.branch_id',Auth::user()->id)
                        ->join('manifest','manifest.id','=','docate.manifest_id')
                        ->join('docate_details as receiver_name','receiver_name.id','=','docate.receiver_id')
                        ->join('city as origin_city','origin_city.id','=','manifest.origin')
                        ->join('city as destination_city','destination_city.id','=','manifest.destination')
                        ->select('docate.*','manifest.created_at as date','manifest.manifest_no as manifest_no','origin_city.name as origin_city','receiver_name.name as receiver_name','destination_city.name as destination_city')
                        ->first();
        $baging_data = Docate::where('docate.id',$id)
                        ->where('docate.branch_id',Auth::user()->id)
                        ->join('manifest','manifest.id','=','docate.manifest_id')
                        ->join('baging','baging.manifest_id','=','manifest.id')
                        ->join('docate_details as receiver_name','receiver_name.id','=','docate.receiver_id')
                        ->join('city as origin_city','origin_city.id','=','baging.origin')
                        ->join('city as destination_city','destination_city.id','=','baging.destination')
                        ->select('docate.*','baging.created_at as date','baging.lock_no as lock_no','origin_city.name as origin_city','receiver_name.name as receiver_name','destination_city.name as destination_city','manifest.manifest_no as manifest_no as manifest_no','manifest.created_at as created_data')
                        ->first();
        $sector_data = Docate::where('docate.id',$id)
                        ->where('docate.branch_id',Auth::user()->id)
                        ->join('manifest','manifest.id','=','docate.manifest_id')
                        ->join('baging','baging.manifest_id','=','manifest.id')
                        ->join('sector_booking as sector_manifest','sector_manifest.manifest_id','=','manifest.id')
                        ->join('sector_booking as sector_baging','sector_baging.bagging_id','=','baging.id')
                        ->join('docate_details as receiver_name','receiver_name.id','=','docate.receiver_id')
                        ->join('city as origin_city','origin_city.id','=','sector_baging.origin')
                        ->join('city as destination_city','destination_city.id','=','sector_baging.destination')
                        ->select('manifest.manifest_no as manifest_no','sector_baging.book_date as date','sector_baging.*','docate.*','destination_city.name as destination','origin_city.name as origin')
                        ->first();
        $tracking_details = DocateHistory::where('data_id',$id)->get();
        return view('branch.outbound.view_details',compact('docate_data','manifest_data','baging_data','sector_data','tracking_details'));
    }

    public function DocateListExcelExport(Request $request){
        
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $type = $request->input('report_type');
        return Excel::download(new Docates($start_date,$end_date,$type), 'docate_list.xlsx');
    }
}

