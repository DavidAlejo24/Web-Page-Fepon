<?php
header('content-type: application/Json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
//include("conexion.php");
include 'conexion.php';
switch ($_GET['accion']) {
    case 'agregar':
        $titulo = $_POST['title'];
        $descripcion = $_POST['descripcion'];
        $color = $_POST['color'];
        //$textcolor = trim($_POST['textColor']);
        $inicio = $_POST['start'];
        $fin = $_POST['end'];
        $imageurl = $_POST['imageurl'];
        echo $titulo;
        echo $descripcion;
        echo $color;
        echo $inicio;
        echo $fin;
        echo $imageurl;
        //INSERT INTO `eventos`(`title`, `descripcion`, `color`, `start`, `end`, `imageurl`) VALUES 
        $insercion = "INSERT INTO `eventos` (`title`, `descripcion`, `color`, `start`, `end`, `imageurl`) VALUES ('$titulo', '$descripcion','$color','$inicio','$fin','$imageurl')";
        $resultado = mysqli_query( $conexion, $insercion );
        echo json_encode($resultado);
        
        break;

    case 'actualizar':
        $id = trim($_POST['id']);
        $titulo = trim($_POST['title']);
        $descripcion = trim($_POST['descripcion']);
        $color = trim($_POST['color']);
        $textcolor = trim($_POST['textColor']);
        $inicio = trim($_POST['start']);
        $fin = trim($_POST['end']);
        $imageurl = trim($_POST['imageurl']);
        //$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";
        $actualizacion = "UPDATE `eventos` SET title = '$titulo', descripcion = '$descripcion', color='$color', start='$inicio', end='$fin', imageurl='$imageurl' WHERE ID = '$id'";
        $resultado = mysqli_query( $conexion, $actualizacion );
        echo json_encode($resultado);
        break;

    case 'eliminar':
        $id = $_POST["id"];
        $eliminacion = "DELETE FROM `eventos` WHERE ID='$id'";
        $respuesta = mysqli_query($conexion, $eliminacion);
        echo json_encode($respuesta);
        break;

    case 'eliminarEntrada':
        $id = $_POST["id"];
        $eliminacion = "DELETE FROM `entradas` WHERE ID='$id'";
        $respuesta = mysqli_query($conexion, $eliminacion);
        echo json_encode($respuesta);
        break;
    
    case 'eliminarImagenesEntrada':
        $id = $_POST["id"];
        $eliminacion = "DELETE FROM `imagenesentradas` WHERE entradaID='$id'";
        $respuesta = mysqli_query($conexion, $eliminacion);
        echo json_encode($respuesta);
        break;
    case 'eliminarFilePrincipal':
        $urlImagen = $_POST['urlImagenTitulo'];
        unlink($urlImagen);
        
        break;
    
    case 'eliminarFilesContenido':
        echo var_dump($_POST);
        for($x=0; $x<count($_POST); $x++) //count($_FILES["file"]["name"]);
        {
            $urlImagen = $_POST["urlImagenContenido$x"];
            echo $urlImagen;
            //Eliminamos la imagen del servidor
            unlink($urlImagen);
            
        }
        break;

    case 'eliminarImagenesContenido':
            //echo var_dump($_POST);
            //echo $_POST[0]["ID"];    
            $id = $_POST['ID'];
            $eliminacion = "DELETE FROM `imagenesentradas` WHERE entradaID='$id'";
            $respuesta = mysqli_query($conexion, $eliminacion);
            echo json_encode($respuesta);
            //
            for($x=1; $x<count($_POST); $x++) //count($_FILES["file"]["name"]);
            {
                if (isset($_POST["urlImagenContenido$x"]))
                {
                    echo 0;
                }else{
                    $urlImagen = $_POST["urlImagenContenido$x"];
                    echo $urlImagen;
                    //Eliminamos la imagen del servidor
                    unlink($urlImagen);
                }
                
            }
        break;
    case 'agregarPost':
        //date_default_timezone_set("America/Guayaquil");
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $urlImagenTitulo = $_POST['urlImagenShow'];
        $fecha_crea =  date("Y-m-d h:i:sa");
        $subcategoriaID =   $_POST['segmento'];
        $insercion = "INSERT INTO `entradas` (`titulo`, `descripcion`, `urlImagenTitulo`, `fechaCreacion`, `subcategoriaID`) VALUES ('$titulo', '$descripcion','$urlImagenTitulo','$fecha_crea','$subcategoriaID')";
        $resultado = mysqli_query( $conexion, $insercion );
        echo json_encode($resultado);   
        break;
    case 'agregarPhotoPost':
        //$_FILES['postUrlImageContenido']['name']
        if (($_FILES["file"]["type"] == "image/jpg") //$_FILES['file']["name"]
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/png")
            || ($_FILES["file"]["type"] == "image/gif")) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], "images/stored/externas/".$_FILES['file']['name'])) {
                echo "images/stored/externas/".$_FILES['file']['name'];
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
        break;
    case 'obtenerPost':
        $consulta = "SELECT * FROM entradas WHERE ID = ".$_POST['id'];
        $resultado = mysqli_query( $conexion, $consulta );
        //echo json_encode($resultado);   
        $spots = array();
        while($spot = mysqli_fetch_assoc($resultado)){
                $spots[] = $spot;
                 
        }
        echo json_encode($spots);
        break;
    case 'obtenerIDPostNuevo':
        //$consulta = "SELECT * FROM entradas ORDER BY ID DESC LIMIT 1";
        $consulta="SELECT MAX(ID) AS id FROM entradas";
        $resultado= mysqli_query($conexion, $consulta);
        //echo json_encode($resultado);  
        $spots = array();
        while($spot = mysqli_fetch_assoc($resultado)){
                $spots[] = $spot;
                 
        }
        echo json_encode($spots);
        
        break;
    case 'agregarPhotoPostInterno':
        //echo var_dump($_POST);
        //echo var_dump($_FILES);
        //echo count($_POST);
        $idEntrada = $_POST["idPost"];
        for($x=0; $x<3; $x++) //count($_FILES["file"]["name"]);
        {
            if ((is_null($_FILES["file$x"] )) || $_FILES["file$x"] == null)
            {
                echo "el elemento esta vacio";
            }else{
                $imagen = $_FILES["file$x"]["name"];
                $rutaImagen = "images/stored/internas/".$imagen;
                $insercion = "INSERT INTO `imagenesentradas` (`urlImagenContenido`, `entradaID`) VALUES ('$rutaImagen','$idEntrada')";
                $resultado = mysqli_query( $conexion, $insercion );
                echo json_encode($resultado);     
                $ruta_provisional = $_FILES["file$x"]["tmp_name"];
                $carpeta = "images/stored/internas/";
                $src = $carpeta.$imagen;
                //Caragamos imagenes al servidor
                move_uploaded_file($ruta_provisional, $src); 
                
            }
        }
        break;
        case 'agregarPhotoPostInternoModif':
            //echo var_dump($_POST);
            //echo var_dump($_FILES);
            //echo count($_POST);
            $idEntrada = $_POST["idPost"];
            for($x=0; $x<3; $x++) //count($_FILES["file"]["name"]);
            {
                if ($_FILES["file$x"])
                {
                    $imagen = $_FILES["file$x"]["name"];
                    $rutaImagen = "images/stored/internas/".$imagen;
                    $insercion = "INSERT INTO `imagenesentradas` (`urlImagenContenido`, `entradaID`) VALUES ('$rutaImagen','$idEntrada')";
                    $resultado = mysqli_query( $conexion, $insercion );
                    echo json_encode($resultado);     
                    $ruta_provisional = $_FILES["file$x"]["tmp_name"];
                    $carpeta = "images/stored/internas/";
                    $src = $carpeta.$imagen;
                    //Caragamos imagenes al servidor
                    move_uploaded_file($ruta_provisional, $src); 
                }else{

                    echo "el elemento esta vacio";
                }
            }
            break;
    case 'obtenerListaImagenes':
            //echo var_dump($_POST);
            $idPost = $_POST["id"];
            $consulta = "SELECT * FROM imagenesentradas WHERE entradaID = '$idPost'";
            //echo $consulta;
            $resultado = mysqli_query( $conexion, $consulta );
            //echo json_encode($resultado);
            $spots = array();
            while($spot = mysqli_fetch_assoc($resultado)){
                    $spots[] = $spot;
                    //echo json_encode($spot);
            }
            
            echo json_encode($spots);
        break;
    case 'actualizarPost':
        //echo var_dump($_POST);
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $contenido = $_POST['descripcion'];
        $urlImagenTitulo = $_POST['urlImagenTitulo'];
        $subcategoriaID = $_POST['subcategoriaID'];
        $fechaModif = date("Y-m-d h:i:sa");
        $actualizacion = "UPDATE `entradas` SET titulo = '$titulo', descripcion = '$contenido', urlImagenTitulo='$urlImagenTitulo', fechaModificacion='$fechaModif', subcategoriaID='$subcategoriaID' WHERE ID = '$id'";
        $resultado = mysqli_query( $conexion, $actualizacion );
        echo json_encode($resultado);
        break;

}   
/*
        
*/
?>

