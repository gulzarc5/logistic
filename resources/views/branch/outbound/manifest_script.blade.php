<script>
    $(document).ready(function() {
        $('#destination').select2();
        $('#origin').select2();
    });

    var table_sl_count = 1;
    $("#destination").change(function(){
        var destination = $(this).val();
        var origin = $('#origin').val();
        $('#docket').html(`<table id="product_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Sl No</th>
                    <th>Docket No</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Weight</th>
                    <th>Packet No</th>
                    <th>Receiver Customer Name</th>
                </tr>
            </thead>

            <tbody id="data_row">
                <tr id="table_row${table_sl_count}">
                    <th id="ids">${table_sl_count}</th>
                    <th><input type="text" name="docate_no[]" onblur="fetchDocate(this.value,${table_sl_count})" id="docate${table_sl_count}"></th>
                    <th id="origin_city${table_sl_count}"></th>
                    <th id="destination_name${table_sl_count}"></th>
                    <th id="weight${table_sl_count}"></th>
                    <th id="packet${table_sl_count}"></th>
                    <th id="Cust_name${table_sl_count}"></th>                    
                </tr>
            </tbody>
        </table>`);
        table_sl_count++;
    });


    function fetchDocate(docate_id,table_id){    
        var docate_data = $("input[name='docate_no[]']")
            .map(function(){return $(this).val();}).get();
        var check_docate_duplicate = getOccurrence(docate_data, docate_id);  
        if ((check_docate_duplicate == 0) || (check_docate_duplicate == 1)) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"GET",
                url:"{{ url('/branch/manifest/fetch/docate/details')}}"+"/"+docate_id,
                success:function(response){  
                    if(response ==1){           
                        alert('No Data Found');            
                        $('#origin_city'+table_id).html('No Data Found');
                        $('#destination_name'+table_id).html('No Data Found');
                        $('#weight'+table_id).html('No Data Found');
                        $('#packet'+table_id).html('No Data Found');
                        $('#Cust_name'+table_id).html('No Data Found');
                        $('#docate'+table_id).val('');                        
                    }else{ 
                        $('#origin_city'+table_id).html(response['origin_city_name']);
                        $('#destination_name'+table_id).html(response['destination_city_name']);
                        $('#weight'+table_id).html(response['actual_weight']);
                        $('#packet'+table_id).html(response['packet']);
                        $('#Cust_name'+table_id).html(response['receiver_name']);
                        
                        var table_row=`<tr id="table_row${table_sl_count}">
                            <th>${table_sl_count}</th>
                            <th><input type="text" name="docate_no[]" onblur="fetchDocate(this.value,${table_sl_count})" id="docate${table_sl_count}"></th>
                            <th id="origin_city${table_sl_count}"></th>
                            <th id="destination_name${table_sl_count}"></th>
                            <th id="weight${table_sl_count}"></th>
                            <th id="packet${table_sl_count}"></th>
                            <th id="Cust_name${table_sl_count}"></th>
                            <th id="btn${table_sl_count}"></th>
                        </tr>`;
                        $('#data_row').append(table_row);
                        $('#btn').show();
                        table_sl_count++;
                    }
                }
            });
        }else{
            alert('Docate Already Added In Manifest');
            $("#docate").val('');
        }
    }

    function getOccurrence(array, value) {
        return array.filter((v) => (v === value)).length;
    }

</script>