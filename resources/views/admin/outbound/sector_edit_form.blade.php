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
        <form method="POST" action="{{ route('admin.update_sector',['sector_id'=>$sector->id]) }}">
        @csrf
        @method('put')
            <div class="col-md-12" style="margin-top:50px;">
                <div class="x_panel">
                    
                    <div class="x_title">
                        <h2>Sector Booking List</h2>
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
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="manifest_no">Manifest Number</label>
                                    <input type="text" class="form-control" readonly = "readonly" id="manifest_no" value="{{ $sector->manifest->manifest_no}}" name="manifest_number">
                                </div>
                               
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="origin">Origin</label>
                                    <select class="form-control" name="origin" id="origin">
                                        <option value="" > Select Origin</option>
                                        @foreach($city as $value)
                                            <option value="{{ $value->id }}" name="origin" {{$value->id==$sector->origin?'selected':'' }}> {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="destination">Destination</label>
                                    <select class="form-control" name="destination"  id="destination" >
                                        <option value="" >Select Destination</option>
                                        @foreach($city as $value)
                                            <option value="{{ $value->id }}" name="destination" {{ $value->id==$sector->destination?'selected':''  }}> {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="coloader_name">Co-Loader Name</label>
                                    <input type="text" class="form-control" id="coloader_name" value="{{ $sector->co_loader_name}}" name="coloader_name">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="date">Book Date</label>
                                    <input type="date" class="form-control" id="date" value="{{ $sector->book_date}}" name="date">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3"> 
                                    <label for="time">Book Time</label>
                                    <input type="time" class="form-control" id="time" value="{{ $sector->book_time}}"name="time">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="booked_by">Booked By</label>
                                    <input type="text" class="form-control" id="booked_by" value="{{ $sector->booked_by}}" name="booked_by">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mode">Mode</label>
                                    <select class="form-control" name="mode" id="mode">
                                        <option value="Air" name="mode" {{ $sector->mode == 'Air'? 'selected':'' }}>By Air</option>
                                        <option value="Train" name="mode"  {{ $sector->mode == 'Train'? 'selected':'' }}>By Train</option>
                                        <option value="Road" name="mode"  {{ $sector->mode == 'Road'? 'selected':'' }}>By Road</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="vehicle_no">Ft No/Train No/Vehicle No</label>
                                    <input type="text" class="form-control" id="vehicle_no" value="{{ $sector->vehicle_no}}" name="vehicle_no">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="cd_no">CD No</label> 
                                    <input type="text" class="form-control" id="cd_no" value="{{ $sector->cd_no}}"name="cd_no">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="dep_date">Departure Date</label>
                                    <input type="date" class="form-control" id="dep_date" value="{{ $sector->dep_date}}" name="dep_date">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="dep_time">Departure Time</label>
                                    <input type="time" class="form-control" id="dep_time" value="{{ $sector->dep_time}}" name="dep_time">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="arr_date">Arrival Date</label>
                                    <input type="date" class="form-control" id="arr_date" value="{{ $sector->arr_date}}" name="arr_date">
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="arr_time">Arrival Time</label>
                                    <input type="time" class="form-control" id="arr_time" value="{{ $sector->arr_time}}" name="arr_time">
                                </div>
                                
                            </div>
                           
                        </div>
                    </div >
                </div>
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action" id ="sector_list" >
                      <thead>
                        <tr class="headings">
                            <th class="column-title">Docate No</th>
                            <th class="column-title">Weight</th>
                            <th class="column-title">Packet</th>
                            <th class="column-title">Lock No</th>
                            <th class="column-title">Sender Name </th>
                            <th class="column-title">Receiver Name</th>
                        </tr>
                      </thead>
                      <tbody id="data_row">
                          @foreach($sector_details as $items)
                        <tr >
                            <th>{{ $items->docate->docate_id }}</th>
                            <th>{{ $items->docate->actual_weight }}</th>
                            <th>{{  $items->docate->no_of_box}}</th>
                            <th>{{  $items->baging->lock_no }}</th>
                            <th>{{  $items->docate->sender->name}}</th>
                            <th>{{  $items->docate->receiver->name}}</th>
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                    
                   
                </div>
                <div class="form-group"  id="btn" style="align:center;">
                    <button id="docate_submit "class="btn btn-sm btn-primary text-white">Save</button>
                </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('admin/select2-4.1.0-beta.1/dist/js/select2.min.js')}}"></script>
<script>
    var table_sl_count=0;
    $('#origin').select2();
    $('#destination').select2();

      
        
</script>

@endsection


        
    