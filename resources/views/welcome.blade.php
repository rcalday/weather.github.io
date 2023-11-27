<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Weather App</title>
    <link rel="icon" href="public/images/weather-app.png" type="image/x-icon">

    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="{{url('public/css/app.css?'.date('Ymdhis'))}}" rel="stylesheet">
</head>

<body class="app-main-bg">
    <div id="app"></div>
    <script src="{{url('/public/js/app.js?'.date('Ymdhis'))}}"></script>
    <!-- <script src="{{url('/public/js/bundle.js?'.date('Ymdhis'))}}"></script> -->
</body>

</html>