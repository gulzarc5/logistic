<script>
$(document).ready(function(){
    $('#sender_state').select2();
    $('#receiver_state').select2();
    $('#sender_city').select2();
    $('#receiver_city').select2();

});
    $("#cn_no").change(function(){
        var cn_no = $(this).val();
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"GET",
                url:"{{ url('/branch/docate/check')}}"+"/"+cn_no,
                beforeSend: function(){
                    $('#doc_div').append('<i class="fa fa-spinner fa-spin" style="font-size:28px;position: absolute;top: 28px;right: 17px;" id="loader_id"></i>');
                },
                success:function(data){
                    $("#loader_id").remove();
                    if(data==1){
                        $("#error_doc").html('<strong>CN No already exist</strong>');
                        $('#cn_no').val('');
                    }else{
                        $("#error_doc").html('');
                    }
                }
                
            });       
                   
        
    });
        
    $('#payment_div').change(function(){
        
        var payment_value = $(this).val();
        
        if(payment_value=="cod" || payment_value=="cash"){
            $('#amount_div').show();
        }else{
            $('#amount_div').hide();
        }
    });
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
        
    
    
   $('#box').keyup(function(){ 
        var box = $('#box').val();
        if(box==''){
            $('#content_div').hide();
        }else{
            $('#content_div').show();
            $('#content_div').empty();
        }
    
       for(var div_count=0;div_count<box;div_count++){
            var htmlContent = `<div id="morediv${div_count}"  class="row" style="margin: 20px">
                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="content">Content</label>
                                        <textarea class="form-control" name="content[]"  required></textarea>
                                    </div> 
                                    <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                        <label for="length">L</label>
                                        <input type="text" class="form-control" name="length[]"   required >                                    
                                    </div> 
                                    <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="width: 3%;">
                                        <br/>
                                        <h4 style="margin-top: 15px;">X</h4>
                                    </div>
                                    <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                        <label for="breadth">B</label>
                                        <input type="text" class="form-control" name="breadth[]"  required>
                                    </div> 
                                    <div class="col-md-1 col-sm-12 col-xs-12 mb-3" style="width: 3%;">
                                        <br/>
                                        <h4  style="margin-top: 15px;">X</h4>
                                    </div>
                                    <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                        <label for="height">H</label>
                                        <input type="text" class="form-control" name="height[]" required>
                                    </div>
                                    <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                        <br>
                                        <h4 style="margin-top: 15px;">/ 5000 </h4>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                        <label for="total"></label>
                                        <input type="text" class="form-control" name="total[]"  required>
                                    </div> 
                                    
                                    
                                </div>`;
                $("#content_div").append(htmlContent);
            }
            });
           
         
         
     
 </script>