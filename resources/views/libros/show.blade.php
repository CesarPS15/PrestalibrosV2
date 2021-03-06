@extends('libros.master')

@section('contenido')
<div class="card-header">Libro</div>
<div class="card-body">
    <div class="float-right">

        <a href="{{route('libros.index')}}" class="btn btn-primary btn-sm">Volver</a>
        <p></p>

        <a href="{{route('imprimir', $libro->id)}}" class="btn btn-dark btn-sm">Imprimir PDF</a>
        <p></p>
        @if ($visible)
            <form action="{{route('libros.restaurar',$libro->id)}}" method="GET">
                <input type="submit" value="Restaurar" class="btn btn-success btn-sm">
                @csrf
            </form>
            <p></p>
            <form action="{{route('libros.eliminar',$libro->id)}}" method="POST">
                <input type="submit" class="btn btn-danger btn-sm" value="Eliminar">
                @method('DELETE')
                @csrf
            </form>
        @else
            @if (!\Gate::allows('isAdmin'))
                @if ($libro->users->find(\Auth::id()))
                    <form action="{{route('LibUser.quitar',$libro->id)}}" method="POST">
                        <input type="submit" value="Quitar de mi biblioteca" class="btn btn-danger btn-sm">
                        @csrf
                    </form>
                @else
                    <form action="{{route('libUser.agregar',$libro->id)}}" method="POST">
                        <input type="submit" value="Añadir a mi biblioteca" class="btn btn-success btn-sm">
                        @csrf
                    </form>
                @endif
            @endif
            
            <p></p>
            @if(\Gate::allows('isAdmin') || \Gate::allows('isMineBook',$libro))
                <form action="{{route('libros.edit',$libro->id)}}" method="GET">
                    <input type="submit" class="btn btn-warning btn-sm" value="Editar">
                </form>
                <p></p>
                <form action="{{route('libros.destroy',$libro->id)}}" method="POST">
                    <input type="submit" class="btn btn-danger btn-sm" value="Eliminar">
                    @method('DELETE')
                    @csrf
                </form>
            @endif
        @endif
    </div>

    <div>
        <img width="200px" height="250px" src="{{Storage::url($libro->portada)}}">
    </div>

    <h1>{{$libro->titulo}}</h1>

    <div>
        <div>
            <h2 class="apartados">Autor</h2>
            <p>{{$libro->autor}}</p>
        </div>

        <div>
            <h2 class="apartados">Género</h2>
            <p>{{$libro->genero->nombre}}</p>
        </div>

        <div>
            <h2 class="apartados">Editorial</h2>
            <p>{{$libro->editorial}}</p>
        </div>

        <div>
            <h2 class="apartados">Edición</h2>
            <p>{{$libro->edicion}}</p>
        </div>

        <div>
            <h2 class="apartados">Año De Publicación</h2>
            <p>{{$libro->anio}}</p>
        </div>

        <div>
            <h2 class="apartados">Descripción</h2>
            <p>{{$libro->descripcion}}</p>
        </div>
    </div>
    <hr>

    <div>
        <h2 class="apartados">Personas que tienen el libro</h2>
        @if (count($libro->users))
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($libro->users as $user)
                    <tr>
                        <td>
                            <a href="{{route('users.show',$user->id)}}">{{$user->name}}</a>
                        </td>
                        <td>
                            <a href="{{route('messages.solicitud',['libro'=>$libro->id,'user'=>$user->id])}}" class="btn btn-primary btn-sm">Enviar Solicitud</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        @else
        <p>Nadie lo tiene</p>
        @endif
    </div>

    <hr>

    <div>
        <h2 class="apartados">Comentarios</h2>
        @if (count($libro->comentarios))
            @foreach ($libro->comentarios as $comentario)
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
                <p>
                    {{$comentario->contenido}}
                </p>
            @endforeach
        @else
            <p>No hay comentarios</p>
        @endif
    </div>
    <br>
    @if (!\Gate::allows('isAdmin'))
        <form action="{{route('comentarios.storeLibro',$libro->id)}}" method="POST">
            <div class="form-group">
                <label for="comentario" style="font-weight: bold;">Comentar</label>
                <textarea class="form-control" id="comentario" name="contenido" rows="5"></textarea>
            </div>
            @csrf
            <input type="submit" value="Aceptar" class="btn btn-primary">
        </form>
    @endif
</div>
@endsection
