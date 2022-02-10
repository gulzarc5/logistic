@extends('admin.template.admin_master')
@section('content')
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2 style="float: left">Pincode List</h2>
                    <a href="{{route('admin.pincode.form')}}" class="btn btn-warning" style="float: right">Add New</a>
                    <div class="clearfix"></div>
                </div>
                <div>
                    <div class="x_content">
                        <table id="product_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Pincode</th>
                                <th>Area</th>
                                <th>Status</th>
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
         $(function () {
    
            var table = $('#product_list').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: 50,
                ajax: "{{route('admin.pincode_list.ajax')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'pincode', name: 'pincode',searchable: true},
                    {data: 'area', name: 'area',searchable: true},
                    {data: 'status_tab', name: 'status_tab' ,searchable: true},
                    {data: 'action', name: 'action' ,searchable: true},
                ]
            });            
        });
     </script>
 @endsection