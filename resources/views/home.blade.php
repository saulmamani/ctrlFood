@extends('layouts.app')

@section('css')
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            position: absolute;
            /*nos posicionamos en el centro del navegador*/
            top: 50%;
            left: 50%;
            /*determinamos una anchura*/
            width: 600px;
            /*indicamos que el margen izquierdo, es la mitad de la anchura*/
            margin-left: -200px;
            /*determinamos una altura*/
            height: 300px;
            /*indicamos que el margen superior, es la mitad de la altura*/
            margin-top: -150px;
            padding: 5px;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <div class="full-height">
            <span class="title">ctrl<strong>FOOD</strong></span>
            v0.9
            <hr style="border-bottom: 1px solid #D0D0D0">
            &copy; Saul Mamani M. <br> <br>
            luas0_1@yahoo.es <br>
            <a href="https://saulmamani.github.io/" target="_blank">https://saulmamani.github.io/</a>
        </div>

    </div>
@endsection
