<nav id="sidebar" class="bg--o-dark text-white">
    <div class="p-4 pt-5">
        <img src="../Img/img_profile_users/<?= $usuario->getProfilePhoto() ?>" alt="alt"class="profile logo rounded-circle mb-5" width="150"/>
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
                        <a href="crud_create_exam.php">
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
                        <a href="crud_create_exam.php">
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