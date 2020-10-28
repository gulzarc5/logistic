<script>
$(document).ready(function(){
  
       
   
    $("#sender_state").change(function(){
            var state_id = $(this).val();
          
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"GET",
                url:"{{ url('/branch/docate/city/list')}}"+"/"+state_id+"",
                success:function(data){
                    console.log(data);
                   
                    if ($.isEmptyObject(data)) {
                        $("#sender_city").html("<option value=''>No sender_city Found</option>"); 
                    } else {
                        $("#sender_city").html("<option value=''>Please Select City</option>"); 
                        $.each( data, function( key, value ) {
                            $("#sender_city").append("<option value='"+value.id+"'>"+value.name+"</option>");
                        });                         
                    }
                    
 
                }
            });
            
        });
     });
     $("#receiver_state").change(function(){
            var state_id = $(this).val();
          
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"GET",
                url:"{{ url('/branch/docate/city/list')}}"+"/"+state_id+"",
                success:function(data){
                    console.log(data);
                   
                    if ($.isEmptyObject(data)) {
                        $("#receiver_city").html("<option value=''>No receiver_city Found</option>"); 
                    } else {
                        $("#receiver_city").html("<option value=''>Please Select City</option>"); 
                        $.each( data, function( key, value ) {
                            $("#receiver_city").append("<option value='"+value.id+"'>"+value.name+"</option>");
                        });                         
                    }
                    
 
                }
            });
            
        });
        var div_count = 1;
   function add_more_div() {
            var htmlContent = `<div id="morediv${div_count}"  class="row" style="margin: 20px">
                                 <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                     <label for="content">Content</label>
                                     <textarea class="form-control" name="content[]"  value="{{ old('content') }}" required></textarea>
                                 </div> 
                                 <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                     <label for="length">L</label>
                                     <input type="text" class="form-control" name="length[]"  value="{{ old('length') }}" required >                                    
                                 </div> 
                                 <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="width: 3%;">
                                     <br/>
                                     <h4 style="margin-top: 15px;">X</h4>
                                 </div>
                                 <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                     <label for="breadth">B</label>
                                     <input type="text" class="form-control" name="breadth[]" value="{{ old('breadth') }}" required>
                                 </div> 
                                 <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="width: 3%;">
                                     <br/>
                                     <h4  style="margin-top: 15px;">X</h4>
                                 </div>
                                 <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                     <label for="height">H</label>
                                     <input type="text" class="form-control" name="height[]" value="{{ old('height') }}" required>
                                 </div>
                                 <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                     <br>
                                     <h4 style="margin-top: 15px;">/ 15000 </h4>
                                 </div>
                                 <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                     <label for="total"></label>
                                     <input type="text" class="form-control" name="total[]"  value="{{ old('total') }}" required>
                                 </div> 
                                 <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="margin-top: 25px;">
                                         
                                         <button type="button" class="btn btn-sm btn-danger" onclick="removeDiv(${div_count})">Remove</button>
                                 </div>
                                
                             </div>`;
             $("#content_div").append(htmlContent);
             div_count++;
         }
         function removeDiv(id) {
             $("#morediv"+id).remove();
             div_count--;
         }
     
 </script>