<?php 
//Configuración del algoritmo de encriptación

//Debes cambiar esta cadena, debe ser larga y unica
//nadie mas debe conocerla
$clave  = 'FederacionDeEstudiantesDeLaEscuelaPolitecnicaNacional';

//Metodo de encriptación
$method = 'aes-256-cbc';

// Puedes generar una diferente usando la funcion $getIV()
$iv = base64_decode("C9fBxl1EWtYTL1/M8jfstw==");

 /*
 Encripta el contenido de la variable, enviada como parametro.
  */
 $encriptar = function ($valor) use ($method, $clave, $iv) {
     return openssl_encrypt ($valor, $method, $clave, false, $iv);
 };

 /*
 Desencripta el texto recibido
 */
 $desencriptar = function ($valor) use ($method, $clave, $iv) {
     $encrypted_data = base64_decode($valor);
     return openssl_decrypt($valor, $method, $clave, false, $iv);
 };

 /*
 Genera un valor para IV
 */
 $getIV = function () use ($method) {
     return base64_encode(openssl_random_pseudo_bytes(openssl_cipher_iv_length($method)));
 };

 //Desencripta información:
  $dato_encriptado = $_GET['usuario'];
  $dato_desencriptado = $desencriptar($dato_encriptado);
  //echo 'Dato desencriptado: '. $dato_desencriptado . '<br>';
  if($dato_desencriptado !="FEPON"){
    header("Location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- full calendar -->
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!--Dinamic Tables-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"/>
    
	<!-- full calendar -->
	<link href='fullcalendar/lib/main.css' rel='stylesheet'/>

    <script src='fullcalendar/lib/main.js'></script>
    <script src='fullcalendar/lib/locales/es.js'></script>
    <script src = "https://code.jquery.com/jquery-3.0.0.min.js"> </script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src = "https://code.jquery.com/jquery-3.0.0.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

          document.addEventListener('DOMContentLoaded', function() {
            var idActual = "";
            var urlImageActual = "";
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                height: 700,
                droppable: true,
                locale: 'es',
                showNonCurrentDates: false,
                selectable: true,
                initialView: 'dayGridMonth',
                headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,Miboton' //,timeGridWeek,listWeek
                },
                customButtons:{
                    Miboton:{
                        text:"Boton 1",
                        click: function() {
                            alert('this button has been clicked!');
                            $("#exampleModal").modal("show");
                        }
                    }
                },
                dateClick: function(info) { //Funcion que opera sobre los cuadros del dia del mes
                    //limpiarModal();
                    reiniciarFormularioDateClick(info);
                    $('#modalForm').modal('show');
                },
                //eventSources:[{ //eventos, cuando accedemos a color, textcolor, entre otros lo ponemos dentro de eventSources
                events: 'eventos.php',
                eventClick: function(info) { //actua sobre los eventos en el calendario
                  //limpiarModal();
                  $('#imagenEvento').html("");
                  $('#videoEvento').html("");
                  urlImageActual=""
                  fechaHora= info.event.start.toISOString();
                  var fechaSeparada = fechaHora.split("T");
                  if(info.event.end){
                    fechaHoraFin= info.event.end.toISOString();
                    var fechaSeparadaFin = fechaHoraFin.split("T");
                    $('#fecha_fin_m').val(fechaSeparadaFin[0]);
                    $('#hora_fin_m').val(fechaSeparadaFin[1]);
                  };
                  $('#titulo_m').val(info.event.title);
                  $('#descripcion_m').val(info.event.extendedProps.descripcion);
                  $('#fecha_m').val(fechaSeparada[0]);
                  $('#hora_m').val(fechaSeparada[1]);
                  $('#estilo_m').val(info.event.backgroundColor);
                  $('#archivo_m').val("");
                  idActual = info.event.extendedProps.ID;
                  console.log(info.event.extendedProps.imageurl)
                  if(info.event.extendedProps.imageurl!=""){
                    urlImageActual = info.event.extendedProps.imageurl;
                    urlSeparado=urlImageActual.split(".");
                    tipoArchivo =urlSeparado[urlSeparado.length - 1]
                    console.log(tipoArchivo);
                    if(tipoArchivo=="mp4" || tipoArchivo=="avi"){
                      //document.getElementById('imagenEvento').src=info.event.extendedProps.imageurl;
                      
                      $('#videoEvento').append('<video style="width:100%; max-width:500px; height:100%; max-height:500px;" controls><source src="'+info.event.extendedProps.imageurl+'" type="video/'+tipoArchivo+'"></video>');
                      console.log("es video")
                    }else if(tipoArchivo== "jpeg"|| tipoArchivo== "jpeg"|| tipoArchivo== "png"|| tipoArchivo== "gif" || tipoArchivo== "jpg"){
                      //info.event.extendedProps.imageurl
                      $('#imagenEvento').html('<div style="text-align:center;"><img style="width:100%; max-width:500px; height:100%; max-height:500px;" src="'+info.event.extendedProps.imageurl+'"></div>');
                      console.log("es imagen")
                    }
                    //document.getElementById('imagenEvento').type="video/mp4";
                    
                    $('#textoImagenEvento').html('Archivo actual');
                    $('#btnEliminar_image').html('Borrar');
                    $('#btnEliminar_image').attr("style","background-color:#CD6155 ; color:#F4F6F6;")
                  }else{
                    $('#textoImagenEvento').html('No tiene una imagen actualmente');
                    $('#imagenEvento').attr("src","");
                    $('#btnEliminar_image').empty();
                    $('#btnEliminar_image').attr("style","");
                  }
                  $('#successModal').empty();
                  //console.log(info.event.backgroundColor);
                  //console.log("color = "+ info.event.color);
                  //console.log("url image = "+info.event.extendedProps.imageurl);
                  /*
                  $('#tituloEvento').html(info.event.title);
                  $('#descripcionEvento').html(info.event.extendedProps.descripcion);
                  document.getElementById('imagenEvento').src="./"+info.event.extendedProps.imageurl;
                  */
                  $('#exampleModal').modal('show');
                }
            });
            
            $('#btnEliminar_image').click(function(){
              urlImageActual = "";
              $('#imagenEvento').attr("src", urlImageActual);
              console.log("imagen lista para borrar");
            });
            

            function reiniciarFormularioDateClick(info){
              $('#fecha').val(info.dateStr);
              $('#hora').val("07:00");
              $('#titulo').val("");
              $('#descripcion').val("");
              $('#archivo').empty();
              $('#archivo').val("");
              $('#estilo').val("#fd7e14");
              $('#fecha_fin').val(info.dateStr);
              $('#hora_fin').val("07:00");
              //$('#imagenEvento').val("");
            }
            function limpiarModal(){
                  $('#tituloEvento').html('');
                  $('#descripcionEvento').html('');
                  document.getElementById('imagenEvento').src="";
            }
            $("#btnAgregar").click(function(){
    
              if(validarDatos()==true){
                console.log("validacion de datos aceptada");
                if(validarImagen()==true){
                  console.log("imagen valida");
                  agregarImagen();
                  agregarRegistro(recuperarDatosFormulario());
                }else{
                  console.log("La imagen sera nula");
                  agregarRegistro(recuperarDatosFormulariosinImagen());
                }
                $('#modalForm').modal('hide');
              }else{
                console.log("al parecer no :v");
              }
            });
            $("#btnModificar_m").click(function(){
              $('#successModal').empty();
              $('#archivo').empty();
              if(validarDatosModificar()==true){
                console.log("validacion de datos modificados aceptada");
                if(validarImagenModificada()=="nuevo"){
                  agregarImagenModificada();
                  console.log("imagen valida modificada o subida");
                  updateRegistro(recuperarDatosFormularioModificado());
                  $('#successModal').html(" Evento actualizado exitosamente!");
                  $('#successModal').attr("style","color:white; text-align: center; background: #2B6C34 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;");
                  
                }
                else if(validarImagenModificada()=="nuevo_sin_imagen"){
                  //agregarImagenModificada();
                  console.log("la imagen se ha mantenido");
                  updateRegistro(recuperarDatosFormularioModificado());
                  $('#successModal').html(" Evento actualizado exitosamente!");
                  $('#successModal').attr("style","color:white; text-align: center; background: #2B6C34 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;");
                }
                else{
                  console.log("La imagen sera nula");
                  updateRegistro(recuperarDatosFormulariosinImagenModificado());
                  $('#successModal').html(" Evento actualizado exitosamente!");
                  $('#successModal').attr("style","color:white; text-align: center; background: #2B6C34 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;");
                }
                
                //$('#modalForm').modal('hide');
              }else{
                console.log("al parecer no :v");
              }
            });
            $("#btnEliminar_m").click(function(){
              deleteRegistro();
              $('#exampleModal').modal('hide');
            });
            // funciones para comunicarse con el servidor via ajax
            function validarImagen(){
              //Verifica si una imagen es vacia o nula por el valor que tenga en file[0]
              console.log(document.getElementById('archivo').files[0]);
              if (document.getElementById('archivo').files[0]=="" || document.getElementById('archivo').files[0]==null ){
                console.log("Imagen vacia");
                urlImageActual = "";
                return false;
              }
              console.log("imagen"+document.getElementById('archivo').files[0].name);
              return true;
            }
            function validarImagenModificada(){
              //Verifica si una imagen es vacia o nula por el valor que tenga en file[0]
              console.log("holaaa "+ document.getElementById('archivo_m').files[0]);
              if(document.getElementById('archivo_m').files[0]!=undefined ){
                console.log("Si existe una imagen para subir")
                urlImageActual = "images/stored/"+document.getElementById('archivo_m').files[0].name
                return "nuevo";
              }
              if (urlImageActual != ""){
                console.log("Si existe una imagen almacenada")
                return "nuevo_sin_imagen";
              }
              console.log("No se encontro imagen almacenada o por subir")
              return false;
            }
            
            function validarDatos(){
              var count=0;
              //Verifica que los campos de TITULO y DESCRIPCION tengan texto.
              $("#mensajeTitulo").empty();
              $("#mensajeDescripcion").empty();
              $('#errorFormato').remove();
              //$('#archivo').get(0).nextSibling;
              //$('.flagstrap-icon').get(0).nextSibling.remove()
              //$('#archivo').empty();
              var title= $("#titulo").val();
              var descripcion= $("#descripcion").val();
                if(title==""){
                  $("#mensajeTitulo").append("<label style='color:white; background: #c51244 !important; box-shadow: 1px 1px 1px #aaaaaa;'>El titulo es obligatorio</label>");
                  count++;
                }
                if(descripcion==""){
                  $("#mensajeDescripcion").append("<label style='color:white; background: #c51244 !important; box-shadow: 1px 1px 1px #aaaaaa;'>La descripcion es obligatoria</label>");
                  count++;
                }
              
              if($('#archivo') != ""){
                var filename = $('#archivo').val().split('\\').pop();
                urlSeparado=filename.split(".");
                var tipoArchivo =urlSeparado[urlSeparado.length - 1];
                if(tipoArchivo== "jpeg"|| tipoArchivo== "jpeg"|| tipoArchivo== "png"|| tipoArchivo== "gif" || tipoArchivo== "jpg"){
                    console.log("es correcto")
                    }else{
                      $('#archivo').after('<label  id="errorFormato" style="color:white; background: #D4AC0D !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;"> Solo se aceptan imagenes con formato jpg/jpeg/png/gif</label>');
                      count++;                
                    }
              }
              if(count==0){
                return true;
              }else{
                return false;
              }
            }
              //imageurl: "images/stored/"+document.getElementById('archivo').files[0].name
            
            function validarDatosModificar(){
              //Verifica que los campos de TITULO y DESCRIPCION tengan texto.
              $("#mensajeTitulo_m").empty();
              $("#mensajeDescripcion_m").empty();
              $('#errorVideo_m').empty();
              var title= $("#titulo_m").val();
              var count=0;
              var descripcion= $("#descripcion_m").val();
                if(title==""){
                  $("#mensajeTitulo_m").append("<label style='color:white; background: #c51244 !important; box-shadow: 1px 1px 1px #aaaaaa;'>El titulo es obligatorio</label>");
                  count++;
                }
                if(descripcion==""){
                  $("#mensajeDescripcion_m").append("<label style='color:white; background: #c51244 !important; box-shadow: 1px 1px 1px #aaaaaa;'>La descripcion es obligatoria</label>");
                  count++;
                }
                if($('#archivo_m') != ""){
                var filename = $('#archivo_m').val().split('\\').pop();
                urlSeparado=filename.split(".");
                var tipoArchivo =urlSeparado[urlSeparado.length - 1];
                if(tipoArchivo== "jpeg"|| tipoArchivo== "jpeg"|| tipoArchivo== "png"|| tipoArchivo== "gif" || tipoArchivo== "jpg"){
                    console.log("es correcto")
                    }else{
                      $('#archivo_m').after('<label id="errorVideo_m" style="color:white; background: #D4AC0D !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;">  Solo se aceptan imagenes con formato jpg/jpeg/png/gif </label>');
                      count++;                
                    }
                }
                if(count==0){
                  return true;
                }else{
                  return false;
                }
              //imageurl: "images/stored/"+document.getElementById('archivo').files[0].name
            }

            function agregarImagen(){
            //Agrega una imagen a un directorio y obtiene su url. Si el directorio no existe, lo crea (PHP)
              var formData = new FormData();
                var files = $('#archivo')[0].files[0];
                formData.append('file',files);
                
                $.ajax({
                    url: 'uploadImage.php',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                      console.log("exito! de imagen");
                      urlImageActual = response;
                    }
                });
                return false;
            }

            function agregarImagenModificada(){
            //Agrega una imagen a un directorio y obtiene su url. Si el directorio no existe, lo crea (PHP)
              var formData = new FormData();
                var files = $('#archivo_m')[0].files[0];
                formData.append('file',files);
                $.ajax({
                    url: 'uploadImage.php',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                      console.log("exito! de imagen modificada");
                      console.log(response);
                      $('#imagenEvento').attr("src", response);
                      urlImageActual = response;
                      //$("#archivo").attr("value", response)
                      /*
                        if (response != 0) {
                          alert("Exito");
                            //$(".card-img-top").attr("src", response);
                        } else {
                            alert('Formato de imagen incorrecto.');
                        }
                        */
                    }
                });
                return false;
            }
            function agregarRegistro(datos) {
              console.log(datos);
              $.ajax({  
                  type: 'POST',
                  url: 'datoseventos.php?accion=agregar',
                  data: datos,
                  success: function(msg) {
                    console.log(msg)
                    calendar.refetchEvents()
                  },
                  error: function(error) {
                      alert("Hay un problema:" + error);
                    }
                });
            };
            function updateRegistro(datos) {
              console.log(datos);
              $.ajax({  
                  type: 'POST',
                  url: 'datoseventos.php?accion=actualizar',
                  data: datos,
                  success: function(msg) {
                    console.log("exito");
                    calendar.refetchEvents()
                  },
                  error: function(error) {
                      alert("Hay un problema:" + error);
                    }
                });
            };
            function deleteRegistro() {
              $.ajax({  
                  type: 'POST',
                  url: 'datoseventos.php?accion=eliminar',
                  data: {
                    id: idActual			
                  },
                  success: function(msg) {
                    console.log("evento eliminado");
                    calendar.refetchEvents()
                  },
                  error: function(error) {
                      alert("Hay un problema:" + error);
                    }
                });
            };
            
            function recuperarDatosFormulario() {
              var nuevoEvento={
                id: idActual,
                title: $("#titulo").val(),
                descripcion: $("#descripcion").val(),
                color: $("#estilo").val(),
                textColor:"#FDFEFE",
                start: $("#fecha").val()+" "+$("#hora").val(),
                end: $("#fecha_fin").val()+" "+$("#hora_fin").val(),
                imageurl: "images/stored/"+ document.getElementById('archivo').files[0].name
              };
                  return nuevoEvento;
            };
                
            function recuperarDatosFormularioModificado() {
              console.log("url actual es = "+ urlImageActual);
              var nuevoEvento={
                id: idActual,
                title: $("#titulo_m").val(),
                descripcion: $("#descripcion_m").val(),
                color: $("#estilo_m").val(),
                textColor:"#FDFEFE",
                start: $("#fecha_m").val()+" "+$("#hora_m").val(),
                end: $("#fecha_fin_m").val()+" "+$("#hora_fin_m").val(),
                imageurl: urlImageActual
              };
                  return nuevoEvento;
            };

            function recuperarDatosFormulariosinImagen() {
              var nuevoEvento={
                id: idActual,
                title: $("#titulo").val(),
                descripcion: $("#descripcion").val(),
                color: $("#estilo").val(),
                textColor:"#FDFEFE",
                start: $("#fecha").val()+" "+$("#hora").val(),
                end: $("#fecha_fin").val()+" "+$("#hora_fin").val(),
                imageurl: ""
              };
                  return nuevoEvento;
            };
            function recuperarDatosFormulariosinImagenModificado() {
              var nuevoEvento={
                id: idActual,
                title: $("#titulo_m").val(),
                descripcion: $("#descripcion_m").val(),
                color: $("#estilo_m").val(),
                textColor:"#FDFEFE",
                start: $("#fecha_m").val()+" "+$("#hora_m").val(),
                end: $("#fecha_fin_m").val()+" "+$("#hora_fin_m").val(),
                imageurl: ""
              };
                  return nuevoEvento;
            };
          calendar.render();
          });

        </script>
