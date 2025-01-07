<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaction</title>
    {{--    <link rel="stylesheet" href="/public/invoice.css" type="text/css">--}}
    <link rel="stylesheet" href="https://cdn.curlwind.com">
    <style type="text/css">
        /*common class*/
        * {
            font-family: Verdana, Arial, sans-serif, Helvetica, Times;
        }

        .page-break {
            page-break-after: always;
        }

        .wrap {
            overflow-wrap: anywhere;
        }

        table {
            width: 100%;
        }

        .bg-gray {
            background-color: #F9FAFB;
        }

        .w-full {
            width: 100%;
        }

        .border {
            border: 1px solid darkgrey;
            border-collapse: collapse;
        }

        .border-none {
            border: none;
        }

        .border-t {
            border-top: 1px solid darkgrey;
            border-collapse: collapse;
        }

        .border-r {
            border-right: 1px solid darkgrey;
            border-collapse: collapse;
        }

        .border-b {
            border-bottom: 1px solid darkgrey;
            border-collapse: collapse;
        }

        .border-l {
            border-left: 1px solid darkgrey;
            border-collapse: collapse;
        }

        .border-t-none {
            border-top: none;
        }

        .border-r-none {
            border-right: none;
        }

        .border-b-none {
            border-bottom: none;
        }

        .border-l-none {
            border-left: none;
        }

        .font-semibold {
            font-weight: lighter;
        }

        .font-bold {
            font-weight: bold;
        }

        .times {
            font-family: "Times New Roman", serif;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .left {
            text-align: left;
        }

        .lh-0 {
            line-height: 0.5;
        }

        .lh-1 {
            line-height: 1;
        }

        .lh-2 {
            line-height: 1.5;
        }

        .lh-3 {
            line-height: 2.5;
        }

        .lh-4 {
            line-height: 3;
        }

        .lh-5 {
            line-height: 3.5;
        }

        .lh-6 {
            line-height: 4;
        }

        .v-align-t {
            vertical-align: top;
        }

        .v-align-c {
            vertical-align: middle;
        }

        .v-align-b {
            vertical-align: bottom;
        }

        .p-0 {
            padding: 0;
        }

        .p-1 {
            padding: 1px;
        }

        .p-2 {
            padding: 2px;
        }

        .p-5 {
            padding: 5px;
        }

        .p-10 {
            padding: 10px;
        }

        .px-1 {
            padding: 0 1px;
        }

        .px-2 {
            padding: 0 2px;
        }

        .px-5 {
            padding: 0 5px;
        }

        .px-10 {
            padding: 0 10px;
        }

        .py-1 {
            padding: 1px 0;
        }

        .py-2 {
            padding: 2px 0;
        }

        .py-5 {
            padding: 5px 0;
        }

        .py-10 {
            padding: 10px 0;
        }

        .text-4xl {
            font-size: 36px;
        }

        .text-3xl {
            font-size: 28px;
        }

        .text-2xl {
            font-size: 24px;
        }

        .text-xl {
            font-size: 20px;
        }

        .text-lg {
            font-size: 16px;
        }

        .text-md {
            font-size: 12px;
        }

        .text-sm {
            font-size: 10px;
        }

        .text-xs {
            font-size: 9px;
        }
    </style>
</head>

<body class="bg-white-100 p-10">

<!-- Address  --------------------------------------------------------------------------------------------------------->
<table class="border w-full">

    <tr>
        <td width="35%" class="right">
            @if($cmp->get('logo')!='no_image')
                <img src="{{ public_path('/storage/images/'.$cmp->get('logo'))}}" alt="company logo" width="130px"/>
            @else
                <img src="{{ public_path('images/sk-logo.jpeg') }}" alt="" width="130px">
            @endif
        </td>
        <td width="65%" class="lh-0 left">
            <div class=" lh-1 font-bold times text-4xl">{{$cmp->get('company_name')}}</div>
            <div class="lh-2 text-md v-align-b">
                <div class="times">{{$cmp->get('address_1')}}</div>
                <div class="times">{{$cmp->get('address_2')}}, {{$cmp->get('city')}}</div>
                <div class="times">{{$cmp->get('contact')}} - {{$cmp->get('email')}}</div>
                <div class="times">{{$cmp->get('gstin')}}</div>
            </div>
        </td>
    </tr>
</table>

<table class="border v-align-c border-t-none">
    <tr class="bg-gray center font-bold text-lg p-1">
        <td class="center py-5">{{$trans_type_name}}</td>
    </tr>
</table>

<table class="border border-t-none">
    <tr class="bg-gray text-sm lh-2 border-b">
        <th width="5%" class="border-r">S.No</th>
        <th width="auto" class="border-r">Contact</th>
        <th width="10%" class="border-r">Payment</th>
        <th width="10%" class="border-r">Receipt</th>
        @if( $trans_type_id != 108)
            <th width="10%" class="border-r">Type</th>
        @endif
        <th width="10%" class="border-r">Balance</th>

    </tr>
    @php
        $balance = 0;
        $OpenBalance = 0;
        $totalBalance = 0;
        $totalPayment = 0;
        $totalReceipt = 0;
    @endphp

    @php
        $balance = 0;
        $OpenBalance = 0;
        $totalBalance = 0;
        $totalPayment = 0;
        $totalReceipt = 0;
    @endphp

    @foreach($list as $index=>$row)
        @php
            if ($row->mode_id ==110)
            {
                $totalPayment  += floatval($row->vname + 0);
            }
            elseif($row->mode_id ==111)
            {
                $totalReceipt  += floatval($row->vname + 0);
            }
        @endphp

        <tr class="text-sm center v-align-c">
            <td height="26px" class="center border-r">{{$index+1}}</td>
            <td class="left border-r px-5">{{$row->contact->vname}}</td>

            @if($row->mode_id == 110)
                <td class="right px-2  border-r ">{{$row->vname+0}}</td>
            @else
                <td class="right px-2 border-r">&nbsp;</td>
            @endif

            @if($row->mode_id == 111)

                <td class="right px-2 border-r border-gray-300">{{$row->vname+0}}</td>
            @else
                <td class="right px-2 border-r border-gray-300"></td>
            @endif

            @if( $trans_type_id != 108)
                <td class="center border-r ">{{\Aaran\Transaction\Models\Transaction::common($row->receipttype_id)}}</td>
            @endif

            <td class="p-2 right border-r border-gray-300">  {{  $balance  = $totalReceipt-$totalPayment}}</td>
        </tr>
    @endforeach

    <tr class="text-sm center v-align-c border-t font-bold">
        <td height="26px" class="center border-r" colspan="2">Total</td>
        <td class="right px-2 border-r ">{{$totalPayment}}</td>
        <td class="right px-2 border-r ">{{$totalReceipt}}</td>
        @if( $trans_type_id != 108)
            <td class="right px-2 border-r" colspan="2">{{$totalReceipt - $totalPayment }}</td>
        @else
            <td class="right px-2 border-r">{{$totalReceipt - $totalPayment }}</td>
        @endif
    </tr>

</table>

</body>
</html>