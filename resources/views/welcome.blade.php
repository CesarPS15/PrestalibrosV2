<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Prestalibros</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="../resources/views/welcomeStyle/welcome.css">
    </head>
    <body style="margin: 0 !important">
        <div class="main">
            <div id="welcomeNav">
                <div onclick="window.location={{ url('/home') }}" class="logo">
                    <img src="../public/newStuff/book.svg" alt="" srcset="">
                    PRESTALIBROS
                </div>
                <ul id="options">
                    <li onclick="window.location='{{ route('login') }}'" >Iniciar sesión </li>
                    <li onclick="window.location='{{ route('register') }}'">Registrarse</li>
                </ul>
                <button id="toggler" onclick="toggleOptions()">
                    <img src="../public/newStuff/down_arrow.svg" alt="">
                </button>
            </div>
            <img src="../public/newStuff/blue_thing.svg" alt="" id="background_svg">
            <img id="main_image" src="../public/newStuff/main_book.png" alt="">
            <div class="content">
                <h1>Dar y recibir</h1>
                <ul>
                    <li>Registra y presta tus libros</li>
                    <li>Pide libros de tu interés que alguien tenga disponible.</li>
                    <li>Recibe una copia del libro en tu</li>
                    <li>Miles de libros publicados por la</li>
                </ul>
            </div>
        </div>
        <script>
            const toggleOptions = () => document.querySelector("#options").classList.toggle("hide")    
        </script>
    </body>
</html>
