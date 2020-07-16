<?php  //Requerimos las funciones, variables y conexion.
    session_start();
    require('../funciones/conexion.php');
    require('../funciones/funciones.php');
    require('../funciones/variables.php');
?>

<?php

if(isset($_POST['enviarLogin'])){
    $usuarioLogin = $_POST['usuarioLogin'];
    $claveLogin = $_POST['claveLogin'];

    if(loginNoVacio($usuarioLogin,$claveLogin)){

        if(conectarUsuario($usuarioLogin,$claveLogin)){
            header("Location: ../index.php");

        }else{
            ///
        }

    }else{
        $errores .= "Ingrese Usuario y contraseña!";
    }
}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Red Social Alexander Duque.</title>
  </head>
  <body>
    
        <div class="container"><!--Creamos nuestro contenedor-->
            <div class="row"><!--Iniciamos nuestra primer ROW (1)-->
            
                <div class="col-12 col-sm-12"><!--Iniciamos nuestra primer COL (1)-->


                <form method="POST"  action="login.php" class="w-75 mx-auto my-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Usuario</label>
                        <input type="text" name="usuarioLogin" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Clave</label>
                        <input type="password" name="claveLogin" class="form-control" id="exampleInputPassword1">
                    </div>
                        <div class="botonLogin d-flex justify-content-center">
                            <button type="submit" name="enviarLogin" class="btn btn-primary">Logearme</button>
                            <a class="btn btn-outline-primary mx-3" href="registro.php" role="button">Registrarme</a>
                        </div>

                        <?php include("../funciones/erroresAndOk.php");?>
                </form>

                </div><!--Cerramos nuestra primer COL (1)-->

            </div><!--Cerramos nuestra primer ROW (1)-->
        </div><!--Cerramos nuestro contenedor-->


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>