</head>
<body style="font-family:Raleway, Sans-serif;">
<?php 
        include 'conexion.php';
    ?>
<div class="container" >
<!-- Revision de mensajes  -->
<br>
  <div id="menuPrincipal" style="text-align:center; border:2px solid;">
  <br>
  <h3>Menu Principal</h3>
  <br>
  <a name="btnMensajes" id="btnMensajes" class="btn btn-primary" href="#tablaMensaje" role="button">Buzon</a><br><br>
  <a name="btnCalendario" id="btnCalendario" class="btn btn-primary" href="#tablaCalendario" role="button">Calendario</a><br><br>
  <a name="btnInformacion" id="btnInformacion" class="btn btn-primary" href="#seccionPost" role="button">Posts</a><br><br>
  <a name="btnPalabrasClave" id="btnNoticias" class="btn btn-primary" href="#seccionPalabrasClave" role="button">Palabras Clave</a><br><br>
  <a name="btnComentarios" id="btnNoticias" class="btn btn-primary" href="#seccionComentarios" role="button">Comentarios</a><br><br>
  </div>
  <br>
  <br>
  
  <div id="tablaMensaje" style="text-align:center; border:2px solid;" class="container">
    <br>
    <div class="row">
      <div class="col">
        <h3 style="text-align:left;">Mensajes</h3>
      </div>
      <div style="text-align:right;"class="col">
        <a name="btnAtras" id="btnAtras" class="btn btn-primary" href="#menuPrincipal" role="button">Atras</a>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col">
          <table id="mensajesTable" class="table table-responsive table-striped ">
            <thead class="thead-inverse">
                <tr>
                    <th>FECHA DE CREACION</th>
                    <th>NOMBRE</th>
                    <th>CORREO</th>
                    <th>FACULTAD</th>
                    <th>CARRERA</th>
                    <th>ASUNTO</th>
                    <th class="display responsive nowrap">MENSAJE</th>
                    <th>OPCIONES</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //Consulta los mensajes y los inserta en la tabla de mensajes - Tambien conecta el boton eliminar con cada ID de mensaje
                //$sql = "SELECT M.nombre, M.correo, M.asunto, M.mensaje, F.Nombre_facu, C.Nombre_carrera FROM mensajes M JOIN  facultades F ON M.facultadID = F.ID JOIN carreras C ON M.carreraID = C.ID";
                $consulta = "SELECT M.ID, M.fecha_creacion, M.nombre, M.correo, M.asunto, M.mensaje, F.Nombre_facu, C.Nombre_carrera FROM mensajes M JOIN  facultades F ON M.facultadID = F.ID JOIN carreras C ON M.carreraID = C.ID";
                $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                while($row = mysqli_fetch_array($resultado)){ ?>
                    <tr>
                        <td><?php echo $row['fecha_creacion'] ?></td>
                        <td><?php echo $row['nombre'] ?></td>
                        <td><?php echo $row['correo'] ?></td>
                        <td><?php echo $row['Nombre_facu'] ?></td>
                        <td><?php echo $row['Nombre_carrera'] ?></td>
                        <td><?php echo $row['asunto'] ?></td>
                        <td><?php echo $row['mensaje'] ?></td>
                        <!--<td><a href="edit.php?id=<?php echo $row['M.ID'];?>">Editar</a></td>-->
                        <td><a class="btn btn-danger" href="deleteMensaje.php?id=<?php echo $row['ID'];?>"> Eliminar</a></td>
                    </tr>
                    <?php
                }
                ?>  
                </tbody>
          </table>
          <!--Plugin Table-->
          <script type="text/javascript">
              
              $('#mensajesTable').DataTable({
                  "language": {
                          "lengthMenu": "Mostrar _MENU_ registros",
                          "zeroRecords": "No se encontraron resultados",
                          "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                          "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                          "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                          "sSearch": "Buscar:",
                          "oPaginate": {
                              "sFirst": "Primero",
                              "sLast":"Último",
                              "sNext":"Siguiente",
                              "sPrevious": "Anterior"
                    },
                    "sProcessing":"Procesando...",
                      }
              });


          </script>
      </div>
    </div> 
    <br>
  <br>
  </div>
  
  <?php
  /*
                      echo "<table class='table' borde='2'>";
                      echo "<thead>";
                      echo "<tr>";
                      echo "<th>ID</th>";
                      echo "<th>NOMBRE</th>";
                      echo "<th>CORREO</th>";
                      echo "<th>FACULTAD</th>";
                      echo "<th>CARRERA</th>";
                      echo "<th>ASUNTO</th>";
                      echo "<th>MENSAJE</th>";
                      echo "<th>FECHA DE CREACION</th>";
                      echo "<th>OPERACIONES</th>";
                      echo "</tr>";
                      echo "</thead>";
                      echo "<tbody>";
                      while ($columna = mysqli_fetch_array( $resultado ))
                      {
                          echo "<tr>";
                          echo "<td>" . $columna['ID'] . "</td><td>" . $columna['nombre'] . "</td><td>" . $columna['correo'] . "</td><td>" . $columna['facultadID'] . "</td><td>" . $columna['carreraID'] . "</td><td>" . $columna['asunto'] . "</td><td>" . $columna['mensaje'] . "</td><td>" . $columna['fecha_creacion'] . "</td>";                        
                          echo "<td>
                          <a href=''>Editar</a>
                          <a href=''>Eliminar</a>
                              </td>";
                          echo "</tr>";
                      }
                      echo "</tbody>";
                      echo "</table>";
                      */
  ?>
  <br>
  <br>
  <br>
  <!-- Crud Calendario-->   
  <div id="tablaCalendario" style="text-align:left; border:2px solid;" class="container">
    <br>
    <div class="row">
      <div class="col">
        <h3 style="text-align:left;">Calendario</h3>
      </div>
      <div style="text-align:right;"class="col">
        <a name="btnAtras" id="btnAtras" class="btn btn-primary" href="#menuPrincipal" role="button">Atras</a>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col">
  
        <div id='calendar'></div>
        <!--Plugin Fullcalendar-->
        
      </div>
      <div>
  <!-- Modal para (edita y elimina) eventos-->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#2B2B2B; color:#F4F6F6;  ">
          <h5 class="modal-title" id="tituloEvento"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#exampleModal').modal('toggle');">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group"> <label for="fecha_m">FECHA DE INICIO</label><input type="date" id="fecha_m" name="fecha_m" class="form-control"></div>
          <div class="form-group"><label for="hora_m">HORA DE INICIO</label><input type="time" id="hora_m" name="hora" value="07:00" class="form-control"></div>
          <div class="form-group"><label for="titulo_m">TITULO </label><div id="mensajeTitulo_m"></div><input type="text" id="titulo_m" name="titulo" class="form-control"></div>
          <div class="form-group"><label for="descripcion_m">DESCRIPCION </label><div id="mensajeDescripcion_m"></div><textarea type="text" id="descripcion_m" name="descripcion" row="3" class="form-control"></textarea></div>
          <div class="form-group"> <label for="fecha_fin_m">FECHA DE FIN</label><input type="date" id="fecha_fin_m" name="fecha_fin" class="form-control"></div>
          <div class="form-group"><label for="hora_fin_m">HORA DE FIN</label><input type="time" id="hora_fin_m" name="hora_fin" value="07:00" class="form-control"></div>
          <div class="form-group"><label for="archivo_m">IMAGEN </label> <input type="file" name="archivo" id="archivo_m" class="form-control"><br><div  id="imagenEvento"></div><div id="videoEvento"></div>
