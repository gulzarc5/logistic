@extends('branch.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div>
            <h2>Sector Booking Report</h2>
        </div>
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">
                <div class="x_title">
                    <form method="POST" action="{{ route('branch.sector_report_downloads_xls') }}">
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
                       
                        <div class="col-md-6 col-sm-4 col-xs-12 mb-3">
                            <label for="button" style="display: block">Action</label>
                            <button type="submit"   class="btn btn-info"> Export</button>
                            <a onclick = "fetchDetails()" class="btn btn-info" >Search </a>
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
                                    <th>Cd No </th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Total Docates</th>
                                    <th>Date</th>
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
      
        var table = $('#contact_list').DataTable({
            processing: true,
            serverSide: true,
            "destroy" : true,
          
            "ajax": {
                "url": "{{ route('admin.fetch_sector_report') }}",
                "data": function ( d ) {
                    d.start_from = start_date,
                    d.end_from = end_date
                 
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'cd_no', name: 'cd_no',searchable: true},
                {data: 'origin', name: 'origin' ,searchable: true},  
                {data: 'destination', name: 'destination' ,searchable: true},  
                {data: 'total_no_docates', name: 'total_no_docates' ,searchable: true}, 
              
                {data: 'date', name: 'date' ,searchable: true},   
                 
                
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