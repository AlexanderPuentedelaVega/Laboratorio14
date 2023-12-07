<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: rgb(241, 249, 253);
            font-family: "Roboto", sans-serif;
        }

        .container {
            text-align: center;
            padding: 20px;
            padding-top: 48px;
        }

        .texto {
            color: rgb(17, 43, 73);
            font-size: 28px;
            font-weight: bold;
            font-family: "Roboto", sans-serif;
            padding: 20px;
        }

        .form {
            padding: 20px;
            width: 500px;
            margin: auto;
            background: white;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .form__text {
            color: rgb(11, 28, 48);
            font-size: 16px;
            font-family: "Roboto", sans-serif;
            font-weight: 500;
        }

        #correo {
            width: 100%;
            border: none;
            outline: none;
            padding: 20px;
            border: solid 2px rgb(234, 244, 253);
        }

        .form__button {
            display: flex;
            justify-content: space-between;
        }

        .button {
            border: none;
            outline: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .salir {
            background: rgb(212, 51, 51);
            color: white;
            text-decoration: none;
        }

        .enviar {
            background: rgb(1, 161, 1);
            color: white;
        }

        .salir:hover {
            background: rgb(189, 36, 36);
        }

        .enviar:hover {
            background: rgb(2, 136, 2);
        }

        .error {
            color: rgb(255, 255, 255);
            background: rgb(211, 78, 68);
            padding: 15px;
        }

        .success {
            color: rgb(255, 255, 255);
            background: rgb(34, 126, 42);
            padding: 15px;
        }

        @media screen and (max-width:545px) {
            .form {
                width: 100%;
            }
        }
    </style>
    
</head>

<body>


    <div class="container">
        <div class="texto">Restablecer Contraseña
        </div>

        <form action="{{route('recuperar.update')}}" method="POST">
            @csrf
            <div class="form">
                @error('correo')
                <label class="error">
                    {{$message}}
                </label>
                @enderror

                @if (session('mensaje'))
                <label class="success">
                    Se ha enviado un LINK a {{session('mensaje')}}
                </label>
                @endif

                <p class="form__text">Ingrese su correo con el que se ha registrado</p>
                <div class="form__input">
                    <input type="email" name="correo" id="correo" placeholder="Ingrese su correo">
                </div>

                <div class="form__button">
                    <a class="button salir" href="login">Salir</a>
                    <button class="button enviar" type="submit">Enviar link</button>
                </div>
            </div>
        </form>
    </div>

    

</body>

</html>