<br><label id="textoImagenEvento"></label><br><button type="button" class="btn" id="btnEliminar_image"></button></div>
          
          <div class="form-group"><label for="estilo">COLOR </label><input type="color" value="#fd7e14" id="estilo_m" class="form-control"></div>
          <p id="successModal"></p>                
        </form>
          <!--
        <p id="descripcionEvento"></p>
        <img id="imagenEvento" style="width:100%">
        -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn" id="btnModificar_m" style="background-color:#F1C40F; color:#F4F6F6;">Modificar</button>  
          <button type="button" class="btn" id="btnEliminar_m" style="background-color:#CD6155 ; color:#F4F6F6;">Borrar</button>    
          <button type="button" class="btn btn-secondary" id="btnAgregar_m" data-dismiss="modal"  onclick="$('#exampleModal').modal('toggle');">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal para (crear,edita y elimina) eventos (agrega,edita y elimina)-->
  <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#2B2B2B; color:#F4F6F6;  ">
          <h5 class="modal-title" id="tituloForm"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modalForm').modal('toggle');">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

      <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group"> <label for="fecha">FECHA DE INICIO</label><input type="date" id="fecha" name="fecha" class="form-control"></div>
      <div class="form-group"><label for="hora">HORA DE INICIO</label><input type="time" id="hora" name="hora" value="07:00" class="form-control"></div>
      <div class="form-group"><label for="titulo">TITULO </label><div id="mensajeTitulo"></div><input type="text" id="titulo" name="titulo" class="form-control"></div>
      <div class="form-group"><label for="descripcion">DESCRIPCION </label><div id="mensajeDescripcion"></div><textarea type="text" id="descripcion" name="descripcion" row="3" class="form-control"></textarea></div>
      <div class="form-group"> <label for="fecha">FECHA DE FIN</label><input type="date" id="fecha_fin" name="fecha_fin" class="form-control"></div>
      <div class="form-group"><label for="hora">HORA DE FIN</label><input type="time" id="hora_fin" name="hora_fin" value="07:00" class="form-control"></div>
      <div class="form-group"><label for="descripcion">IMAGEN </label> <input type="file" name="archivo" id="archivo" class="form-control"></div>
      <div class="form-group"><label for="estilo">COLOR </label><input type="color" value="#fd7e14"id="estilo" class="form-control"></div>
      
      </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn" id="btnAgregar" style="background-color:#1ABC9C; color:#F4F6F6;">Agregar</button>   
          <button type="button" class="btn btn-secondary" data-dismiss="modal"  onclick="$('#modalForm').modal('toggle');">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<br>
