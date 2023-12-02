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
 * @date Última Actualización: 1 de Diciembre del 2023
 * 
 */

    // ----- valida los datos para ver si son correctos antes de hacer algo con ellos ----

    if(strlen($_POST["usuario"]) > 25) //verifica si el usuario es del tamaño adecuado
    {
        die("El usuario no debe de pasar de los 25 caracteres");
    }

    if(strlen($_POST["correo"]) > 255) //verifica si el correo es del tamaño adecuado
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

    $query = "INSERT INTO proy_usuarios (nombre, correo, clave_hash) VALUES (?, ?, ?)"; //Se elabora el query

    $stmt = $link->stmt_init(); //se prepara para realizar la insersión evaluando si el query está bien

    if (! $stmt->prepare($query) ){
        die("SQL error: " . $link->error);
    }

    $stmt->bind_param("sss", $_POST["usuario"], $_POST["correo"], $contrasenia_hash); //toma los datos ingresados por el usuario

    if($stmt->execute()) // Valida si los datos que va a insertar no están repetidos vía la unisidad del correo
    {
        header("Location: ../../html/SubPaginas_html/registroExitoso.html");
    }
    else
    {

        if($stmt->errno === 1062)  // Valida si el correo es el problema
        {
            die("El email o el usuario ingresado ya está registrado.");
        } 
        else 
        {
            die($link->error . " " . $link->errno);  //el error es otro si el correo no es el problema
        }
    }

    // Cerramos la conexion
	@mysqli_close($link);

    exit;
?>