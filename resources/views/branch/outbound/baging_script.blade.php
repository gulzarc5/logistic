<script>
$(document).ready(function() {
        $('#destination').select2();
        $('#origin').select2();
    });
    var table_sl_count = 1;
    
    $("#manifest_no").change(function(){
        // var destination = $('#destination').val();
        // var origin = $('#origin').val();
        var manifest_no = $(this).val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"GET",
            url:"{{ url('/branch/baging/add/form')}}"+"/"+manifest_no,
            beforeSend: function() {
                $('#data_row').html(`<tr>
                          <td colspan="5" align="center">  <i class="fa fa-spinner fa-spin"  style="font-size:100px" id="loader_id"></i></td>
                        </tr>`);
           },
            success:function(response){
               
                if(response == 2){
                    $("#data_row").html("<tr id="+'row'+table_sl_count+" class='even pointer'><th style='text-align:center;' colspan='6'>No Docates Found </th></tr>");
                    $('#bag_list').show();
                }else{
                    $('#lock_div').show();
                    $('#row'+table_sl_count).remove();
                    $.each( response, function( key, value ) {
                                $("#data_row").append("<tr id="+'row'+table_sl_count+" class='even pointer'><td class='a-center '><input type='checkbox' onclick='check_btn()' id="+'check_bag'+table_sl_count+" name='docate_id[]'></td><th>"+value.docate_id+"</th><th>"+value.sender_name+"</th><th>"+value.receiver_name+"</th><th>"+value.no_of_box+"</th><th>"+value.actual_weight+"</th></tr>");
                                $("#check_bag"+table_sl_count).val(value.id);
                                if($('#check_bag'+table_sl_count).is(':checked')){
                                    console.log('worked');
                    }
                    table_sl_count++;
                });                         
                $('#bag_list').show();
            }
                                
            }
        });
    });
    
    function check_btn(){
        
        if($('input[name="docate_id[]"]').is(':checked')){
            $('#btn').show();
        }else{
            $('#btn').hide();
        }
         
    }
</script>