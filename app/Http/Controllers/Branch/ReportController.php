<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Docate;
use App\Inbound;
use App\DocateHistory;
use Auth;
use App\Manifest;
use App\Drs;
use App\Baging;
use App\SectorBooking;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Docates;
use App\Exports\Manifests;
use App\Exports\Bagings;
use App\Exports\SectorBookings;
use App\Exports\Drss;
use App\Services\BranchService;

class ReportController extends Controller
{
    protected $branch_id;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->branch_id = BranchService::branchId();
            return $next($request);
        });
    }

    public function reportForm(){
        return view('branch.outbound.report_form');
    }

    public function fetchAllEntries(Request $request){
       $start_date = $request->get('start_from');
       $end_date = $request->get('end_from');
       $date_start = date('Y-m-d', strtotime($start_date))." 00:00:00";
       $date_end = date('Y-m-d', strtotime($end_date))." 23:59:59";
       $types = $request->get('type');
      
        if($types=="Y"){
            if($start_date == null && $end_date == null){
                $docate_data = Docate::orderBy('id','desc')->where('branch_id',$this->branch_id);
            }else{
                $docate_data = Docate::whereBetween('created_at', [$date_start, $date_end])
                ->orderBy('id','desc')
                ->where('branch_id',$this->branch_id);
            }
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
           })->addColumn('sender_name', function ($row) {
                if (isset($row->sender->name)) {
                    return $row->sender->name;
                } else {
                    return null;
                }
            })->addColumn('receiver_name', function ($row) {
                if (isset($row->receiver->name)) {
                    return $row->receiver->name;
                } else {
                    return null;
                }
            })->addColumn('invoice_no', function ($row) {
                if (isset($row->invoice_no)) {
                    return $row->invoice_no;
                } else {
                    return null;
                }
            })->addColumn('invoice_value', function ($row) {
                if (isset($row->invoice_value)) {
                    return $row->invoice_value;
                } else {
                    return null;
                }
            })->addColumn('delivery_date', function ($row) {
                if (isset($row->inbound->delivery_date)) {
                    return $row->inbound->delivery_date;
                } else {
                    return null;
                }
            })->addColumn('remarks', function ($row) {
                if (isset($row->inbound->negative_status)) {
                    return $row->inbound->negative_status;
                } else {
                    return null;
                }
            })->addColumn('action', function ($row) {
                return $btn = '<a target="_blank" href="' . route('branch.view_details', ['id' => $row->id,'status'=>1]) . '" class="btn btn-primary">View</a>';
            })->rawColumns(['origin_city', 'remarks','destination_city','sender_name','receiver_name','action','invoice_no','invoice_value','delivery_date'])
            ->make(true);
                                
        }else{
            
            $inbound_docates = Inbound::whereBetween('created_at', [$date_start, $date_end])
                ->orderBy('id','desc')->where('branch_id',$this->branch_id);;
                
            
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
                })->addColumn('sender_name', function ($row) {
                    if (isset($row->docate->sender->name)) {
                        return $row->docate->sender->name;
                    } else {
                        return null;
                    }
                })->addColumn('receiver_name', function ($row) {
                    if (isset($row->docate->receiver->name)) {
                        return $row->docate->receiver->name;
                    } else {
                        return null;
                    }
                })->addColumn('invoice_no', function ($row) {
                    if (isset($row->docate->invoice_no)) {
                        return $row->docate->invoice_no;
                    } else {
                        return null;
                    }
                })->addColumn('invoice_value', function ($row) {
                    if (isset($row->docate->invoice_value)) {
                        return $row->docate->invoice_value;
                    } else {
                        return null;
                    }
                })->addColumn('delivery_date', function ($row) {
                    if (isset($row->delivery_date)) {
                        return $row->delivery_date;
                    } else {
                        return null;
                    }
                })->addColumn('remarks', function ($row) {
                    if (isset($row->negative_status)) {
                        return $row->negative_status;
                    } else {
                        return null;
                    }
                })->addColumn('action', function ($row) {
                    return $btn = '<a target="_blank" href="' . route('branch.view_details', ['id' => $row->id,'status'=>2]) . '" class="btn btn-primary">View</a>';
                 })->rawColumns(['origin_city','sender_name','receiver_name','action','actual_weight','no_of_box','docate_id','destination_city','pickup_date','pickup_time','remarks','delivery_date','invoice_value','invoice_no'])
                ->make(true);
        }
           
       
    }

    public function viewDetails($id,$status){
       if($status == 2){
           $inbound = Inbound::where('id',$id)->first();
           $docate = Docate::where('docate_id',$inbound->docate_no)->first();
           $id = $docate->id;
       }
        $docate_data = Docate::where('docate.id',$id)
                        ->where('docate.branch_id',$this->branch_id)
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
                        ->where('docate.branch_id',$this->branch_id)
                        ->join('manifest','manifest.id','=','docate.manifest_id')
                        ->join('docate_details as receiver_name','receiver_name.id','=','docate.receiver_id')
                        ->join('city as origin_city','origin_city.id','=','manifest.origin')
                        ->join('city as destination_city','destination_city.id','=','manifest.destination')
                        ->select('docate.*','manifest.created_at as date','manifest.manifest_no as manifest_no','origin_city.name as origin_city','receiver_name.name as receiver_name','destination_city.name as destination_city')
                        ->first();
        $baging_data = Docate::where('docate.id',$id)
                        ->where('docate.branch_id',$this->branch_id)
                        ->join('manifest','manifest.id','=','docate.manifest_id')
                        ->join('baging','baging.manifest_id','=','manifest.id')
                        ->join('docate_details as receiver_name','receiver_name.id','=','docate.receiver_id')
                        ->join('city as origin_city','origin_city.id','=','baging.origin')
                        ->join('city as destination_city','destination_city.id','=','baging.destination')
                        ->select('docate.*','baging.created_at as date','baging.lock_no as lock_no','origin_city.name as origin_city','receiver_name.name as receiver_name','destination_city.name as destination_city','manifest.manifest_no as manifest_no as manifest_no','manifest.created_at as created_data')
                        ->first();
        $sector_data = Docate::where('docate.id',$id)
                        ->where('docate.branch_id',$this->branch_id)
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
        $docate_id = Docate::where('id',$id)->first();
        $docate_no = $docate_id->docate_id;
        $inbound = Inbound::where('docate_no',$docate_no)->first();
        return view('branch.outbound.view_details',compact('docate_data','manifest_data','baging_data','inbound','sector_data','tracking_details'));
    }

    public function DocateListExcelExport(Request $request){
        
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $type = $request->input('report_type');
        return Excel::download(new Docates($start_date,$end_date,$type), 'docate_list.xlsx');
    }

    public function manifestReportForm(){
        return view('branch.outbound.manifest_report');
    }

    public function manifestListAjax(Request $request){
       
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
       
        $manifest = Manifest::OrderBy('id','desc');
        if (!empty($start_date) && !empty($end_date)) {
            $manifest->whereDate('created_at','>=', $start_date)
                ->whereDate('created_at','<=', $end_date)
                ->where('branch_id',$this->branch_id);
        }
        
            return datatables()->of($manifest->get())
            ->addIndexColumn()
            ->addColumn('origin', function ($manifest) {
                return isset($manifest->originName->name)?$manifest->originName->name:'';
            })->addColumn('destination', function ($manifest) {
                return isset($manifest->destinationName->name)?$manifest->destinationName->name:'';
            })->addColumn('total_no_docates', function ($manifest) {
                return isset($manifest->totalDocateCount)?$manifest->totalDocateCount->count():0;
            })->addColumn('date', function ($manifest) { 
                return $manifest->created_at->format('d/m/y');
            
            })->rawColumns([ 'date','origin','total_no_docates','destination'])
            ->make(true);
    }

    public function ManifestListExcelExport(Request $request){
        
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
       
        return Excel::download(new Manifests($start_date,$end_date), 'manifest_list.xlsx');
    }

    public function bagingReportForm(){
        return view('branch.outbound.baging_report');
    }

    public function bagingListAjax(Request $request){
       
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
       
        $baging = Baging::OrderBy('id','desc');
        if (!empty($start_date) && !empty($end_date)) {
            $baging->whereDate('created_at','>=', $start_date)
                ->whereDate('created_at','<=', $end_date)
                ->where('branch_id',$this->branch_id);
        }
        
            return datatables()->of($baging->get())
            ->addIndexColumn()
            ->addColumn('origin', function ($baging) {
                return isset($baging->originName->name)?$baging->originName->name:'';
            })->addColumn('destination', function ($baging) {
                return isset($baging->destinationName->name)?$baging->destinationName->name:'';
            })->addColumn('total_no_docates', function ($baging) {
                return isset($baging->docatesCount)?$baging->docatesCount->count():0;
            })->addColumn('manifest_id', function ($baging) {
                return isset($baging->manifest->manifest_no)?$baging->manifest->manifest_no:'';
            })->addColumn('date', function ($baging) { 
                return $baging->created_at->format('d/m/y');
            
            })->rawColumns([ 'date','origin','manifest_id','total_no_docates','destination'])
            ->make(true);
    }

    public function bagingListExcelExport(Request $request){
        
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        return Excel::download(new Bagings($start_date,$end_date), 'baging_list.xlsx');
    }

    public function sectorReportForm(){
        return view('branch.outbound.sector_report');
    }

    public function sectorListAjax(Request $request){
       
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
       
        $sector = SectorBooking::OrderBy('id','desc');
        if (!empty($start_date) && !empty($end_date)) {
            $sector->whereDate('created_at','>=', $start_date)
                ->whereDate('created_at','<=', $end_date)->where('branch_id',$this->branch_id);
        }
        
            return datatables()->of($sector->get())
            ->addIndexColumn()
            ->addColumn('origin', function ($sector) {
                return isset($sector->originName->name)?$sector->originName->name:'';
            })->addColumn('destination', function ($sector) {
                return isset($sector->destinationName->name)?$sector->destinationName->name:'';
            })->addColumn('total_no_docates', function ($sector) {
                return isset($sector->totalDocateCount)?$sector->totalDocateCount->count():0;
            })->addColumn('manifest_id', function ($sector) {
                return isset($sector->manifest->manifest_no)?$sector->manifest->manifest_no:'';
            })->addColumn('date', function ($sector) { 
                return $sector->created_at->format('d/m/y');
            
            })->rawColumns([ 'date','origin','manifest_id','total_no_docates','destination'])
            ->make(true);
    }

    public function sectorListExcelExport(Request $request){
        
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        return Excel::download(new SectorBookings($start_date,$end_date), 'sector_booking_list.xlsx');
    }

    public function drsReportForm(){
        return view('branch.outbound.drs_report');
    }

    public function drsListAjax(Request $request){
       
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
       
        $drs = Drs::OrderBy('id','desc');
        if (!empty($start_date) && !empty($end_date)) {
            $drs->whereDate('created_at','>=', $start_date)
                ->whereDate('created_at','<=', $end_date)
                ->where('branch_id',$this->branch_id);
        }
        
            return datatables()->of($drs->get())
            ->addIndexColumn()
           
            ->addColumn('status', function ($drs) {
               if($drs->status ==1){
                   return $btn = '<a class="btn btn-success btn-xs">Drs Prepared</a>';
               }else{
                   return $btn =  '<a class="btn btn-primary btn-xs">Drs Closed</a>';
               }
            
            })->rawColumns([ 'status'])
            ->make(true);
    }

    public function drsListExcelExport(Request $request){
        
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        return Excel::download(new Drss($start_date,$end_date), 'drs_list.xlsx');
    }

}

