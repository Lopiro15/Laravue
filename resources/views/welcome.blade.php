<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="{{asset('css/app.css')}}" rel="stylesheet">

        <!-- Styles -->
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <router-link to="/" class="nav-link active router-link-activ">Accueil</router-link>
                        </li>
                        <li class="nav-item">
                        <router-link to="/tasks" class="nav-link">Liste des Taches</router-link>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>
            <div class="container">
                <router-view></router-view>
            </div>
        </div>
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
