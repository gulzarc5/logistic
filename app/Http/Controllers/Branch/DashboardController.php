<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Docate;
use Carbon\Carbon;
use Auth;
class DashboardController extends Controller
{
    public function dashboardView()
    {
        $date = Carbon::now();
        $to_date = $date->toDateTimeString();
        $from_date = $date->subMonths(3)->toDateTimeString();
        
        $inbound_pie = $this->inboundpieData($from_date,$to_date);
        $outbound_pie = $this->outboundpieData($from_date,$to_date);
        $total_docates = $inbound_pie+$outbound_pie;
        $pie = [
            'inbound_pie_data' => $total_docates == 0 ? 0 : round(($inbound_pie*100)/$total_docates),
            'outbound_pie_data' => $total_docates == 0 ? 0 : round(($outbound_pie*100)/$total_docates),
        ];
        $today_date = Carbon::today()->toDateString();
        $chart = $this->chartData();
        $new_docates = Docate::where('courier_status',1)->where('branch_id',Auth::user()->id)->count();
        $docates_manifested = Docate::where('courier_status',2)->where('branch_id',Auth::user()->id)->count();
        $docates_bagged =  Docate::where('courier_status',3)->where('branch_id',Auth::user()->id)->count();
        $docates_sector_booked =  Docate::where('courier_status',4)->where('branch_id',Auth::user()->id)->count();
        $docates_picked =  Docate::where('courier_status',5)->where('branch_id',Auth::user()->id)->count();
        $today_delivered = Docate::where('courier_status', 8)
                                ->where('branch_id',Auth::user()->id)
                                ->whereDate('docate.created_at','=',$today_date)
                                ->join('docate_details as sender','sender.id','=','docate.sender_id')
                                ->select('docate.*','sender.name as sender_name')
                                ->get();
        $today_pickup=Docate::where('courier_status', 5)
                            ->where('branch_id',Auth::user()->id)
                            ->whereDate('docate.created_at','=',$today_date)
                            ->join('docate_details as sender','sender.id','=','docate.sender_id')
                            ->select('docate.*','sender.name as sender_name')
                            ->get();
        return view('branch.dashboard',compact('new_docates','docates_manifested','docates_bagged','docates_sector_booked','chart','pie','today_delivered','today_pickup','docates_picked'));
    }

    function chartData(){
        $data[] = [
            'level' => Carbon::now()->format('Y-m'),
            'inbound' => $this->chartQueryInbound(Carbon::now()->month),
            'outbound' => $this->chartQueryoutbound(Carbon::now()->month),
        ];

        for ($i=1; $i < 11; $i++) {
            $data[] = [
                'level' => Carbon::now()->subMonths($i)->format('Y-m'),
                'inbound' => $this->chartQueryInbound(Carbon::now()->subMonths($i)->month),
                'outbound' => $this->chartQueryoutbound(Carbon::now()->subMonths($i)->month),
            ];
        }
        return $data;
    }

    function inboundpieData($from_date,$to_date)
    {
        $inbound_data = Docate::whereBetween('courier_status',[5,9])->where('branch_id',Auth::user()->id)->whereBetween('created_at',[$from_date,$to_date])->count();
        return $inbound_data;
    }

    function outboundpieData($from_date,$to_date)
    {
        $outbound_data = Docate::whereBetween('courier_status', [1, 9])->where('branch_id',Auth::user()->id)->whereBetween('created_at',[$from_date,$to_date])->count();
        return $outbound_data;
    }

    
    function chartQueryInbound($month){
        $inbound = Docate::whereBetween('courier_status',[5,9])->where('branch_id',Auth::user()->id)->whereMonth('created_at', $month)->count();
        return $inbound;
    }

    function chartQueryoutbound($month){
        $outbound = Docate::whereBetween('courier_status', [1, 9])->where('branch_id',Auth::user()->id)->whereMonth('created_at', $month)->count();
        return $outbound;
    }
}