</div>
<br><br>
<section id="seccionPost" class="container" style="text-align:left; border:2px solid;">
  <br>
    <div class="row">
      <div class="col">
        <h3 style="text-align:left;">Posts</h3>
      </div>
      <div style="text-align:right;"class="col">
        <a name="btnAtras" id="btnAtras" class="btn btn-primary" href="#menuPrincipal" role="button">Atras</a>
      </div>
    </div>
    <br>
  <div class="row">
    <div class="col-md-4">
      <div style="margin-left:7%; margin-bottom:10%;">
        <button type="button" id="btnCreateEntrada"class="btn btn-primary">Cree una entrada</button>
        <br>
        <br>
        <button type="button" id="btnAdminEntradas"class="btn btn-primary">Administre sus entradas</button>
        <br>
        <br>
        <button type="button" id="btnAdminEntradaPost"class="btn btn-primary">Conecte con un Evento</button>
      </div>
    </div>
    <div class="col">
      <div id="formAgregarPost" style="margin-right:7%; margin-bottom:10%; display:none;">
          <h3>Area de Posts</h3>
          <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group"> <label for="postSegmento">SEGMENTO</label><select type="select" class="form-control"  id="postSegmentoID" name="postSegmento" title="Seleccione una facultad" aria-describedby="facultadHelp" >
              <option  value="">  Elija un segmento</option>
              <?php
              include 'conexion.php';
              $consulta = "SELECT * FROM subcategorias";
              $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
              
                while ($columna1 = mysqli_fetch_array( $resultado ))
                {
                  echo '<option value="'.$columna1['ID'].'">'.$columna1['nombre'].'</option>';
                  #echo "<h5 class='text-center'>" . $columna1['nombre'] . "</h5><h6 class='text-center'>" . $columna1['message'] . "</h6>";
                }
              ?>
              </select>	
              <div id="error-segmento"></div>
          </div>
          
          <div class="form-group"><label for="postTitulo">TITULO</label><input type="text" id="postTituloID" name="postTitulo" placeholder="Ingrese un titulo" class="form-control" ><div id="error-titulo"></div></div>
          
          <div class="form-group"><label for="postDescripcion">DESCRIPCION</label><div id=""><textarea type="text" class="form-control" id="postDescripcionID" name="postMensaje" aria-describedby="messageHelp" rows="3" maxlength="5000" placeholder="Ingrese un mensaje para su posts"></textarea><div id="error-descripcion"></div></div>
          
          <div class="form-image-1"><label for="postUrlImageContenido">INSERTE IMAGEN(ES) IMAGEN PARA EL  CONTENIDO POST MAX(3)</label><input type="file" id="postUrlImagenContenidoID" name="postUrlImageContenido[]" placeholder="Ingrese una imagen para el post"row="3" class="form-control" multiple><div id="error-message" ></div></div>
          
            <div class="form-group"> <label for="postUrlImageShow">INSERTE UNA IMAGEN PARA LA EXHIBICION DEL POST </label><input type="file" id="postUrlImagenShowID" name="postUrlImageShow" placeholder="Ingrese una imagen para mostrar en los slider y acceso al post"class="form-control" ><div id="error-image-2"></div></div>
            <br>
            <div class="form-group"> <label for="postUrlVideoShow">INSERTE UN VIDEO PARA LA EXHIBICION DEL POST </label><input type="file" id="postUrlVideoShowID" name="postUrlVideoShow" placeholder="Ingrese un video para mostrar en los slider y acceso al post"class="form-control" ><div id="errorVideoPost"></div></div>
            <button  type="button"  id="btnPostAgregar"  class="btn" style="background-color:#1ABC9C; color:#F4F6F6;" >Agregar</button>  
          </form>
          <br>
          <br>
          <div id="mensajeFinal"></div> 
        </div>
        
        
      </div>
      <!-- Area de administracion-->
      <div id="adminPost"style="margin-right:7%; margin-bottom:10%; display:none;">
        <h3>Area de  Administracion de Posts</h3>
        <table id="mensajesTable1" class="table table-responsive table-striped display responsive nowrap" style="width:80%; height:100%;" >  
            <thead class="thead-inverse">
                <tr>
                    <th>FECHA DE CREACION</th>
                    <th>TITULO</th>
                    <th>SEGMENTO</th>
                    <th>CONTENIDO</th>
                    <th>EDICION</th>
                    <th>ELIMINACION</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //Consulta los mensajes y los inserta en la tabla de mensajes - Tambien conecta el boton eliminar con cada ID de mensaje
                //$sql = "SELECT M.nombre, M.correo, M.asunto, M.mensaje, F.Nombre_facu, C.Nombre_carrera FROM mensajes M JOIN  facultades F ON M.facultadID = F.ID JOIN carreras C ON M.carreraID = C.ID";
                $consulta = "SELECT e.ID,titulo,descripcion,urlImagenTitulo,fechaCreacion, s.nombre FROM  entradas e JOIN subcategorias s ON  e.subcategoriaID = s.ID";
                $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                while($row = mysqli_fetch_array($resultado)){ ?>
                    <tr id="filaPost<?php echo $row['ID'];?>">
                        <td><?php echo $row['fechaCreacion'];?></td>
                        <td><?php echo $row['titulo'];?></td>
                        <td><?php echo $row['nombre'];?></td>
                        <td><button  type="button"  id="btnVerContenido<?php echo $row['ID'];?>" onclick="verContenidoPost(this)" class="btn btn-success" value="<?php echo $row['ID'];?>"> Ver Contenido</button>  </td>
                        <td><button  type="button"  id="btnModificarPost<?php echo $row['ID'];?>" onclick="editarContenidoPost(this)" class="btn btn-warning" value="<?php echo $row['ID'];?>">Editar Post</button>  </td>
                        <td><button  type="button"  id="btnEliminarPost<?php echo $row['ID'];?>"  onclick="eliminarContenidoPost(this)" class="btn btn-danger" value="<?php echo $row['ID'];?>">Eliminar</button>  </td>
                        <!--<td><a href="edit.php?id=<?php echo $row['M.ID'];?>">Editar</a></td>-->
                    </tr>
                    <?php
                }
                ?>
                </tbody>
          </table>
          
          <!-- Modal para VER CONTENIDO  de los post-->
          <div class="modal fade" id="modalContenidoPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#2B2B2B; color:#F4F6F6;  ">
                  <h5 class="modal-title" id="tituloEvento"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modalContenidoPost').modal('toggle');">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group" style="font-weight:700;">FECHA DE CREACION <br><label id="fechaPost"  style="font-weight:450;"></label><br></div>
                  <div class="form-group" style="font-weight:700;">TITULO <br><label id="tituloPost" style="font-weight:450; width:100%;"> </label></div>
                  <div class="form-group" style="font-weight:700;">CONTENIDO <br><label id="contenidoPost" style="font-weight:450; width:100%;"> </label></div>
                  <div class="form-group" style="font-weight:700;">IMAGEN(ES) CONTENIDO <br><label id="imagenContenidoPost" style="font-weight:450; text-align:center;"></label></div>
                  <div class="form-group" style="font-weight:700;">IMAGEN PRINCIPAL <br><label id="imagenTituloPost" style="font-weight:450;  text-align:center;"></label></div>
                  <div id="videoPostNew"></div>
                  <p id="successModal"></p>
                </form>
                  <!--
                <p id="descripcionEvento"></p>
                <img id="imagenEvento" style="width:100%">
                -->

                </div>
                <div class="modal-footer">   
                  <button type="button" class="btn btn-secondary" id="btnAgregar_m" data-dismiss="modal"  onclick="$('#modalContenidoPost').modal('toggle');">Cerrar</button>
                </div>
              </div>
            </div>

          </div>
          <br>
            <button class="btn btn-success" id="btnRecargar">Recargar Pagina<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
            </svg> </button>
            <!--Entradas-->
          <script type="text/javascript">
              function irNotificaciones(){
                console.log("hola mundo")
                $('#defaultContenido').hide();
                $('#tablaTodoContenido').hide();
                $('#tablaNewContenido').show();
              }
              function irTodosComentarios(){
                $('#defaultContenido').hide();
                $('#tablaNewContenido').hide();
                $('#tablaTodoContenido').show();
              }
            document.addEventListener('DOMContentLoaded', function() {
              function sleep (ms) { return new Promise(r => setTimeout(r, ms)); }
              (async function slowDemo () {
                console.log('Starting slowDemo ...');
                $('#tablaNewContenido').hide();
                $('#tablaTodoContenido').hide();
                $('#areaPostEventos').hide();
                //await sleep(2000);
                $.ajax({
                url: 'datoseventos.php?accion=obtenerComentarios',
                type: 'post',
                data: { 'id' : 'dato'},
                contentType: false,
                processData: false,
                success: function(response) {
                  //console.log(response);
                  var obj = $.parseJSON(response);
                  var count=0;
                  for(var i = 0; i< obj.length; i++){ 
                    if(obj[i]['estado']=='ninguno'){
                      count++;
                    }
                  }
                  if(count>0){
                    $('#cajaNotificacion').before('<p>'+count+' nuevo(s) Mensajes <img style="width:12%;"src="images/tenor.gif"></p>')
                    $('#cajaNotificacion').html('<button name="" id="btnNewNotifies" class="btn btn-primary" onclick="irNotificaciones();">Nuevas Notificaciones</button> <br><br>');
                  }
                  
                }
                });
                console.log('slowDemo: TWO seconds later ...');
              })();
              /*

              */

              function limpiarFormPost(){
                  $('#postSegmentoID').val('');
                  $('#postTituloID').val('');
                  $('#postDescripcionID').val('');
                  $('#postUrlImagenContenidoID').val('');
                  $('#postUrlImagenShowID').val('');
                  $('#errorVideoPost').empty();
                  $('#postUrlVideoShowID').val('');
                  $('#postUrlVideoShowID').empty();
                  
              }
              function obtenerDatos(){
                //var aleat = entierAleatoire(1, Math.pow(10,9)); //numero aleatorio para imagenes
                var filename = $('#postUrlImagenShowID').val().split('\\').pop();
                if($('#postUrlVideoShowID').val() != ""){
                  filenameVideoCortado = $('#postUrlVideoShowID').val().split('\\').pop();
                  filenameVideo = 'images/stored/externas/'+ filenameVideoCortado;
                }else{
                  filenameVideo = null;
                }
                var datos ={
                  segmento: $('#postSegmentoID').val(),
                  titulo : $('#postTituloID').val(),
                  descripcion:$('#postDescripcionID').val(),
                  urlImagenShow: 'images/stored/externas/'+filename,//$('#postUrlImagenShowID').val()
                  urlVideoPrincipal: filenameVideo
                }
                console.log(datos);
                return datos;
              }
            
              function agregarPost(datos){
                //Agrega un nuevo post
                console.log(datos);
                $.ajax({  
                    type: 'POST',
                    url: 'datoseventos.php?accion=agregarPost',
                    data: datos,
                    success: function(msg) {
                      console.log(msg)
                      agregarImagenShowPost();
                      agregarImagenPost();
                      agregarVideo();
                      if(msg){
                        console.log("por fin entro en true")  
                      }else{
                        console.log(typeof(msg));
                        $('#mensajeFinal').html("<label style='color:white; text-align: center; background: #c51244 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;'> No se puede enviar el mensaje por el momento</label>");
                      }
                      
                      return msg;
                    },
                    error: function(error) {
                        alert("Hay un problema:" + error);
                        $('#mensajeFinal').html("<label style='color:white; text-align: center; background: #c51244 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;'> No se puede agregar el post por el momento</label>");
                        console.log("error!!!!!!!!!!!!!!!!!!!!!")
                      }
                  });
              }
              $('#btnRecargar').click(function(){
                location.reload();
              })
              $('#btnCreateEntrada').click(function(){
                borrarDatosForm();
                $('#formAgregarPost').show();
                $('#adminPost').hide();
                $('#defaultPost').hide();
                $('#areaPostEventos').hide();
              });
              $('#btnAdminEntradas').click(function(){
                //

                $('#formAgregarPost').hide();
                $('#adminPost').show();
                $('#defaultPost').hide();
                $('#areaPostEventos').hide();
                //location.reload();
              });
              $('#cerrarEntrada').click(function(){
                //borrarDatosForm();
                $('#defaultPost').show();
                $('#formAgregarPost').hide();
                $('#adminPost').hide();
                $('#areaPostEventos').hide();
              });
              $('#btnAdminEntradaPost').click(function(){
                
                $('#formAgregarPost').hide();
                $('#adminPost').hide();
                $('#defaultPost').hide();
                $('#areaPostEventos').show();
              });
              $('#btnPostAgregar').click(function(){
                var contenido;
                var bandera=true
                borrarDatosForm();
                if(validarDatosPost()){
                  contenido =obtenerDatos();
                  agregarPost(contenido);
                  //location.reload();
                  //$('#btnPostAgregar').reload('#btnPostAgregar')
                  //$('#mensajesTable1'). ().reload();
                  //$("#mensajesTable1").data.reload();
                  //$("#adminPost").reload();
                  //table.ajax.reload();
                  //console.log(contenido);
                }
              });
              
              function obtenerDatosImagenes(id){
                let formData = new FormData();
                //console.log($('#postUrlImagenContenidoID')[0].files[0]);
                if($('#postUrlImagenContenidoID')[0].files[0] != undefined){
                  formData.append('file0',$('#postUrlImagenContenidoID')[0].files[0]);
                }
                if($('#postUrlImagenContenidoID')[0].files[1] != undefined){
                  formData.append('file1',$('#postUrlImagenContenidoID')[0].files[1]);
                }
                if($('#postUrlImagenContenidoID')[0].files[2] != undefined){
                  formData.append('file2',$('#postUrlImagenContenidoID')[0].files[2]);
                }
                formData.append('idPost',id);
              // Display the values
                for (var value of formData.values()) {
                  console.log(value);
                }
                return formData
                /*let urlsImagenes = {
                  
                }*/
              }
              function agregarVideo(){
                let formData = new FormData();
                if($('#postUrlVideoShowID')[0].files[0] != undefined || $('#postUrlVideoShowID')[0].files[0] != null || $('#postUrlVideoShowID')[0].files[0] != ""){
                  formData.append('file0',$('#postUrlVideoShowID')[0].files[0]);
                }
                $.ajax({
                      url: 'datoseventos.php?accion=agregarVideoInterno',
                      type: 'post',
                      data: formData,
                      contentType: false,
                      processData: false,
                      success: function(response) {
                        
                        console.log(response);
                        
                      }
                      });
              }
              function agregarImagenPost(){
                $.ajax({
                  url: 'datoseventos.php?accion=obtenerIDPostNuevo',
                  type: 'post',
                  data: false,
                  contentType: false,
                  processData: false,
                  success: function(response) {
                    var obj = $.parseJSON(response);
                    let archivosImagenes= obtenerDatosImagenes(obj[0]['id']);
                    //console.log($('#postUrlImagenContenidoID')[0].files[1].name);
                    //console.log($('#postUrlImagenContenidoID')[0].files[2]);
                    //var files2 = $('#postUrlImagenContenidoID')[0].files[2];
                    //formData.append('id', obj[0]['id']);
                    $.ajax({
                      url: 'datoseventos.php?accion=agregarPhotoPostInterno',
                      type: 'post',
                      data: archivosImagenes,
                      contentType: false,
                      processData: false,
                      success: function(response) {
                        
                        console.log(response);
                        $('#mensajeFinal').html("<label style='color:white; text-align: center; background: #2B6C34 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;'> Mensaje Enviado Exitosamente</label>");
                        limpiarFormPost();
                              //urlImageActual = response;
                      }
                      });
                            //urlImageActual = response;
                    }
                  });
                  
              };
              function agregarImagenShowPost(){
                    //Agrega una imagen a un directorio y obtiene su url. Si el directorio no existe, lo crea (PHP)
                    var formData = new FormData();
                  var files = $('#postUrlImagenShowID')[0].files[0];
                  //console.log($('#postUrlImagenShowID')[0].files[0]);
                  formData.append('file',files);
                  $.ajax({
                      url: 'datoseventos.php?accion=agregarPhotoPost',
                      type: 'post',
                      data: formData,
                      contentType: false,
                      processData: false,
                      success: function(response) {
                        console.log(response);
                        //urlImageActual = response;
                      }
                  });
                  return false;
              }
              function entierAleatoire(min, max)
              {
              return Math.floor(Math.random() * (max - min + 1)) + min;
              }
              //Utilisation
              //La variable contient un nombre aléatoire compris entre 1 et 10
              
              function borrarDatosForm(){
                $('#error-titulo').empty()
                $('#error-descripcion').empty()
                $('#error-segmento').empty()
                $('#error-image-1').empty()
                $('#error-image-2').empty()
              }

              function validarDatosPost(){
                $('#errorVideoShow').empty();
                $('#errorMultiimagenes0').empty();
                $('#errorMultiimagenes1').empty();
                $('#errorMultiimagenes2').empty();
                $('#errorMultiimagenes3').empty();
                $('#errorVideoPost').empty();
                $('#error-image-2').empty();
                let bandera = false;
                let contador = 0;

                console.log(tipoArchivo)
                if($('#postSegmentoID').val()=="" ){
                  $('#error-segmento').html("<label style='color:white; background: #c51244 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;'> Ingrese un Segmento valido, esto le permitira establecer la ubicacion donde se mostrara el post.</label>")
                    contador++;
                }if($('#postTituloID').val()=="" ){
                  $('#error-titulo').html("<label style='color:white; background: #c51244 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;'> Ingrese un Titulo valido.</label>")
                  contador++;
                }if($('#postUrlImagenShowID').val()=="" ){
                  $('#error-image-2').html("<label style='color:white; background: #c51244 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;'> Ingrese una imagen, esto le permitira tener una vista previa hacia el contenido del post</label>")
                  contador++;
                }if($('#postUrlVideoShowID')[0].files[0] != undefined || $('#postUrlVideoShowID')[0].files[0] != null){
                  var filename = $('#postUrlVideoShowID').val().split('\\').pop();
                  urlSeparado=filename.split(".");
                  var tipoArchivo =urlSeparado[urlSeparado.length - 1];
                  if(tipoArchivo == "mp4" || tipoArchivo == "avi"){
                    console.log("es correcto")
                    }else{
                      console.log($('#postUrlVideoShowID')[0].files[0])
                      $('#errorVideoPost').html('<label style="color:white; background: #D4AC0D !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;"> Solo se aceptan videos con formato mp4 / avi</label>');
                        contador++;                
                    }
                }if($('#postUrlImagenShowID')[0].files[0] != undefined || $('#postUrlImagenShowID')[0].files[0] != null){
                  var filename = $('#postUrlImagenShowID').val().split('\\').pop();
                  urlSeparado=filename.split(".");
                  var tipoArchivo =urlSeparado[urlSeparado.length - 1];
                  if(tipoArchivo== "jpeg"|| tipoArchivo== "jpeg"|| tipoArchivo== "png"|| tipoArchivo== "gif" || tipoArchivo== "jpg"){
                    console.log("es correcto")
                    }else{
                      console.log($('#postUrlImagenShowID')[0].files[0])
                      $('#error-image-2').html('<label style="color:white; background: #D4AC0D !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;">  Solo se aceptan imagenes con formato jpg/jpeg/png/gif </label>');
                        contador++;                
                    }
                }if($('#postUrlImagenContenidoID') != ""){
                  // Recorre el input multifile 
                  var files = document.getElementById("postUrlImagenContenidoID").files; 
                  for (var i = 0; i < files.length; i++) 
                  { 
                  nombre= files[i].name; 
                  urlSeparado=nombre.split(".");
                  console.log(urlSeparado);
                  var tipoArchivo =urlSeparado[urlSeparado.length - 1];
                    if(tipoArchivo== "jpeg"|| tipoArchivo== "jpeg"|| tipoArchivo== "png"|| tipoArchivo== "gif" || tipoArchivo== "jpg"){
                      console.log("es correcto")
                      }else{
                        $('#postUrlImagenContenidoID').after('<label id="errorMultiimagenes'+i+'" style="color:white; background: #D4AC0D !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;">  Solo se aceptan imagenes con formato jpg/jpeg/png/gif </label>');
                        contador++;                
                      }
                  } 
                }
                if(contador==0){
                  bandera = true;
                }
                return bandera;
              }
                //"ajax": "datoseventos.php?accion=obtenerListaEntradas",
              $('#mensajesTable1').DataTable({
                
                "language": {
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se encontraron resultados",
                        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sSearch": "Buscar:",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast":"Último",
                          "sNext":"Siguiente",
                            "sPrevious": "Anterior"
                  },
                  "sProcessing":"Procesando...",
                    },
                    responsive: true, 
                    "order": [[ 0, "desc" ]]
              });
            });
          </script>
          <!-- Modal para editar el contenido de los post. Se encuentra en el menu de entradas-->
          <div class="modal fade" id="modalEditarPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#2B2B2B; color:#F4F6F6;  ">
                  <h5 class="modal-title" id="tituloEvento"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modalEditarPost').modal('toggle');">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group"> <label for="post_segmento">SEGMENTO</label><select type="select" class="form-control"  id="post_segmento" name="post_segmento" title="Seleccione una facultad" aria-describedby="facultadHelp" >
              <option  value="">  Elija un segmento</option>
              <?php
              include 'conexion.php';
              $consulta = "SELECT * FROM subcategorias";
              $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
              
                while ($columna1 = mysqli_fetch_array( $resultado ))
                {
                  echo '<option value="'.$columna1['ID'].'">'.$columna1['nombre'].'</option>';
                  #echo "<h5 class='text-center'>" . $columna1['nombre'] . "</h5><h6 class='text-center'>" . $columna1['message'] . "</h6>";
                }
              ?>
              </select>	
              <div id="error-segmento-modif" ></div>
          </div>
                  <div class="form-group"><label for="post_titulo">TITULO</label><input type="text" id="post_titulo" name="post_titulo" placeholder="Ingrese un titulo" class="form-control" ><div id="error-titulo-modif"></div></div>
                  <div class="form-group"><label for="post_contenido">CONTENIDO</label><input type="text" id="post_contenido" name="post_contenido" placeholder="Ingrese un titulo" class="form-control" ><div id="error-titulo"></div></div>
                  <div class="form-group"><label for="">CAMBIAR IMAGEN(ES) ACTUALMENTE</label> <input type="file" name="post_imagenes_interior" id="post_imagenes_interior" class="form-control" multiple><br><div style="text-align:center;"id="imagenesContenido"></div></div>
                  <div class="form-group"><label for="post_imagen_principal">CAMBIAR IMAGEN PRINCIPAL </label> <input type="file" name="post_imagen_principal" id="post_imagen_principal" class="form-control" ><br><div  style="text-align:center;"><div id="textoImagenPrincipal"></div><br><img id="imagenPrincipal" style="width:50%"><br></div></div>
                  <div id="postVideo"></div>
                  <p id="successModal"></p>
                   
                </form>
                  <!--
                <p id="descripcionEvento"></p>
                <img id="imagenEvento" style="width:100%">
                -->

                </div>
                <div id="mensajeUpdatePost" style="text-align:center;"></div>
                <div class="modal-footer">
                <button  type="button"  id="btnPostModificar"  class="btn" style="background-color:#1ABC9C; color:#F4F6F6;" >Actualizar Cambios</button> 
                  <button type="button" class="btn btn-secondary" id="btnAgregar_m" data-dismiss="modal"  onclick="$('#modalEditarPost').modal('toggle');">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
      </div>
      <!-- Area por defecto-->
      <div id="defaultPost"style="margin-right:7%; text-align:center; margin-bottom:10% display:block; ">
      <i class="fa fa-paragraph" aria-hidden="true">Agregue Articulos a su pagina web, dales un segmento para establecer la ubicacion del post</i>
      <i class="fa fa-paragraph" aria-hidden="true">El segmento, el titulo y una imagen principal son datos obligatorios</i><br>
      <i class="fa fa-paragraph" aria-hidden="true">"Recargar la Pagina" permite actualizar la tabla con los nuevos Post </i><br>
      <br>
      <img src="images/libro1.gif" alt="">
      <br>
      <br>
      </div>
      <!-- Area Conexion Post Eventos-->
      <div id="areaPostEventos"style="margin-right:7%; text-align:center; margin-bottom:10% display:block; ">
        <form >
        <div class="form-group">
          <label >Subcategoria&nbsp;&nbsp;</label>
          <select type="select" class="form-control"  name="inlineFormCustomSelectPref1" title="Seleccione una facultad" aria-describedby="facultadHelp" id="inlineFormCustomSelectPref1">
            <option selected>Elija la categoria</option>
            <?php
              include 'conexion.php';
              $consulta = "SELECT * FROM subcategorias ";
              $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
              
                while ($columna1 = mysqli_fetch_array( $resultado ))
                {
                  echo '<option value="'.$columna1['ID'].'">'.$columna1['nombre'].'</option>';
                }
              ?>
          </select>
          <div id="errorSubcategoria"></div>
          </div>
          <div class="form-group">
          <label >Post&nbsp;&nbsp;</label>
          <select class="form-control" id="postSelected" name="postSelected" required>
					<option value="">Elija un Post</option>
					</select>
          <div id="errorPostSelected"></div>
          </div>
          <hr>
          <div class="form-group">
          <label>Evento&nbsp;&nbsp;</label>
          <select type="select" class="form-control" id="inlineFormCustomSelectPref2" name="inlineFormCustomSelectPref2" required>
          
            <option value="">Elija un evento</option>
            <?php
              include 'conexion.php';
              $consulta = "SELECT * FROM eventos ORDER BY ID DESC";
              $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
              
                while ($columna1 = mysqli_fetch_array( $resultado ))
                {
                  echo '<option value="'.$columna1['ID'].'">'.$columna1['title'].'</option>';
                }
              ?>
          </select>
          <div id="errorEventoSelected"></div>
          </div>
          <button type="button" class="btn btn-primary mb-2" onclick="conectarPostEvento()" >Conectar</button>
          <div id="mensajeConectar"></div>
        </form>
        <br>
        <br>
      </div>
      <script type="text/javascript">
       var idModificar;
       var datosModificados;
       var  urlImagenTituloModificar;
       var urlVideoActual;
        function conectarPostEvento(){
          if(validarConectar()){
            var postContenido =$('#postSelected').val();
            var eventoContenido =$('#inlineFormCustomSelectPref2').val();
            console.log(postContenido+"  "+ eventoContenido);
            datosEmpaquetados={
              idPost: postContenido,
              idEvento : eventoContenido
            }
            $.ajax({
            url :"datoseventos.php?accion=conectarEventoPost",
            type:"POST",
            cache:false,
            data: datosEmpaquetados,
            success:function(data){
              console.log(data);
              console.log("exito");
              $("#mensajeConectar").html('<label style="color:white; text-align: center; background: #2B6C34 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;">Conexion establecida</label>')
              limpiarTodoForm();
            //$("#postSelected").html('<option value="'+obj[0]['ID']+'">'+obj[0]['titulo']+'</option>');
            }
            });
          }else{
            console.log("esta falso");
          }
        }
        function limpiarTodoForm(){
          $("#errorEventoSelected").empty();
          $("#errorPostSelected").empty();
          $('#inlineFormCustomSelectPref2').val("");
          $('#postSelected').val("");
        }
        function validarConectar(){
          count=0;
          if($('#postSelected').val() == "" || $('#postSelected').val() == null || $('#postSelected').val() == undefined){
            $('#errorPostSelected').append('<label style="color:white; background: #c51244 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;">Seleccione un Post </label>');
            count++;
          }
          if($('#inlineFormCustomSelectPref2').val()== "" || $('#inlineFormCustomSelectPref2').val() == null || $('#inlineFormCustomSelectPref2').val() == undefined){
            $('#errorEventoSelected').append('<label style="color:white; background: #c51244 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;">Seleccione un Evento</label>');
            count++;
          }
          if(count == 0){
            return true;
          }else{
            return false
          };
        }
      $("#inlineFormCustomSelectPref1").on("change",function(){
        $("#postSelected").empty();
        var idSubcategoria = $(this).val();
        $.ajax({
          url :"datoseventos.php?accion=obtenerPostPorSubcategoria",
          type:"POST",
          cache:false,
          data:{id:idSubcategoria},
          success:function(data){
            console.log(data);
            var obj = $.parseJSON(data);
            console.log(obj);
            console.log(obj.length);
            for(var i = 0; i<= obj.length; i++){
              if(obj.length == 0){
                $("#postSelected").append('<option value="">No tiene Post que mostrar</option>');      
              }else{
                $("#postSelected").append('<option value="'+obj[i]['ID']+'">'+obj[i]['titulo']+'</option>');
              }
            }
          //$("#postSelected").html('<option value="'+obj[0]['ID']+'">'+obj[0]['titulo']+'</option>');
          }
        });
			});
          function obtenerDatosPostModificarForm(){
            var videoFile =$('#post_video_principal').val().split('\\').pop();
            /*
            if( $('#post_video_principal').val() != ""){
              urlVideoPrincipal = "images/stored/externas/"+videoFile;
            }else{
              urlVideoPrincipal = null
            }
            */
            //console.log($('#post_imagen_principal').val());
            if( $('#post_imagen_principal').val()=="" || $('#post_imagen_principal').val()==null){
              console.log("la imagen principal no ha cambiado");
                urlImagenTitulo = urlImagenTituloModificar;
              
            }else{
              var filename = $('#post_imagen_principal').val().split('\\').pop();
              urlImagenTitulo = "images/stored/externas/"+filename;
              var formData = new FormData();
              var files = $('#post_imagen_principal')[0].files[0];
              //console.log($('#postUrlImagenShowID')[0].files[0]);
              formData.append('file',files);
              $.ajax({
                  url: 'datoseventos.php?accion=agregarPhotoPost',
                  type: 'post',
                  data: formData,
                  contentType: false,
                  processData: false,
                  success: function(response) {
                    console.log(response);

                  }
              });
            }
            if( $('#post_video_principal').val()=="" || $('#post_video_principal').val()==null){
              console.log("El video principal no ha cambiado");
              //urlVideoActual = urlVideoActual;
              
            }else{
              console.log("el video actual es" +urlVideoActual)
              $.ajax({
                  url: 'datoseventos.php?accion=eliminarVideoInterno',
                  type: 'post',
                  data: {
                    urlVideoPost: urlVideoActual
                  },
                  success: function(response) {
                    console.log(response);
                    console.log("borrado y listo para subir la nuevo video")
                  }
              });
              var filenameVideo = $('#post_video_principal').val().split('\\').pop();
              urlVideoActual = "images/stored/externas/"+filenameVideo;
              var formData = new FormData();
              var files = $('#post_video_principal')[0].files[0];
              //console.log($('#postUrlImagenShowID')[0].files[0]);
              formData.append('file0',files);
              $.ajax({
                  url: 'datoseventos.php?accion=agregarVideoInterno',
                  type: 'post',
                  data: formData,
                  contentType: false,
                  processData: false,
                  success: function(response) {
                    console.log(response);
                    $('#videoPrincipal').attr('src',urlVideoActual)
                  }
              });
            }
            var datosForm = {
              id: idModificar,
              titulo: $('#post_titulo').val(),
              descripcion: $('#post_contenido').val(),
              urlImagenTitulo: urlImagenTitulo,
              subcategoriaID: $('#post_segmento').val(),
              urlVideoPrincipal: urlVideoActual
            }
            return datosForm
          }
          function obtenerDatosImagenesModificar(id){
            let formData = new FormData();
            //console.log($('#postUrlImagenContenidoID')[0].files[0]);
            if($('#post_imagenes_interior')[0].files[0] != undefined){
              formData.append('file0',$('#post_imagenes_interior')[0].files[0]);
            }
            if($('#post_imagenes_interior')[0].files[1] != undefined){
              formData.append('file1',$('#post_imagenes_interior')[0].files[1]);
            }
            if($('#post_imagenes_interior')[0].files[2] != undefined){
              formData.append('file2',$('#post_imagenes_interior')[0].files[2]);
            }
            formData.append('idPost',id);
          // Display the values
            for (var value of formData.values()) {
              console.log(value);
            }
            return formData
            /*let urlsImagenes = {
              
            }*/
          }
          $('#btnPostModificar').click(function(){          
                if(validarEntradaModificada()){
                  datosModificados = obtenerDatosPostModificarForm();
                  var listaObtenida;
                  $.ajax({  
                        type: 'POST',
                        url: 'datoseventos.php?accion=actualizarPost',
                        data: datosModificados,
                        success: function(response) { 
                          console.log(response)
                          if(response){
                            if(verificarMultiplesImagenes()){
                              $.ajax({  
                                type: 'POST',
                                url: 'datoseventos.php?accion=obtenerListaImagenes',
                                data: datosModificados,
                                success: function(listaImagenesObtenidas) { 
                                  console.log("Lista obtenida exitosamente");
                                  var obj = $.parseJSON(listaImagenesObtenidas);
                                  var formData = new FormData();
                                  var size = Object.keys(obj).length;
                                  console.log(size);
                                  //console.log(obj[0]['urlImagenContenido']);
                                  if(size ==1){
                                    console.log("entro a 1")
                                    var listaImagenes={
                                    'urlImagenContenido1': obj[0]['urlImagenContenido'],
                                    'ID': idModificar
                                  }
                                  }
                                  if(size ==2){
                                    console.log("entro a 2")
                                    var listaImagenes={
                                    'urlImagenContenido1': obj[0]['urlImagenContenido'],
                                    'urlImagenContenido2': obj[1]['urlImagenContenido'],
                                    'ID': idModificar
                                  }
                                  }
                                  if(size ==3){
                                    console.log("entro a 3")
                                    var listaImagenes={
                                    'urlImagenContenido1': obj[0]['urlImagenContenido'],
                                    'urlImagenContenido2': obj[1]['urlImagenContenido'],
                                    'urlImagenContenido3': obj[2]['urlImagenContenido'],
                                    'ID': idModificar
                                  }
                                  }
                                  if(response){
                                    $.ajax({  
                                      type: 'POST',
                                      url: 'datoseventos.php?accion=eliminarImagenesContenido',
                                      data: listaImagenes,
                                      success: function(response) { 
                                        console.log("Eliminadas exitosamente");
                                        console.log(response);
                                        
                                          console.log("insertando nuevas imagenes");
                                           formData= obtenerDatosImagenesModificar(idModificar);
                                          if(response){
                                            $.ajax({  
                                              type: 'POST',
                                              url: 'datoseventos.php?accion=agregarPhotoPostInternoModif',
                                              data: formData,
                                              processData: false,  // tell jQuery not to process the data
                                              contentType: false,
                                              success: function(msg) {
                                                console.log(msg);
                                                console.log("nuevas imagenes insertadas");
                                                console.log("aplicando nuevas imagenes contenido...");
                                                $.ajax({  
                                                  type: 'POST',
                                                  url: 'datoseventos.php?accion=obtenerListaImagenes',
                                                  data: datosModificados,
                                                  success: function(msg) {
                                                    console.log(msg);
                                                    console.log("nuevas imagenes cambiadas");
                                                    var obj = $.parseJSON(msg);
                                                    console.log(obj[0]['ID']);
                                                    var size = Object.keys(obj).length;
                                                    $('#imagenesContenido').empty();
                                                    for(var i = 0; i< obj.length; i++){ 
                                                      $('#imagenesContenido').append("<p style='background-color:#2B2B2B; color:white;'>Imagen(es) Actualmente</p><br><img style='width:50%;' src='"+obj[i]['urlImagenContenido']+"'><hr>"); 
                                                    }                                                    
                                                  },
                                                  error: function(error) {
                                                      alert("Hay un problema:" + error);
                                                    }
                                                });
                                              },
                                              error: function(error) {
                                                  alert("Hay un problema:" + error);
                                                }
                                            });
                                          }else{
                                            console.log("Error al insertar las fotos");
                                          }                           
                                      },error: function(error) {
                                              alert("Hay un problema:" + error);
                                            }
                                    });
                                  }else{
                                    console.log("error al obtener info de imagenes contenido")
                                  }
                                  
                                },error: function(error) {
                                        alert("Hay un problema:" + error);
                                      }
                              });
                            };
                            //Dinamicidad para la imagen principal

                            $.ajax({  
                                    type: 'POST',
                                    url: 'datoseventos.php?accion=obtenerPost',
                                    data: datosModificados,
                                    success: function(msg) {
                                      console.log(msg);
                                      var obj = $.parseJSON(msg);
                                      console.log(obj[0]['ID']);
                                      var size = Object.keys(obj).length;
                                      $('#imagenPrincipal').empty();
                                      $('#textoImagenPrincipal').empty();
                                      //$('#imagenPrincipal').attr("src",obj[0]['urlImagenTitulo']);
                                      $('#textoImagenPrincipal').append("<p style='background-color:#2B2B2B; color:white;'>Imagen Principal Actualmente</p><br><hr>");  
                                      $('#imagenPrincipal').attr("src",obj[0]['urlImagenTitulo']);
                                                                  
                                    },
                                    error: function(error) {
                                        alert("Hay un problema:" + error);
                                      }
                                  });
                            $('#mensajeUpdatePost').append('<label style="background: #2B6C34 !important; box-shadow: 1px 1px 1px #aaaaaa;"> Post Actualizado Exitosamente</label>');
                          }else{
                            console.log("error al actualizar los datos")
                          }
                          //var imagen = $.parseJSON(response);
                            //console.log(imagen[0]['ID']);
                            /*
                            for(var i = 0; i< imagen.length; i++){ 
                              $('#imagenesContenido').append("<img style='width:50%;' src='"+imagen[i]['urlImagenContenido']+"'><hr>"); 
                            }
                            */
                        },error: function(error) {
                                alert("Hay un problema:" + error);
                              }
                    }); 
                }
          });
          function verificarMultiplesImagenes(){
            var respuesta;
            if($('#post_imagenes_interior').val()=="" || $('#post_imagenes_interior').val() ==null){
              console.log("sin cambiar imagenes contenido")
              respuesta = false;
            }else{
              respuesta = true;
            }
            return respuesta
          }
          function validarEntradaModificada(){
            
            $('#mensajeUpdatePost').empty();
            $('#errorImagenShow').empty();
            $('#textoVideoPrincipal').empty();
            $('#errorMultiimagenesUpdate0').empty();
            $('#errorMultiimagenesUpdate1').empty();
            $('#errorMultiimagenesUpdate2').empty();
            
            let count=0;

            if($('#post_titulo').val()=="" ||   $('#post_segmento').val()==null){
              $('#error-titulo-modif').append('<p style="color:white; background: #c51244 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;">El titulo es obligatorio</p>')
              count++
            }
            if($('#post_segmento').val()=="" || $('#post_segmento').val()==null){
              $('#error-segmento-modif').append('<p style="color:white; background: #c51244 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;">El segmento es obligatorio</p>')
              count++
            }
            if($('#post_video_principal')[0].files[0] != undefined || $('#post_video_principal')[0].files[0] != null || $('#post_video_principal').val() ){
              var filename = $('#post_video_principal').val().split('\\').pop();
                urlSeparado=filename.split(".");
                var tipoArchivo =urlSeparado[urlSeparado.length - 1];
                console.log("se detecto video principal")
                console.log(tipoArchivo)
                  if(tipoArchivo == "mp4" || tipoArchivo == "avi"){
                    console.log("es correcto")
                    }else{
                      console.log($('#postUrlVideoShowID')[0].files[0])
                      $('#textoVideoPrincipal').html('<label style="color:white; background: #D4AC0D !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;"> Solo se aceptan videos con formato mp4 / avi</label>');
                        count++;                
                    }
            }else if($('#post_video_principal')[0].files[0] == ""){
                  console.log("mantener video actual");
                }
            if($('#post_imagen_principal').val() != ""){
              var filename = $('#post_imagen_principal').val().split('\\').pop();
                urlSeparado=filename.split(".");
                var tipoArchivo =urlSeparado[urlSeparado.length - 1];
                console.log("se detecto imagen principal")
                console.log(tipoArchivo)
                var tipoArchivo =urlSeparado[urlSeparado.length - 1];
                if(tipoArchivo== "jpeg"|| tipoArchivo== "jpeg"|| tipoArchivo== "png"|| tipoArchivo== "gif" || tipoArchivo== "jpg"){
                    console.log("es correcto")
                    }else{
                      $('#post_imagen_principal').after('<label id="errorImagenShow" style="color:white; background: #D4AC0D !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;">  Solo se aceptan imagenes con formato jpg/jpeg/png/gif </label>');
                      count++;                
                    }
              }else if($('#post_imagen_principal')[0].files[0] == ""){
                  console.log("mantener imagen principal actual");
                }
          if($('#post_imagenes_interior').val() != ""){
            var filename = $('#post_imagenes_interior').val().split('\\').pop();
                urlSeparado=filename.split(".");
                var tipoArchivo =urlSeparado[urlSeparado.length - 1];
                console.log("se detecto imagenes interior")
                console.log(tipoArchivo)
                  // Recorre el input multifile 
                  var files = document.getElementById("post_imagenes_interior").files; 
                  for (var i = 0; i < files.length; i++) 
                  { 
                  nombre= files[i].name; 
                  urlSeparado=nombre.split(".");
                  console.log(urlSeparado);
                  var tipoArchivo =urlSeparado[urlSeparado.length - 1];
                    if(tipoArchivo== "jpeg"|| tipoArchivo== "jpeg"|| tipoArchivo== "png"|| tipoArchivo== "gif" || tipoArchivo== "jpg"){
                      console.log("es correcto")
                      }else{
                        $('#post_imagenes_interior').after('<label id="errorMultiimagenesUpdate'+i+'" style="color:white; background: #D4AC0D !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;">  Solo se aceptan imagenes con formato jpg/jpeg/png/gif </label>');
                        count++;                
                      }
                  } 
                }else if($('#post_imagenes_interior')[0].files[0] == ""){
                  console.log("mantener video actual");
                }
                
            if(count==0){
              return true;
            }else{
              return false;
            }
            
          }
          function eliminarRegistro(comp){
            $.ajax({  
                        type: 'POST',
                        url: 'datoseventos.php?accion=eliminarEntrada',
                        data: {
                          id: comp.value
                        },
                        success: function(response) { 
                          console.log(response);
                          return true;
                        },error: function(error) {
                          return false;
                              }
                    }); 
          }
          function eliminarRegistroImagenes(comp){
            $.ajax({  
                        type: 'POST',
                        url: 'datoseventos.php?accion=eliminarImagenesEntrada',
                        data: {
                          id: comp.value
                        },
                        success: function(response) { 
                          console.log(response);
                          return true;
                        },error: function(error) {
                          return false;
                              }
                    }); 
          }
          function eliminarFileImagenPrincipal(comp){
            $.ajax({  
              type: 'POST',
              url: 'datoseventos.php?accion=obtenerPost',
              data: {
                id: comp.value
              },
              success: function(response) { 
                console.log(response);
                var obj = $.parseJSON(response);
                //console.log(obj[0]['ID']);                
                $.ajax({  
                  type: 'POST',
                  url: 'datoseventos.php?accion=eliminarFilePrincipal',
                  data: {
                    urlImagenTitulo : obj[0]['urlImagenTitulo']
                  },
                  success: function(response) { 
                    console.log(response);
                    return true;
                  },error: function(error) {
                    return false;
                  }
                }); 
              },error: function(error) {
                return false;
              }
            }); 
          }
          function eliminarVideoPrincipal(comp){
            $.ajax({  
              type: 'POST',
              url: 'datoseventos.php?accion=obtenerPost',
              data: {
                id: comp.value
              },
              success: function(response) { 
                console.log(response);
                var obj = $.parseJSON(response);
                //console.log(obj[0]['ID']);                
                $.ajax({  
                  type: 'POST',
                  url: 'datoseventos.php?accion=eliminarVideoInterno',
                  data: {
                    urlVideoPost : obj[0]['urlVideoPrincipal']
                  },
                  success: function(response) { 
                    console.log(response);
                    console.log("video borrado exitosamente");
                    return true;
                  },error: function(error) {
                    return false;
                  }
                }); 
              },error: function(error) {
                return false;
              }
            }); 
          }
          function eliminarFilesImagenesContenido(comp){
            
            $.ajax({  
                        type: 'POST',
                        url: 'datoseventos.php?accion=obtenerListaImagenes',
                        data: {
                          id: comp.value
                        },
                        success: function(response) { 
                          console.log(response);
                          var listaImagenes;
                          var obj = $.parseJSON(response);
                          let size = Object.keys(obj).length;
                            console.log(size);
                            //console.log(obj[0]['urlImagenContenido']);
                            if(size ==1){
                              console.log("entro a 1")
                              console.log(obj[0]['urlImagenContenido']);
                               listaImagenes={
                              'urlImagenContenido0': obj[0]['urlImagenContenido']
                              }
                            }
                            if(size ==2){
                              console.log("entro a 2")
                              console.log(obj[0]['urlImagenContenido']);
                               listaImagenes={
                              'urlImagenContenido0': obj[0]['urlImagenContenido'],
                              'urlImagenContenido1': obj[1]['urlImagenContenido']
                              }
                            }
                            if(size ==3){
                              console.log("entro a 3")
                              console.log(obj[0]['urlImagenContenido']);
                               listaImagenes={
                                'urlImagenContenido0': obj[0]['urlImagenContenido'],
                                'urlImagenContenido1': obj[1]['urlImagenContenido'],
                                'urlImagenContenido2': obj[2]['urlImagenContenido']
                              }
                            }
                            $.ajax({  
                              type: 'POST',
                              url: 'datoseventos.php?accion=eliminarFilesContenido',
                              data: listaImagenes,
                              success: function(response) { 
                                console.log(response);
                                return true;
                              },error: function(error) {
                                      return false;
                                }
                            });  
                        },error: function(error) {
                          return false;
                              }
                    }); 
          }
          function eliminarContenidoPost(comp){
            count=0;
            //eliminar imagenes, comentarios y entradas
            console.log("eliminar imagenes, comentarios y entradas");
            //console.log(eliminarFilesImagenesContenido(comp));
            eliminarFilesImagenesContenido(comp);
            eliminarFileImagenPrincipal(comp);
            eliminarVideoPrincipal(comp);
            eliminarRegistroImagenes(comp);
            eliminarRegistro(comp);
            console.log("entrada eliminada exitosamente"); 
            $('#filaPost'+comp.value).css("background-color", "red");
            $('#filaPost'+comp.value).html("Entrada Eliminada")
          }
          function editarContenidoPost(comp){
            limpiarEspaciosModificar();
            obtenerDatosPostModificar(comp.value);
            idModificar=comp.value;
            //console.log(a);
            $('#modalEditarPost').modal('show');
            
          }
          function verContenidoPost(comp){
              limpiarEspacios();
              a=obtenerDatosPost(comp.value);
              //console.log(datos1);
              console.log(a);
              $('#modalContenidoPost').modal('show');
          }
          function obtenerDatosPostModificar(idEntrada){
            $('#postVideo').empty();
            $.ajax({  
                type: 'POST',
                url: 'datoseventos.php?accion=obtenerPost',
                data: {
                  id: idEntrada
                },
                success: function(response) { 
                  var obj = $.parseJSON(response);
                    //console.log(obj[0]['ID']);
                    urlImagenTituloModificar = obj[0]['urlImagenTitulo'];
                    $('#post_segmento').val(obj[0]['subcategoriaID']);
                    $('#post_titulo').val(obj[0]['titulo']);
                    $('#post_contenido').val(obj[0]['descripcion']);
                    urlVideoActual =obj[0]['urlVideoPrincipal']
                    //$('#imagenesContenido').val();Imagen Principal Actual
                    $('#imagenPrincipal').attr("src",obj[0]['urlImagenTitulo']);
                    if(obj[0]['urlVideoPrincipal'] != null){
                    $('#postVideo').append('<div class="form-group"><label for="post_imagen_principal">CAMBIAR VIDEO PRINCIPAL </label> <input type="file" name="post_video_principal" id="post_video_principal" class="form-control" ><br><div  style="text-align:center;"><div id="textoVideoPrincipal"></div><br><video id="videoPrincipal" src="'+obj[0]['urlVideoPrincipal']+'" style="width:50%" controls><br></div></div>');  
                    }else{
                      console.log("No ha un video actualmente");
                    }
                    
                    $('#textoImagenPrincipal').append("<br><p style='background-color:#2B2B2B; color:white;'>Imagen Principal Actualmente</p>");
                    $.ajax({  
                        type: 'POST',
                        url: 'datoseventos.php?accion=obtenerListaImagenes',
                        data: {
                          id: idEntrada
                        },
                        success: function(response) { 
                          console.log(response);
                          var imagen = $.parseJSON(response);
                            
                            
                            for(var i = 0; i< imagen.length; i++){ 
                              $('#imagenesContenido').append("<p style='background-color:#2B2B2B; color:white;'>Imagen(es) Actualmente</p><br><img style='width:50%;' src='"+imagen[i]['urlImagenContenido']+"'><hr>"); 
                            }
                            
                        },error: function(error) {
                                alert("Hay un problema:" + error);
                              }
                    });     
                },error: function(error) {
                        alert("Hay un problema:" + error);
                      }
            });
          }
          
          function obtenerDatosPost(idEntrante){
            $.ajax({  
                type: 'POST',
                url: 'datoseventos.php?accion=obtenerPost',
                data: {
                  id: idEntrante
                },
                success: function(response) { 
                    let formData = new FormData();
                    console.log(response);
                    var obj = $.parseJSON(response);
                    console.log(obj[0]['urlVideoPrincipal']);
                    idDato=obj[0]['ID'];//parseInt(obj[0]['ID'])
                    $('#fechaPost').append('<br><label style="width:100%">'+obj[0]['fechaCreacion']+'</label>');
                    $('#tituloPost').append('<br><label style="width:100%">'+obj[0]['titulo']+'</label>');
                    if(obj[0]['descripcion']){
                      $('#contenidoPost').append('<br><label style="width:100%">'+obj[0]['descripcion']+'</label>');
                    }else{
                      $('#contenidoPost').append('<br><label>'+"No contiene ningun contenido almacenado"+'</label>');
                    }
                    if(obj[0]['urlVideoPrincipal'] !=null){
                      $('#videoPostNew').append('<div class="form-group" style="font-weight:700;"> VIDEO ACTUAL <br><label id="imagenTituloPost" style="font-weight:450;  text-align:center;"></label><video style="width:100%; max-width:500px; height:100%; max-height:500px;" src="'+obj[0]['urlVideoPrincipal']+'" controls></div>');
                    }
                    formData.append('id', obj[0]['ID']);
                    $.ajax({
                    url: 'datoseventos.php?accion=obtenerListaImagenes',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(datosrecibidos) {
                      console.log(datosrecibidos);
                      var listaImagenes = $.parseJSON(datosrecibidos);
                      console.log(listaImagenes.length);
                      //urlImageActual = response;
                      for(var i=0; i<listaImagenes.length; i++){
                        if(listaImagenes[i]['urlImagenContenido'] !=undefined || listaImagenes[i]['urlImagenContenido'] !=null){
                          console.log(listaImagenes[i]['urlImagenContenido']);
                        $('#imagenContenidoPost').append('<br><img style="width:50%" src="'+listaImagenes[i]['urlImagenContenido']+'"><hr>');
                        }else{
                          $('#imagenContenidoPost').append('<br><br><label>'+"No contiene una imagen para su contenido"+'</label>');
                        };  
                      }
                      $('#imagenTituloPost').append('<br><br><img style="width:50%" src="'+obj[0]['urlImagenTitulo']+'">');  
                    },
                    error: function(error) {
                        alert("Hay un problema:" + error);
                      }
                    });
                } 
            })
          };
          function limpiarEspacios(){
            $('#fechaPost').empty();
            $('#tituloPost').empty();
            $('#contenidoPost').empty();
            $('#videoPostNew').empty();
            
            $('#imagenContenidoPost').empty();
            $('#imagenContenidoPost').empty();
            $('#imagenTituloPost').empty();
          }
          function limpiarEspaciosModificar(){
            //$('#post_segmento').empty();
            $('#post_titulo').empty();
            $('#imagenesContenido').empty();
            $('#imagenPrincipal').empty();
            $('#post_imagenes_interior').val("");
            $('#post_imagen_principal').val("");
            $('#textoImagenPrincipal').empty();
            $('#imagenesContenido').empty();
          }
      </script>
  </div>
  <br>
  <br>

