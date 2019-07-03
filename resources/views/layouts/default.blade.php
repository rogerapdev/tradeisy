<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME', 'Tradeisy') }}</title>
    <link rel="stylesheet" href="{!! asset('theme/vendor/simple-line-icons/css/simple-line-icons.css') !!}">
    <link rel="stylesheet" href="{!! asset('theme/vendor/font-awesome/css/fontawesome-all.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('theme/css/styles.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/custom.css') !!}">
</head>
<body class="sidebar-fixed header-fixed">
<div class="page-wrapper">
    <div class="page-header">
        @include('elements.header')
    </div>

    <div class="main-container">
        <div class="sidebar">
            @include('elements.sidebar')
        </div>

        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<script src="{!! asset('theme/vendor/jquery/jquery.min.js') !!}"></script>
<script src="{!! asset('theme/vendor/popper.js/popper.min.js') !!}"></script>
<script src="{!! asset('theme/vendor/bootstrap/js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('theme/vendor/chart.js/chart.min.js') !!}"></script>
<script src="{!! asset('theme/js/carbon.js') !!}"></script>
<script src="{!! asset('theme/js/demo.js') !!}"></script>
<script src="{!! asset('js/jquery.mask.js') !!}"></script>
<script src="{!! asset('js/jquery.maskMoney.js') !!}"></script>

<script src="{!! asset('js/custom.js') !!}"></script>

</body>
</html>
