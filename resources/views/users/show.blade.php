@extends('libros.master')

@section('contenido')
<!-- <link href="../../resources/views/users/userStyle/userStyle.css"> -->
<!-- <link href="{{ asset('resources/views/users/userStyle/userStyle.css') }}"> -->
<!-- <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }} " rel="stylesheet" type="text/css"> -->
<!-- C:\xampp\htdocs\PrestaLibros\resources\views\users\userStyle\userStyle.css -->

<style>
* {
  margin: 0;
  padding: 0;
  font-family: 'Nunito', sans-serif;
}

h1 {
  font-family: "Nunito Neue", Nunito, Arial, sans-serif;
  font-size: 24px;
  font-style: normal;
  font-variant: normal;
  font-weight: 700;
  line-height: 26.4px;
}

h3 {
  font-family: "Nunito Neue", Nunito, Arial, sans-serif;
  font-size: 14px;
  font-style: normal;
  font-variant: normal;
  font-weight: 700;
  line-height: 15.4px;
}

p {
  font-family: "Nunito Neue", Nunito, Arial, sans-serif;
  font-size: 14px;
  font-style: normal;
  font-variant: normal;
  font-weight: 400;
  line-height: 20px;
}

blockquote {
  font-family: "Nunito Neue", Nunito, Arial, sans-serif;
  font-size: 21px;
  font-style: normal;
  font-variant: normal;
  font-weight: 400;
  line-height: 30px;
}

pre {
  font-family: "Nunito Neue", Nunito, Arial, sans-serif;
  font-size: 13px;
  font-style: normal;
  font-variant: normal;
  font-weight: 400;
  line-height: 18.5714px;
}

.profileContainer {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  width: 620px;
  max-width: 90%;
  -ms-flex-item-align: center;
      align-self: center;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  background-color: white;
  border-radius: 10px;
  -webkit-box-shadow: 0 0 3px 1px;
          box-shadow: 0 0 3px 1px;
}

.profileContainer .content {
  width: 90%;
  padding: 20px;
}

.profileContainer .content h1 {
  letter-spacing: 1px;
  text-transform: uppercase;
  color: #3B61D1;
  font-size: 16px;
  font-weight: 600;
  margin: 0;
}

.profileContainer .content .personalInfoContainer {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  width: 100%;
}

.profileContainer .content .personalInfoContainer .profileImageContainer {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  width: 100px;
  height: 100px;
  border: 1px solid #1d1d1b;
  border-radius: 50%;
  overflow: hidden;
}

.profileContainer .content .personalInfoContainer .profileImageContainer img {
  max-height: 100%;
  max-width: auto;
}

.profileContainer .content .personalInfoContainer .profileBasics {
  padding: 0.5em 1em;
}

.profileContainer .content .personalInfoContainer .profileBasics h3 {
  color: #3B61D1;
}

.profileContainer .content .personalInfoContainer .profileBasics p {
  margin: 0;
}

.profileContainer .content .personalInfoContainer .profileBasics .editProfile {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
      -ms-flex-direction: row;
          flex-direction: row;
  color: #3B61D1;
  cursor: pointer;
  font-size: 70%;
}

.profileContainer .content .personalInfoContainer .profileBasics .editProfile:hover {
  -webkit-filter: brightness(1.2);
          filter: brightness(1.2);
}

.profileContainer .content .personalInfoContainer .profileBasics .editProfile img {
  height: 10px;
  width: 10px;
}

.profileContainer .content .personalInfoContainer .profileBasics .editProfile p {
  margin: 0;
  padding-left: 0.5em;
}
/*# sourceMappingURL=userStyle.css.map */
</style>

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
