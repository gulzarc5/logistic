@extends('branch.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2 style="float: left">Role List</h2>
                    <a href="{{route('branch.add_role_form')}}" class="btn btn-warning" style="float: right">Add New</a>
                    <div class="clearfix"></div>
                </div>
                <div>
                    <div class="x_content">
                        <table id="product_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>      
                                @if (isset($role) && !empty($role))
                                @php
                                    $role_count = 1;
                                @endphp
                                    @foreach ($role as $item)
                                        <tr>
                                            <td>{{$role_count++}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->display_name}}</td>
                                            <td>{{$item->description}}</td>
                                            <td>
                                                <a href="{{route('branch.view_role_permissions',['id'=>encrypt($item->id)])}}" class="btn btn-info">View Permission</a>
                                                @permission(['edit-user'])
                                                    <a href="{{route('branch.edit_role',['id'=>encrypt($item->id)])}}" class="btn btn-warning">Edit</a>
                                                @endpermission
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif                 
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
            var table = $('#product_list').DataTable();
         });
     </script>
 @endsection