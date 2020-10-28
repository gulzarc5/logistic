@extends('branch.template.admin_master')

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
        <form method="POST" action="{{ route('branch.add_baging_no') }}">
        @csrf
            <div class="col-md-12" style="margin-top:50px;">
                <div class="x_panel">
                    
                    <div class="x_title">
                        <h2>Baging List</h2>
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
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3" style="display: none;">
                                        <label for="origin">Origin</label>
                                        <select class="form-control" name="origin" id="origin">
                                            <option value="" > Select Origin</option>
                                            @foreach($city as $value)
                                                <option value="{{ $value->id }}" name="origin"> {{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                                                            
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3" style="display: none;">
                                    <label for="destination">Destination</label>
                                    <select class="form-control" name="destination" id="destination" id="destination" >
                                        <option value="" >Select Destination</option>
                                        @foreach($city as $value)
                                            <option value="{{ $value->id }}" name="destination"> {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="manifest_no">Manifest Number</label>
                                    <input type="text" class="form-control" id="manifest_no" name="manifest_number">
                                </div>
                                @if($errors->has('lock_no'))
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3" id="lock_div">
                                @else
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3" id="lock_div" style="display: none;">
                                @endif
                                    <label for="lock_no">Lock Number<span><b style="color: red"> * </b></span></label>
                                    <input type="text" class="form-control" id="lock_no" name="lock_no" required>
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
                    <table class="table table-striped jambo_table bulk_action" id ="bag_list" style="display: none">
                      <thead>
                        <tr class="headings">
                            <th class="column-title"></th>
                            <th class="column-title">Docate No</th>
                            <th class="column-title">Sender Name</th>
                            <th class="column-title"> Origin</th>
                            <th class="column-title">Destination</th>
                            <th class="column-title">Receiver Name</th>
                            </th>
                        </tr>
                      </thead>
                      <tbody id="data_row">
                        
                      </tbody>
                    </table>
                    
                    <div class="form-group" style="display:none" id="btn">
                        <button id="docate_submit "class="btn btn-sm btn-primary text-white">Save</button>
                    </div>
                </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('admin/select2-4.1.0-beta.1/dist/js/select2.min.js')}}"></script>
@include('branch.outbound.baging_script');

@endsection


        
    