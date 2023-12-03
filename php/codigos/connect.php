<?php

/**
 * @file connect.php
 * 
 * @brief Este archivo permite la conección e interacción de la base de datos y la página web de manera dinámica para cualquier
 *        archivo de php que lo ocupe
 * 
 * @author Diego Bravo Pérez y Javier Lachica y Sánchez
 * 
 * @date fecha de creación: 30 de noviembre del 2023
 * 
 * @date última actualización: 2 de Diciembre del 2023
 */

/**
 * configuración del servidor
 */

 $cfgServer['host'] = 'localhost';
 $cfgServer['user'] = 'msc22dbp';
 $cfgServer['password'] = '227019';
 $cfgServer['dbname'] = 'msc22dbp';

 /**
  * Se conecta al servidor
  */

 $link = mysqli_connect($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or die('Could not connect: ' . mysqli_error($link));

 mysqli_select_db($link, $cfgServer['dbname']) or die("Could not select database"); //valida que no haya errores en la base de datos

 return $link; //retorna link para que pueda operar en otros documentos de php

?>