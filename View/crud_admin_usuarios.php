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

        <title>Administrar usuarios</title>
    </head>
    <body>
        <?php
        //Includes
        require_once '../Model/PersonDAO.php';
        require_once '../Model/Person.php';

        // Inicio sesión
        session_start();

        // Recupero el rol del usuario
        $userRol = $_SESSION['userRol'];
        $userEmail = $_SESSION['userEmail'];

        //Recupero los datos del usuario
        $datJSON = PersonDAO::getPersonJSON($userEmail);

        // Decodifico el JSON y saco el usuario del array
        $objs = json_decode($datJSON, true);
        $o = $objs[0];
        $usuario = new Person($o['dni'], $o['name'], $o['surname'], $o['email'], $o['password'], $o['profilePhoto'], $o['rol'], $o['active']);

        // Recupero todos los usuarios
        $datJSON = PersonDAO::getAllJSON();

        // Variable para guardar los usuarios
        $users = array();

        // Decodifico el JSON y saco los usuarios del array
        $objs = json_decode($datJSON, true);
        foreach ($objs as $o) {
            $users[] = new Person($o['dni'], $o['name'], $o['surname'], $o['email'], $o['password'], $o['profilePhoto'], $o['rol'], $o['active']);
        }
        ?>

        <div class="wrapper d-flex align-items-stretch">
            <nav id="sidebar" class="bg--o-dark text-white">
                <div class="p-4 pt-5">
                    <img src="../Img/img_profile_users/<?= $usuario->getProfilePhoto() ?>" alt="alt" class="profile logo rounded-circle mb-5" width="150"/>
                    <ul class="list-unstyled components mb-5">
                        <li class="border-bottom">
                            <a href="home.php">
                                <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                <use xlink:href="../Icons/bootstrap-icons.svg#house"/>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li class="border-bottom">
                            <a href="ver_perfil.php">
                                <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                <use xlink:href="../Icons/bootstrap-icons.svg#person"/>
                                </svg>
                                Mi perfil
                            </a>
                        </li>
                        <li class="border-bottom">
                            <a href="crud_admin_usuarios.php">
                                <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                <use xlink:href="../Icons/bootstrap-icons.svg#people"/>
                                </svg>
                                Usuarios
                            </a>
                        </li>
                        <li class="border-bottom">
                            <a href="#examSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                <use xlink:href="../Icons/bootstrap-icons.svg#journal-bookmark"/>
                                </svg>
                                Examenes
                            </a>
                            <ul class="collapse list-unstyled ml-4" id="examSubmenu">
                                <li>
                                    <a href="crud_exam.php">
                                        <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                        <use xlink:href="../Icons/bootstrap-icons.svg#journal-plus"/>
                                        </svg>
                                        Crear examen
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                        <use xlink:href="../Icons/bootstrap-icons.svg#journal-check"/>
                                        </svg>
                                        Corregir examen
                                    </a>
                                </li>
                                <li>
                                    <a href="crud_preguntas.php">
                                        <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                        <use xlink:href="../Icons/bootstrap-icons.svg#question-square"/>
                                        </svg>
                                        BDD Preguntas
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="border-bottom">
                            <a href="#studentSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                <use xlink:href="../Icons/bootstrap-icons.svg#file-earmark-text"/>
                                </svg>
                                Curso
                            </a>
                            <ul class="collapse list-unstyled ml-4" id="studentSubmenu">
                                <li>
                                    <a href="#">
                                        <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                        <use xlink:href="../Icons/bootstrap-icons.svg#file-earmark-plus"/>
                                        </svg>
                                        Realizar exámen
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                        <use xlink:href="../Icons/bootstrap-icons.svg#file-earmark-richtext"/>
                                        </svg>
                                        Exámenes activos
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                        <use xlink:href="../Icons/bootstrap-icons.svg#file-earmark-check"/>
                                        </svg>
                                        Examenes realizados
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg class="bi mr-2" width="20" height="20" fill="currentColor">
                                        <use xlink:href="../Icons/bootstrap-icons.svg#book"/>
                                        </svg>
                                        Notas
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="border-bottom">
                            <a href="../Controller/controller_home.php?cerrar=1">
                                <svg class="bi mr-2" width="22" height="22" fill="currentColor">
                                <use xlink:href="../Icons/bootstrap-icons.svg#arrow-right-circle"/>
                                </svg>
                                Cerrar sesión
                            </a>
                        </li>
                    </ul>

                    <div class="footer">
                        Footer
                    </div>

                </div>
            </nav>

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
                                <nav class="navbar navbar-expand-lg justify-content-between shadow-none">
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
                                <h1 class="display-2 text-white">Administrar usuarios</h1>
                                <p class="text-white mt-0">Está página te permitirá añadir, editar, eliminar o activar los usuarios de la aplicación</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Administrar usuarios -->
                <div class="container-fluid mt-4">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-11">
                            <div class="card mb-0 shadow">
                                <div class="card-header font-weight-bold text-white bg--o-light display-4 text-center">
                                    Crear un nuevo usuario
                                </div>
                                <div class="card-body">
                                    <div class="row border-bottom font-weight-bolder mb-4 pb-0">
                                        <div class="col">
                                            <p>DNI  </p>
                                        </div>
                                        <div class="col">
                                            <p>Nombre</p>
                                        </div>
                                        <div class="col">
                                            <p>Apellido</p>
                                        </div>
                                        <div class="col">
                                            <p>Correo</p>
                                        </div>
                                        <div class="col">
                                            <p>Contraseña</p>
                                        </div>
                                        <div class="col">
                                            <p>Rol</p>
                                        </div>
                                        <div class="col-3 text-center">
                                            <p>Acciones</p>
                                        </div>
                                    </div>

                                    <form action="../Controller/controller_crud_admin_usuarios.php" method="POST" name="add_user" class="needs-validation" novalidate>
                                        <div class="row align-items-center">
                                            <div class="col mb-2">
                                                <input type="text" id="dni-new-user" name="dni" class="form-control mb-1" placeholder="DNI" pattern="[0-9]{8}[A-Za-z]{1}" required aria-describedby="error"/>
                                            </div>
                                            <div class="col mb-2">
                                                <input type="text" id="name-new-user" name="name" class="form-control mb-1" placeholder="Nombre" minlength="3" maxlength="20" required aria-describedby="error"/>
                                            </div>
                                            <div class="col mb-2">
                                                <input type="text" id="surname-new-user" name="surname" class="form-control mb-1" placeholder="Apellido" minlength="3" maxlength="20" required aria-describedby="surnameError"/>
                                            </div>
                                            <div class="col mb-2">
                                                <input type="text" id="email-new-user" name="email" class="form-control mb-1" placeholder="Correo" 
                                                       pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*" minlength="5" maxlength="60" required aria-describedby="emailError"/>
                                            </div>
                                            <div class="col mb-2">
                                                <input type="text" id="password-new-user" name="password" class="form-control mb-1" placeholder="Contraseña" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}" minlength="8" maxlength="10" required aria-describedby="emailPassword"/>
                                            </div>
                                            <div class="col mb-2">
                                                <select class="custom-select" id="rol" name="rol" required>
                                                    <option value="usuario" selected>Alumno</option>
                                                    <option value="profesor">Profesor</option>
                                                    <option value="administrador">Administrador</option>
                                                </select>
                                            </div>
                                            <div class="col-3 mb-2">
                                                <button type="submit" class="btn btn--g-medium w-100 mt-0" name="add_user" value="add_user">
                                                    <svg class="bi" width="22" height="22" fill="currentColor">
                                                    <use xlink:href="../Icons/bootstrap-icons.svg#person-plus"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="invalid-feedback mb-4 text-left" id="error-new-user"></div>
                                            </div>
                                        </div>
                                        <?php
                                        if (isset($_SESSION['feedback-add-user'])) {
                                            ?>
                                            <div class="row align-items-center">
                                                <div class="invalid-feedback mb-4 text-left"  value="<?php echo $_SESSION['mensaje']; ?>"></div>
                                            </div>
                                            <?php
                                        }
                                        unset($_SESSION['feedback-add-user']);
                                        ?>
                                    </form>   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center mt-4">
                        <div class="col-11">
                            <div class="card mb-0 shadow">
                                <div class="card-header font-weight-bold text-white bg--o-light display-4 text-center">
                                    Gestor de usuarios
                                </div>
                                <div class="card-body">
                                    <?php
                                    if (isset($_SESSION['feedback-edit-user'])) {
                                        ?>
                                        <div class="row align-items-center">
                                            <div class="invalid-feedback mb-4 text-left"  value="<?php echo $_SESSION['feedback-edit-user']; ?>"></div>
                                        </div>
                                        <?php
                                    }
                                    unset($_SESSION['feedback-edit-user']);
                                    ?>
                                    <?php
                                    if (isset($_SESSION['feedback-active-user'])) {
                                        ?>
                                        <div class="row align-items-center">
                                            <div class="invalid-feedback mb-4 text-left"  value="<?php echo $_SESSION['feedback-active-user']; ?>"></div>
                                        </div>
                                        <?php
                                    }
                                    unset($_SESSION['feedback-active-user']);
                                    ?>
                                    <?php
                                    if (isset($_SESSION['feedback-delete-user'])) {
                                        ?>
                                        <div class="row align-items-center">
                                            <div class="invalid-feedback mb-4 text-left"  value="<?php echo $_SESSION['feedback-delete-user']; ?>"></div>
                                        </div>
                                        <?php
                                    }
                                    unset($_SESSION['feedback-delete-user']);
                                    ?>
                                    <div class="row border-bottom font-weight-bolder mb-4 pb-0">
                                        <div class="col">
                                            <p>DNI  </p>
                                        </div>
                                        <div class="col">
                                            <p>Nombre</p>
                                        </div>
                                        <div class="col">
                                            <p>Apellido</p>
                                        </div>
                                        <div class="col">
                                            <p>Correo</p>
                                        </div>
                                        <div class="col">
                                            <p>Contraseña</p>
                                        </div>
                                        <div class="col">
                                            <p>Rol</p>
                                        </div>
                                        <div class="col-3 text-center">
                                            <p>Acciones</p>
                                        </div>
                                    </div>

                                    <!-- Listar usuarios -->
                                    <section class="scrollbar">
                                        <?php
                                        foreach ($users as $user) {
                                            ?>
                                        <form action="../Controller/controller_crud_admin_usuarios.php" class="" method="POST" name="crud_admin_usuario" novalidate>
                                                <div class="row align-items-center">
                                                    <div class="col mb-2">
                                                        <input readonly type="text" id="dni" name="dni" class="form-control" value="<?php echo strtoupper($user->getDni()); ?>">
                                                    </div>
                                                    <div class="col mb-2">
                                                        <input type="text" id="name" name="name" class="form-control mb-1" value="<?php echo ucfirst($user->getName()); ?>" minlength="3" maxlength="20" required aria-describedby="nameError"/>
                                                        <div class="invalid-feedback mb-4 text-left"  id="nameError"></div>
                                                    </div>
                                                    <div class="col mb-2">
                                                        <input type="text" id="surname" name="surname" class="form-control mb-1" value="<?php echo ucfirst($user->getSurname()); ?>" minlength="3" maxlength="20" required aria-describedby="surnameError"/>
                                                        <div class="invalid-feedback mb-4 text-left"  id="surnameError"></div>
                                                    </div>
                                                    <div class="col mb-2">
                                                        <input type="text" id="email" name="email" class="form-control mb-1" value="<?php echo $user->getEmail(); ?>" 
                                                               pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*" minlength="5" maxlength="60" required aria-describedby="emailError"/>
                                                        <div class="invalid-feedback text-left" id="emailError"></div>
                                                    </div>
                                                    <div class="col mb-2">
                                                        <input type="text" id="password" name="password" class="form-control mb-1" value="<?php echo $user->getPassword(); ?>" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}" minlength="8" maxlength="10" required aria-describedby="emailPassword"/>
                                                        <div class="invalid-feedback mb-4 text-left"  id="passwordError"></div>
                                                    </div>
                                                    <div class="col mb-2">
                                                        <select class="custom-select" id="rol" name="rol" required>
                                                            <?php
                                                            if ($user->getRol() == 0) {
                                                                ?>
                                                                <option value="usuario" selected>Alumno</option>
                                                                <option value="profesor">Profesor</option>
                                                                <option value="administrador">Administrador</option>
                                                                <?php
                                                            } else if ($user->getRol() == 1) {
                                                                ?>
                                                                <option value="usuario">Alumno</option>
                                                                <option value="profesor" selected>Profesor</option>
                                                                <option value="administrador">Administrador</option>
                                                                <?php
                                                            } else if ($user->getRol() == 2) {
                                                                ?>
                                                                ?>
                                                                <option value="usuario" selected>Alumno</option>
                                                                <option value="profesor">Profesor</option>
                                                                <option value="administrador" selected>Administrador</option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div> 
                                                    <div class="col-lg-3 col-md-3 col-sm mb-2 align-items-center">
                                                        <?php
                                                        if ($user->getActive() == 0) {
                                                            ?>
                                                            <button type="submit" class="btn btn--g-medium flex-grow-1" name="active_user" value="active_user">
                                                                <svg class="bi" width="22" height="22" fill="currentColor">
                                                                <use xlink:href="../Icons/bootstrap-icons.svg#person-check-fill"/>
                                                                </svg>
                                                            </button>
                                                            <?php
                                                        } else if ($user->getActive() == 1) {
                                                            ?>
                                                            <button type="submit" class="btn btn--g-medium flex-grow-1" name="active_user" value="inactive_user">
                                                                <svg class="bi" width="22" height="22" fill="currentColor">
                                                                <use xlink:href="../Icons/bootstrap-icons.svg#person-dash-fill"/>
                                                                </svg>
                                                            </button>
                                                            <?php
                                                        }
                                                        ?>
                                                        <button type="submit" class="btn btn-success flex-grow-1" name="edit_user" value="edit_user">
                                                            <svg class="bi" width="22" height="22" fill="currentColor">
                                                            <use xlink:href="../Icons/bootstrap-icons.svg#pencil-square"/>
                                                            </svg>
                                                        </button>
                                                        <button type="submit" class="btn btn-danger flex-grow-1" name="delete_user" value="delete_user">
                                                            <svg class="bi" width="22" height="22" fill="currentColor">
                                                            <use xlink:href="../Icons/bootstrap-icons.svg#person-x"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <?php
                                        }
                                        ?>
                                    </section>    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 mb-5">
                        <div class="col-6">
                            <svg class="bi" width="20" height="20" fill="currentColor">
                            <use xlink:href="../Icons/bootstrap-icons.svg#arrow-left-short"/>
                            </svg>
                            <a href="home.php" class="text--o-dark"><small>Volver al inicio</small></a>
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
        <script type="text/javascript" src="../Js/validationCrudUsuarios.js"></script>
    </body>
</html>



