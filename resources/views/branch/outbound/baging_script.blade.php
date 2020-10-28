<script>
// $(document).ready(function() {
    //     $('#destination').select2();
    //     $('#origin').select2();
    // });
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
            success:function(response){
                if(response == 2){
                    $("#data_row").html("<tr id="+'row'+table_sl_count+" class='even pointer'><th></th><th>No Manifest Found or already bagged</th><th>-</th><th>-</th><th>-</th><th>-</th></tr>");
                    $('#bag_list').show();
                }else{
                    $('#lock_div').show();
                    $('#row'+table_sl_count).remove();
                    $.each( response, function( key, value ) {
                                $("#data_row").append("<tr id="+'row'+table_sl_count+" class='even pointer'><td class='a-center '><input type='checkbox' onclick='check_btn()' id="+'check_bag'+table_sl_count+" name='docate_id[]'></td><th>"+value.docate_id+"</th><th>"+value.sender_name+"</th><th>"+value.origin_city+"</th><th>"+value.destination_city_name+"</th><th>"+value.receiver_name+"</th></tr>");
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