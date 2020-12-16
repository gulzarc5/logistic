@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2 style="float: left">User List</h2>
                    <a href="{{route('admin.add_user_form')}}" class="btn btn-warning" style="float: right">Add New</a>
                    <div class="clearfix"></div>
                </div>
                <div>
                    <div class="x_content">
                        <table id="product_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Mobile Number</th>
                                <th>Email Id</th>
                                <th>User Role</th>
                                <th>Branch</th>
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
                ajax: "{{route('admin.userListAjax')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name',searchable: true},
                    {data: 'mobile', name: 'mobile',searchable: true},
                    {data: 'email', name: 'email' ,searchable: true},
                    {data: 'role', name: 'role' ,searchable: true},
                    {data: 'branch', name: 'branch' ,searchable: true},
                    {data: 'action', name: 'action' ,searchable: true},
                ]
            });            
        });
     </script>
 @endsection