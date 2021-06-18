<?php
    $usuario = "root";
    $contrasena = "";  // en mi caso tengo contraseña pero en casa caso introducidla aquí.
    $servidor = "127.0.0.1";
    $basededatos = "fepon1";
    $conexion = mysqli_connect( $servidor, $usuario, "" ) or die ("No se ha podido conectar al servidor de Base de datos");
    $db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
    #$con = mysqli_connect('127.0.0.1','root','');
    #mysqli_select_db($con,'portafolio');
    #$con = mysql_connect("127.0.0.1","root");
    #mysql_select_db("portafolio",$con);
    #mysqli_query("SET NAME 'utf8'");
    
    //$mysqli->query("SET CHARACTER SET utf8");
    date_default_timezone_set("America/Guayaquil");
?>