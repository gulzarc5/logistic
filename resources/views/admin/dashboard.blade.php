@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
     <!-- top tiles -->
     <div class="row tile_count">
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count" style="text-align: center">
        <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
        <div class="count green">{{ $total_users }}</div>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count"  style="text-align: center">
        <span class="count_top"><i class="fa fa-clock-o"></i> Docate Booked Today</span>
        <div class="count green">{{ $docates_count }}</div>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count"  style="text-align: center">
          <span class="count_top"><i class="fa fa-user"></i> Docate Pickup Today </span>
          <div class="count green">{{ $docates_pickup_count }}</div>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count"  style="text-align: center">
        <span class="count_top"><i class="fa fa-user"></i> Docate Delivered Today</span>
        <div class="count green">{{ $docates_delivered_count }}</div>
      </div>
      
    </div>
    <!-- /top tiles -->

    <div class="row">
      <div class="col-md-12">
        <div class="col-md-6">
          <div id="order_graph2"></div>
        </div>
        <div class="col-md-6">
          <h4>Docates Delivered Today</h4>
          <div class="table-responsive" style="height:300px;overflow:auto;">
            <table class="table table-striped jambo_table bulk_action">
              <thead>
                <tr class="headings" style="font-size: 10.5px;">
                  <th class="column-title">Sl No. </th>
                  <th class="column-title">Sender Name </th>
                  <th class="column-title">Docate No</th>
                  <th class="column-title">Date</th>
                </tr>
            </thead>
            @php
              $count = 1;
            @endphp
            <tbody class="form-text-element">
              @if(isset($today_delivered) && !empty($today_delivered) && count($today_delivered)>0)
                @foreach($today_delivered as $docates)
                  <tr class="even pointer">
                    <td>{{ $count++ }}</td>
                    <td>{{ $docates->sender_name }}</td>
                    <td>{{ $docates->docate_id}}</td>
                    <td>{{ $docates->created_at->format('d/m/y')}}</td>
                  </tr>
                @endforeach
              @else
              <td></td>
              <td></td>
              <td>No Docates Delivered today</td>
              <td></td>
              @endif
            </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="col-md-6">
          <h4>Docates Picked  Today</h4>
          <div class="table-responsive" style="height:300px;overflow:auto;">
            <table class="table table-striped jambo_table bulk_action">
              <thead>
                <tr class="headings" style="font-size: 10.5px;">
                  <th class="column-title">Sl No. </th>
                  <th class="column-title">Sender Name </th>
                  <th class="column-title">Docate No</th>
                  <th class="column-title">Date</th>
                </tr>
            </thead>
            @php
              $countwo = 1;
            @endphp
            <tbody class="form-text-element">
              @if(isset($today_pickup) && !empty($today_pickup) && count($today_pickup)>0)
                @foreach($today_pickup as $pickup_docates)
                  <tr class="even pointer">
                    <td>{{ $countwo++ }}</td>
                    <td>{{ $pickup_docates->sender_name }}
                    <td>{{ $pickup_docates->docate_id}}</td>
                    <td>{{ Carbon\Carbon::parse($pickup_docates->pickup_date)->format('d/m/y')}}</td>
                  </tr>
                @endforeach
              @else
              <tr class="even pointer">
                <td></td>
                <td></td>
                <td>No Docates Pickep Up today</td>
                <td></td>
              </tr>
              @endif
            </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-6">
          <div id="order_graph"></div>
        </div>
      </div>
    </div>

</div>
@endsection

@section('script')
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
<script src="{{asset('admin/vendors/morris.js/morris.js')}}"></script>
<script>
  $(function () {
    Morris.Donut({
      element: 'order_graph',
      data: [
      {value: {{$pie['inbound_pie_data']}}, label: 'Inbound  Docates'},
      {value: {{$pie['outbound_pie_data']}}, label: 'Outbound Docates'},
      
      ],
      backgroundColor: '#ccc',
      labelColor: '#060',
      colors: [
      '#FF5733',
      '#FF0000',
      '#008000'
      ],
      formatter: function (x) { return x + "%"}
    });
  });


  var data = [
    @for($i = 0; $i < 11; $i++)
        @if($i==10)
            { y:"{{$chart[$i]['level']}}", a: {{$chart[$i]['inbound']}}, b: {{$chart[$i]['outbound']}}}
        @else
            { y: "{{$chart[$i]['level']}}", a: {{$chart[$i]['inbound']}}, b: {{$chart[$i]['outbound']}}},
        @endif
    @endFor
  ],
  formatY = function (y) {
      return '$'+y;
  },
  formatX = function (x) {
      return x.src.y;
  },
  config = {
      xLabels: 'month',
      data: data,
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['Inbound Docates', 'Outbound Docates'],
      fillOpacity: 0.6,
      stacked: true,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true,
      pointFillColors:['#ffffff'],
      pointStrokeColors: ['black'],
      lineColors:['gray','red']
  };
  config.element = 'order_graph2';
  Morris.Area(config);
</script>
@endsection
