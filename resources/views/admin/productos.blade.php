<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-13">
            <div class="card">
                <div class="card-header">
                    <form class="form-inline w-75" action="/administrar/busquedaProd" method="get">
                        <label for="search" class="mr-2">Nombre:</label>
                        <input class="form-control mr-sm-4 w-50" name="search" type="text" placeholder="Buscar producto" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        @csrf
                    </form>
                </div>
                <div class="card-body">
                    @if(count($data['productos'])>0)
                        <table id="productosAdmin" style="table-layout: fixed;" class="table table-striped excludeThisClass">
                            <thead class="thead-dark">
                            <tr  class="dashboard text-center">
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Descripcion</th>
                                <th>Categoria</th>
                                <th>Subcategoria</th>
                                <th>Cantidad</th>
                                <th class="noExl" >Acciones</th>
                            </tr>
                            </thead>
                            @foreach($data['productos'] as $producto)
                                <tr class="text-center">
                                    @foreach($data['categorias'] as $categoria)
                                        @foreach($data['subcategorias'] as $subcategoria)
                                            @if( $producto->categoria_id == $categoria->id )
                                                @if( $producto->subcategoria_id == $subcategoria->id )
                                                    <td style="vertical-align: middle">{{$producto->nombre}}</td>
                                                    <td style="vertical-align: middle">{{$producto->precio}}</td>
                                                    <td style="vertical-align: middle">{{$producto->descripcion}}</td>
                                                    <td style="vertical-align: middle">{{$categoria->categoria}}</td>
                                                    <td style="vertical-align: middle">{{$subcategoria->subcategoria}}</td>
                                                    <td style="vertical-align: middle">{{$producto->cantidad}}</td>
                                                    <td class="noExl" >
                                                        <div>
                                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editarProd{{$producto->id}}" style="width: 70%">Editar</button>
                                                            <div class="modal fade" id="editarProd{{$producto->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <form class="editarProducto" method="post" action="/productos/{{$producto->id}}" enctype="multipart/form-data">
                                                                            <input type="hidden" name="_method" value="put">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group" >
                                                                                    <label for="nombre" class="col-form-label">Nombre del Producto</label>
                                                                                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{$producto->nombre}}" >
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="descripcion" class="col-form-label">Descripción</label>
                                                                                    <textarea cols="20" rows="5" class="form-control" id="descripcion" name="descripcion">{{$producto->descripcion}}</textarea>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="categoria" class="col-form-label">Categoria</label>
                                                                                    <select type="text" class="form-control" id="categoria" name="categoria">
                                                                                        @foreach($data['categorias'] as $categoria)
                                                                                            <option value="{{$categoria->id}}"
                                                                                                    @if ( $categoria->id==$producto->categoria_id )
                                                                                                    selected
                                                                                                    @endif
                                                                                            >{{$categoria->categoria}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="subcategoria" class="col-form-label">Subcategoria</label>
                                                                                    <select class="form-control" id="subcategoria" name="subcategoria">
                                                                                        @foreach($data['subcategorias'] as $subcategoria)
                                                                                            <option value="{{$subcategoria->id}}"
                                                                                                    @if ( $subcategoria->id==$producto->subcategoria_id )
                                                                                                    selected
                                                                                                    @endif
                                                                                            >{{$subcategoria->subcategoria}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group form-inline">
                                                                                    <label for="precio" class="col-form-label">Precio</label>
                                                                                    <input type="number" class="form-control ml-3" id="precio" name="precio" value="{{$producto->precio}}">
                                                                                </div>
                                                                                <div class="form-group form-inline">
                                                                                    <label for="cantidad" class="col-form-label">Cantidad en stock</label>
                                                                                    <input type="number" class="form-control ml-3" id="cantidad" name="cantidad" value="{{$producto->cantidad}}">
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label for="imagen" class="col-form-label">Cargar imagen</label>
                                                                                    <input type="file" id="imagen" name="imagen" class="form-control" accept="image/*"/>
                                                                                </div>
                                                                                @csrf
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                                <input type="hidden" name="user_id" value="{{$producto->user_id}}">
                                                                                <input type="hidden" name="admin" value="1">
                                                                                <input type="submit" class="btn btn-primary" id="validar" value="Editar Producto">
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <form method="post" action="/productos/{{$producto->id}}">
                                                                <input type="hidden" name="_method" value="delete">
                                                                <input type="submit" value="Eliminar" class="btn btn-danger btn-sm" style="width: 70%">
                                                                @csrf
                                                            </form>
                                                        </div>
                                                    </td>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>No ha añadido ningún producto</p>
                    @endif
                </div>
                <div class="card-footer d-flex justify-content-between" style="padding-top: 2%" >
                    <div>
                        <button class="btn btn-success" id="exportar_prod2">Exportar</button>
                    </div>
                    <div>
                        {{$data['productos']->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>