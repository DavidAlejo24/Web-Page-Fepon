<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="favicon.ico">
		<title>FEPON - Federación de Estudiantes de la Escuela Politecnica Nacional</title>
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Custom styles for this template -->
		<link href="css/jquery.bxslider.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		
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

		<div class="container">
		<header class="grid-block" style=" position: relative; background-image: url('images/preguntas1.jpeg'); width: 100%; height: 120vh; max-height:300px;   background-repeat: no-repeat;
			background-attachment: fixed;
			background-position: 50% 0%;
			margin-top:100px;
			">
				<a href="index.html" style="   position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 15%; height: 50%; margin: auto;"><img src="images/fepon.jpeg"  width="250"></a>
			</header>
		<section>
			<div class="row">
				<div class="col-md-8">
				<style>
				.cuadrado {
					width:25vh;
					max-width:100px;
					height:25vh;
					max-height:50px;
					position:relative;
					background:white;
					text-align:center;
					float: left;
					margin-right:1%;
					}
				.btnGrupoP {
					border: 0; width:100%; height:100%;  border-radius: 5px; background:#34495E; color:white; margin: 1% 2%; text-align:center;
				}
				</style>
                    <!--Lista de preguntas en article-->
					<h3 class="sidebar-title">Preguntas Generales</h3>
					<article id="grupoMenuP">
					
					<div><div class="cuadrado"><button id="btnGrupoP1" class="btnGrupoP"  value="1" onclick="abrirGrupoP(this);">Tema 1</button></div><div class="cuadrado"><button id="btnGrupoP2" value="2" class="btnGrupoP"  onclick="abrirGrupoP(this);">Tema 2</button></div><div class="cuadrado"><button id="btnGrupoP3" class="btnGrupoP"  value="3" onclick="abrirGrupoP(this);">Tema 3</button></div><div class="cuadrado"><button id="btnGrupoP4" class="btnGrupoP"  value="4" onclick="abrirGrupoP(this);">Tema 4</button></div></div>
					</article>
					<br>
					<br>
					<!--Bloque preguntas 1-->
					<article id="preguntasGrupo1"class="blog-post">
					<!--Did Contenedor de Pregunta-->
					<br>
					<br>
					<div style="border-radius: 5px;  width:100%;">
					<button id="pregunta1" onclick="mostrar(this)" style="border: 0; width:100%; height:100%;  border-radius: 5px; background:#E67E22; margin: 1% 2%; text-align:left; "value="1">¿Qué es Lorem Ipsum?
					<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-arrows-angle-expand" style="float:right; margin-top:0.5%; margin-right:0.5%;" viewBox="0 0 16 16">
					<path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707z"/>
					</svg></button>
					</div>
					<hr>
					<!--Did Contenedor de Pregunta-->
					<div style="border-radius: 5px;  width:100%;">
					<button id="pregunta2" onclick="mostrar(this)" style="border: 0; width:100%; height:100%;  border-radius: 5px; background:#E67E22; margin: 1% 2%; text-align:left; "value="2">¿Por qué lo usamos?
					<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-arrows-angle-expand" style="float:right; margin-top:0.5%; margin-right:0.5%;" viewBox="0 0 16 16">
					<path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707z"/>
					</svg></button>
					</div>
					</article>
					<article id="preguntasGrupo2">					
					<br>
					<br>Soy el grupo 2</article>
					<article id="preguntasGrupo3">
					<br>
					<br>Soy el grupo 3</article>
					<article id="preguntasGrupo4">
					<br>
					<br>Soy el grupo 4</article>

				</div>
				<script type="text/javascript">
				//Funcion que permite cargar elementos al inicio al tener ya la pagina cargada 
				document.addEventListener('DOMContentLoaded', function() {
					(async function slowDemo () {
 		               console.log('Starting slowDemo ...');
						$('#preguntasGrupo1').hide();
						$('#preguntasGrupo2').hide();
						$('#preguntasGrupo3').hide();
						$('#preguntasGrupo4').hide();
						
						//$('#tablaTodoContenido').hide();
						//$('#areaPostEventos').hide();
						//await sleep(2000);
						console.log('slowDemo: TWO seconds later ...');
              		})();
				});
				function abrirGrupoP(comp){
					$('#preguntasGrupo1').hide();
					$('#preguntasGrupo2').hide();
					$('#preguntasGrupo3').hide();
					$('#preguntasGrupo4').hide();
					$('#btnGrupoP1').css("background-color","#34495E");
					$('#btnGrupoP2').css("background-color","#34495E");
					$('#btnGrupoP3').css("background-color","#34495E");
					$('#btnGrupoP4').css("background-color","#34495E");
					
					console.log(comp);
					if(comp.value=="1"){
						$('#btnGrupoP1').css("background-color","#5499C7");
						$('#preguntasGrupo1').show();
					}else if(comp.value=="2"){
						$('#btnGrupoP2').css("background-color","#5499C7");
						$('#preguntasGrupo2').show();
					}else if(comp.value=="3"){
						$('#btnGrupoP3').css("background-color","#5499C7");
						$('#preguntasGrupo3').show();
					}else if(comp.value=="4"){
						$('#btnGrupoP4').css("background-color","#5499C7");
						$('#preguntasGrupo4').show();
					}
				}
				function mostrar(comp){
					console.log(comp.id);
					var valorActual= comp.value;
					var idActual = comp.id;
					idJQ = "#"+ idActual;
					respuestaActual = "#respuesta"+valorActual
					$(respuestaActual).empty();
					$(idJQ).on('click',function(){
						$(respuestaActual).toggle();
					});
					//$(this).closest('.li').remove();
					//$(idJQ).closest('p').remove();

					if(valorActual==1){
						$(idJQ).after(`<br><p  id="respuesta`+valorActual+`" style='text-align:left; margin-left:2%;'>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p>`);
					}else if(valorActual==2){
						$(idJQ).after(`<p id="respuesta`+valorActual+`" style='text-align:left; margin-left:2%;'>Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo "Contenido aquí, contenido aquí". Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de "Lorem Ipsum" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo).</p>`);
					}else{
						console.log("no se encontro resultados");
					}
				}
				</script>
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
	</body>

</html>