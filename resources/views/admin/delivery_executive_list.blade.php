@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Delivery Executive List </h2>
    	            <div class="clearfix"></div>
              </div>
    	        <div>
    	            <div class="x_content">
                        <table id="contact_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                             
                              <th>First Name</th>
                              <th>Last Name</th>
                              <th>Email Address</th>
                              <th>Phone</th>
                              <th>City</th>
                              <th>Bike</th>
                              <th>State</th>
                              <th>Special Info</th>
                              <th>Freight Type</th>
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
  
      $(function () {

        var table = $('#contact_list').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.delivery_executive_list_ajax') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              
                {data: 'first_name', name: 'first_name' ,searchable: true},
                {data: 'last_name', name: 'last_name' ,searchable: true},
                {data: 'email_address', name: 'email_address' ,searchable: true},
                {data: 'phone', name: 'phone' ,searchable: true}, 
                {data: 'city', name: 'city' ,searchable: true},
                {data: 'bike', name: 'bike' ,searchable: true},
                {data: 'state', name: 'state' ,searchable: true},   
                {data: 'special_info', name: 'special_info' ,searchable: true}, 
                {data: 'freight_type', name: 'freight_type' ,searchable: true}, 
                                 
                
            ]
        });
        
    });
  </script>

{{-- <script>
  function export_excel(){
  window.location.href = "{{route('admin.product_list_excel')}}";
}
</script> --}}
    
 @endsection