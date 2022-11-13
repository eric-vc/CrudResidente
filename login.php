<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesion</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <main>
        <div class="contenedor__todo">
            <div class="caja_trasera">
                <div class="caja_trasera_login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>inicia sesion para acceder a todas las funciones</p>
                    <button id='botonparainiciar'>iniciar Sesion</button>
                </div>
                <div class="caja_trasera_register">
                    <h3>¿Aun no tienes una cuenta?</h3>
                    <p>Registrate ahora</p>
                    <button id='botonparainiciar'>Register</button>
                </div>
            </div>

            <div class="contenedor_loginregister">

                <form action="" class="forumulario_login">
                    <h2>Iniciar Sesion</h2>
                    <input type="text" placeholder="Correo Electronico">
                    <input type="password" placeholder="Contraseña">
                    <button>Entrar</button>

                </form>

                <form action="" class="formulario_register">
                    <h2>Registrate</h2>
                    <input type="text" name="" id="" placeholder="Nombre Completo">
                    <input type="text" name="" id="" placeholder="Correo Electronico">
                    <input type="text" name="" id="" placeholder="Usuario">
                    <input type="password" placeholder="Contraseña">
                    <button>Registrarse</button>
                </form>
            </div>

        </div>
    </main>
    
</body>
</html>

<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        text-decoration: none;
    }

    body{
        background-image: url(https://ichef.bbci.co.uk/news/976/cpsprodpb/10B7B/production/_107157486_students8.jpg);
        background-position: center;
        background-color: rgba(0,0,0,.5);
        background-blend-mode: darken;
    }
</style>