@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Contact List <b><button onclick="export_excel()"><i class="fa fa-file-excel-o" aria-hidden="true" style="font-size: 20px; color:#FF9800"></i></button></b></h2>
    	            <div class="clearfix"></div>
              </div>
    	        <div>
    	            <div class="x_content">
                        <table id="contact_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Name</th>
                              <th>Phone</th>
                              <th>Email</th>
                              <th>Subject</th>
                              <th>Message</th>
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
            ajax: "{{ route('admin.contact_list_ajax') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name',searchable: true},
                {data: 'email', name: 'email' ,searchable: true},
                {data: 'phone', name: 'phone' ,searchable: true}, 
                {data: 'subject', name: 'subject' ,searchable: true},   
                {data: 'message', name: 'message' ,searchable: true},  
                                 
                
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