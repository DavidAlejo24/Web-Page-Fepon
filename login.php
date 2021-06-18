<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="text-align:center; margin-top:70px;">
        <div>
            <img src="images/fepon.jpeg" class="" width="20%" alt="">
            <h2>ADMINISTRACION FEPON</h2>
            <form action="" method="post">
                <div class="form-group">
                <label for="user">Usuario</label>
                <br>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="" maxlength="10">
                </div>
                <br>
                <div class="form-group">
                <label for="password">Contraseña</label>
                <br>
                <input type="password" class="form-control" name="contra" id="contra" placeholder="" maxlength="50">
                </div>
                <div class="form-group">
                <br>
                <button type="submit" class="btn btn-primary" name="register">Enviar</button>
                </div>
            </form>
            <?php 
//            include("conexion.php");
                include("conexion.php");
                if (isset($_POST['register']) ){
                    $nombre = $_POST['nombre'];
                    $password = $_POST['contra'];
                    if ($nombre == 'FEPON' && $password == '123456') {
                        header ("Location: admin.php");
                                        //mysqli_close(conexion);
                        } else {
                            echo '<label style="background:red;" >Credenciales incorrectos</label>';
                            echo ' <div style="background:#dc3545;">
                            <label class="btn-danger">Solo personal autorizado</label>
                            <br>
                            <label class="btn-danger">Si accedio aqui por error retirese!</label>
                            </div>';
                                            //mysqli_close(conexion);
                        }
                }else{
                    echo '            <div style="background:#ffc107;">
                    <label class="btn-warning">Solo personal autorizado</label>
                    <br>
                    <label class="btn-warning">Si accedio aqui por error retirese!</label>
                    </div>';
                }
            ?>

        </div>
    </div>
</body>
</html>
<!--Bootstrap script-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>