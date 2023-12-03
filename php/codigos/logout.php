<?php

/**
 * @file logout.php
 * 
 * @brief Este documento permite cerrar la sesión del usuario. Esto lo redirige a la página html de la principal
 * 
 * @author Diego Bravo Pérez y Javier Lachica Sánchez
 * 
 * @date Fecha de creación: 3 de Diciembre del 2023
 * 
 * @date Última actualización: 3 de Diciembre del 2023
 */

 session_start(); //es importante poner esto a esar de que la sesión ya se haya iniciado

 session_destroy(); //cierra sesión

 header("Location: ../../html/Paginas/mainMenu.html"); //regresa a la página de iniciar sesión
 exit;