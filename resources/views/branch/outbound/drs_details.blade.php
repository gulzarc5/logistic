@extends('branch.template.admin_master')

@section('content')

<link href="{{ asset('admin/select2-4.1.0-beta.1/dist/css/select2.min.css') }}" rel="stylesheet" />
<style>
    .error{
        color:red;
    }
</style>
<div class="right_col" role="main">
    <div class="row">
        <div><h2>DRS Details</h2></div>
         <div class="col-md-12" style="margin-top:50px;">
            <div id="docket">
               
                <table id="product_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>CN No</th>
                           
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="data_row">
                        @if (isset($drs) && !empty($drs))                            
                            @php
                                $inbound_data = $drs->inbound;
                                // dd($inbound_data);
                            @endphp

                            @forelse($inbound_data as $item)
                        
                                <tr>
                                    <th id="cn_no">
                                        {{ $item->docate_no }}
                                    </th>
                                    <th>
                                        @if($item->status == 1)
                                            Pick Up
                                        @elseif($item->status == 2)
                                            Out For Delivery
                                        @elseif($item->status ==3)
                                            Delivered
                                        @else
                                            Delivery Delayed
                                        @endif

                                    </th>
                                </tr>
                            @empty

                            @endforelse
                        @endif
                    </tbody>
                </table>
               
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    
@endsection


        
    