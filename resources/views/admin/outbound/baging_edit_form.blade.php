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
        <form method="POST" action="{{ route('admin.update_baging',['baging_id'=>$baging->id]) }}">
            @method('put')
        @csrf
            <div class="col-md-12" style="margin-top:50px;">
                <div class="x_panel">
                    
                    <div class="x_title">
                        <h2>Update Baging Details</h2>
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
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3" >
                                        <label for="origin">Origin</label>
                                        <select class="form-control" name="origin" id="origin">
                                            <option value="" > Select Origin</option>
                                            @foreach($city as $value)
                                                <option value="{{ $value->id }}" name="origin" {{ $value->id==$baging->origin?'selected':'' }}> {{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                                                            
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3" >
                                    <label for="destination">Destination</label>
                                    <select class="form-control" name="destination" id="destination" id="destination" >
                                        <option value="" >Select Destination</option>
                                        @foreach($city as $value)
                                        <option value="{{ $value->id }}" name="destination" {{ $value->id==$baging->destination?'selected':'' }}> {{ $value->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="manifest_no">Manifest Number</label>
                                    <input type="text" value="{{ $baging->manifest->manifest_no }}" readonly="readonly" class="form-control" id="manifest_no" name="manifest_number">
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3" id="lock_div" >
                                    <label for="lock_no">Lock Number<span><b style="color: red"> * </b></span></label>
                                    <input type="text" class="form-control" id="lock_no" value="{{ $baging->lock_no }}" name="lock_no" required>
                                    @if($errors->has('lock_no'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('lock_no') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                    
                            </div>
                        </div>
                    </div >
                </div>
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action" id ="bag_list" >
                      <thead>
                        <tr class="headings">
                            <th class="column-title"></th>
                            <th class="column-title">Docate No</th>
                            <th class="column-title">Sender Name</th>
                            <th class="column-title">Receiver Name</th>
                            <th class="column-title">Packet</th>
                            <th class="column-title">Actual Weight</th>
                        </tr>
                      </thead>
                      <tbody id="data_row">
                            @foreach($manifest_items as $value)
                            <tr  class='even pointer'>
                                    @if($baging->id == $value->docate->baging_id)
                                        <td class='a-center '><input type='checkbox'  checked onclick="docateAction({{ $value->docate->id }},{{ $baging->id }},1)"></td>
                                    @else
                                        <td class='a-center '><input type='checkbox' onclick="docateAction({{ $value->docate->id }},{{ $baging->id }},2)"></td>
                                    @endif
                                    <td>{{ $value->docate->docate_id }}</td>
                                    <td>{{ $value->docate->sender->name }}</td>
                                    <td>{{ $value->docate->receiver->name }}</td>
                                    <td>{{ $value->docate->no_of_box }}</td>
                                    <td>{{ $value->docate->actual_weight}}</td>

                                </tr>
                            @endforeach
                       
                      </tbody>
                    </table>
                    
                    <div class="form-group" id="btn">
                        <button id="docate_submit "class="btn btn-sm btn-primary text-white">Save</button>
                    </div>
                </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('admin/select2-4.1.0-beta.1/dist/js/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#destination').select2();
        $('#origin').select2();
    });
    var status;
    function docateAction(docate_id,baging_id,status){
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"GET",
            url:"{{ url('/admin/baging/docate/operation')}}"+"/"+docate_id+"/"+baging_id+"/"+status,
            beforeSend: function(){
                    $('#doc_div').append('<i class="fa fa-spinner fa-spin" style="font-size:28px;position: absolute;top: 28px;right: 17px;" id="loader_id"></i>');
                },
            success:function(response){
                console.log(response);

            }
        });

    }


</script>

@endsection


        
    