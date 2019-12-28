<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-13">
            <div class="card">
                <div class="card-header">
                    <form class="form-inline w-75" action="/administrar/busquedaSub" method="get">
                        <label for="search" class="mr-2">Nombre:</label>
                        <input class="form-control mr-sm-4 w-50" name="search" type="text" placeholder="Buscar subcategoria" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        @csrf
                    </form>
                </div>
                <div class="card-body">
                    @if(count($data['subcategorias'])>0)
                        <table id="subcategoriasAdmin" style="table-layout: fixed;" class="table table-striped">
                            <thead class="thead-dark">
                            <tr class="dashboard text-center">
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Categoria</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            @foreach($data['subcategorias'] as $subcategoria)
                                <tr class="text-center">
                                    <td style="vertical-align: middle">{{$subcategoria->subcategoria}}</td>
                                    <td style="vertical-align: middle">{{$subcategoria->descripcion}}</td>
                                    @foreach($data['categorias'] as $categoria)
                                        @if($categoria->id == $subcategoria->categoria_id)
                                    <td style="vertical-align: middle">{{$categoria->categoria}}</td>
                                        @endif
                                    @endforeach
                                    <td>
                                        <div>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editarSub{{$subcategoria->id}}" style="width: 35%">Editar</button>
                                            <div class="modal fade" id="editarSub{{$subcategoria->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form class="subcategoria" method="post" action="/subcategorias/{{$subcategoria->id}}" enctype="multipart/form-data">
                                                            <input type="hidden" name="_method" value="put">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Editar Subcategoria</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group" >
                                                                    <label for="nombre" class="col-form-label">Nombre de Subcategoria</label>
                                                                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{$subcategoria->subcategoria}}" >
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="descripcion" class="col-form-label">Descripción</label>
                                                                    <textarea cols="20" rows="5" class="form-control" id="descripcion" name="descripcion">{{$subcategoria->descripcion}}</textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="categoria" class="col-form-label">Categoria</label>
                                                                    <select type="text" class="form-control" id="categoria" name="categoria">
                                                                        @foreach($data['categorias'] as $categoria)
                                                                            <option value="{{$categoria->id}}"
                                                                                    @if ( $categoria->id==$subcategoria->categoria_id )
                                                                                    selected
                                                                                    @endif
                                                                            >{{$categoria->categoria}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                @csrf
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                <input type="submit" class="btn btn-primary" value="Editar Subcategoria">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <form method="post" action="/subcategorias/{{$subcategoria->id}}">
                                                <input type="hidden" name="_method" value="delete">
                                                <input type="submit" value="Eliminar" class="btn btn-danger btn-sm" style="width: 35%">
                                                @csrf
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p class="mx-auto text-center" style="font-size: 1.2em; color: red">No ha añadido ninguna subcategoria</p>
                    @endif
                </div>
                <div class="card-footer d-flex justify-content-between" style="padding-top: 2%" >
                    <div class="w-50">
                        <div class="d-inline">
                            <button type="button" class="btn btn-primary d-inline" data-toggle="modal" data-target="#nuevaSub">Agregar</button>
                            <div class="modal fade" id="nuevaSub" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form class="subcategoria" method="post" action="/subcategorias" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Nueva subcategoria</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group" >
                                                    <label for="nombre" class="col-form-label">Nombre de Subcategoria</label>
                                                    <input type="text" class="form-control" id="nombre" name="nombre">
                                                </div>
                                                <div class="form-group">
                                                    <label for="descripcion" class="col-form-label">Descripción</label>
                                                    <textarea cols="20" rows="5" class="form-control" id="descripcion" name="descripcion"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="categoria" class="col-form-label">Categoria</label>
                                                    <select type="text" class="form-control" id="categoria" name="categoria">
                                                        @foreach($data['categorias'] as $categoria)
                                                            <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @csrf
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <input type="submit" class="btn btn-primary" value="Nueva Subcategoria">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-inline">
                            <button class="btn btn-success d-inline" id="exportar_sub">Exportar</button>
                        </div>
                    </div>
                    <div>
                        {{$data['subcategorias']->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>