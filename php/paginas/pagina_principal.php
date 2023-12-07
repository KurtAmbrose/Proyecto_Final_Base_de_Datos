<?php

/**
 * @file pagina_principal.php
 * 
 * @brief Este archivo se manda a llamar una vez se inicia la sesión con éxito. La página es una copia del html, sólo que este si interactúa con el usuario
 * 
 * @author Diego Bravo Pérez y Javier Lachica Sanchéz
 * 
 * @date Fecha de creación: 2 de Diciembre del 2023
 * 
 * @date Última actualización: 5 de Diciembre del 2023
 */

 session_start(); //inicia sesión con éxito

?>


<!DOCTYPE html>
<html lang="es-419">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Página principal de la app Web que se redirige una vez que se logra iniciar sesión con éxito.">
    <meta name="author" content="Diego Bravo Pérez y Javier Lachica y Sánchez">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="../../css/style.css" rel="stylesheet">
    <link rel="icon" href="https://png.pngtree.com/png-clipart/20221222/original/pngtree-flag-of-mexico-png-image_8797173.png" type="image/x-icon">
    <title>Proyecto final</title>
</head>
<body>

    <!-------- VALIDACIÓN SI SE INICIÓ SESIÓN ------->

    <?php

      if(!isset($_SESSION["user"])) //si no hay ningún usuario que inició sesión, redirige al archivo html de la página principal
      {
          header("Location: ../../html/Paginas/mainMenu.html");
          exit;
      }
    ?>

    <!--------Encabezado-------->

    <header>
        <nav id="encabezado" class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
            <div class="container-fluid">
                <div class="col-lg-4 col-md-3 col-sm-3 col-12 navbar-brand text-lg-start text-md-start text-sm-start text-center"><a id="principal" class="navbar-brand" href="#"><img id="gob-mexico" class="img-fluid" src="https://framework-gb.cdn.gob.mx/landing/img/logoheader.svg" alt="bandera-mexico"></a></div>
                <div class="col-sm-auto col-12 navbar-brand text-center text-info-emphasis">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                  </svg>
                  <span class="text-uppercase fw-bolder">¡Hola <?= htmlspecialchars($_SESSION["user"] ?? "") ?>!</span>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-3 col-12 navbar-brand text-lg-end text-md-end text-sm-end text-center"><img id="logo" class="img-fluid" src="https://www.logha.mx/wp-content/uploads/2022/05/universidad-iberoamericana-ibero-logo-vector-300x300.png" alt="logo-ibero"></div>
            </div>
        </nav>
    </header>

    <!--------Fin del Encabezado-------->

    <!--------Cuerpo-------->

    <div id="contenido-cuerpo" class="container-fluid">

        <!------Título------>

        <div id="palacio-nacional" class="row">
            <div id="logo-titulo" class="col-lg-12 col-md-12 col-sm-12 text-center img-fluid">
                <img id="bandera-mexico" class="img-fluid" src="https://png.pngtree.com/png-clipart/20221222/original/pngtree-flag-of-mexico-png-image_8797173.png" alt="bandera-mexico">
            </div>
            <div id="titulo" class="col-lg-12 col-md-12 col-sm-12 text-center">
                <p>Bienvenido a la página de <span>Presidentes de México</span>. ¡¡¡Conoce a todos los que gobernaron nuestro país!!!</p>
            </div>
        </div>

        <!------Fin del Título------>

        <!------Resto del cuerpo------>

        <div class="row text-center">
            <span class="label-opciones"> Ahora si <?= htmlspecialchars($_SESSION["user"] ?? "") ?>, ya puedes seleccionar cualquier opción</span>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <a href="../../php/codigos/mostrarPresidentes3.php">
                  <div class="opciones-tiles">
                    <img src="https://cdn-icons-png.flaticon.com/512/42/42446.png" alt="Calendario">
                    <span>Fecha de nacimiento</span>
                  </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <a href="../../php/codigos/mostrarPresidentes2.php">
                  <div class="opciones-tiles">
                    <img src="https://cdn-icons-png.flaticon.com/512/450/450016.png" alt="Ubicación">
                    <span>Estado de nacimiento</span>
                  </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-12 col-sm-12">
                <a href="../../php/codigos/mostrarPresidentes.php">
                  <div class="opciones-tiles">
                    <img src="https://cdn-icons-png.flaticon.com/512/2285/2285516.png" alt="Lista">
                    <span>Mostrar todos</span>
                  </div>
                </a>
            </div>
        </div>

        <!------Fin del Resto del cuerpo------>

    </div>

    <!--------Fin del Cuerpo-------->

    <!--------Pié de página-------->

    <footer class="bd-footer py-4 py-md-5 mt-5 bg-body-tertiary" data-bs-theme="dark">

        <div class="container py-4 py-md-5 px-4 px-md-3 text-body-secondary">
            <div class="row">

                <div class="col-lg-6 mb-3">
                    <a class="d-inline-flex align-items-center mb-2 text-body-emphasis text-decoration-none" href="/" aria-label="Bootstrap">
                      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="d-block me-2" viewBox="0 0 118 94" role="img"><title>Bootstrap</title><path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="currentColor"></path></svg>
                      <span class="fs-5">Bootstrap</span>
                    </a>
                    <ul class="list-unstyled small">
                      <li class="mb-2">Diseñado y creado <a href="https://antares.dci.uia.mx/msc22dbp/">Diego Bravo Pérez</a>, con la ayuda de <a href="https://antares.dci.uia.mx/icm22jls/">Javier Lachica y Sánchez</a>.</li>
                      <li class="mb-2">Powered by <a href="https://getbootstrap.com">Bootstrap</a>.</li>
                    </ul>
                </div>

                <div class="col-6 col-lg-3 offset-lg-2 mb-3">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                      <li class="mb-2"><a class="nav-link active" href="#">Home</a></li>
                      <li class="mb-2"><a href="../../php/codigos/mostrarPresidentes.php">Mostrar Presidentes</a></li>
                      <li class="mb-2"><a href="../codigos/logout.php">Cerrar sesión</a></li>
                      <li class="mb-2"><a class="nav-link disabled" aria-disabled="true" href="#">Olvidé mi contraseña</a></li>
                    </ul>
                </div>
            
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>