<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Prestalibros</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <!-- <link rel="stylesheet" href="../resources/views/welcomeStyle/welcome.css"> -->
        <!-- <link href="{{ asset('../resources/views/welcomeStyle/welcome.css') }}"> -->
        <style>
            * {
                margin: 0;
                padding: 0;
                font-family: 'Helvetica', sans-serif;
            }

            h1 {
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-size: 24px;
                font-style: normal;
                font-variant: normal;
                font-weight: 700;
                line-height: 26.4px;
            }

            h3 {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            font-style: normal;
            font-variant: normal;
            font-weight: 700;
            line-height: 15.4px;
            }

            p {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            font-style: normal;
            font-variant: normal;
            font-weight: 400;
            line-height: 20px;
            }

            blockquote {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 21px;
            font-style: normal;
            font-variant: normal;
            font-weight: 400;
            line-height: 30px;
            }

            pre {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 13px;
            font-style: normal;
            font-variant: normal;
            font-weight: 400;
            line-height: 18.5714px;
            }

            html {
            margin: 0;
            padding: 0;
            }

            .main {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
                -ms-flex-direction: column;
                    flex-direction: column;
            -webkit-box-align: center;
                -ms-flex-align: center;
                    align-items: center;
            min-height: 100%;
            min-width: 100%;
            }

            #welcomeNav {
            position: fixed;
            top: 0;
            left: 15%;
            right: 15%;
            height: 75px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
                -ms-flex-pack: justify;
                    justify-content: space-between;
            -webkit-box-align: center;
                -ms-flex-align: center;
                    align-items: center;
            background-color: white;
            z-index: 10;
            }

            #welcomeNav .logo {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
                -ms-flex-pack: center;
                    justify-content: center;
            -webkit-box-align: center;
                -ms-flex-align: center;
                    align-items: center;
            height: 100%;
            max-width: 180px;
            width: 240px;
            font-weight: bold;
            letter-spacing: 1px;
            cursor: pointer;
            color: #3B61D1;
            }

            #welcomeNav .logo img {
            margin-right: 1em;
            }

            #welcomeNav #options {
            -webkit-box-pack: end;
                -ms-flex-pack: end;
                    justify-content: flex-end;
            list-style: none;
            margin-left: 20px;
            }

            #welcomeNav #options li {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
                -ms-flex-align: center;
                    align-items: center;
            -webkit-box-pack: center;
                -ms-flex-pack: center;
                    justify-content: center;
            color: #1d1d1b;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            font-size: 90%;
            padding: 0 1em;
            font-weight: bold;
            }

            #welcomeNav .hide {
            display: block !important;
            }

            #welcomeNav #toggler {
            max-width: 30px;
            max-height: 30px;
            background-color: transparent;
            border: none;
            }

            #welcomeNav #toggler img {
            max-width: 100%;
            }

            #main_image {
            position: fixed;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            right: 10%;
            bottom: 8%;
            -ms-flex-preferred-size: 500px;
                flex-basis: 500px;
            max-width: 70%;
            max-height: 65%;
            z-index: 2;
            }

            #background_svg {
            position: fixed;
            right: 0%;
            bottom: 0%;
            max-width: 100%;
            min-width: 100%;
            z-index: 1;
            }

            .content {
            position: fixed;
            top: 25%;
            left: 15%;
            right: 15%;
            max-width: 75%;
            -ms-flex-preferred-size: 550px;
                flex-basis: 550px;
            z-index: 3;
            }

            .content h1 {
            color: #3B61D1;
            font-weight: bold;
            font-size: Max(42px, 4.5vw);
            line-height: 1em;
            }

            .content li {
            text-indent: 1.5em;
            font-size: Max(17px, 1.5vw);
            line-height: 1.2em;
            margin: 0.5em;
            width: -webkit-fit-content;
            width: -moz-fit-content;
            width: fit-content;
            background-color: rgba(255, 255, 255, 0.8);
            }

            @media (min-width: 618px) {
            #toggler {
                display: none;
            }
            #options {
                position: relative;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                height: 100%;
            }
            #options li {
                height: 100%;
            }
            }

            @media (max-width: 617px) {
            #toggler {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
            }
            #welcomeNav {
                height: 50px;
            }
            #options {
                display: none;
                position: fixed;
                top: 50px;
                right: 15%;
                left: 15%;
                height: 100px;
                width: 70%;
                margin: 0 !important;
            }
            #options li {
                height: 50px;
            }
            }
            /*# sourceMappingURL=welcome.css.map */
        </style>
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
