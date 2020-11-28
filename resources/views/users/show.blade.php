@extends('libros.master')

@section('contenido')
<link rel="stylesheet" href="../../resources/views/users/userStyle/userStyle.css">
<!-- C:\xampp\htdocs\PrestaLibros\resources\views\users\userStyle\userStyle.css -->
<div class="profileContainer">
    <div class="content">
        <h1>Información personal</h1>
        <div class="personalInfoContainer">
            <div class="profileImageContainer">
                <img src="../newStuff/elonMusk.jpg" alt="">

            </div>
            <div class="profileBasics">
                <h3>{{$user->name}}</h3>
                <p>{{$user->email}}</p>
                @if (\Gate::allows('isAdmin'))
                <div>
                    <!-- <h2 class="apartados">Rol:</h2> -->
                    <p>{{$user->role->nombre??App\Role::find(2)->nombre}}</p>
                </div>
                @endif
                <div class="editProfile">
                    <img src="../newStuff/edit-solid.svg" alt="Edit icon">
                    <p class="editProfile"> Editar información </p>
                </div>
            </div>
        </div>

    </div>
    <hr style="width: 90%; margin: 5px">
    <div class="content">
        <h1>Colección</h1>
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
    <hr style="width: 90%; margin: 5px">
    <div class="content">
        <h1>Comentarios</h1>
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
</div>
   
@endsection
