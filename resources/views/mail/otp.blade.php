<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light" />
    <meta name="supported-color-schemes" content="light" />
    <style>
        * {
            margin: 0;
            padding: 0;
            border: 0;
            box-sizing: border-box;
        }
    </style>
</head>

<body
    style="width: 100%;font-family: OpenSans, sans-serif;background-color: #eef2f8;color: #3d4750;padding: 0 10px;line-height: 1.45;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;">
    <div style="width: 100%;padding: 20px 10px;">
        <h1 style="font-size: 19px;text-align: center;">
            <a href="{{ url('/') }}" style="color: #3d4750;text-decoration: none;"
                target="_blank">{{ config('app.name') }}</a>
        </h1>
    </div>
    <div
        style="width: 100%;background-color: #fff;border-radius: 6px;padding: 20px;overflow-x: auto;-webkit-overflow-scrolling: touch;">
        <div>
            <span>Halo {{ $params['name'] }},</span>
            <br><br>
            <span>Berikut OTP yang kami kirimkan ke email Anda:</span>
            <br>
            <span style="font-size: 18px;font-weight: bold;">{{ $params['otp'] }}</span>
        </div>
    </div>
    <div style="width: 100%;color: #bcbac8;font-size: 12px;text-align: center;padding: 20px 10px;">
        <span>&copy; {{ date('Y') . ' ' . config('app.name') }}. All rights reserved.</span>
    </div>
</body>

</html>
