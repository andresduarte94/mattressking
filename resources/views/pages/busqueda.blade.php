@extends('layouts.app')

@section('content')
    <br>
    <div class="row justify-content-center d-flex" >
        <div class="d-inline" style="margin-right: 2%; margin-bottom: 4%"> <!-- id="sticky" style="position: fixed"-->
            <div class="card" style="width: 200px;">
                <div class="sidebar-header card-header" style="padding-top: 8%">
                    <h4 class="text-center">Categorías</h4>
                </div>
                <ul class="list-group">
                    @foreach($data['categorias'] as $categoria)
                        <li class="list-group-item" style="padding: 0"><a class="nav-link active" href="/categorias/{{$categoria->id}}">{{$categoria->categoria}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div>
            <div class="container ">
                @foreach($data['productos'] as $index => $producto)
                    @if($index==0 || $index==3 || $index==6)
                        <div class="row d-flex">
                            @endif
                            <div class="col-md-4 col-12 mb-2">
                                <div class="card mx-auto" style="width: 17rem;">
                                    <a href="/productos/{{$producto->id}}"><img class="card-img-top" height="250px" src="/storage/img_productos/{{$producto->imagen}}" alt="Imagen del producto"></a>
                                    <div class="card-body">
                                        <p class="card-text">
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
                            @if($index==2 || $index==5 || $index==8)
                        </div>
                    @endif
                @endforeach
                {{$data['productos']->links()}}
            </div>
        </div>
    </div>
@endsection