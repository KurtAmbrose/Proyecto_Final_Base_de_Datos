<?php

/**
 * @file mostrarPresidentes.php
 * 
 * @brief Este documento carga los templates respectivos y muestar todos los presidentes registrados
 * 
 * @author Diego Bravo Pérez y Javier Lachica Sánchez
 * 
 * @date Fecha de elaboración: 4 de Diciembre del 2023
 * 
 * @date Última Actualización: 5 de Diciembre del 2023
 */
	require_once "HTML/Template/ITX.php";
	
	// ========================================================================
	//
	// 	Cargamos el template principal
	// 
	// ========================================================================

	$template = new HTML_Template_ITX("../../html/templates");

	$template->loadTemplatefile("mostrarTodos.html", true, true);

	// Nos conectamos a la base de datos
	$link = require __DIR__ . "/connect.php";
	
	$query = "SELECT CONCAT(nombre, ' ', ap_paterno, ' ', ap_materno) AS nombre, imagen FROM proy_presidentes";

	// ========================================================================
	//
	// 	Cargamos el template de la tabla con los presidentes
	// 
	// ========================================================================	
	
	$template->addBlockfile("CONTENIDO", "TABLA", "bloquePresidente.html");
	$template->setCurrentBlock("TABLA");
	
	// Ejecutamos el query
	$result = mysqli_query($link, $query) or die("Query 1 failed");
						
	while($line = mysqli_fetch_assoc($result)){
		
			// Fijamos el bloque con la informacion de cada presidente
			$template->setCurrentBlock("PRESIDENTE");
			
			// Desplegamos la informacion de cada presidentes
			$template->setVariable("NOMBRE", $line['nombre']);
			
			$template->parseCurrentBlock("PRESIDENTE");
		}// while
		
		
	$template->parseCurrentBlock("PRESIDENTES");
	// Liberamos memoria
	mysqli_free_result($result);	
	
	// Cerramos la conexion
	@mysqli_close($link);

    // Mostramos la pagina con los templates que llenamos
	$template->show();

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>