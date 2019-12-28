@extends('layouts.app')

@section('content')
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2 class="text-center">Ventas realizadas</h2></div>
                    <div class="card-body">
                        @if(count($data['ventas'])>0)
                            <table id="ventas" style="table-layout: fixed;" class="table table-striped">
                                <thead class="thead-dark">
                                <tr  class="dashboard text-center">
                                    <th>Fecha</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Comprador</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                @foreach($data['ventas'] as $venta)
                                    <tr class="text-center">
                                        @foreach($data['users'] as $user)
                                            @if( $venta->vendedor_id == $user->id )
                                                @foreach($data['productos'] as $producto)
                                                    @if( $venta->producto_id == $producto->id )
                                                        @foreach($data['users'] as $user1)
                                                            @if( $venta->comprador_id == $user1->id )
                                                                <td>{{$venta->fecha}}</td>
                                                                <td>{{$producto->nombre}}</td>
                                                                <td>{{$producto->precio}} €</td>
                                                                <td>{{$user1->name}}</td>
                                                                <td>{{$venta->cantidad}}</td>
                                                                <td>{{$venta->cantidad*$producto->precio}}</td>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center" style="font-size: 1.3em; font-weight: bold">TOTAL</td>
                                    <td class="text-center" style="font-size: 1.3em; font-weight: bold">{{$data['total']}} €</td>
                                </tr>
                            </table>
                        @else
                            <p class="mx-auto text-center" style="font-size: 1.2em; color: red">No se ha realizado ninguna venta</p>
                        @endif
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <div>
                            <button class="btn btn-success" id="exportar_ventas">Exportar</button>
                        </div>
                        <div>
                            {{$data['ventas']->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection