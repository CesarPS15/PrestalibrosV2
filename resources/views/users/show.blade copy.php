@extends('libros.master')

@section('contenido')


<div class="card-header">Perfil</div>
    <div class="card-body">
        <div class="float-right">
            <a href="{{route('users.index')}}" class="btn btn-primary btn-sm">Ver Lista</a>
            <p></p>
            <a href="{{route('home')}}" class="btn btn-primary btn-sm">Volver al menu</a>
            <p></p>
            <a href="{{route('ImprimirDatos', $user->id)}}" class="btn btn-dark btn-sm">Imprimir PDF</a>
            <p></p>
            @if(\Gate::allows('isAdmin') || \Gate::allows('isMineUser',$user))
                {!! link_to_route('users.edit', 'Modificar', [$user->id], ['class'=>'btn btn-warning btn-sm']) !!}
                <p></p>
                @if ($visible)
                    <form action="{{route('users.eliminar',$user->id)}}" method="POST">
                        <input type="submit" class="btn btn-danger btn-sm" value="Eliminar">
                        @method('DELETE')
                        @csrf
                    </form>
                    <p></p>
                    <form action="{{route('users.restaurar',$user->id)}}" method="GET">
                        <input type="submit" class="btn btn-success btn-sm" value="Restaurar">
                        @csrf
                    </form>
                @else
                    <form action="{{route('users.destroy',$user->id)}}" method="POST">
                        <input type="submit" class="btn btn-danger btn-sm" value="Eliminar">
                        @method('DELETE')
                        @csrf
                    </form>
                @endif
            @endif
        </div>
        

        <div>
            <div>
                <h2 class="apartados">Nombre</h2>
                <p>{{$user->name}}</p>
            </div>
            <div>
                <h2 class="apartados">Email</h2>
                <p>{{$user->email}}</p>
            </div>
            @if (\Gate::allows('isAdmin'))
                <div>
                    <h2 class="apartados">Rol:</h2>
                    <p>{{$user->role->nombre??App\Role::find(2)->nombre}}</p>
                </div>
            @endif
        </div>
        <hr>

        {{-- @if (!\Gate::allows('isAdminPerfil',$user->role_id)) --}}
            <div>
                <h2 class="apartados">Colección</h2>
                @if (count($user->libros))
                    <ul class="list-group">
                        @foreach ($user->libros as $libro)
                            <li class="list-group-item"><a href="{{route('libros.show',$libro->id)}}">{{$libro->titulo}}</a></li>
                        @endforeach
                    </ul>
                @else
                    <p>Aún no tiene libros agregados</p>
                @endif
            </div>
            <hr>
            <div>
                <h2 class="apartados">Comentarios</h2>
                @if (count($user->comentarios))
                    @foreach ($user->comentarios as $comentario)
                        <?php $id = $comentario->user['id']; ?>
                        <a href="{{route('users.show',$comentario->user->id)}}">{{$comentario->user->name}}</a>
                        @can('accionComentario', $comentario)
                            <form action="{{route('comentarios.edit',$comentario->id)}}" method="GET" class="float-right">
                                <input type="submit" class="btn btn-warning btn-sm" value="Editar">
                            </form>
                            <form action="{{route('comentarios.destroy',$comentario->id)}}" method="POST" class="float-right">
                                <input type="submit" class="btn btn-danger btn-sm" value="Eliminar">
                                @method('DELETE')
                                @csrf
                            </form>
                        @endcan
                        <p>{{$comentario->contenido}}</p>
                    @endforeach
                @else
                    <p>No tiene ningún comentario</p>
                @endif
            </div>
            <br>
            {{-- Area para comentar --}}
            @if (!\Gate::allows('isAdmin'))
                <div>
                    <form action="{{route('comentarios.storeUser',$user->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="comentario" style="font-weight: bold;">Comentar</label>
                            <textarea class="form-control" id="comentario" name="contenido" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Aceptar">
                        </div>
                    </form>
                </div>
            @endif
        {{-- @endif --}}
        
        {{-- fin del Area para comentar --}}
    </div>
@endsection
