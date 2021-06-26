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
		<header class="grid-block" style=" position: relative; background-image: url('images/EstudiarInvierno-1140x500.jpg'); width: 100%; wax-width:1140px; height: 120vh; max-height:300px;   background-repeat: no-repeat;
			background-attachment: fixed;
			background-position: 50% 50%;
			margin-top:100px;
			">
		<?php $dato= $_GET["ID"]; ?> 
		<a href="index.html" style="   position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 50%; height: 50%; margin: auto;"><img src="images/fepon.jpeg"  style="width:30%;"></a>
			
		</header>
		<section>
			<div class="row">
				<div class="col-md-8">				

				<div  class="container pagination__list" style="width:100%;" id="cajaPaginacion">
				<?php  
				include 'conexion.php';
				if($dato=="1"){
					echo '<h5 class="sidebar-title">Noticias Generales</h5>';
					$consulta = "SELECT * FROM entradas WHERE subcategoriaID= $dato";
					$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
					while ($columna1 = mysqli_fetch_array( $resultado ))
						{
							$titulo=$columna1['titulo'];
							$id = $columna1['ID'];
							//echo $titulo;
							$fecha=$columna1['fechaCreacion'];
							$contenido=$columna1['descripcion'];
							$urlImagenTitulo=$columna1['urlImagenTitulo'];
							echo '<div class="pagination__item"><br><article class="blog-post" style="text-align:center;">';
							echo '<div style="width:70%; max-width:300px;  margin:0px; float: left; "><img src="'.$urlImagenTitulo .'" style="width:83%; max-width:300px; max-height:150px; text-align:center;" class="img-fluid" alt=""></div>';
							echo '<div style="margin:1%; max-width:400px; display: inline-block; text-align: center; font-weight: 800; font-size: 110%">'.$titulo.'</div><br>';
							echo '<div style="margin:1%; display: inline-block; font-weight: 500;">'.$fecha.'</div><br><br>';
							echo '<div class="read-more" width:90%; style="display: inline-block;"><a type="button" href="post.php?ID='.$id.'" >Continuar Leyendo</a></div>';
							echo '</articule></div>';
							echo '<hr>';
							
						}
							
				} elseif ($dato=="2"){	
					echo '<h5 class="sidebar-title">Eventos del Periodo Academico</h5>';
					$consulta = "SELECT * FROM entradas WHERE subcategoriaID= $dato";
					$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
					while ($columna1 = mysqli_fetch_array( $resultado ))
						{
							$titulo=$columna1['titulo'];
							//echo $titulo;
							$id = $columna1['ID'];
							$fecha=$columna1['fechaCreacion'];
							$contenido=$columna1['descripcion'];
							$urlImagenTitulo=$columna1['urlImagenTitulo'];
							echo '<div class="pagination__item"><br><article class="blog-post" style="text-align:center;">';
							echo '<div style="width:70%; max-width:300px;  margin:0px; float: left; "><img src="'.$urlImagenTitulo .'" style="width:83%; max-width:300px; max-height:150px; text-align:center;" class="img-fluid" alt=""></div>';
							echo '<div style="margin:1%; max-width:400px; display: inline-block; text-align: center; font-weight: 800; font-size: 110%">'.$titulo.'</div><br>';
							echo '<div style="margin:1%; display: inline-block; font-weight: 500;">'.$fecha.'</div><br><br>';
							echo '<div class="read-more" width:90%; style="display: inline-block;"><a type="button"  href="post.php?ID='.$id.'">Continuar Leyendo</a></div>';
							echo '</articule></div>';
							echo '<hr>';
							
						}
				} elseif ($dato=="3"){	
					echo '<h5 class="sidebar-title">Comunidad Politecnica</h5>';
					$consulta = "SELECT * FROM entradas WHERE subcategoriaID= $dato";
					$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
					while ($columna1 = mysqli_fetch_array( $resultado ))
						{
							$titulo=$columna1['titulo'];
							//echo $titulo;
							$id = $columna1['ID'];
							$fecha=$columna1['fechaCreacion'];
							$contenido=$columna1['descripcion'];
							$urlImagenTitulo=$columna1['urlImagenTitulo'];
							echo '<div class="pagination__item"><br><article class="blog-post" style="text-align:center;">';
							echo '<div style="width:70%; max-width:300px;  margin:0px; float: left; "><img src="'.$urlImagenTitulo .'" style="width:83%; max-width:300px; max-height:150px; text-align:center;" class="img-fluid" alt=""></div>';
							echo '<div style="margin:1%; max-width:400px; display: inline-block; text-align: center; font-weight: 800; font-size: 110%">'.$titulo.'</div><br>';
							echo '<div style="margin:1%; display: inline-block; font-weight: 500;">'.$fecha.'</div><br><br>';
							echo '<div class="read-more" width:90%; style="display: inline-block;"><a type="button"  href="post.php?ID='.$id.'">Continuar Leyendo</a></div>';
							echo '</articule></div>';
							echo '<hr>';
							
						}
				} elseif ($dato=="4"){	
					echo '<h5 class="sidebar-title">Revisa Todas Las Noticias</h5>';
					$consulta = "SELECT e.ID, e.titulo, e.descripcion, e.urlImagenTitulo, e.fechaCreacion, s.nombre FROM entradas e JOIN  subcategorias s ON e.subcategoriaID = s.ID ORDER BY e.ID DESC";
					$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
					while ($columna1 = mysqli_fetch_array( $resultado ))
						{
							$titulo=$columna1['titulo'];
							//echo $titulo;
							$id = $columna1['ID'];
							$fecha=$columna1['fechaCreacion'];
							$contenido=$columna1['descripcion'];
							$urlImagenTitulo=$columna1['urlImagenTitulo'];
							$subcategoria=$columna1['nombre'];
							echo '<div class="pagination__item"><br><article class="blog-post" style="text-align:center;">';
							echo '<div style="width:70%; margin-bot:10px; max-width:300px; max-height:400px  margin:0px; float: left; "><img src="'.$urlImagenTitulo .'" style="width:83%; max-width:300px; max-height:150px; text-align:center;" class="img-fluid" alt=""></div>';
							echo '<div style="margin:1%; max-width:400px; display: inline-block; text-align: center; font-weight: 800; font-size: 110%">'.$titulo.'</div><br>';
							echo '<div style="margin:1%; display: inline-block; font-weight: 500;  font-size: 90%">'.$fecha.'</div><br><br>';
							echo '<div style="margin:0; font-weight: 500; float: center; font-size: 75%">'.$subcategoria.'</div><br><br>';
							echo '<div class="read-more"  style="display: inline-block; width:90%;"><a type="button"  href="post.php?ID='.$id.'">Continuar Leyendo</a></div>';
							echo '</articule></div>';
							echo '<hr>';
							
						}
				}elseif ($dato=="5"){	
					echo '<h5 class="sidebar-title">TODO DE POLISEGURA</h5>';
					$consulta = "SELECT * FROM entradas ORDER BY ID DESC"; //BUSCAR POR polisegura
					$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
					while ($columna1 = mysqli_fetch_array( $resultado ))
						{
							$titulo=$columna1['titulo'];
							//echo $titulo;
							$id = $columna1['ID'];
							$fecha=$columna1['fechaCreacion'];
							$contenido=$columna1['descripcion'];
							$urlImagenTitulo=$columna1['urlImagenTitulo'];
							echo '<div class="pagination__item"><br><article class="blog-post" style="text-align:center;">';
							echo '<div style="width:80%; max-width:300px; max-height:400px;  margin:0px; float: left; "><img src="'.$urlImagenTitulo .'" style="width:83%; max-width:300px; max-height:150px; text-align:center;" class="img-fluid" alt=""></div>';
							echo '<div style="margin:1%; max-width:400px; display: inline-block; text-align: center; font-weight: 800; font-size: 110%">'.$titulo.'</div><br>';
							echo '<div style="margin:1%; display: inline-block; font-weight: 500;">'.$fecha.'</div><br><br>';
							echo '<div class="read-more" width:90%; style="display: inline-block;"><a type="button"  href="post.php?ID='.$id.'">Continuar Leyendo</a></div>';
							echo '</articule></div>';
							echo '<hr>';
							
						}
				}

				?>

				
				</div>
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script type="text/javascript" src="./jPaginate/jQuery.paginate.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.bxslider.js"></script>
		<script src="js/mooz.scripts.min.js"></script>
		<script type="text/javascript">
				//$('#cajaPaginacion').jpaginate();
				/*
				$('#cajaPaginacion').paginate({
					count: 5
				});
				*/
				$('#cajaPaginacion').paginate({
					pagination_class: "pagination",
					items_per_page  : 10,
					prev_next       : true,
					prev_text       : '«',
					next_text       : '»'
				});
				</script>
	</body>

</html>