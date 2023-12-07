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
        
        $query = sprintf("SELECT CONCAT(nombre, ' ', ap_paterno, ' ', ap_materno) AS nombre, edad, muerte, nacimiento, fechaInicio, fechaFin, partido, ciudad, estado, info, imagen FROM proy_presidentes LEFT JOIN proy_periodos USING(idPresidente) LEFT JOIN proy_partidos USING(idPartido) LEFT JOIN proy_ciudades ON idCiudadNacimiento = idCiudad LEFT JOIN proy_estados USING(idEstado) WHERE estado = '%s'", $link->real_escape_string($_GET["filtroEstado"]));
        
        // Ejecutamos el query
        $result = mysqli_query($link, $query) or die("Query 1 failed");

		if(mysqli_num_rows($result) > 0) //Si existe información en la base de datos
		{
			while($line = mysqli_fetch_assoc($result)){
            
                // Fijamos el bloque con la informacion de cada presidente
				$template->setCurrentBlock("PRESIDENTE");
				
				// Desplegamos la informacion de cada presidentes
				$template->setVariable("NOMBRE", $line['nombre']);
				$template->setVariable("NACIMIENTO", $line['nacimiento']);
				if($line['muerte'] != NULL)
				{
					$template->setVariable("MUERTE", $line['muerte']);
				}
				else
				{
					$template->setVariable("MUERTE", "Vivo");
				}
				$template->setVariable("EDAD", $line['edad']);
				$template->setVariable("CIDNAC", $line['ciudad']);
				$template->setVariable("ESTADO", $line['estado']);
				$template->setVariable("INICIO", $line['fechaInicio']);
				$template->setVariable("FIN", $line['fechaFin']);
				if($line['partido'] == NULL)
				{
					$template->setVariable("PARTIDO", "Independiente");
				}
				else
				{
					$template->setVariable("PARTIDO", $line['partido']);
				}
				$template->setVariable("BIO", $line['info']);

				$image = sprintf("<img src=\"../../pictures/Presidentes/%s\" style=\"width: 256px; height: 300px;\">", $line['imagen']);

				$template->setVariable("IMAGEN", $image);
				
				$template->parseCurrentBlock("PRESIDENTE");
            }// while
            
            
        	$template->parseCurrentBlock("PRESIDENTE");

		}
		else //Si no hay resultados en la búsqueda
		{
			// Fijamos el bloque con la informacion de cada presidente
			$template->setCurrentBlock("MENSAJE");
			$template->setVariable("MENSAJE", "<em id= \"noEncontrado\" class= \"text-danger\">No hay presidentes registrados que hayan nacido en este estado.</em>");

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
		
		$query = "SELECT CONCAT(nombre, ' ', ap_paterno, ' ', ap_materno) AS nombre, edad, muerte, nacimiento, fechaInicio, fechaFin, partido, ciudad, estado, info, imagen FROM proy_presidentes LEFT JOIN proy_periodos USING(idPresidente) LEFT JOIN proy_partidos USING(idPartido) LEFT JOIN proy_ciudades ON idCiudadNacimiento = idCiudad LEFT JOIN proy_estados USING(idEstado)";
		// Ejecutamos el query
		$result = mysqli_query($link, $query) or die("Query 1 failed");
							
		while($line = mysqli_fetch_assoc($result)){
			
				// Fijamos el bloque con la informacion de cada presidente
				$template->setCurrentBlock("PRESIDENTE");
				
				// Desplegamos la informacion de cada presidentes
				$template->setVariable("NOMBRE", $line['nombre']);
				$template->setVariable("NACIMIENTO", $line['nacimiento']);
				if($line['muerte'] != NULL)
				{
					$template->setVariable("MUERTE", $line['muerte']);
				}
				else
				{
					$template->setVariable("MUERTE", "Vivo");
				}
				$template->setVariable("EDAD", $line['edad']);
				$template->setVariable("CIDNAC", $line['ciudad']);
				$template->setVariable("ESTADO", $line['estado']);
				$template->setVariable("INICIO", $line['fechaInicio']);
				$template->setVariable("FIN", $line['fechaFin']);
				if($line['partido'] == NULL)
				{
					$template->setVariable("PARTIDO", "Independiente");
				}
				else
				{
					$template->setVariable("PARTIDO", $line['partido']);
				}
				$template->setVariable("BIO", $line['info']);

				$image = sprintf("<img src=\"../../pictures/Presidentes/%s\" style=\"width: 256px; height: 300px;\">", $line['imagen']);

				$template->setVariable("IMAGEN", $image);
				
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