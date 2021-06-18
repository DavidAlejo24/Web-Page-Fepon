
<?php
//include('conexion.db');
include("conexion.php");
if( isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM  mensajes WHERE ID = $id ";
    $result = mysqli_query($conexion,$query);
    if (!$result){
        die("Consulta fallida");
    }
    $_SESSION['message'] = 'Mensaje eliminado exitosamente!';
    $_SESSION['message_type'] = 'danger';
    header("Location: admin.php");
}
?>