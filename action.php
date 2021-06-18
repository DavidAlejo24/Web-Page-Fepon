<?php
// Include the database connection file
include 'conexion.php';
if (isset($_POST['countryId']) && !empty($_POST['countryId'])) {
 // Fetch state name base on country id
 $consulta = "SELECT * FROM carreras WHERE facultadID = ".$_POST['countryId'];
 $result = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
 if ($result->num_rows > 0) {
 echo '<option value="">Seleccione una carrera</option>';
 while ($row = $result->fetch_assoc()) {
 echo '<option value="'.$row['ID'].'">'.$row['Nombre_carrera'].'</option>';
 }
 } else {
 echo '<option value="">Carreras no disponibles</option>';
 }
}
?>