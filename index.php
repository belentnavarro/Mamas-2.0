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
        <link rel="stylesheet" href="Css/mdb.min.css">

        <!-- App CSS -->
        <link rel="stylesheet" href="Css/app.css">

        <!-- Font -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700;900&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;400;700;900&display=swap" rel="stylesheet">

        <!--Favicon-->
        <link rel="icon" type="image/png" href="Img/logo/favicon-birrete.png">

        <title>Inicio</title>

        <script src='https://www.google.com/recaptcha/api.js?render=6LchkOQZAAAAAJMQMvfYZ9WpQ6U0qdddvzAUgv_d'></script>

        <script>
            grecaptcha.ready(function () {
                grecaptcha.execute('6LchkOQZAAAAAJMQMvfYZ9WpQ6U0qdddvzAUgv_d', {action: 'login'})
                        .then(function (token) {
                            document.getElementById('recaptchaResponse').value = token;
                        });
            });
        </script>
    </head>
    <body>
        <?php
        session_start();
        ?>

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
                            <!-- Forumulario -->
                            <form name="login" class="text-center p-5 needs-validation" action="Controller/controller_access.php" method="POST" novalidate>

                                <p class="h4 mb-4">Iniciar sesión</p>

                                <!-- Correo -->
                                <input type="email" class="form-control mb-1 campo" placeholder="E-mail" name="email" id="email" required aria-describedby="emailError"
                                       minlength="5" maxlength="40" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*">
                                <div class="invalid-feedback text-left" id="emailError">
                                    Mensaje de error
                                </div>
                                <!-- Password -->
                                <input type="password" class="form-control mb-1 mt-4 campo" placeholder="Password" name="password" id="password" required aria-describedby="emailPassword"
                                       minlength="8" maxlength="10" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}">
                                <div class="invalid-feedback mb-4 text-left"  id="passwordError">
                                    Mensaje de error
                                </div>

                                <!-- Inicio de sesion -->
                                <button class="btn btn--g-medium btn-block my-4" type="submit" name="login" value="login">Iniciar sesion</button>

                                <input type="hidden" name="recaptchaResponse" id="recaptchaResponse"/>
                                <?php
                                if (isset($_SESSION['mensaje-captcha'])) {
                                    ?>
                                    <span class="text-left text--g-dark"><?php echo $_SESSION['mensaje-captcha']; ?></span>
                                    <?php
                                    unset($_SESSION['mensaje-captcha']);
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <!-- Enlaces para recuperar la contraseña y crear nueva cuenta -->
                        <div class="col-6">
                            <a href="View/recuperar_password.php" class="text--o-light"><small>¿Se te olvidó tu contraseña?</small></a>
                        </div>
                        <div class="col-6 text-right">
                            <a href="View/registro.php" class="text--o-light"><small>Crear una nueva cuenta</small></a>
                        </div>
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
        <script type="text/javascript" src="Js/app.js"></script>
        <script type="text/javascript" src="Js/validationLogin.js"></script>
    </body>
</html>