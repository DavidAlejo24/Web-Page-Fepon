<?php
include("conexion.php");
                        if (isset($_POST['register']) ){
                          if (strlen($_POST['nombre']) >= 1 &&
                            strlen($_POST['correo']) >= 1 &&
                            strlen($_POST['facultad']) >= 1 &&
                            strlen($_POST['carrera']) >= 1 &&
                            strlen($_POST['asunto']) >= 1 &&
                            strlen($_POST['mensaje'])>= 1) {
                              $name = trim($_POST['nombre']);
                              $email = trim($_POST['correo']);
                              $facultad = trim($_POST['facultad']);
                              $carrera = trim($_POST['carrera']);
                              $subject = trim($_POST['asunto']);
                              $message = trim($_POST['mensaje']);
                              $fecha_crea = date("d-m-y H:i:s"); 
                              #INSERT INTO `mensajes`(`nombre`, `correo`, `facultadID`, `carreraID`, `asunto`, `mensaje`, `fecha_creacion`) VALUES ('pewrro','perro123@gmail.com',3,1,'Otros','este es un mensaje','esto seria fecha');
                                $insercion = "INSERT INTO mensajes (nombre, correo, facultadID, carreraID, asunto, mensaje, fecha_creacion)
                                VALUES ('$name', '$email','$facultad','$carrera', '$subject', '$message','$fecha_crea');";
                                $resultado = mysqli_query( $conexion, $insercion );
                              if ($resultado) {
                                ?>
                                <p style='color:white; text-align: center; background: #2B6C34 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;' > Mensaje enviado exitosamente! </p>                              
                                <?php
                                //mysqli_close(conexion);
                              } else {
                                ?>
                                <p class='error-message' style='color:white; background: #c51244 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;'> Lo sentimos, por el momento no podemos enviar su mensaje </h3>
                                <?php
                                //mysqli_close(conexion);
                              }
                              
                        }
                        }
                        /*
                        $insercion = "INSERT INTO mensajes (id_mensaje, nombre, email, subject, message)
                        VALUES ('3', 'juanito', 'juanito@hotmail.com', 'otros', 'hola mundo');";
                        $resultado = mysqli_query( $conexion, $insercion ) or die ( "Algo ha ido mal en la insercion a la base de datos");
                        */
?>