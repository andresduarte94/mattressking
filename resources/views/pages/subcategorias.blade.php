@extends('layouts.app')

@section('content')
    <br>
    <div class="buscador w-100 mx-auto mb-3" id="buscador2">
        <form class="form-inline" action="/busqueda" method="POST">
            <input class="form-control mr-sm-4 mx-auto w-75" name="search" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0 mx-auto" type="submit">Search</button>
            @csrf
        </form>
    </div>
        <div class="row justify-content-center d-flex">
            <div class="mb-2 col-lg-2">
                <div class="card mx-auto" style="width: 200px;">
                    <ul class="list-group">
                        <li class="list-group-item" ><a class="btn btn-success" href="/categorias/{{$data['categoria']->categoria_id}}">Volver</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-10">
                @if(count($data['productos'])>0)
                    <div class="container">
                        @foreach($data['productos'] as $index => $producto)
                            @if($index==0 || $index==3 || $index==6)
                                <div class="row d-flex">
                                    @endif
                                    <div class="col-md-4 col-sm-6 col-12 mb-2">
                                        <div class="card mx-auto" style="width: 17rem;">
                                            <img class="card-img-top" height="250px" src="/storage/img_productos/{{$producto->imagen}}" alt="Imagen del producto">
                                            <div class="card-body">
                                                <div class="card-text">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <a href="/productos/{{$producto->id}}"><strong>{{$producto->nombre}}</strong></a>
                                                    </div>
                                                    <div>
                                                        <strong>{{$producto->precio}}€</strong>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($index==2 || $index==5 || $index==8)
                                </div>
                            @endif
                        @endforeach
                    </div>
                    {{$data['productos']->links()}}
                @else
                    <div class="d-flex align-content-center mx-auto">
                        <p class="mx-auto" style="font-size: 1.3em; color: red; margin-bottom: 15%; margin-top: 10%; text-align: center;" >Todavía no existen productos en esta subcategoría.</p>
                    </div>
                @endif
            </div>
        </div>
@endsection