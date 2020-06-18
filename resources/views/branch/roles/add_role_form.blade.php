@extends('branch.template.admin_master')

@section('content')
<style>
    .error{
        color:red;
    }
</style>
<div class="right_col" role="main">
    <div class="row">
    	{{-- <div class="col-md-2"></div> --}}
    	<div class="col-md-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Add New Role</h2>
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
    	           
    	            	{{ Form::open(['method' => 'post','route'=>'branch.add_role' ]) }}
    	            	
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                  <label for="name">Name</label>
                                  <input type="text" class="form-control" name="name"  placeholder="Enter  Name"  value="{{ old('name') }}" required>
                                  @if($errors->has('name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="d_name">Display Name</label>
                                    <input type="text" class="form-control" name="d_name"  placeholder="Enter  Display Name"  value="{{ old('d_name') }}" required>
                                    @if($errors->has('d_name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('d_name') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-row mb-10">
                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="description" required>Description</label>
                                        <textarea class="form-control" rows="4" name="description" placeholder="Type Description">{{ old('description') }}</textarea>
                                        @if($errors->has('description'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
  
                            </div>
                        </div>

                 

                       <div class="well" style="overflow: auto">

                        @if (isset($permission) && !empty($permission))
                            @foreach ($permission as $item)
                            <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                <div class="checkbox">
                                    <label>
                                      <input type="checkbox" value="{{$item->id}}" name="permission[]">{{$item->display_name}}
                                    </label>
                                </div>
                            </div>  
                            @endforeach
                        @endif
                            
                       </div>




    	            	<div class="form-group">    
                            <button type="submit" class='btn btn-success'>Submit</button>
    	            	</div>
    	            	{{ Form::close() }}

    	            </div>
    	        </div>
    	    </div>
    	</div>
    	{{-- <div class="col-md-2"></div> --}}
    </div>
</div>


 @endsection

@section('script')
<script>
    function get_city_list(state_id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "GET",
            url: "{{ url('city/list') }}/"+ state_id,
            dataType: 'json',
            beforeSend: function () {
                $("#city").html('');
            },
            success: function (response) {
                var data=response;
                if (!$.isEmptyObject(data)) {
                    var city_html = '<option value=""> Select City</option>';
                    $.each(data, function(i, e) {
                        city_html += '<option value="' + e.id + '">' + e.name + '</option>';
                    });
                    $("#city").html(city_html);
                }else{
                    $("#city").html('<option value=""> No City Found </option>');
                }
            }
        })
    }
</script>
@endsection


        
    