<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Buscador Autocompletar</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.12.1/jquery-ui.min.css')}}">
    <style>
        .filtro {
            background-color: #F0F0F1;
        }

        .filtro .nav-item>a {
            background-color: #fff;
            margin-right: 10px;
            color: #636b6f;
        }

        .filtro i {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="display-4">Buscadores con Autocompletar</h1>
        <h3 class="m-5">En una petición a una url que devuelve un JSON</h3>
        <form action="#" autocomplete="off">
            <div class="input-group">
                <input type="text" class="form-control" id="search" placeholder="Buscamos en https://jsonplaceholder.typicode.com/comments">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button">Buscar</button>
                </div>

            </div>
        </form>
        <h3 class="m-5">En una petición a una Base de Datos en Laravel</h3>
        <form action="#" autocomplete="off">
            <div class="input-group">
                <input type="text" class="form-control" id="search-2" placeholder="Buscamos en la base de datos en la tabla cursos">
                <div class="input-group-append">
                    <button class="btn btn-danger" type="button">Buscar</button>
                </div>

            </div>
        </form>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{asset('vendor/jquery/jquery-3.6.0.min.js')}}"></script>
    </div>
    <script src="{{asset('vendor/jquery-ui-1.12.1/jquery-ui.min.js')}}"></script>
    <script>
        //var cursos = ['html', 'css', 'javascript', 'php', 'laravel'];
        //Buscador en  https://jsonplaceholder.typicode.com/comments
        $('#search').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "https://jsonplaceholder.typicode.com/comments",
                    dataType: 'json',
                    success: function(listaElementos) {
                        data = [];
                        if (listaElementos.length == 0) return false;
                        listaElementos.forEach(item => {

                            if (item.name.substr(0, search.value.length) == search.value) {
                                data.push(item.name);
                            }
                        });

                        response(data);
                    }
                });
            }
        });

        //Buscador en la base de datos Laravel en la tabla cursos
        $('#search-2').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{route('search.cursos')}}",
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            }
        });
    </script>

</body>

</html>