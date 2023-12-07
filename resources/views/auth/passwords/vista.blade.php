<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            font-family: "Roboto", sans-serif;
        }

        .container2 {
            width: 80%;
            margin: auto;
            background: rgb(255, 255, 255);
            padding: 20px;
        }

        p {
            background: rgb(250, 250, 250);
            padding: 20px;
            color: rgb(110, 110, 110);
            font-size: 17px;
            line-height: 27px;
            margin: 25px 0px;
        }

        a.link {
            background: rgb(0, 138, 218);
            padding: 15px 40px;
            border-radius: 7px;
            color: white;
            text-decoration: none;
        }

        .div {
            text-align: center;
        }

        h1 {
            color: rgb(9, 29, 43);
        }
    </style>
</head>

<body>
    <div style="background: #CACACA;width: 100%;margin: auto; padding: 13px;border-radius: 5px">

        <div class="container2">
            <h1 style="text-align: center; font-family: monospace;font-size: 35px">
                RESTABLECER CONTRASEÑA
            </h1>
            <p>Hola, hemos recibido una solicitud para cambiar tu contraseña. Para restablecerla, haz
                click en el siguiente botón:</p>
            <div class="div">
                <a class="link" href="{{route('nuevo.clave',$correo['correo'])}}">Cambia tu contraseña</a>
            </div>
            <p>¿No fuiste tú? Ignora este mensaje y sigue disfrutando de tu experiencia.</p>
        </div>
    </div>
</body>

</html>