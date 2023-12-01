<?php

/**
 * @file registrar.php
 * 
 * @brief Este archivo permite al usuario poder registrarse en la página de los presidentes
 *        El archivo permite que los datos se guarden en la base de datos y salta warnings si los datos están mal 
 * 
 * @author Diego Bravo Pérez y Javier Lachica y Sánchez
 * 
 * @date Fecha de creación del archivo: 30 de Noviembre del 2023
 * 
 * @date Última Actualización: 30 de Noviembre del 2023
 * 
 */

    require_once "HTML/Template/ITX.php";

    // ----- valida los datos para ver si son correctos antes de hacer algo con ellos ----

    if(strlen($_POST["usuario"]) > 25) //verifica si el usuario es del tamaño adecuado
    {
        die("El usuario no debe de pasar de los 25 caracteres");
    }

    if(strlen($_POST["correo"]) > 20) //verifica si el correo es del tamaño adecuado
    {
        die("El correo no debe de pasar de los 20 caracteres");
    }

    if(! filter_var($_POST["correo"], FILTER_VALIDATE_EMAIL)) // verifica el email
    {
        die("Ingresa un email válido");
    }

    if((strlen($_POST["contrasenia"]) < 10) || (strlen($_POST["contrasenia"]) > 10)) //verifica si la contraseña es del tamaño adecuado
    {
        die("La contraseña debe de tener 10 caracteres al menos");
    }

    if(! preg_match("/[a-z]/i", $_POST["contrasenia"])) // valida si tiene una letra
    {
        die("La contraseña debe de tener una letra al menos");
    }

    if(! preg_match("/[0-9]/", $_POST["contrasenia"])) // valida si tiene un número
    {
        die("La contraseña debe de tener un número al menos");
    }

    if($_POST["contrasenia"] != $_POST["confirmar-contrasenia"])
    {
        die("La contraseña debe de coincidir");
    }

    $contrasenia_hash = password_hash($_POST["contrasenia"], PASSWORD_DEFAULT); //vuelve la contraseña un hash por cuestiones de seguridad

     //conexión con la base de datos

    $link = require __DIR__ . "/connect.php";

    /*

    $query = "INSERT INTO proy_usuarios (nombre, correo, clave_hash) VALUES (?, ?, ?)"; //insersión de datos

    $stmt = $link->stmt_init(); 

    if (! $stmt->prepare($query) ){
        die("SQL error: " . $link->error);
    }

    */

    print_r($_POST);

    var_dump($contrasenia_hash);

?>