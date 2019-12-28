@extends('layouts.app')

@section('content')
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h2 class="text-center">Últimas compras</h2></div>
                    <div class="card-body">
                        @if(count($data['compras'])>0)
                            <table id="compras" style="table-layout: fixed;" class="table table-striped">
                                <thead class="thead-dark">
                                <tr  class="dashboard text-center">
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th style="width: 200px; overflow: auto;">Fecha</th>
                                </tr>
                                </thead>
                                @foreach($data['compras'] as $compra)
                                    <tr class="text-center">
                                        @foreach($data['productos'] as $producto)
                                            @if($compra->producto_id == $producto->id )
                                                <td>{{$producto->nombre}}</td>
                                                <td>{{$producto->precio}}</td>
                                                <td>{{$compra->cantidad}}</td>
                                                <td>{{$compra->cantidad*$producto->precio}}</td>
                                                <td style="width: 200px; overflow: auto;">{{$compra->fecha}}</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p class="mx-auto text-center" style="font-size: 1.2em; color: red">No ha agregado ningún producto al carrito.</p>
                        @endif
                    </div>
                    @if(count($data['compras'])>0)
                        <div class="card-footer d-flex justify-content-between my-auto" >
                            <div>
                                <button class="btn btn-success" id="exportar">Export</button>
                            </div>
                            <div>
                                {{$data['compras']->links()}}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
