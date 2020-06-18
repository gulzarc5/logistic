@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2 style="float:left">State List</h2>
                    <a class="btn btn-warning" style="float:right" href="{{route('admin.add_state_form')}}">Add New</a>

                    <div class="clearfix"></div>
                </div>
                <div>
                    <div class="x_content">
                        <table id="product_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody> 
                                @if (isset($state) && !empty($state))
                                    @php
                                        $state_sl = 1;
                                    @endphp
                                    @foreach ($state as $item)
                                        <tr>
                                            <td>{{$state_sl++}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>
                                                @if ($item->status == '1')
                                                    <a class="btn btn-success">Enabled</a>
                                                @else
                                                    <a class="btn btn-danger">Disabled</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-warning" href="{{route('admin.state_edit',['id'=>encrypt($item->id)])}}">Edit</a>
                                                @if ($item->status == '1')
                                                    <a class="btn btn-danger" href="{{route('admin.state_status',['id'=>encrypt($item->id),'status'=>2])}}">Disable</a>
                                                @else
                                                    <a class="btn btn-success" href="{{route('admin.state_status',['id'=>encrypt($item->id),'status'=>1])}}">Enable</a>
                                                @endif
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