</section>
<br><br>
<section id="seccionPalabrasClave" class="container" style="text-align:left; border:2px solid;">
  <br>
  <div class="row">
    <div class="col">
      <h3 style="text-align:left;">Palabras Clave</h3>
      
    </div>
    <div style="text-align:right;"class="col">
      <a name="btnAtras" id="btnAtras" class="btn btn-primary" href="#menuPrincipal" role="button">Atras</a>
     </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-4">
    <button type="button" class="btn btn-primary">Nueva Palabra</button>
    <button type="button" class="btn btn-primary">Enlace al Post</button>
    </div>
    <div style="text-align:center;"class="col">
      <div id="areaPalabra" style="margin-right:7%; text-align:center; margin-bottom:10% display:none;"></div>
      <div id="areaEmparejamiento" style="margin-right:7%; text-align:center; margin-bottom:10% display:none;"></div>
      <div id="areaDefault" style="margin-right:7%; text-align:center; margin-bottom:10% display:block;">
        <i class="fa fa-paragraph" aria-hidden="true">Agregue y empareje las PALABRAS CLAVE que tendran relacion con el Post publicado</i>
        <i class="fa fa-paragraph" aria-hidden="true"> y permitirá obtener la informacion en la en la barra de busqueda</i><br><br>
        <img style="width:20%;"src="images/letras-lupa.gif" alt="">
        <br>
        <br>
      </div>
     </div>
  </div>
