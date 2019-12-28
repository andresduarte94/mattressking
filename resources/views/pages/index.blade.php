@extends('layouts.app')

@section('content')
    <br>
    @if((count($data['productos'])>3))
    <div id="contenedorSlide" class="slider-wrapper mx-auto theme-dark mb-3 d-none d-xl-block">
        <div id="slider" class="nivoSlider">
            <img class="img-slide" src="/storage/img_nivo/logonivo.png" />
            <img class="img-slide" src="/storage/img_nivo/pasoscompra.png"/>
            <img class="img-slide" src="/storage/img_nivo/prueba 4.png"/>
        </div>
    </div>
    @endif
    <div class="buscador w-100 mx-auto mb-3" id="buscador2" >
        <form class="form-inline" action="/busqueda" method="POST">
            <input class="form-control mr-sm-4 mx-auto w-75" name="search" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0 mx-auto" type="submit">Search</button>
            @csrf
        </form>
    </div>
    <div class="row justify-content-center d-flex" >
        <div class="d-inline" style="margin-bottom: 4%"> <!-- id="sticky" style="position: fixed"-->
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
                        <div class="flex-lg-row row d-flex" id="index">
                            @endif
                            <div class="col-lg-4 col-md-6 col-12 mb-2">
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
                            @if($index==2 || $index==5 || $index==8 )
                        </div>
                    @endif
                @endforeach
                    @if((count($data['productos'])<3))
                        <div class="col-lg-4 mb-2" style="width: 17rem;"></div></div>
            @endif
        </div>
        <div class="ml-3">{{$data['productos']->links()}}</div>
    </div>
    </div>
@endsection