<!DOCTYPE html>
<html lang="en">
	<head>
		<meta context="text/html" charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="favicon.ico">
		<title>Renda - clean blog theme based on Bootstrap</title>
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Custom styles for this template -->
		<link href="css/jquery.bxslider.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<!-- Dinamic Select-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
		<!-- full calendar -->

	<link href='fullcalendar/lib/main.css' rel='stylesheet'/>

    <script src='fullcalendar/lib/main.js'></script>
    <script src='fullcalendar/lib/locales/es.js'></script>


	</head>
	<body>
		
		<!-- Navigation -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
		
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="http://127.0.0.1:8080/renda-FEPON-project/">Inicio</a></li>
						<li><a href="catalogo.php?ID=4">Noticias</a></li>
						<li><a href="preguntasGenerales.php">Preguntas Frecuentes</a></li>
						<li><a href="poliSegura.php">PoliSegura</a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right">
						<li><a href="https://www.facebook.com/fepon.epn" target="_blank"><i class="fa fa-facebook"></i></a></li>
						<li><a href="https://www.youtube.com/c/FEPON/videos" target="_blank"><i class="fa fa-youtube"></i></a></li>
						<li><a href="https://www.instagram.com/fepon.epn/?hl=es" target="_blank"><i class="fa fa-instagram"></i></a></li>
					</ul>

				</div>
				<!--/.nav-collapse -->
			</div>
		</nav>
		<header class="grid-block" style=" position: relative; background-image: url('images/vista1.jpg'); width: 100%; height: 120vh; max-height:300px;   background-repeat: no-repeat;
			background-attachment: fixed;
			background-position: 50% 50%;
			margin-top:100px;
			">
				<a href="index.html" style="   position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 50%; height: 50%; margin: auto;"><img src="images/fepon.jpeg"  width="250"></a>
			</header>
		<div class="container">

		<section class="main-slider" >
			<ul class="bxslider">
			<?php
				include 'conexion.php';
                //Inserta los ultimos 4 noticias Comunidad Politecnica
                //$sql = "SELECT M.nombre, M.correo, M.asunto, M.mensaje, F.Nombre_facu, C.Nombre_carrera FROM mensajes M JOIN  facultades F ON M.facultadID = F.ID JOIN carreras C ON M.carreraID = C.ID";
                $consulta = "SELECT * FROM entradas WHERE subcategoriaID = 3 ORDER BY ID DESC LIMIT 4";
                $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                while($row = mysqli_fetch_array($resultado)){ ?>
					<li><div class="slider-item"><img style=" float: right; width:100% max-width: 1140px; height:100%; max-height: 500px;" src="<?php echo $row['urlImagenTitulo'] ?>" title="Funky roots" /><h2><a href="post.php?ID=<?php echo $row['ID'] ?>" title="Vintage-Inspired Finds for Your Home"><?php echo $row['titulo'] ?></a></h2></div></li>
                    <?php
                }
                ?>
			</ul>
		</section>
		<section>
			<div class="row">
				<div class="col-md-8">
				<h3 class="sidebar-title">Eventos</h3> <!--noticia(azul), informacion(amarillo), eventos(verde)-->
				<div id='calendar'></div>
				<div class="modal fade" id="exampleEvento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header" style="background-color:#2B2B2B; color:#F4F6F6;">
							<h3 style="text-align:center;" class="modal-title" id="tituloEvento"></h3>
							</div>
							<div class="modal-body">
							<label id="fechaEvento"></label>
							<p id="descripcionEvento"></p>
							<div style="text-align:center;">
							<div id="imagenEvento"></div>
							<div id="videoEvento"></div>
							
							</div>
							
							<!--
							<p id="descripcionEvento"></p>
							<img id="imagenEvento" style="width:100%">
							-->

							</div>
							<div style="text-align:center;"class="modal-footer">
							<div id="dirigeteEvento" style="float:left;"></div>
							<button type="button"  style="float:right;" class="btn btn-secondary" id="btnAgregar_m" data-dismiss="modal"  onclick="$('#exampleModal').modal('toggle');">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
				</br>
				</br>
				<h3 class="sidebar-title">Noticias Comunidad Politecnica</h3>
				
				<?php
				include 'conexion.php';
                //Inserta los ultimos 4 noticias Comunidad Politecnica
                //$sql = "SELECT M.nombre, M.correo, M.asunto, M.mensaje, F.Nombre_facu, C.Nombre_carrera FROM mensajes M JOIN  facultades F ON M.facultadID = F.ID JOIN carreras C ON M.carreraID = C.ID";
                $consulta = "SELECT * FROM entradas WHERE subcategoriaID = 3 ORDER BY ID DESC LIMIT 4";
                $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                while($row = mysqli_fetch_array($resultado)){ ?>
					<!-- article -->
					<article class="blog-post">
						<div class="blog-post-image" style="text-align:center;">
							<a href="post.php?ID=<?php $idActual =$row['ID']; echo $row['ID'] ?>"><img src="<?php echo $row['urlImagenTitulo'] ?>" alt=""></a>
						</div>
						<div class="blog-post-body">
							<h2><a href="post.php?ID=<?php echo $row['ID'] ?>"><?php echo $row['titulo'] ?></a></h2>
							<div class="post-meta"><span><i class="fa fa-clock-o"></i><?php echo $row['fechaCreacion'] ?></span></div>
							<p><?php echo $resultado1 = substr($row['descripcion'], 0, 175)?>....</p>
							<div class="read-more"><a type="button" href="post.php?ID=<?php echo $row['ID'] ?>">Continuar Leyendo</a></div>
						</div>
					</article>
                    <?php
                }
                ?>
				</div>
				<div class="col-md-4 sidebar-gutter">
					<aside>
					<!-- sidebar-widget -->
					<div class="sidebar-widget">
						<h3 class="sidebar-title">Conócenos</h3>
						<div class="widget-container widget-about">
							<a href="post.html"><iframe style="width:100%;" src="https://www.youtube.com/embed/g-wRk7QA10c" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></a>
							<h4>Federación de Estudiantes de la Escuela Politecnica Nacional</h4>
							<div class="author-title">FEPON</div>
							<p style="font-size:small;">La Federación de Estudiantes de la Escuela Politécnica Nacional (FEPON) es el máximo organismo de representación estudiantil de la Escuela Politécnica Nacional (EPN). Conscientes del papel que desempeñan los gremios estudiantiles, la FEPON enfoca sus esfuerzos en la defensa de los derechos de los estudiantiles, trabaja porque institucionalmente se implementen políticas culturales y deportivas que contribuyan a la Formación Integral del estudiante politécnico y que la educación que se imparta sea una educación científica tecnológica, que responda a las necesidades y realidad de nuestro país.</p>
						</div>
					</div>
					<!-- sidebar-widget -->
					<div class="sidebar-widget">
						<h3 class="sidebar-title">Ultimas noticias e informacion</h3><!--Ultimas noticias e informacion-->
						<div class="widget-container">
						<?php
							include 'conexion.php';
							//Inserta los ultimos 4 noticias Comunidad Politecnica
							//$sql = "SELECT M.nombre, M.correo, M.asunto, M.mensaje, F.Nombre_facu, C.Nombre_carrera FROM mensajes M JOIN  facultades F ON M.facultadID = F.ID JOIN carreras C ON M.carreraID = C.ID";
							$consulta = "SELECT * FROM entradas ORDER BY ID DESC LIMIT 5";
							$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
							while($row = mysqli_fetch_array($resultado)){ ?>
								<!-- article -->
								<article class="widget-post">
									<div class="post-image">
										<a href="post.php?ID=<?php echo $row['ID'] ?>"><img src="<?php echo $row['urlImagenTitulo'] ?>" alt=""></a>
									</div>
									<div class="post-body">
										<h2><a href="post.php?ID=<?php echo $row['ID'] ?>"><?php echo $row['titulo'] ?></a></h2>
										<div class="post-meta">
											<span><i class="fa fa-clock-o"></i><?php echo $row['fechaCreacion'] ?></span> <span><a href="post.html"></span>
										</div>
									</div>
								</article>
								<?php
							}
						?>
						</div>
					</div>
					<!-- sidebar-widget -->
					<div class="sidebar-widget">
						<h3 class="sidebar-title">Visitanos</h3>
						<div class="widget-container">
							<div class="widget-socials">
								<a href="https://www.facebook.com/fepon.epn" target="_blank"><i class="fa fa-facebook"></i></a>
								<a href="https://www.youtube.com/c/FEPON/videos" target="_blank"><i class="fa fa-youtube"></i></a>
								<a href="https://www.instagram.com/fepon.epn/?hl=es" target="_blank"><i class="fa fa-instagram"></i></a>
							</div>
						</div>
					</div>
					<!-- sidebar-widget -->
					<div class="sidebar-widget">
						<h3 class="sidebar-title">Categorias</h3>
						<div class="widget-container" style="text-align:center;">
						
						<a class="btn btn-light" href="catalogo.php?ID=1" role="button">Noticias Generales</a>
						<br>
						<a class="btn btn-light"  href="catalogo.php?ID=2" role="button">Eventos del Periodico Academico</a>
						<br>
						<a class="btn btn-light"  href="catalogo.php?ID=3" role="button">Comunidad Politecnica</a>
						<br>
						<a class="btn btn-light"  href="poliSegura.php" role="button">Polisegura</a>
						<br>
						<a class="btn btn-light" href="preguntasGenerales.php" role="button">Preguntas Generales</a>
						<br>
						</div>
					</div>
					</div>
					</aside>
				</div>
			</div>
		</section>
		<section>
		<script type="javascript" src="js/form.js"></script>
		<div class="container">
		<h3 class="sidebar-title">Visita Nuestras Secciones</h3>
			<div class="row">
				<div class="col-md-4"  style="text-align:center;">
				<a class="btn btn-light" href="#formulario-seccion" role="button">
				<h3 style="text-align:center">CONTACTOS</h3>
				<img style="width:80%;" src="images/informacion.gif" alt="Funny image">
				</a>
				</div>
				<div class="col-md-4" style="text-align:center;">
				<a class="btn btn-light" href="catalogo.php?ID=4" role="button">
				<h3>NOTICIAS</h3>
				<img style="width:80%; "src="images/noticias.gif" alt="Funny image">
				</a>
				</div>
				<div class="col-md-4"  style="text-align:center;">
				<a class="btn btn-light" href="preguntasGenerales.php" role="button">
				<h3 style="text-align:center" >PREGUNTAS GENERALES</h3>
				<img style="width:80%;" src="images/preguntas.gif" alt="Funny image">
				</a>
				</div>
			</div>
		</div>
		</section>

		<section style="background:#222; color:#EAEBEA;" id="formulario-seccion">	
		<br>
		<br>
		<div class="container" id="cajacontacto">
			<div class="row">
                  <div class="col-md-6">
				  <h2>Dejanos un mensaje</h2>
			<form id="contact-form" action="#formulario-seccion" method="post">
			<div class="mb-3">
					<p style="color:#8A8A8A" for="exampleInputName">Nombre</p>
					<input type="text" class="form-control" id="name" name="nombre" aria-describedby="nameHelp" required>
					<div id="error-name"></div>
				</div>
				<div class="mb-3">
					<p style="color:#8A8A8A" for="exampleInputEmail">Correo Electronico</p>
					<input type="email" class="form-control" id="email" name="correo" aria-describedby="emailHelp" required>
					<div id="error-email"></div>
				</div>
				<div class="mb-3">
				<p style="color:#8A8A8A" for="exampleInputSelect">Facultad</p>
				<select type="select" class="form-control" id="faculty" title="Seleccione una facultad" name="facultad" aria-describedby="facultadHelp" required>
					<option value="">Seleccione una facultad</option>
					<?php
					include 'conexion.php';
					$consulta = "SELECT * FROM facultades";
					$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
					
						while ($columna1 = mysqli_fetch_array( $resultado ))
						{
							echo '<option value="'.$columna1['ID'].'">'.$columna1['Nombre_facu'].'</option>';
							#echo "<h5 class='text-center'>" . $columna1['nombre'] . "</h5><h6 class='text-center'>" . $columna1['message'] . "</h6>";
						}
					?>
					</select>	
					<div id="error-faculty"></div>
				</div>
				<div class="mb-3">
					<!-- State dropdown -->
					<p style="color:#8A8A8A" for="exampleInputEmail">Carrera</p>
					<select class="form-control" id="career" name="carrera" required>
					<option value="">Seleccione una carrera</option>
					</select>
					<div id="error-career"></div>
				</div>

				<div class="mb-3">
				<p style="color:#8A8A8A" for="exampleInputSubject">Ingrese uno o varios asuntos a tratar</p>
					<select type="select" class="form-control selectpicker" name="asunto" id="miSelect1" title="Elija uno o mas asuntos" multiple data-selected-text-format="count" required>
                            <option>Convenios</option>
                              <option>Problemas académicos</option>
                              <option>Acoso</option>
                              <option>discriminación o violencia</option>
							  <option>Consultas académicas</option>
							  <option>Otros</option>
                            </select> 
                            <div id="error-miSelect1"></div> 
				</div>
				<div class="mb-3">
				<p style="color:#8A8A8A" for="exampleInputMessage">Mensaje</p>
					<textarea type="text" class="form-control" id="message" name="mensaje" aria-describedby="messageHelp" rows="3" maxlength="5000" placeholder="No compartiremos tu informacion personal con terceros" required></textarea>
					<div id="error-message"></div>
				</div>
					</br>
				<button type="submit" class="btn btn-primary" name="register" onclick="dimePropiedades()">Enviar</button>
			</form>
			<?php
            	include("contacto.php")
            ?>
			</div>
			<div class="col-md-6">
			
				<h2><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
  				<path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
				</svg> Comunicate con nosotros</h2>
				<h3   style="color:#8A8A8A;">Responderemos todas tus dudas</h3>
				<h3><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
				<path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z"/>
				<path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z"/>
				</svg> Encuentranos en</h3>
				<p  style="color:#8A8A8A;">Av. Ladrón de Guevara E11-25 y Andalucía, Facultad de Ingeniería en Sistemas(Edificio 20), Planta Baja.</p>
				<p style="color:#8A8A8A;">Mon - Fri, 8:00 - 19:00</p>
				<h3><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
				<path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
				</svg> Nuestro correo electronico</h3>
				<p style="color:#8A8A8A;">fepon@epn.edu.ec</p>
				<h3><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-phone-vibrate-fill" viewBox="0 0 16 16">
				<path d="M4 4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4zm5 7a1 1 0 1 0-2 0 1 1 0 0 0 2 0zM1.807 4.734a.5.5 0 1 0-.884-.468A7.967 7.967 0 0 0 0 8c0 1.347.334 2.618.923 3.734a.5.5 0 1 0 .884-.468A6.967 6.967 0 0 1 1 8c0-1.18.292-2.292.807-3.266zm13.27-.468a.5.5 0 0 0-.884.468C14.708 5.708 15 6.819 15 8c0 1.18-.292 2.292-.807 3.266a.5.5 0 0 0 .884.468A7.967 7.967 0 0 0 16 8a7.967 7.967 0 0 0-.923-3.734zM3.34 6.182a.5.5 0 1 0-.93-.364A5.986 5.986 0 0 0 2 8c0 .769.145 1.505.41 2.182a.5.5 0 1 0 .93-.364A4.986 4.986 0 0 1 3 8c0-.642.12-1.255.34-1.818zm10.25-.364a.5.5 0 0 0-.93.364c.22.563.34 1.176.34 1.818 0 .642-.12 1.255-.34 1.818a.5.5 0 0 0 .93.364C13.856 9.505 14 8.769 14 8c0-.769-.145-1.505-.41-2.182z"/>
				</svg> Numeros de contacto</h3>
				<p style="color:#8A8A8A;"> (02) 297-6300 ext.: 5114</p>
				
			</div>
			</div>
			</div>
		</section>
		
		</div><!-- /.container -->

		<footer class="footer">

			<div class="footer-socials">
				<a href="https://www.facebook.com/fepon.epn" target="_blank"><i class="fa fa-facebook"></i></a>
				
				<a href="https://www.instagram.com/fepon.epn/?hl=es" target="_blank"><i class="fa fa-instagram"></i></a>
				<a href="https://www.youtube.com/c/FEPON/videos" target="_blank"><i class="fa fa-youtube"></i></a>
			</div>

			<div class="footer-bottom">
				<i class="fa fa-copyright"></i> Copyright 2021. Todos los derechos reservados.<br>
				Desarrollado por <a href="https://www.facebook.com/alejo.davidc/" target="_blank">David Cruz</a>
			</div>
		</footer>
		<!-- Bootstrap core JavaScript
			================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
				
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.bxslider.js"></script>
		<script src="js/mooz.scripts.min.js"></script>
		<script src="js/form.js"></script>
		<!-- Select Picker -->
		<script>
		document.addEventListener('DOMContentLoaded', function() {
			var calendarEl = document.getElementById('calendar');
			var calendar = new FullCalendar.Calendar(calendarEl, {
			initialView: 'dayGridMonth',
			headerToolbar: {
				left: 'prev,next today',
				center: 'title',
				right: 'dayGridMonth' //,timeGridWeek,listWeek
			},
			locale: 'es',
			showNonCurrentDates: true,
			selectable: true,
			events: 'eventos.php',
        	eventClick: function(info) { //actua sobre los eventos en el calendario
				$('#videoEvento').empty();
				$('#imagenEvento').empty();
				
				fechaHora= info.event.start.toISOString();
          		var fechaSeparada = fechaHora.split("T");
				$('#tituloEvento').html(info.event.title);
				$('#fechaEvento').html(fechaSeparada[0]);
				$('#descripcionEvento').html(info.event.extendedProps.descripcion);
				urlImageActual = info.event.extendedProps.imageurl;
                    urlSeparado=urlImageActual.split(".");
                    tipoArchivo =urlSeparado[urlSeparado.length - 1]
                if(tipoArchivo=="mp4" || tipoArchivo=="avi"){
                  //document.getElementById('imagenEvento').src=info.event.extendedProps.imageurl;
                  $('#videoEvento').append('<video style="width:100%; max-width:500px; height:100%; max-height:500px;" controls><source src="'+urlImageActual+'" type="video/'+tipoArchivo+'"></video>');
                  console.log("es video")
                }else if(tipoArchivo== "jpeg"|| tipoArchivo== "jpeg"|| tipoArchivo== "png"|| tipoArchivo== "gif" || tipoArchivo== "jpg"){
                  //info.event.extendedProps.imageurl
                  $('#imagenEvento').html('<div style="text-align:center;"><img style="width:100%; max-width:500px; height:100%; max-height:500px;" src="'+urlImageActual+'"></div>');
                     console.log("es imagen")
                }
				$('#imagenEvento').attr("src", info.event.extendedProps.imageurl);
				if(info.event.extendedProps.entradaID){
					$('#dirigeteEvento').html('<a type="button" class="btn" id="goPost" href="post.php?ID='+info.event.extendedProps.entradaID +'" style="background-color:#2B6C34 !important; color:#F4F6F6;">Informate</a>');
				}else{
					//$('#dirigeteEvento').html('No tiene link');
				}
				
				$('#exampleEvento').modal('show');
			}
			});
			calendar.render();
		});		

		</script>
		<!-- Script to dinamic select on contact form-->
		<script type="text/javascript">
		$(document).ready(function(){
			// Country dependent ajax
			$("#faculty").on("change",function(){
			var countryId = $(this).val();
			$.ajax({
				url :"action.php",
				type:"POST",
				cache:false,
				data:{countryId:countryId},
				success:function(data){
				$("#career").html(data);
				}
			});
			});
		});
		</script>
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
		
	</body>
</html>