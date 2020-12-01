<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../Css/bootstrap.min.css">

        <!-- Material Design Bootstrap -->
        <link rel="stylesheet" href="../Css/mdb.min.css">

        <!-- App CSS -->
        <link rel="stylesheet" href="../Css/app.css">
        <link rel="stylesheet" href="../Css/style.css">


        <!-- Font -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700;900&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;400;700;900&display=swap" rel="stylesheet">

        <!--Favicon-->
        <link rel="icon" type="image/png" href="../Img/logo/favicon-birrete.png">

        <title>Mamas 2.0</title>
    </head>
    <body>
        <?php
        //Includes
        require_once '../Model/PersonDAO.php';
        require_once '../Model/Person.php';

        // Inicio sesión
        session_start();

        // Recupero datos de la sesion
        $userEmail = $_SESSION['userEmail'];
        $userRol = $_SESSION['userRol'];

        //Recupero los datos del usuario
        $datJSON = PersonDAO::getPersonJSON($userEmail);

        // Decodifico el JSON y saco el usuario del array
        $objs = json_decode($datJSON, true);
        $o = $objs[0];
        $usuario = new Person($o['dni'], $o['name'], $o['surname'], $o['email'], $o['password'], $o['profilePhoto'], $o['rol'], $o['active']);
        ?>

        <div class="wrapper d-flex align-items-stretch">
            
            <!-- Sidebar -->
            <?php include("../Includes/sidebar.php"); ?>

            <!-- Contenido página  -->
            <div id="content">

                <!-- Header contenido-->
                <div class="header-home d-flex align-items-center position-relative pt-4">
                    <!-- Mask -->
                    <span class="mask bg-gradient-default opacity-8"></span>
                    <!-- Header container -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <nav class="navbar navbar-expand-lg justify-content-between shadow-none p-0">
                                    <button type="button" id="sidebarCollapse" class="btn btn--g-medium py-1 px-2">
                                        <svg class="bi" width="30" height="30" fill="currentColor">
                                        <use xlink:href="../Icons/bootstrap-icons.svg#list"/>
                                        </svg>
                                    </button>
                                    <h1 class="text-white font-weight-bolder bg--o-light px-1 rounded">mamas 2.0</h1>
                                </nav>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h1 class="display-2 text-white">Perfil de <?= ucfirst($usuario->getName()) ?>!!</h1>
                                <p class="text-white mt-0">Desde aquí podrás modificar tu perfil de una forma sencilla.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Perfil -->
                <div class="container-fluid mt-4">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-8 col-md-10">
                            <div class="card mb-0 shadow">
                                <div class="card-header bg--o-light text-center">
                                    <h2 class="text-white font-weight-bolder">Editar perfil</h2>
                                </div>
                                <div class="card-body">
                                    <form name="registro" class="text-center p-5 needs-validation" action="../Controller/controller_user.php" method="POST" enctype="multipart/form-data" novalidate>

                                        <div>
                                            <img src="../Img/img_profile_users/<?= $usuario->getProfilePhoto() ?>" alt="alt" class="profile logo rounded-circle mb-5" id="imgProfileU" width="150"/>
                                        </div>

                                        <!-- DNI -->
                                        <input type="text" class="form-control mb-1" name="dni" value="<?= $usuario->getDni() ?>" disabled>

                                        <!-- Correo -->
                                        <input type="email" class="form-control mb-1 mt-4 campo" placeholder="E-mail" name="email" id="email" required aria-describedby="emailError"
                                               minlength="5" maxlength="60" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*"
                                               value="<?= $usuario->getEmail() ?>">
                                        <div class="invalid-feedback text-left" id="emailError">
                                        </div>

                                        <!-- Password -->
                                        <input type="password" class="form-control mb-1 mt-4 campo" placeholder="Nueva contraseña" name="passwordNew" id="password" aria-describedby="emailPassword"
                                               minlength="8" maxlength="10" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}"
                                               value="">
                                        <div class="invalid-feedback mb-4 text-left"  id="passwordError">
                                        </div>

                                        <!-- Nombre -->
                                        <input type="text" class="form-control mb-1 mt-4" placeholder="Nombre" name="name" id="name" required aria-describedby="nameError"
                                               minlength="3" maxlength="20" pattern="[A-Z]{1}[a-z]+"
                                               value="<?= ucfirst($usuario->getName()) ?>">
                                        <div class="invalid-feedback mb-4 text-left"  id="nameError">
                                        </div>

                                        <!-- Apellido -->
                                        <input type="text" class="form-control mb-1 mt-4" placeholder="Apellido" name="surname" id="surname" required aria-describedby="surnameError"
                                               minlength="3" maxlength="20" pattern="[A-Z]{1}[a-z]+"
                                               value="<?= ucfirst($usuario->getSurname()) ?>">
                                        <div class="invalid-feedback mb-4 text-left"  id="surnameError">
                                        </div>

                                        <!-- Imagen de perfil -->
                                        <input type="file" class="form-control-file mt-4" name="profile_img" accept="image/png, image/jpeg" id="profileImg" onchange="previewImg(event)">
                                        <div class="invalid-feedback mb-4 text-left"  id="profileImgError">
                                        </div>

                                        <!-- Botón de registroi -->
                                        <button class="btn btn--g-medium btn-block my-4" type="submit" name="update_profile" value="update_profile">Modificar perfil</button>
                                    </form>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-6">
                                    <svg class="bi" width="20" height="20" fill="currentColor">
                                    <use xlink:href="../Icons/bootstrap-icons.svg#arrow-left-short"/>
                                    </svg>
                                    <a href="tareas.php" class="text--o-light"><small>Volver al inicio</small></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script type="text/javascript" src="../Js/jquery.min.js"></script>

        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="../Js/popper.min.js"></script>

        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="../Js/bootstrap.min.js"></script>

        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="../Js/mdb.min.js"></script>

        <!-- APP JS -->
        <script type="text/javascript" src="../Js/app.js"></script>
        <script type="text/javascript" src="../Js/validationUpdateProfile.js"></script>
    </body>
</html>