</section>
<br><br>
<section id="seccionComentarios" class="container" style="text-align:left; border:2px solid;">
<br>
  <div class="row">
    <div class="col">
      <h3 style="text-align:left;">Comentarios</h3>
      
    </div>
    <div style="text-align:right;"class="col">
      <a name="btnAtras" id="btnAtras" class="btn btn-primary" href="#menuPrincipal" role="button">Atras</a>
     </div>
  </div>
  <br>
  <div class="row">
    <div class="col-4">
    <div id="cajaNotificacion">
      </div>
      <button name="" id="btnNewNotifies" class="btn btn-primary" onclick="irTodosComentarios();">Mensajes Recibidos</button>
    <br>
    </div>
    <div class="col" style="text-align:center;">
    <div id="defaultContenido">
      <i class="fas fa-h3" style="text-align:center;">Aqui podras administrar los comentarios de todos los post </i><br>
      <i class="fas fa-h3" style="text-align:center;">El boton "Nuevas notificaciones" solo aparecera cuando haya nuestros mensajes </i>
      <br>
      <br>
      <img style="width:20%;" src="images/escribiendo.gif" alt="">
      </div>
      
    </div>
    <br>
    <br>
    <br>
    <div id="tablaNewContenido" style=" width:100%; margin-left:1%; margin-right:6%;">
    <br>
    <i class="fas fa-h3" style="text-align:center; margin-left:2%;">Elija una opción para el comentario</i><br>
    <br>

      <table class="table table-striped table-inverse table-responsive" style=" margin-left:3%; margin-right:3%;">
        <thead class="thead-inverse">
          <tr>
            <th>Fecha Creacion</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Tema</th>
            <th>Mensaje</th>
            <th>Publicar</th>
            <th>Ocultar</th>
            <th>Eliminar</th>
          </tr>
          </thead>
          <tbody>
            <?php
                //Consulta los mensajes y los inserta en la tabla de mensajes - Tambien conecta el boton eliminar con cada ID de mensaje
                //$sql = "SELECT M.nombre, M.correo, M.asunto, M.mensaje, F.Nombre_facu, C.Nombre_carrera FROM mensajes M JOIN  facultades F ON M.facultadID = F.ID JOIN carreras C ON M.carreraID = C.ID";
                $consulta = "SELECT C.ID, C.nombre, C.correo, C.mensaje, C.estado, C.fechaCreacion, E.titulo FROM comentarios C  JOIN entradas E ON (C.entradaID = E.ID)  WHERE (estado='ninguno')";
                $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                while($row = mysqli_fetch_array($resultado)){ ?>
                    <tr id="filaComentarioNew<?php echo $row['ID'];?>">
                        <td><?php echo $row['fechaCreacion'] ?></td>
                        <td><?php echo $row['nombre'] ?></td>
                        <td><?php echo $row['correo'] ?></td>
                        <td><?php echo $row['titulo'] ?></td>
                        <td><?php echo $row['mensaje'] ?></td>
                        <td><button class="btn btn-success" type="button" value="<?php echo $row['ID'] ?>"  onclick="mostrarMsj(this)" > Publico</button></td>
                        <td><button class="btn btn-warning" type="button" value="<?php echo $row['ID'] ?>" onclick="ocultarMsj(this);"> Privado</button></td>
                        <td><button class="btn btn-danger" type="button" value="<?php echo $row['ID'] ?>" onclick="eliminarMsj(this);"> Eliminado</button></td>
                    </tr>
                    <?php
                }
                ?> 
          </tbody>
      </table>
      <br>
      <br>
    </div>
    <div id="tablaTodoContenido" style=" width:100%; margin-left:1%; margin-right:6%;">
    <table class="table table-striped table-inverse table-responsive" id="tablaComentariosTodo" style=" margin-left:3%; margin-right:3%;">
        <thead class="thead-inverse">
          <tr>
            <th>Fecha Creacion</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Titulo</th>
            <th>Comentario</th>
            <th>Estado Actual</th>
            <th>Cambiar Estado</th>
            <th>Borrar</th>
          </tr>
          </thead>
          <tbody>
            <?php
                //Consulta los mensajes y los inserta en la tabla de mensajes - Tambien conecta el boton eliminar con cada ID de mensaje
                //$sql = "SELECT M.nombre, M.correo, M.asunto, M.mensaje, F.Nombre_facu, C.Nombre_carrera FROM mensajes M JOIN  facultades F ON M.facultadID = F.ID JOIN carreras C ON M.carreraID = C.ID";
                $consulta = "SELECT C.ID, C.nombre, C.correo, C.mensaje, C.estado, C.fechaCreacion, E.titulo FROM comentarios C  JOIN entradas E ON (C.entradaID = E.ID)";
                $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
                while($row = mysqli_fetch_array($resultado)){ ?>
                    <tr id="filaComentarioTodo<?php echo $row['ID'];?>">
                        <td><?php echo $row['fechaCreacion'] ?></td>
                        <td><?php echo $row['nombre'] ?></td>
                        <td><?php echo $row['correo'] ?></td>
                        <td><?php echo $row['titulo'] ?></td>
                        <td><?php echo $row['mensaje'] ?></td>
                        <td><?php echo $row['estado'] ?></td>
                        
                        <td><select id="estadoNuevo" class="form-select" aria-label="Default select example">
                            <option selected>Selecciona otro estado</option>
                            <option value="show">Mostrar</option>
                            <option value="ocultar">Ocultar</option>
                          </select>
                        <button class="btn btn-success" type="button" value="<?php echo $row['ID'] ?>"  onclick="cambiarMsj(this)" > Cambiar</button></td>
                        <td><button class="btn btn-danger" type="button" value="<?php echo $row['ID'] ?>"  onclick="eliminarMsjTabla(this)" > Eliminar</button></td>
                    </tr>
                    <?php
                }
                ?> 
          </tbody>
      </table>
    </div>
  </div>
  <br>
    <script type="text/javascript">
        $('#tablaComentariosTodo').DataTable({
          "language": {
              "lengthMenu": "Mostrar _MENU_ registros",
              "zeroRecords": "No se encontraron resultados",
              "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
              "infoFiltered": "(filtrado de un total de _MAX_ registros)",
              "sSearch": "Buscar:",
              "oPaginate": {
                  "sFirst": "Primero",
                  "sLast":"Último",
                "sNext":"Siguiente",
                  "sPrevious": "Anterior"
        },
        "sProcessing":"Procesando...",
          },
          responsive: true, 
          "order": [[ 0, "desc" ]]
    });
     function cambiarMsj(comp){
       otroEstado =$('#estadoNuevo').val();
       if(otroEstado=="show"){
         $.ajax({
            url: 'datoseventos.php?accion=updateComentario',
            type: 'post',
            data: {
              idComentario : comp.value,
              estado: otroEstado
            },
            success: function(response) {
              console.log(response)
              $("#tablaTodoContenido").load(" #tablaComentariosTodo");
            }
          });
       }else if(otroEstado=="ocultar"){
        console.log("2");
        $.ajax({
            url: 'datoseventos.php?accion=updateComentario',
            type: 'post',
            data: {
              idComentario : comp.value,
              estado: otroEstado
            },
            success: function(response) {
              console.log(response)
              $("#tablaTodoContenido").load(" #tablaComentariosTodo");
            }
          });
       }else{
        console.log("No hace nd");
       }
     }
    function mostrarMsj(comp){
      $.ajax({
        url: 'datoseventos.php?accion=updateMensaje',
        type: 'post',
        data: {
          idComentario : comp.value
        },
         success: function(response) {
           console.log(response)
           $('#filaComentarioNew'+comp.value).css("background-color", "green");
            $('#filaComentarioNew'+comp.value).html("Entrada Publicada")
        }
      });
    }
    function ocultarMsj(comp){
      $.ajax({
        url: 'datoseventos.php?accion=ocultarMensaje',
        type: 'post',
        data: {
          idComentario : comp.value
        },
         success: function(response) {
           console.log(response)
           $('#filaComentarioNew'+comp.value).css("background-color", "yellow");
            $('#filaComentarioNew'+comp.value).html("Entrada Ocultada")
        }
      });
    }
    function eliminarMsjTabla(comp){
      $.ajax({
        url: 'datoseventos.php?accion=eliminarMensaje',
        type: 'post',
        data: {
          idComentario : comp.value
        },
         success: function(response) {
           console.log(response)
           $("#tablaTodoContenido").load(" #tablaComentariosTodo");
        }
      });
    }
    function eliminarMsj(comp){
      $.ajax({
        url: 'datoseventos.php?accion=eliminarMensaje',
        type: 'post',
        data: {
          idComentario : comp.value
        },
         success: function(response) {
           console.log(response)
           $('#filaComentarioNew'+comp.value).css("background-color", "red");
            $('#filaComentarioNew'+comp.value).html("Entrada Eliminada")
        }
      });
    }
    //document.addEventListener("DOMContentLoaded", getComentarios, false);
    </script>
</section>
<br>
<br>
<br>
</div><!--Div final-->
</body>

</html>




