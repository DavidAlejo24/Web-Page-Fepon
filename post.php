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
		<header>
		<?php $dato= $_GET["ID"]; ?> 
		<?php
				include 'conexion.php';
                //Inserta los ultimos 4 noticias Comunidad Politecnica
                //$sql = "SELECT M.nombre, M.correo, M.asunto, M.mensaje, F.Nombre_facu, C.Nombre_carrera FROM mensajes M JOIN  facultades F ON M.facultadID = F.ID JOIN carreras C ON M.carreraID = C.ID";
                $consulta = "SELECT * FROM entradas WHERE ID = $dato ORDER BY ID";
                $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                while($row = mysqli_fetch_array($resultado)){ ?>
					<a href="#"><img style="max-width:1140px; width:100%; max-height:500px; height:100%;"src="<?php echo $row['urlImagenTitulo'] ?>"></a>
                    <?php
                }
                ?>
			
		</header>
		<section>
			<div class="row">
				<div class="col-md-8">
				<?php
				//include 'conexion.php';
                //Inserta los ultimos 4 noticias Comunidad Politecnica
                //$sql = "SELECT M.nombre, M.correo, M.asunto, M.mensaje, F.Nombre_facu, C.Nombre_carrera FROM mensajes M JOIN  facultades F ON M.facultadID = F.ID JOIN carreras C ON M.carreraID = C.ID";
                $consulta = "SELECT * FROM entradas WHERE ID = $dato ORDER BY ID";
                $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                while($row = mysqli_fetch_array($resultado)){ ?>
					<article class="blog-post">
						<div class="blog-post-body">
							<h2><?php echo $row['titulo'] ?></h2>
							<div class="post-meta"><span><i class="fa fa-clock-o"></i><?php echo $row['fechaCreacion'] ?></span></div>
							<div class="blog-post-text">
								<p><?php echo $row['descripcion'] ?></p>
							</div>
							<div style="text-align:center;" >
							<?php if($row['urlVideoPrincipal'] !="" || $row['urlVideoPrincipal'] !=null){
								echo ('<video style="width:100%; max-width:500px; max-height:100%; height:500px;" src="'.$row['urlVideoPrincipal'].'" controls>');  
							}
							?>
							</div>
						</div>
						
                    <?php
                }
                ?>
					<?php
						include 'conexion.php';
						//Inserta los ultimos 4 noticias Comunidad Politecnica
						$consulta1 = "SELECT * FROM imagenesentradas WHERE entradaID = $dato";
						$resultado2 = mysqli_query( $conexion, $consulta1 ) or die ( "Algo ha ido mal en la consulta a la base de datos");
						//echo $row1 = mysqli_fetch_array($resultado2);
						$bandera=get_object_vars($resultado2) ? TRUE : FALSE;
						if (empty($bandera) !=true) { ?> 						
							<section class="main-slider" >
							<ul class="bxslider">
							<?php
							while($row1 = mysqli_fetch_array($resultado2)){
								if (strlen($row1["urlImagenContenido"]) >= 1 || $row1["urlImagenContenido"]==" ") {	
									?>
									<li><div class="slider-item"><img style="max-width:750px; width: 100%; max-height:500px; height:100%;" src="<?php echo $row1['urlImagenContenido'] ?>" title="Funky roots" /></div></li>								
									<?php
								}else{ 	
									?>
									<li><div class="slider-item"><img style="max-width:750px; width: 100%; max-height:500px; height:100%;" src="images/cec.jpg" title="Funky roots" /><p></div></li>
									<?php  
									}
								}?>
							</ul>
							
							</section>
						
						<?php
						}?>

					<div style="width:100%; height:60%;"> 
						<h5 class="sidebar-title">Comentarios</h5>	

						<form id="contact-form" style="width:100%"	 action="" method="post">
							<div class="form-row">
								<div class="form-group col-md-6">
								<label for="inputEmail4">Nombre</label>
								<input type="text" class="form-control" id="inputEmail4" placeholder="Nombre" required>
								<div id="error-nombre"></div>
								</div>
								<div class="form-group col-md-6">
								<label for="inputPassword4">Correo</label>
								<input type="email" class="form-control" id="inputPassword4" required data-msg-email="Enter a valid email account!" placeholder="Correo" required>
								<div id="error-correo"></div>
								</div>
							</div>
							<div class="form-group">
								<label for="inputAddress">Comentario</label>
								<textarea  type="text" class="form-control" id="message" name="mensaje" aria-describedby="messageHelp" rows="2" maxlength="300" placeholder="Cuentanos que piensas al respecto" required></textarea>
								<div id="error-mensaje"></div>
							</div>
							</br>
							<div id="mensajeFinal"> </div>
							<button type="button" class="btn btn-primary" id="register" name="register" onclick="agregarComentario()">Enviar</button>
						</form>
						
					</div>
					
					
						
					<script type="text/javascript" >
					function activarBoton(){
						setTimeout(function(){
							$('#register').attr('disabled', false);
						}, 3000);
						}
					function agregarComentario()
						{
							
							console.log("agregando comentario....");
							
								
								if(validarCamposComentario() ==true){
									$('#register').attr('disabled', true);
									$('#register').attr('disabled', true);
									console.log("enviar mensaje...");
									listaMensaje = conseguirDatos();
									$.ajax({
										url: 'datoseventos.php?accion=agregarComentario',
										type: 'post',
										data: listaMensaje,
										success: function(response) {
											console.log(response)
											console.log("mensaje agregado exitosamente");
											$('#mensajeFinal').html("<label style='color: white; text-align: center; background: #2B6C34 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;'> Comentario enviado exitosamente para su revisión</label>")
											
											$('#mensajeFinal').hide(4000);
											$('#mensajeFinal').hide("fast");
											
											//$('#mensajeFinal').empty();
										}
									});
									limpiarFormularioMensaje();
								}else{
									console.log("datos incompletos");
								}
							$('#mensajeFinal').empty();
							$('#mensajeFinal').show();
							
							activarBoton();
						}
						function limpiarFormularioMensaje(){
							$('#inputEmail4').val("");
							$('#inputPassword4').val("");
							$('#message').val("");
						}
						var idEntradaGlobal;
						function conseguirDatos(){
							var listaRetornar = {
								'nombre' : $('#inputEmail4').val(),
								'correo': $('#inputPassword4').val(),
								'mensaje' : $('#message').val(),
								'entradaID': <?php echo $dato ?>,
								'estado': 'ninguno'
							}
							console.log(listaRetornar);
							return listaRetornar;
						}
						function validarCamposComentario(){
							count=0;
							if($('#inputEmail4').val() != ""){
								count++;
								$('#error-nombre').empty();
							}else{
								$('#error-nombre').html("<label style='color: white; background: #c51244 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;'> El nombre es obligatorio</label>");
							}
							if($('#inputPassword4').val() != ""){
								count++;
								$('#error-correo').empty();
							}else{
								$('#error-correo').html("<label style='color: white; background: #c51244 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;'> El correo es obligatorio </label>");
							}
							if($('#message').val() != ""){
								count++;
								$('#error-mensaje').empty();
							}else{
								$('#error-mensaje').html("<label style='color: white; background: #c51244 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;'> Es necesario un comentario </label>");
							}
							if(!validateEmail($('#inputPassword4').val())) { /* do stuff here */ 
								$('#error-correo').html("<label style='color: white; background: #c51244 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;'> Es necesario un correo valido </label>");
							}else{
								count++
							}
							if(count==4){
								return true;
							}else{
								return false;
							}
						}
						function validateEmail($email) {
							var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
							return emailReg.test( $email );
							}
					</script>
					<div>
					<?php
					//Inserta los ultimos 4 noticias Comunidad Politecnica
					//$sql = "SELECT M.nombre, M.correo, M.asunto, M.mensaje, F.Nombre_facu, C.Nombre_carrera FROM mensajes M JOIN  facultades F ON M.facultadID = F.ID JOIN carreras C ON M.carreraID = C.ID";
					$consulta = "SELECT * FROM comentarios WHERE (entradaID = $dato) AND (estado='show') ORDER BY ID";
					$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
					while($row = mysqli_fetch_array($resultado)){ ?>
					<hr>
					<article>
					<div style="border: #2B2B2B 2px ridge ; border-radius: 5px; background:#fff;">
					<div style="background:#2B2B2B;">
					<h5 style="margin: 1% 2%; display:inline-block; color:#fff;"><?php echo $row['nombre'] ?></h5><h6 style="font-weight: 500; color:#fff; margin: 1% 2%; float: right; text-align:right;"><?php echo $row['fechaCreacion'] ?></h6>
					</div>
						<p style=" margin: 1% 2%;"><?php echo $row['mensaje'] ?></p>
					</div>
					</article>
						<?php
					}
					?>
					</div>
				<hr>
				<br>
				<div class="read-more" style="text-align:center;"><a type="button" href="catalogo.php?ID=4">Lee Todos Nuestros Post</a></div>

				</article>

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
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.bxslider.js"></script>
		<script src="js/mooz.scripts.min.js"></script>
	</body>

</html>