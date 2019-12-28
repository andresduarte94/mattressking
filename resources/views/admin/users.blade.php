<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-13">
            <div class="card">
                <div class="card-header">
                    <form class="form-inline w-75" action="/administrar/busquedaUser" method="get">
                        <label for="search" class="mr-2">Nombre:</label>
                        <input class="form-control mr-sm-4 w-50" name="search" type="text" placeholder="Busca usuarios" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        @csrf
                    </form>
                </div>
                <div class="card-body">
                    @if(count($data['users'])>0)
                        <table id="usersAdmin" style="table-layout: fixed;" class="table table-striped">
                            <thead class="thead-dark">
                            <tr class="dashboard text-center">
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Tipo de Usuario</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            @foreach($data['users'] as $user)
                                <tr class="text-center">
                                    <td style="vertical-align: middle">{{$user->name}}</td>
                                    <td style="vertical-align: middle">{{$user->email}}</td>
                                    <td style="vertical-align: middle">
                                        @if($user->tipo==0)Comprador
                                        @elseif($user->tipo==1)Vendedor
                                        @else Administrador
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editarUser{{$user->id}}" style="width: 40%">Editar</button>
                                            <div class="modal fade" id="editarUser{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form class="usuario" method="post" action="/users" enctype="multipart/form-data">
                                                            <input name="user" value="{{$user->id}}" type="hidden">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group" >
                                                                    <label for="nombre" class="col-form-label">Nombre de Usuario</label>
                                                                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{$user->name}}" >
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="email" class="col-form-label">Email</label>
                                                                    <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="pass" class="col-form-label">Contraseña</label>
                                                                    <input type="password" class="form-control" id="pass" name="pass">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tipo" class="col-form-label">Tipo de usuario</label>
                                                                    <select name="tipo">
                                                                        <option value="0" @if($user->tipo==0) selected @endif>Comprador</option>
                                                                        <option value="1" @if($user->tipo==1) selected @endif>Vendedor</option>
                                                                        <option value="2" @if($user->tipo==2) selected @endif>Administrador</option>
                                                                    </select>
                                                                </div>
                                                                @csrf
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                <input type="submit" class="btn btn-primary " value="Editar Usuario">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <form method="get" action="/users">
                                                <input type="hidden" name="_method" value="delete">
                                                <input type="hidden" name="user" value="{{$user->id}}">
                                                <input type="submit" value="Eliminar" class="btn btn-danger btn-sm" style="width: 40%">
                                                @csrf
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                        @endforeach
                        </table>
                    @else
                        <p class="mx-auto" style="font-size: 1.2em; color: red">No ha añadido ningún usuario.</p>
                    @endif
                </div>
                <div class="card-footer d-flex justify-content-between" style="padding-top: 2%" >
                    <div class="w-50">
                        <button type="button" class="btn btn-primary d-inline" data-toggle="modal" data-target="#nuevoUsu">Agregar</button>
                        <div class="modal fade" id="nuevoUsu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form class="usuario" method="post" action="/users/nuevo" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Nuevo usuario</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group" >
                                                <label for="nombre" class="col-form-label">Nombre de Usuario</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre">
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="col-form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="pass" class="col-form-label">Contraseña</label>
                                                <input type="password" class="form-control" id="pass" name="pass">
                                            </div>
                                            <div class="form-group">
                                                <label for="tipo" class="col-form-label">Tipo de usuario</label>
                                                <select name="tipo">
                                                    <option value="0">Comprador</option>
                                                    <option value="1">Vendedor</option>
                                                    <option value="2">Administrador</option>
                                                </select>
                                            </div>
                                            @csrf
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <input type="submit" class="btn btn-primary" value="Nuevo Usuario">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success" id="exportar_user">Exportar</button>
                    </div>
                    <div>
                        {{$data['users']->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>