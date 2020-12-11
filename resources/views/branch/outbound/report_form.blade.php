@extends('branch.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div>
            <h2>Docate Report</h2>
        </div>
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">
                <div class="x_title">
                    <form method="POST" action="{{ route('branch.docate_report_downloads_xls') }}">
                    @csrf
                    <div class="well" style="overflow: auto">
                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                            <label for="start_date"> Start Date</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" >
                        </div> 
                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                            <label for="end_date">End Date</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" >
                        </div> 
                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                            <label for="report_type"> Type</label>
                            <select class="form-control" name="report_type"  id="type" >
                                <option value="" >Select Report Type</option>
                                <option value="Y" > Outbound</option>
                                <option value="N" > Inbound</option>
                            </select>
                        </div> 
                        <div class="col-md-6 col-sm-4 col-xs-12 mb-3">
                            <label for="button" style="display: block">Action</label>
                            <button type="submit"   class="btn btn-info"> Export</button>
                            <a   onclick = "fetchDetails()" class="btn btn-info" >Search </a>
                        </div>
                    </div>
                </form>
              </div>
                <div>
                    <div class="x_content">
                        <table id="contact_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>CN No</th>
                                    <th>Pickup Date</th>
                                    <th>Pickup Time</th>
                                    <th>Sender Name</th>
                                    <th>Receiver Name</th>
                                    <th>No Of Packets</th>
                                    <th>Actual Weight</th>
                                    <th>Invoice No</th>
                                    <th>Invoice value</th>
                                    <th>Delivery Date</th>
                                    <th>Remarks</th>
                                    <th>Origin City</th>
                                    <th>Destination City</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>                       
                            </tbody>
                        </table>
                    </div>
                </div>
    	    </div>
    	</div>
    </div>
</div>


 @endsection

@section('script')

  <script type="text/javascript">
   function fetchDetails(){
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var type = $('#type').val();
        var table = $('#contact_list').DataTable({
            processing: true,
            serverSide: true,
            "destroy" : true,
          
            "ajax": {
                "url": "{{ route('branch.fetch_all_entries') }}",
                "data": function ( d ) {
                    d.start_from = start_date,
                    d.end_from = end_date,
                    d.type = type
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'docate_id', name: 'docate_id',searchable: true},
                {data: 'pickup_date', name: 'pickup_date' ,searchable: true},  
                {data: 'pickup_time', name: 'pickup_time' ,searchable: true},  
                {data: 'sender_name', name: 'sender_name' ,searchable: true}, 
                {data: 'receiver_name', name: 'receiver_name' ,searchable: true},   
                {data: 'no_of_box', name: 'no_of_box' ,searchable: true},  
                {data: 'actual_weight', name: 'actual_weight' ,searchable: true},  
                {data: 'invoice_no', name: 'invoice_no' ,searchable: true},  
                {data: 'invoice_value', name: 'invoice_value' ,searchable: true}, 
                {data: 'delivery_date', name: 'delivery_date' ,searchable: true},
                {data: 'remarks', name: 'remarks' ,searchable: true},  
                {data: 'origin_city', name: 'origin_city' ,searchable: true},  
                {data: 'destination_city', name: 'destination_city' ,searchable: true},  
               
                {data: 'action', name: 'action' ,searchable: false}                 
                
            ]
        });
        
    }
  </script>

{{-- <script>
  function export_excel(){
  window.location.href = "{{route('admin.product_list_excel')}}";
}
</script> --}}
    
 @endsection