<?php

/**
 * @file login.php
 * 
 * @brief Este archivo permite al usuario iniciar sesión verificando si los datos ingresados pertenecen a la base de datos
 * 
 * @author Elaborado por DIego Bravo Pérez y Javier Lachica Sánchez
 * 
 * @date Elaborado el día 30 de Noviembre del 2023
 * 
 * @date Última actualización: 30 de Noviembre del 2023
 */

 require_once "HTML/Template/ITX.php";

 // Se obtienen los datos ingresados en la página de iniciar sesión

 if ($_SERVER["REQUEST_METHOD"] === "POST")
 {
    if(filter_var($_POST["dato1"], FILTER_VALIDATE_EMAIL))
    {
        $link = require __DIR__ ."/connect.php"; //Se conecta a la base de datos

        $query = sprintf("SELECT * FROM proy_usuarios WHERE correo = '%s'", $link->real_escape_string($_POST["dato1"]));  // Se realiza el query imprimiento este en una variable. real_escape_string sirve para evitar la inyección de código en el email

        $result = mysqli_query($link, $query); //obtiene el resultado del query

        $usario = $result->fetch_assoc(); //busca un dato asociado a uno de los datos insertados en la página de iniciar sesión
        
        var_dump($usuario);

        @mysqli_close($link); //sale de la base de datos   
    }

    else
    {
        die("ingresa un correo");
    }
 }

 else
 {
    die("este...no sé");
 }

?>