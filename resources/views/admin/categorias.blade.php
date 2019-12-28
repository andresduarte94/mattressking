<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-13">
            <div class="card">
                <div class="card-header">
                    <form class="form-inline w-75" action="/administrar/busquedaCat" method="get">
                        <label for="search" class="mr-2">Nombre:</label>
                        <input class="form-control mr-sm-4 w-50" name="search" type="text" placeholder="Buscar categoria" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        @csrf
                    </form>
                </div>
                <div class="card-body">
                    @if(count($data['categorias'])>0)
                        <table id="categoriasAdmin" style="table-layout: fixed;" class="table table-striped">
                            <thead class="thead-dark">
                            <tr class="dashboard text-center">
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            @foreach($data['categorias'] as $categoria)
                                <tr class="text-center">
                                    <td style="vertical-align: middle">{{$categoria->categoria}}</td>
                                    <td style="vertical-align: middle">{{$categoria->descripcion}}</td>
                                    <td>
                                        <div>
                                            <button type="button" class="btn btn-primary btn-sm w-25" data-toggle="modal" data-target="#editarCat{{$categoria->id}}">Editar</button>
                                            <div class="modal fade" id="editarCat{{$categoria->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form class="categoria" method="post" action="/categorias/{{$categoria->id}}" enctype="multipart/form-data">
                                                            <input type="hidden" name="_method" value="put">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Editar categoria</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group" >
                                                                    <label for="nombre" class="col-form-label">Nombre de Categoria</label>
                                                                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{$categoria->categoria}}" >
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="descripcion" class="col-form-label">Descripción</label>
                                                                    <textarea cols="20" rows="5" class="form-control" id="descripcion" name="descripcion">{{$categoria->descripcion}}</textarea>
                                                                </div>
                                                                @csrf
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                <input type="submit" class="btn btn-primary" value="Editar Categoria">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <form method="post" action="/categorias/{{$categoria->id}}">
                                                <input type="hidden" name="_method" value="delete">
                                                <input type="submit" value="Eliminar" class="btn btn-danger btn-sm w-25" style="width: 70%">
                                                @csrf
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p class="mx-auto text-center" style="font-size: 1.2em; color: red">No ha añadido ninguna categoria</p>
                    @endif
                </div>
                <div class="card-footer d-flex justify-content-between" style="padding-top: 2%" >
                    <div class="w-50">
                        <button type="button" class="btn btn-primary d-inline" data-toggle="modal" data-target="#nuevaCat">Agregar</button>
                        <div class="modal fade" id="nuevaCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form class="categoria" method="post" action="/categorias" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Nueva categoria</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group" >
                                                <label for="nombre" class="col-form-label">Nombre de Categoria</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre">
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion" class="col-form-label">Descripción</label>
                                                <textarea cols="20" rows="5" class="form-control" id="descripcion" name="descripcion"></textarea>
                                            </div>
                                            @csrf
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <input type="submit" class="btn btn-primary" value="Nueva Categoria">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success d-inline" id="exportar_cat">Exportar</button>
                    </div>
                    <div>
                        {{$data['categorias']->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>