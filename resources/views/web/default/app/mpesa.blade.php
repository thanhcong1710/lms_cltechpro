<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/default/vendor/bootstrap/css/bootstrap.min.css"/>
    <title>MPESA</title>
    <style>
        body{
           background-color: #fdfdfe;
        }
        .box{
            background-color: rgba(0,0,0,0.2);
            margin: 10px auto 0;
            padding: 20px;
            padding-bottom: 0;
            height: auto;
            border-radius: 10px;
            border: 2px solid rgba(0,0,0,0.1);
            box-shadow: 1px 1px 1px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        @if($mode == 'pay')
            <form method="post" action="/api/v1/mpesa/confirm">
                <input type="hidden" name="amount" value="{!! $transaction->price ?? 0 !!}">
                <input type="hidden" name="id" value="{!! $transaction->id ?? '' !!}">
                <input type="hidden" name="mode" value="{!! $type ?? '' !!}">
                <div class="row">
                    <div class="col-12 col-xs-12 col-md-4 col-md-offset-4">
                        <div class="box">
                            <div class="form-group">
                                <label>Enter Your Phone Number:</label>
                                <input type="tel" name="phone" class="form-control text-center">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Pay">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
        @if($mode == 'verify')

        @endif
    </div>
</body>
</html>
