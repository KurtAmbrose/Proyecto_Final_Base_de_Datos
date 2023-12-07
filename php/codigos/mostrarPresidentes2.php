<?php

/**
 * @file mostrarPresidentes.php
 * 
 * @brief Este documento carga los templates respectivos y muestar todos los presidentes registrados
 * 
 * @author Diego Bravo Pérez y Javier Lachica Sánchez
 * 
 * @date Fecha de elaboración: 6 de Diciembre del 2023
 * 
 * @date Última Actualización: 7 de Diciembre del 2023
 */
	require_once "HTML/Template/ITX.php";

	session_start(); //inicia sesión con éxito

	if(!isset($_SESSION["user"])) //si no hay ningún usuario que inició sesión, redirige al archivo html de la página principal
      {
          header("Location: ../../html/Paginas/mainMenu.html");
          exit;
      }
	
	// ========================================================================
	//
	// 	Cargamos el template principal
	// 
	// ========================================================================

	$template = new HTML_Template_ITX("../../html/templates");

	$template->loadTemplatefile("mostrarPorEstado.html", true, true);

	
	// ========================================================================
	//
	// 	Cargamos el template de la tabla con los presidentes
	// 
	// ========================================================================	
	
	$template->addBlockfile("CONTENIDO", "TABLA", "bloquePresidente.html");
	$template->setCurrentBlock("TABLA");

	if(isset($_GET['buscarEstado']))
	{
        // Nos conectamos a la base de datos
        $link = require __DIR__ . "/connect.php";
        
        $query = sprintf("SELECT CONCAT(nombre, ' ', ap_paterno, ' ', ap_materno) AS nombre FROM proy_presidentes INNER JOIN proy_ciudades ON idCiudadNacimiento = idCiudad INNER JOIN proy_estados USING(idEstado) WHERE estado LIKE '%%%s%%'", $link->real_escape_string($_GET["filtroEstado"]));
        
        // Ejecutamos el query
        $result = mysqli_query($link, $query) or die("Query 1 failed");

		if(mysqli_num_rows($result) > 0) //Si existe información en la base de datos
		{
			while($line = mysqli_fetch_assoc($result)){
            
                // Fijamos el bloque con la informacion de cada presidente
                $template->setCurrentBlock("PRESIDENTE");
                
                // Desplegamos la informacion de cada presidentes
                $template->setVariable("NOMBRE", $line['nombre']);
                
                $template->parseCurrentBlock("PRESIDENTE");
            }// while
            
            
        	$template->parseCurrentBlock("PRESIDENTE");

		}
		else //Si no hay resultados en la búsqueda
		{
			// Fijamos el bloque con la informacion de cada presidente
			$template->setCurrentBlock("MENSAJE");
			$template->setVariable("MENSAJE", "<em id= \"noEncontrado\" class= \"text-danger\">No hay presidentes registrados que hayan nacido en ese estado.</em>");
		}

        // Liberamos memoria
        mysqli_free_result($result);

        // Mostramos la pagina con los templates que llenamos
        $template->show();

        // Cerramos la conexion
        @mysqli_close($link);
	}
	else
	{
		// Nos conectamos a la base de datos
		$link = require __DIR__ . "/connect.php";
		
		$query = "SELECT CONCAT(nombre, ' ', ap_paterno, ' ', ap_materno) AS nombre, imagen FROM proy_presidentes";

		
		// Ejecutamos el query
		$result = mysqli_query($link, $query) or die("Query 1 failed");
							
		while($line = mysqli_fetch_assoc($result)){
			
				// Fijamos el bloque con la informacion de cada presidente
				$template->setCurrentBlock("PRESIDENTE");
				
				// Desplegamos la informacion de cada presidentes
				$template->setVariable("NOMBRE", $line['nombre']);
				
				$template->parseCurrentBlock("PRESIDENTE");
			}// while
			
			
		$template->parseCurrentBlock("PRESIDENTE");

		// Liberamos memoria
		mysqli_free_result($result);

		// Mostramos la pagina con los templates que llenamos
		$template->show();

		// Cerramos la conexion
		@mysqli_close($link);
	}

	error_reporting(E_ALL);
	ini_set('display_errors', 1);
?>