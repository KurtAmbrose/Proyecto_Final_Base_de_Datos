<?php
/**
 * @file mostrarPresidentes.php
 * 
 * @brief Este documento carga los templates respectivos y muestra el presidente seleccionado
 * 
 * @author Diego Bravo Pérez y Javier Lachica Sánchez
 * 
 * @date Fecha de elaboración: 5 de Diciembre del 2023
 * 
 * @date Última Actualización: 5 de Diciembre del 2023
 */

require_once "HTML/Template/ITX.php";

// Recupera el valor de textoEnlace desde la URL
$textoEnlace = isset($_GET['textoEnlace']) ? urldecode($_GET['textoEnlace']) : '';

// Ahora puedes utilizar $textoEnlace en tu lógica PHP
echo "Texto del Enlace: " . $textoEnlace;

?>