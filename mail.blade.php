@php
    $sl = 1;
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>Product Purchase Mail</title>
</head>
<body>
    <h2 style="color:green;"><u>Product Purchase Invoice</u></h2>

    <table style="border:1px solid black; padding: 10px; ">
        <thead>
            <tr>
                <th>SL#</th>
                <th style="padding-left: 10px;">Payment ID</th>
                <th style="padding-left: 10px;">Balance Transaction ID</th>
                <th style="padding-left: 10px;">Shipping Charge</th>
                <th style="padding-left: 10px;">Total Price</th>
            </tr>
        </thead>
            <tbody>
                <tr>
                    <td>{{$sl++}}</td>
                    <td style="padding-left: 10px; text-align: center;">{{$data['payment_id']}}</td>
                    <td style="padding-left: 10px; text-align: center;">{{$data['balance_transection_id']}}</td>
                    <td style="padding-left: 10px; text-align: center;">${{$data['shipping_charge']}}</td>
                    <td style="padding-left: 10px; text-align: center;">${{$data['total']}}</td>

                </tr>
            </tbody>
    </table>

    <div style="margin-top: 50px;">NOTICE:</div>
    <br>
        <h5>Thank You</h5><br>
        <h5>Fashion Ecommerce</h5>
        <h6>Dhaka,Banglades</h6>
        <div><b>*A finance charge of 1.5% will be made on unpaid balances after 30 days.</b></div>

        <div><b>*Invoice was created on a computer and is valid without the signature and seal.</b></div>


</body>
</html>
