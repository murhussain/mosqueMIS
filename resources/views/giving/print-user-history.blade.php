<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>{{config('app.name')}}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

    <link href="/css/admin.css" rel="stylesheet"/>
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>

    <style>
        [class^="fa fa-"], [class*=" fa fa-"] {
            margin-left: 4px;
            margin-right: 4px;
        }

        table td:first-child {
            text-align: left;
        }

        body {
            background: #fff;
            margin-top:10px;
        }
    </style>
</head>
<body>
<div class="container">
    <table class="table">
        <tr>
            <td>
                <table class="no-border">
                    <tr>
                        <td><span class="fa fa-user"></span></td>
                        <td><strong> {{Auth::user()->first_name.' '.Auth::user()->last_name}}</strong></td>
                    </tr>
                    <tr>
                        <td><span class="fa fa-inbox"></span></td>
                        <td>{!! Auth::user()->address !!}</td>
                    </tr>
                    <tr>
                        <td><span class="fa fa-phone"></span></td>
                        <td>{{Auth::user()->phone}}</td>
                    </tr>
                </table>

            </td>
            <td class="text-center">

                <h2>{{$_GET['y']}}</h2>
                <h3>@lang("Yearly Contributions")</h3>
            </td>
            <td>
                <img class="thumbnail" src="/img/admin-logo.png" style="background:#333;padding:10px;"/>
                <h4 class="title">{{config('app.name')}}</h4>
                <table class="no-border">
                    <tr>
                        <td><span class="fa fa-inbox"></span></td>
                        <td valign="top">{!!config('app.company.address') !!}</td>
                    </tr>
                    <tr>
                        <td><span class="fa fa-envelope"></span></td>
                        <td>{{config('mail.from.address')}}</td>
                    </tr>
                    <tr>
                        <td><span class="fa fa-phone"></span></td>
                        <td>{{config('app.company.email')}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    @if(sizeof($gifts)>0)
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang("Date")</th>
                <th>@lang("Item")</th>
                <th>@lang("Description")</th>
                <th>@lang("Amount")</th>
            </tr>
            </thead>
            <tbody>
            @foreach($gifts as $gift)
                <tr>
                    <td>{{date('d M y',strtotime($gift->created_at))}}</td>
                    <td>{{$gift->item}}</td>
                    <td>{{$gift->desc}}</td>
                    <td>{{$gift->amount}}</td>
                </tr>
            @endforeach
            </tbody>

        </table>

    @else
        <hr/>
        <div class="alert alert-danger">@lang("No records found")</div>
    @endif</div>

</body>
</html>