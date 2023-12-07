<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: rgb(234, 241, 248);
            font-family: 'Roboto', sans-serif;
        }

        .container {
            width: 500px;
            background: white;
            padding: 20px;
            padding-top: 40px;
            margin: auto;
            margin-top: 100px;
        }

        h2 {
            text-align: center;
            color: rgb(20, 44, 66);
            font-size: 25px;
            margin-bottom: 28px;
        }

        .form__control {
            width: 100%;
            display: flex;
            flex-direction: column;
            margin-bottom: 25px;
        }

        label {
            margin-bottom: 8px;
            color: rgb(58, 58, 58);
            font-size: 16px;
        }

        input {
            padding: 15px;
            border: none;
            background: rgb(235, 241, 241);
            outline: none;
            border-radius: 5px;
        }

        button {
            background: rgb(2, 132, 192);
            padding: 17px;
            outline: none;
            border: none;
            color: white;
            font-size: 17px;
            cursor: pointer;
            font-weight: 600;
        }

        button:hover {
            background: rgb(1, 113, 165);
        }

        .error {
            padding: 5px;
            color: rgb(194, 88, 88);
            font-weight: 600;
        }

        .mensaje {
            background: rgb(221, 78, 53);
            padding: 10px;
            color: rgb(255, 255, 255);
        }

        .success {
            background: rgb(28, 129, 45);
            padding: 10px;
            color: rgb(255, 255, 255);
        }

        a {
            font-style: italic;
            display: block;
            text-align: center;
            margin: auto;
            color: rgb(8, 28, 41);
            font-size: 15px;
        }

        @media screen and (max-width: 510px) {
            .container {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="{{route('reset.clave')}}" method="post">
            @csrf
            <input type="hidden" value="{{$correo}}" name="correo">
            <h2>Recuperar contraseña</h2>
            <div class="form__control">
                @if (session("mensaje"))
                <small class="mensaje">{{session('mensaje')}}</small>
                @endif
                @if (session("correcto"))
                <small class="success">{{session('correcto')}}</small>
                @endif
                @if (session("incorrecto"))
                <small class="mensaje">{{session('incorrecto')}}</small>
                @endif
            </div>
            @error('correo')
            <small class="error">{{$message}}</small>
            @enderror
            <div class="form__control">
                <label for="">Nueva contraseña</label>
                <input type="password" name="clave1">
                @error('clave1')
                <small class="error">{{$message}}</small>
                @enderror
            </div>
            <div class="form__control">
                <label for="">Repetir nueva contraseña</label>
                <input type="password" name="clave2">
                @error('clave2')
                <small class="error">{{$message}}</small>
                @enderror
            </div>
            <div class="form__control">
                <button type="submit">Recuperar</button>
            </div>
            <a href="login">Iniciar Sesion</a>
        </form>
    </div>
</body>

</html>