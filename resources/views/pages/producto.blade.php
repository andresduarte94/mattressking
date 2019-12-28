@extends('layouts.app')

@section('content')
    <br>
    <div class="container-fluid">
        <div class="card">
            <div class="row p-2 my-3">
                <div class="col-md-4 col-sm-4">
                    <img class="img-fluid img-thumbnail my-auto" src="/storage/img_productos/{{$data['producto']->imagen}}">
                </div>
                <div class="col-md-5 col-sm-5 pl-5" style="position: relative">
                    <h1>{{$data['producto']->nombre}}</h1>
                    <p style="font-size: 1.3em">Precio: <span style="color: #ff6600; font-size: 1.1em" class="font-weight-bold">{{$data['producto']->precio}} €</span></p>
                    <p class="mb-4" style="font-size: 1.1em"><strong>Descripción</strong><br>{{$data['producto']->descripcion}}</p>

                    <form method="POST" action="/carrito">
                        <div class="form-row">
                            <span class="pt-2 mr-2 ml-2 font-weight-bold" style="font-size: 1.1em">Cantidad: </span>
                            <input style="width: 20%" type="number" name="cantidad" class="form-control" required>
                            <input type="hidden" name="id" value="{{$data['producto']->id}}">
                            <span class="ml-3 pt-2" style="font-weight: 800; opacity: 0.6">Existen {{$data['producto']->cantidad}} unidades disponibles</span>
                        </div><br>
                        <input type="submit" value="Añadir a carrito" class="btn btn-primary">
                        {{ csrf_field() }}
                    </form>
                </div>
                <div class="col-md-3 col-sm-3 mt-3 mt-lg-0" >
                    <img class="mx-auto d-block" src="/storage/estrellas/{{round($data['valoracion'])}}.jpg">
                    <p class="text-center">Puntuación: {{$data['valoracion']}}</p>
                </div>
            </div>
        </div>
        @include('pages.comentarios')
    </div>
@endsection
