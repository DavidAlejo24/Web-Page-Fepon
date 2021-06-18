<?php
include("conexion.php");
    if (isset($_POST['register']) ){
        $nombre = $_POST['nombre'];
        $password = $_POST['contra'];
        if ($nombre == 'FEPON') {
            echo 'entro';
                            //mysqli_close(conexion);
            } else {
                echo "Credenciales incorrectas";
                                //mysqli_close(conexion);
            }
    }else{
        echo "Solo personal Autorizado";
    }
?>