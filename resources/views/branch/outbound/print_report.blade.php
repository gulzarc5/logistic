@extends('branch.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" id="printable">
              <?php
                  // if (isset($_GET['msg'])) {
                  //   showMessage($_GET['msg']);
                  // }
              ?>
                <div class="x_title" style="border-bottom: white;">

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        {{--///////////////////// Company Address ///////////////////////--}}
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            {{-- <img src="uploads/logo.png" height="150" style="height: 38px;margin-bottom: 18px; margin-right: -9px;"> --}}
                            <b style="font-size: 35px;color: #0194ea;">Logi</b>
                            <b style="font-size: 35px;color: #262161;">stics</b>
                           
                        </div>

                        {{--///////////////// Invoice Details ////////////////////--}}
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <span style="font-size: 38px;color: black;font-weight: bold;">REPORT</span>
                        </div>
                    </div>

                    {{--//////////////////// Shipping Details And Billing Details ///////////////////--}}
                    

                </div>

                {{-- ////////////////// Order Details /////////////////////////////--}}
                <div class="x_content table-responsive">
                    <div class="col-md-12 col-xs-12 col-sm-12" style="padding-top: 16px;">
                        <table class="table">
                            <thead>
                                <tr style="background-color: #0089ff;color:white ">
                                <th style="min-width: 125px;">Docate No</th>
                                <th>Sender Name</th>
                                <th>Receiver Name</th>
                                <th>Origin</th>
                                <th>Destination</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($docate_data as $docate)
                                <tr>
                                    <td>{{ $docate->docate_id }}</td>
                                    <td>{{ $docate->sender_name }}</td>
                                    <td>{{ $docate->receiver_name }}</td>
                                    <td>{{ $docate->origin_city_name }}</td>
                                    <td>{{ $docate->destination_city_name}}</td>
                                </tr>
                               @endforeach
                                
                                
                            </tbody>
                        </table>
                        </div>
                        <div class="col-md-7 col-xs-7 col-sm-7">
                        <table class="table">
                            <thead>
                           
                            </thead>
                            <tbody>
                            <tr>
                                {{-- <td> <img src="{{asset('images/'.$invoice_setting->image.'')}}" style="height: 169px;width: 543px;"></td> --}}
                            </tr>

                            </tbody>
                        </table>
                        </div>

                        <div class="col-md-12 col-xs-12 col-sm-12">
                        <button class="btn btn-info" id="print-btn" onclick="printDiv()">Print</button>
                            <a class="btn btn-danger" onclick="window.close()" id="backprint">Close</a>
                        </div>
                    </div>
                    <div id="thanks_msg"></div>
            </div>
          </div>
        </div>
      </div>
</div>


 @endsection

@section('script')

<script type="text/javascript">
    function printDiv() {
       var printContents = document.getElementById("printable").innerHTML;
       var originalContents = document.body.innerHTML;

       document.body.innerHTML = printContents;
       // document.getElementById("thanks_msg").innerHTML = "Thanks For Shopping With Us";

       //document.getElementById("backprint").hide();
       element = document.getElementById('backprint');
       element.style.display = "none";

        element = document.getElementById('print-btn');
       element.style.display = "none";

       window.print();

       element.style.display = "";
       document.getElementById("thanks_msg").innerHTML ="";
       document.body.innerHTML = originalContents;
    }
  </script>

 @endsection
