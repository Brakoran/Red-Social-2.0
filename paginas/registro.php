<?php  //Requerimos las funciones, variables y conexion.
    require('../funciones/conexion.php');
    require('../funciones/funciones.php');
    require('../funciones/variables.php');
?>

<?php

if(isset($_POST['submit'])){ //Verificamos que el usuario de click en "Registrarme"

    $usuarioIng = trim($_POST['usuario']); //Pasamos los campos de de POST, a nuestras variables
    $claveIng = trim($_POST['clave']); //Limpiamos de espacios en blanco con trim
    $confirmaClave = trim($_POST['claveconfirm']);
    $nombreIng = $_POST['nombre'];
    $apellidoIng = $_POST['apellido'];

    if(datosLlenos($usuarioIng,$claveIng,$confirmaClave,$nombreIng,$apellidoIng)){ //Verificamos que no esten vaciosLos campos
                                                                                          
       if(!usuarioExiste($usuarioIng)){ //Verificamos que ese usuario no exista en la base de datos

            if(contrasenasIguales($claveIng,$confirmaClave)){ //Las contrasenas son iguales

                   $contrasenaHash = hashContrasena($claveIng); //Hash las contraseñas

                   if(registraUsuario($usuarioIng,$contrasenaHash,$nombreIng,$apellidoIng)){
                     $registroOk = "Registro Exitoso";


                   }else{

                    $errores .= "Algo salio mal al momento de registrarte";

                   }

            }else{

                $errores .= "Las contraseñas deben ser iguales"; 
            }

       }else{
            $errores .= "Lo sentimos ese usuario ya existe";   
       }


    }else{
        $errores .= "Porfavor Llene todos los campos!";
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
    

        <div class="container"><!--Creamos el contenedor principal-->

            <div class="row"><!--Creamos el primer (1) ROW-->

                <div class="col-12 col-sm-12"><!--Creamos las primeras (1) COLUMNAS-->


                    <form method="POST" action="registro.php" class="w-75 mx-auto my-5 border border-info p-3">
                    
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Usuario</label>
                                <input type="text" name="usuario" class="form-control" id="inputEmail4">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Clave</label>
                                <input type="password" name="clave" class="form-control" id="inputPassword4">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Repita la clave</label>
                                <input type="password" name="claveconfirm" class="form-control" id="inputPassword4">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="inputEmail4">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Apellido</label>
                                <input type="text" name="apellido" class="form-control" id="inputPassword4">
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" name="submit" class="btn btn-primary">Registrarme</button>
                            <!--con esta condicional evitamos que aparezcan dos botones-->
                            <?php if (empty($registroOk)): ?> 
                                <a class="btn btn-outline-primary mx-3" href="login.php" role="button">Logearme</a>
                            <?php endif ?>
                        </div>


                        <!--Pintamos nuestros errores y el ok en caso de se el registro sea exitoso-->   
                        <?php include("../funciones/erroresAndOk.php");?>

                                       
                    </form>


                </div><!--Cerramos las primeras (1) COLUMNAS-->

            </div><!--Cerramos el primer (1) ROW-->

        </div><!--Cerramos el contenedor principal-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>