@extends('admin.template.admin_master')

@section('content')

<link href="{{ asset('admin/select2-4.1.0-beta.1/dist/css/select2.min.css') }}" rel="stylesheet" />
<style>
    .error{
        color:red;
    }
</style>
<div class="right_col" role="main">
    <div class="row">
    	{{-- <div class="col-md-2"></div> --}}
        <div class="col-md-12" style="margin-top:50px;">
            <form method="POST" action="#">
            @csrf
                <div class="x_panel">
                    
                    <div class="x_title">
                        <h2>DRS Closed List</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div>
                        @if (Session::has('message'))
                        <div class="alert alert-success" >{{ Session::get('message') }}</div>
                        @endif
                        @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif

                    </div>
                    <div>
                    <div class="x_content">
                            <div class="well" style="overflow: auto">
                                <div class="form-row mb-10">
                                    <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                        <label for="origin">Start Date</label>
                                        <input type="date" id="start_date" class="form-control">
                                        <span id="start" style="display:none;color:red">Start Date Cannot Be empty</span>                             
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    <label for="end_date">End Date</label>
                                    <input type="date" id="end_date" class="form-control">
                                    <span id="end" style="display:none;color:red">End Date Cannot Be empty</span>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    <label for="destination">Branch</label>
                                    <select class="form-control" name="branch_id" id="branch_id">
                                        <option value="">Select Branch</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}" name="branch_id">{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                    <span id="branch" style="display:none;color:red">Branch Cannot Be empty</span>
                                </div> 
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    <label for="action" style="display:block;">Action</label>
                                    <a id="docate_submit" onclick ="get_docate()" class="btn btn-sm btn-primary text-white">Search</a>
                                </div> 
                                
                            </div>
                        </div>
                    </div >
                </div>
                <div class="table-responsive">
                    <div style="text-align: right">
                        <a class="btn btn-success" target="_blank" href="{{ route('admin.edit_drs_close_form') }}">Edit</a>
                    </div>
                    <table class="table table-striped jambo_table bulk_action" id ="docate_list">
                      <thead>
                        <tr class="headings">
                            <th class="column-title">ID</th>
                            <th>Drs No</th>
                            <th>CN No</th>
                            <th>Received By</th>
                            <th>Delivery Date</th>
                            <th>Delivery Time</th>
                            
                        </tr>
                      </thead>
                      <tbody >
                        
                      </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('admin/select2-4.1.0-beta.1/dist/js/select2.min.js')}}"></script>

<script >
   function get_docate(){
        var start_date =$('#start_date').val();
        var end_date = $('#end_date').val();
        var branch_id = $('#branch_id').val();

        // code is for validating input fields only
        if(start_date=="" && end_date!=""){
            $('#start').show();
            setTimeout(function(){
            $('#start').hide();
            }, 2000);
            return 0;
        }else if(end_date =="" && start_date!="" ){
            $('#end').show();
            setTimeout(function(){
            $('#end').hide();
            }, 2000);
            return 0;
        }else if(end_date =="" && start_date=="" && branch_id==""){                 
            $('#branch').show();
            setTimeout(function(){
            $('#branch').hide();
            }, 2000);
            return 0;
        }
        // end of validation
        var table = $('#docate_list').DataTable({
            processing: true,
            serverSide: true,
            "bDestroy": true,
            ajax: {url:"{{  url('admin/inbound/drsclose/fetch/details')}}"+"?start_date="+start_date+"&end_date="+end_date+"&branch_id="+branch_id,
            method:'GET'},
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'drs_no', name: 'drs_no',searchable: true},
                {data: 'docate_no', name: 'docate_no',searchable: true},
                {data: 'received_by', name: 'received_by',searchable: true},
                {data: 'delivery_date', name: 'delivery_date',searchable: true},
                {data: 'delivery_time', name: 'delivery_time',searchable: true},
                

            ]
        });
    }
</script>
@endsection


        
    