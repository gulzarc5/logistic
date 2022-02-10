<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@px;700&display=swap" rel="stylesheet">
    <style>*{padding: 0;margin: 0;}body{background: #fff;font-family: 'Open Sans', sans-serif;}section{width: 939px;background-color: #fff}table{width: 100%;background: #bfbdbd;}table table{border-spacing: 0}.light-bg{ background-color: #eee}td{background-color: #fff}.text-center{text-align: center}.bottom-td td{width: 30%;padding: 8px 7px;border-bottom: 2px solid #bfbdbd;flex-grow: 1;font-size: 11px;}.bottom-td td:first-child{border-right: 2px solid #bfbdbd;font-weight: 700;width: 36%;} td.barcode {padding: 7px;width: 78%;}</style>
</head>
<body>
    <section>
        <div style="padding:10px">            
            <table>
                <tbody>
                    <tr>
                        <td style="width: 20%;margin: 25px;">
                            <img src="{{asset('web/images/log.png')}}" style="width: 90%;" />
                        </td>
                        <td>
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Origin</td>
                                    </tr>
                                    <tr>
                                        <td>{{$docate_data->origin_city}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Destination</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->destination_city }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td style="width: 16%;">                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">CN No.</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->docate_id }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Invoice No.</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->invoice_no }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Invoice value</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->invoice_value }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Pickup Date</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->pickup_date }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Pickup Time</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->pickup_time }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td colspan="2">                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Docate Date Time</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->created_at }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Payment Type</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            @if($docate_data->payment_option=='c')
                                                Credit
                                            @elseif($docate_data->payment_option=='cod')
                                                Topay
                                            @else
                                                Cash 
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Service Mode</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->send_mode }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>         
            <table style="-webkit-border-vertical-spacing: 0;border-bottom: 1.6px solid #bfbdbd;">
                <tbody>
                    <tr>
                        <td colspan=2 style="width: 38%"> 
                            <strong style="padding:10px;padding-bottom:5px">SENDER ADDRESS</strong> <br />
                            <div style="padding:10px;padding-top:5px">
                                <strong>Name:</strong> {{ $docate_data->sender_name }} <br />
                                <strong>State :</strong> {{ $docate_data->sender_state}} <br />
                                <strong>City :</strong>{{ $docate_data->sender_city }}<br />
                                <strong>Pincode :</strong> {{ $docate_data->sender_pin }}  <br />
                                <strong>Address :</strong> <br />
                                {{ $docate_data->sender_address}}
                            </div>
                        </td>
                        <td colspan=2 style="width: 38%"> 
                            <strong style="padding:10px;padding-bottom:5px">RECIVER ADDRESS</strong> <br />
                            <div style="padding:10px;padding-top:5px">
                                <strong>Name:</strong> {{ $docate_data->receiver_name }}  <br />
                                <strong>State :</strong> {{ $docate_data->receiver_state}}  <br />
                                <strong>City :</strong> {{ $docate_data->receiver_city }} <br />
                                <strong>Pincode :</strong> {{ $docate_data->receiver_pin }} <br />
                                <strong>Address :</strong> <br />
                                {{ $docate_data->receiver_address}}
                            </div>
                        </td>
                        <td colspan=2 style="display: flex;"> 
                            <table>
                                <tbody style="display: flex;flex-direction:column">
                                    <tr class="bottom-td">
                                        <td>No of Boxes</td>
                                        <td class="text-center"> {{ $docate_data->no_of_box}}</td>
                                    </tr>
                                    <tr class="bottom-td">
                                        <td>Actual Weight</td>
                                        <td class="text-center"> {{ $docate_data->actual_weight}} gm</td>
                                    </tr>
                                    <tr class="bottom-td">
                                        <td>Chargeable Weight</td>
                                        <td class="text-center"> {{ $docate_data->chargeable_weight}} gm</td>
                                    </tr>
                                    <tr>
                                        <td class="barcode">
                                            {!! DNS1D::getBarcodeHTML("$docate_data->docate_id", 'I25') !!}
                                        </td>
                                    </tr>
                                    <tr style="background: #fff;height: 100px;position: relative;text-align: center;">
                                        <td style="color: #aba9a9;position: absolute;bottom: 6px;width: 100%;">Signed by Authenticate</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="margin:10px 0;border-bottom:2px dashed #777"></div>
        <div style="padding:10px">            
            <table>
                <tbody>
                    <tr>
                        <td style="width: 20%;margin: 25px;">
                            <img src="{{asset('web/images/log.png')}}" style="width: 90%;" />
                        </td>
                        <td>
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Origin</td>
                                    </tr>
                                    <tr>
                                        <td>{{$docate_data->origin_city}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Destination</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->destination_city }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td style="width: 16%;">                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">CN No.</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->docate_id }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Invoice No.</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->invoice_no }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Invoice value</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->invoice_value }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Pickup Date</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->pickup_date }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Pickup Time</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->pickup_time }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td colspan="2">                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Docate Date Time</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->created_at }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Payment Type</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            @if($docate_data->payment_option=='c')
                                                Credit
                                            @elseif($docate_data->payment_option=='cod')
                                                Topay
                                            @else
                                                Cash 
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Service Mode</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->send_mode }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>         
            <table style="-webkit-border-vertical-spacing: 0;border-bottom: 1.6px solid #bfbdbd;">
                <tbody>
                    <tr>
                        <td colspan=2 style="width: 38%"> 
                            <strong style="padding:10px;padding-bottom:5px">SENDER ADDRESS</strong> <br />
                            <div style="padding:10px;padding-top:5px">
                                <strong>Name:</strong> {{ $docate_data->sender_name }} <br />
                                <strong>State :</strong> {{ $docate_data->sender_state}} <br />
                                <strong>City :</strong> {{ $docate_data->sender_city }} <br />
                                <strong>Pincode :</strong> {{ $docate_data->sender_pin }}  <br />
                                <strong>Address :</strong> <br />
                                {{ $docate_data->sender_address}}
                            </div>
                        </td>
                        <td colspan=2 style="width: 38%"> 
                            <strong style="padding:10px;padding-bottom:5px">RECIVER ADDRESS</strong> <br />
                            <div style="padding:10px;padding-top:5px">
                                <strong>Name:</strong>{{ $docate_data->receiver_name }} <br />
                                <strong>State :</strong> {{ $docate_data->receiver_state}}  <br />
                                <strong>City :</strong> {{ $docate_data->receiver_city }} <br />
                                <strong>Pincode :</strong> {{ $docate_data->receiver_pin }} <br />
                                <strong>Address :</strong> <br />
                                {{ $docate_data->receiver_address}}
                            </div>
                        </td>
                        <td colspan=2 style="display: flex;"> 
                            <table>
                                <tbody style="display: flex;flex-direction:column">
                                    <tr class="bottom-td">
                                        <td>No of Boxes</td>
                                        <td class="text-center"> {{ $docate_data->no_of_box}}</td>
                                    </tr>
                                    <tr class="bottom-td">
                                        <td>Actual Weight</td>
                                        <td class="text-center"> {{ $docate_data->actual_weight}} gm</td>
                                    </tr>
                                    <tr class="bottom-td">
                                        <td>Chargeable Weight</td>
                                        <td class="text-center"> {{ $docate_data->chargeable_weight}} gm</td>
                                    </tr>
                                    <tr>
                                        <td class="barcode">
                                            {!! DNS1D::getBarcodeHTML("$docate_data->docate_id", 'I25') !!}
                                        </td>
                                    </tr>
                                    <tr style="background: #fff;height: 100px;position: relative;text-align: center;">
                                        <td style="color: #aba9a9;position: absolute;bottom: 6px;width: 100%;">Signed by Authenticate</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="margin:10px 0;border-bottom:2px dashed #777"></div>
        <div style="padding:10px">            
            <table>
                <tbody>
                    <tr>
                        <td style="width: 20%;margin: 25px;">
                            <img src="{{asset('web/images/log.png')}}" style="width: 90%;" />
                        </td>
                        <td>
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Origin</td>
                                    </tr>
                                    <tr>
                                        <td>{{$docate_data->origin_city}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Destination</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->destination_city }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td style="width: 16%;">                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">CN No.</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->docate_id }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Invoice No.</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->invoice_no }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Invoice value</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->invoice_value }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Pickup Date</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->pickup_date }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Pickup Time</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->pickup_time }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td colspan="2">                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Docate Date Time</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->created_at }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Payment Type</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            @if($docate_data->payment_option=='c')
                                                Credit
                                            @elseif($docate_data->payment_option=='cod')
                                                Topay
                                            @else
                                                Cash 
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>                        
                            <table style="height:78px;text-align: center">
                                <tbody>
                                    <tr>
                                        <td class="light-bg" style="font-weight:700">Service Mode</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $docate_data->send_mode }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>         
            <table style="-webkit-border-vertical-spacing: 0;border-bottom: 1.6px solid #bfbdbd;">
                <tbody>
                    <tr>
                        <td colspan=2 style="width: 38%"> 
                            <strong style="padding:10px;padding-bottom:5px">SENDER ADDRESS</strong> <br />
                            <div style="padding:10px;padding-top:5px">
                                <strong>Name:</strong> {{ $docate_data->sender_name }}<br />
                                <strong>State :</strong> {{ $docate_data->sender_state}} <br />
                                <strong>City :</strong> {{ $docate_data->sender_city }} <br />
                                <strong>Pincode :</strong> {{ $docate_data->sender_pin }}  <br />
                                <strong>Address :</strong> <br />
                                {{ $docate_data->sender_address}}
                            </div>
                        </td>
                        <td colspan=2 style="width: 38%"> 
                            <strong style="padding:10px;padding-bottom:5px">RECIVER ADDRESS</strong> <br />
                            <div style="padding:10px;padding-top:5px">
                                <strong>Name:</strong>{{ $docate_data->receiver_name }} <br />
                                <strong>State :</strong> {{ $docate_data->receiver_state}}  <br />
                                <strong>City :</strong> {{ $docate_data->receiver_city }} <br />
                                <strong>Pincode :</strong> {{ $docate_data->receiver_pin }} <br />
                                <strong>Address :</strong> <br />
                                {{ $docate_data->receiver_address}}
                            </div>
                        </td>
                        <td colspan=2 style="display: flex;"> 
                            <table>
                                <tbody style="display: flex;flex-direction:column">
                                    <tr class="bottom-td">
                                        <td>No of Boxes</td>
                                        <td class="text-center"> {{ $docate_data->no_of_box}}</td>
                                    </tr>
                                    <tr class="bottom-td">
                                        <td>Actual Weight</td>
                                        <td class="text-center"> {{ $docate_data->actual_weight}} gm</td>
                                    </tr>
                                    <tr class="bottom-td">
                                        <td>Chargeable Weight</td>
                                        <td class="text-center"> {{ $docate_data->chargeable_weight}} gm</td>
                                    </tr>
                                    <tr>
                                        <td class="barcode">
                                            {!! DNS1D::getBarcodeHTML("$docate_data->docate_id", 'I25') !!}
                                        </td>
                                    </tr>
                                    <tr style="background: #fff;height: 100px;position: relative;text-align: center;">
                                        <td style="color: #aba9a9;position: absolute;bottom: 6px;width: 100%;">Signed by Authenticate</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>