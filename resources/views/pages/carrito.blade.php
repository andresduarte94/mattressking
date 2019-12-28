@extends('layouts.app')

@section('content')
    <br>
    <div class="card mx-auto" style="width: 85%">
        <div class="card-header"><h1 class="mx-auto text-center">Productos en el carrito</h1></div>
        <div class="card-body mx-auto pb-2">
            @guest
                <p class="mx-auto" style="font-size: 1.2em; color: red">Debes estar logueado para agregar productos al carrito.</p>
            @else
                @if(!(count($carrito)>1))
                    <p class="mx-auto" style="font-size: 1.2em; color: red">No ha agregado ningún producto al carrito.</p>
                @else
                    <div class="container">
                        <div class="row mt-1" style="font-size: 1.3em">
                            <div class='col-md-2 col-sm-2'></div>
                            <div class='col-md-2 col-sm-2 text-center'>Producto</div>
                            <div class='col-md-2 col-sm-2 text-center'>Precio</div>
                            <div class='col-md-2 col-sm-2 text-center'>Cantidad</div>
                            <div class='col-md-2 col-sm-2 text-center'>Total</div>
                            <div class='col-md-1 col-sm-1 text-center'></div>
                        </div>
                        <hr class="mb-3" style="margin-top: -0.3%">
                        @foreach($carrito as $index => $compra)
                            @if($index!=(count($carrito)-1))
                                <div class="card">
                                    <div class="row my-auto">
                                        <div class='col-md-2 col-sm-2 my-auto'><img class="mx-auto d-block w-75" style="max-height: 80px" src="/storage/img_productos/{{$compra['producto']->imagen}}"></div>
                                        <div class='col-md-2 col-sm-2 text-center my-auto' ><h5>{{$compra['producto']->nombre}}</h5></div>
                                        <div class='col-md-2 col-sm-2 text-center my-auto' >{{$compra['producto']->precio}} €</div>
                                        <div class='col-md-2 col-sm-2 text-center my-auto'>{{$compra['cantidad']}}</div>
                                        <div class='col-md-2 col-sm-2 text-center my-auto'>{{$compra['producto']->precio*$compra['cantidad']}} €</div>
                                        <div class='col-md-1 col-sm-1 my-auto'><a href="/carrito/{{$compra['producto']->id}}/edit" class="btn btn-warning btn-sm">Eliminar</a></div>
                                    </div>
                                </div>
                            @else
                                <div class="card">
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class='col-md-2 col-sm-2'></div>
                                            <div class='col-md-1 col-sm-1'></div>
                                            <div class='col-md-2 col-sm-2 text-center my-auto'>
                                                <form action="/carrito/comprar" method="post" target="_top">
                                                    <input type="hidden" name="_method" value="put">
                                                    <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal, la forma rápida y segura de pagar en Internet.">
                                                    {{ csrf_field() }}
                                                </form>
                                            </div>
                                            <div class='col-md-3 col-sm-3 text-right my-auto' style="font-size: 1.3em; font-weight: 700; ">Total a pagar:</div>
                                            <div class='col-md-2 col-sm-2 text-right my-auto' style="font-size: 1.3em; margin-left: -1.5%"><strong>{{$compra}} €</strong></div>
                                            <div class='col-md-1 col-sm-1 my-auto ml-3'>
                                                <form method="post" action="carrito/vaciar">
                                                    <input type="submit" value="Vaciar carrito" class="btn btn-danger btn-sm">
                                                    <input type="hidden" name="_method" value="delete">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            @endguest
        </div>
    </div>
@endsection