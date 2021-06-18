<?php 

header('content-type: application/Json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

include("conexion.php");

//include 'conexion.php';

$consulta = "SELECT * FROM `eventos`";
$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
//echo json_encode(mysqli_fetch_assoc($resultado));
$spots = array();
while($spot = mysqli_fetch_assoc($resultado)){
        $spots[] = $spot;
        
}
echo json_encode($spots);
//echo '['.json_encode($spots).']';

?>
