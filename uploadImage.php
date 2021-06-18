<?php
//Almacena la imagen en la base de datos
if (($_FILES["file"]["type"] == "image/pjpeg")
    || ($_FILES["file"]["type"] == "image/jpeg")
    || ($_FILES["file"]["type"] == "image/png")
    || ($_FILES["file"]["type"] == "image/gif")) {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "images/stored/".$_FILES['file']['name'])) {
        //more code here...
        echo "images/stored/".$_FILES['file']['name'];
        /*$file = "images/stored/".$_FILES['file']['name'];
        $file = str_replace( "\\", '/', $file );
        echo basename( $file );
        */
    } else {
        echo 0;
    }
} else {
    echo 0;
}
?>