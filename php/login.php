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
 * @date Última actualización: 1 de Diciembre del 2023
 */

 require_once "HTML/Template/ITX.php";

 $es_invalido = false; //validación de la contraseña

 if ($_SERVER["REQUEST_METHOD"] === "POST") //verifica si se posteó la forma    
 {

    // verifica si se ingreso un correo o un usuario

    if(! filter_var($_POST["dato1"], FILTER_VALIDATE_EMAIL))
    {
        $mysqli = require __DIR__ . "/connect.php";         // Se conecta a la base de datos

        //Obitene el query y verifica si no hay algún mysql inyection

        $query = sprintf("SELECT * FROM proy_usuarios WHERE nombre = '%s'", $mysqli->real_escape_string($_POST["dato1"]));

        $res = $mysqli->query($query); // obtiene el resultado del query

        $row = $res->fetch_assoc(); // almacena el resultado en una variable $row

        if($row) // validación si el row tiene datos diferentes de NULL
        {
            if(password_verify($_POST["contrasenia"], $row["clave_hash"])) //Validación si la contraseña es correcta
            {
                die("Ingresaste con éxito");
            }
        }

        $es_invalido = true;

    }

    else
    {

        $mysqli = require __DIR__ . "/connect.php";         // Se conecta a la base de datos

        //Obitene el query y verifica si no hay algún mysql inyection

        $query = sprintf("SELECT * FROM proy_usuarios WHERE correo = '%s'", $mysqli->real_escape_string($_POST["dato1"]));

        $res = $mysqli->query($query); // obtiene el resultado del query

        $row = $res->fetch_assoc(); // almacena el resultado en una variable $row

        if($row) // validación si el row tiene datos diferentes de NULL
        {
            if(password_verify($_POST["contrasenia"], $row["clave_hash"])) //Validación si la contraseña es correcta
            {
                die("Ingresaste con éxito");
            }
        }
        
    }

    // Cerramos la conexion
    @mysqli_close($link);

    
    exit;

 }

?>