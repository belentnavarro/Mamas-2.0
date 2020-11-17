<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!doctype html>
<html lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="Css/bootstrap.min.css">

        <!-- Material Design Bootstrap -->
        <link rel="stylesheet" href="css/mdb.min.css">

        <!-- App CSS -->
        <link rel="stylesheet" href="Css/app.css">

        <!-- Font -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700;900&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;400;700;900&display=swap" rel="stylesheet">

        <title>Inicio</title>
    </head>
    <body>


        <!-- Cabecera -->
        <div class="container header-body text-center my-5">
            <div class="row justify-content-center">
                <div class="col-7 px-5">
                    <h1 class="display-3 font-weight-bolder text--o-dark">mamas 2.0</h1>
                </div>
            </div>
        </div>

        <!-- Login -->
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-7">
                    <div class="card mb-0 shadow">
                        <!-- Cabecera con el logo -->
                        <div class="card-header bg--g-medium text-center">
                            <img src="Img/logo/birrete_1.png" alt="logo">
                        </div>
                        <div class="card-body">
                            <form action="controller/controlador.php" method="" name="login">
                                <!-- Campo del correo -->
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <svg class="bi" width="20" height="20" fill="currentColor">
                                                <use xlink:href="Icons/bootstrap-icons.svg#envelope"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <input type="text" name="correo" class="form-control" placeholder="Correo">
                                    </div>
                                </div>
                                <!-- Campo del password -->
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <svg class="bi" width="20" height="20" fill="currentColor">
                                                <use xlink:href="Icons/bootstrap-icons.svg#lock"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <input type="text" name="password" class="form-control" placeholder="Contraseña">
                                    </div>
                                </div>
                                <!-- Boton para iniciar sesion -->
                                <input type="submit" class="btn btn--g-medium w-100" name="login_entrar" value="Iniciar sesion"/>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <!-- Enlaces para recuperar la contraseña y crear nueva cuenta -->
                        <div class="col-6">
                            <a href="vistas/recuperar_pass.php" class="text--o-light"><small>¿Se te olvidó tu contraseña?</small></a>
                        </div>
                        <div class="col-6 text-right">
                            <a href="vistas/registro.php" class="text--o-light"><small>Crear una nueva cuenta</small></a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- jQuery -->
            <script type="text/javascript" src="Js/jquery.min.js"></script>

            <!-- Bootstrap tooltips -->
            <script type="text/javascript" src="Js/popper.min.js"></script>

            <!-- Bootstrap core JavaScript -->
            <script type="text/javascript" src="Js/bootstrap.min.js"></script>

            <!-- MDB core JavaScript -->
            <script type="text/javascript" src="Js/mdb.min.js"></script>

            <!-- APP JS -->
            <script type="text/javascript" <script src="Js/app.js"></script></script>
</body>
</html>