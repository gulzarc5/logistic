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
        <div class="col-md-12" style="margin-top:50px;">
            <form method="POST" action="{{ route('branch.add_manifest_no') }}">
            @csrf
                <div class="x_panel">
                    
                    <div class="x_title">
                        <h2>Manifest List</h2>
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
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="origin">Origin<span><b style="color: red"> * </b></span></label>
                                        <select class="form-control" name="origin" id="origin" required>
                                            <option value="" > Select Origin</option>
                                            @foreach($city as $value)
                                                <option value="{{ $value->id }}"> {{ $value->name }}</option>
                                            @endforeach
                                        </select>                                    
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="destination">Destination<span><b style="color: red"> * </b></span></label>
                                    <select class="form-control" name="destination"  id="destination" required>
                                        <option value="" >Select Destination</option>
                                        @foreach($city as $value)
                                            <option value="{{ $value->id }}"> {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>  
                            </div>
                        </div>
                    </div >
                </div>
            
                <div id="docket">
                    
                </div>
                <div class="form-group" style="display:none" id="btn">
                    <button id="docate_submit "class="btn btn-sm btn-primary text-white">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('admin/select2-4.1.0-beta.1/dist/js/select2.min.js')}}"></script>
@include('branch.outbound.manifest_script');
   

    

     

@endsection


        
    