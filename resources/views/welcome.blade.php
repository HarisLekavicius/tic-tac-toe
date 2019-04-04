<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Tic-Tac-Toe</title>

        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

    </head>
    <body>
        <div id="app">
            <current-player></current-player>
            <clear-button></clear-button>
            <tic-tac-toe-table></tic-tac-toe-table>
            <game-log></game-log>
        </div>
    </body>
</html>
<script src="{{ mix('js/app.js') }}"></script>

<!-- <script src="https://unpkg.com/vuex@2.0.0"></script> -->
<!-- <script src="{{ asset('js/app.js') }}" -->
