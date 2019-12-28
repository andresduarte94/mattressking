<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FastBuy') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estrellas.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('Logo.png') }}">
    <!-- NivoSlider -->
    <link rel="stylesheet" href="{{ asset('js/nivo-slider/themes/dark/dark.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('js/nivo-slider/nivo-slider.css')}}" type="text/css"/>
    <style>
        .error {
            color: red;
            margin-top: 1.5%;
        }
        #contenedorSlide {
            width: 80%;
        }
        .img-slide, #slider {
            max-height: 230px;
        }
        #slider {
            overflow: hidden;
        }
        #contenedorSlide {

        }
        /*body {
            min-height: 1000px;
        }
        */
        @media screen and (min-device-width: 620px) and (max-device-width: 800px) {
            #index {
                display: flex;
                -ms-flex-wrap: initial;
                flex-wrap: initial;
                margin-right: initial;
                margin-left: initial;
            }
        }
        @media screen and (max-device-width: 800px) {
            #buscador {
                display: none;
            }
            #buscador2 {
                display: block;
            }
        }
        @media screen and (min-device-width: 800px) {
            #buscador2 {
                display: none;
            }
        }
    </style>
</head>
<body >
<div id="app">
    @include('inc.nav')
    <div class="container">
        @include('inc.messages')
        @yield('content')
    </div>
</div>
<br>
<div class="p-3 bg-dark text-white" id="footer" >
    <footer class=".bg-dark" style="align-content: center; margin-left: 10%; ">Contáctanos en <a href="mailto:soporte@fastbuy.com">soporte@fastbuy.com</a><br> <address>Barcelona, España</address></footer>
</div>
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

<script src="{{ asset('js/jquery.table2excel.js') }}"></script>
<script src="{{ asset('js/jquery.validate.js') }}"></script>
<script src="{{ asset('js/nivo-slider/jquery.nivo.slider.js')}}"></script>
<script src="{{ asset('js/nivo.js')}}"></script>
<script src="{{ asset('js/sticky-kit.min.js')}}"></script>

<script src="{{ asset('js/exports.js') }}"></script>
<script src="{{ asset('js/validar.js') }}"></script>
<script src="{{ asset('js/validarEdit.js') }}"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>

</script>
</body>
</html>
