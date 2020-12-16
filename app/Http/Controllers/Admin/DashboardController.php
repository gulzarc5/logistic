<?php

namespace App\Http\Controllers\Admin;

use App\Docate;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $total_users = User::whereNotNull('user_role')->count();
        $docates_count = Docate::whereDate('created_at',$today_date)->count();
        $docates_pickup_count = Docate::whereDate('created_at',$today_date)->where('courier_status',5)->count();
        $docates_delivered_count = Docate::whereDate('created_at',$today_date)->where('courier_status',8)->count();
        
        // dd(1);
        
        $today_delivered = Docate::where('courier_status', 8)
            ->whereDate('docate.created_at',$today_date)
            ->join('docate_details as sender','sender.id','=','docate.sender_id')
            ->select('docate.*','sender.name as sender_name')
            ->get();
        $today_pickup=Docate::where('courier_status', 5)
            ->whereDate('docate.created_at',$today_date)
            ->join('docate_details as sender','sender.id','=','docate.sender_id')
            ->select('docate.*','sender.name as sender_name')
            ->get();

        return view('admin.dashboard',compact('total_users','docates_count','docates_pickup_count','docates_delivered_count','chart','pie','today_delivered','today_pickup'));
    }

    function inboundpieData($from_date,$to_date)
    {
        $inbound_data = Docate::whereBetween('courier_status',[5,9])->whereBetween('created_at',[$from_date,$to_date])->count();
        return $inbound_data;
    }

    function outboundpieData($from_date,$to_date)
    {
        $outbound_data = Docate::whereBetween('courier_status', [1, 9])->whereBetween('created_at',[$from_date,$to_date])->count();
        return $outbound_data;
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

    function chartQueryInbound($month){
        $inbound = Docate::whereBetween('courier_status',[5,9])->whereMonth('created_at', $month)->count();
        return $inbound;
    }

    function chartQueryoutbound($month){
        $outbound = Docate::whereBetween('courier_status', [1, 9])->whereMonth('created_at', $month)->count();
        return $outbound;
    }

}
