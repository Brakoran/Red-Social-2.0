<?php  //Requerimos las funciones, variables y conexion.
    session_start();
    require('funciones/conexion.php');
    require('funciones/funciones.php');
    require('funciones/variables.php');
?>


<?php
if(!isset($_SESSION["user"])){
    header("Location: paginas/registro.php");

}else{
    mostrarDatos($_SESSION["user"]);
    actualizaFecha();
}
?>


<?php
if(isset($_POST['enviarP'])){
    
    if(!empty($_FILES["archivo"]) && !empty($_POST["texto"])){
        
        if(in_array($_FILES["archivo"]["type"],$archivosAdmitidos)){

            if($_FILES["archivo"]["size"] < $tamanoAdmitido){

                $carpetaUser .= $_SESSION["user"]."/";
                
                if(!file_exists($carpetaUser)){
                    mkdir($carpetaUser);
                }

                $fecha = date("Y-m-d-H-i-s");
                $archivoUsuario .= $carpetaUser.$fecha."-".$_FILES["archivo"]["name"];
                $nombreTemporal .= $_FILES["archivo"]["tmp_name"];
                if(!file_exists($archivoUsuario)){

                    if(move_uploaded_file($nombreTemporal,$archivoUsuario)){

                        subirPublicacion($_POST["texto"],$archivoUsuario);
                        $postOk="Publicacion Subida Correctamente";
                    }

                }

            }else{
                $errores .= "Tamaño Maximo 1MB";  
            }

        }else{
            $errores .= "Lo sentimos, solo acceptamos JPG Y PNG"; 
        }

    }else{
        $errores .= "Seleccione la imagen e ingrese el texto!";
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
    <link rel="stylesheet" href="css/estilos.css">
    <title>Red Social Alexander Duque.</title>
  </head>
  <body>
    
    <!--Aca va el Navbar----------------------------------------------------------------------->

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="paginas/cerrar.php">Cerrar Sesion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">
                        <?php echo "$nombreMostrar $apellidoMostrar" ?>
                        </a>
                    </li>
                    </ul>
                </div>
            </nav>

    <!--Aca va el Navbar----------------------------------------------------------------------->

    <div class="container"><!--container-->
        <div class="row"><!--Row-->
            <div class="col-12 col-sm-12"><!--Col-->


            <div class="card my-5">
                <h5 class="card-header">Agregar Publicacion</h5>
                <div class="card-body">
                    <h5 class="card-title">Aca Puedes Agregar una nueva publicacion</h5>
                    <p class="card-text">Agrega la imagen y el contenido</p>
                    <form method="POST" action="index.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Selecciona El Archivo</label>
                            <input type="file" name="archivo" class="form-control-file" id="exampleFormControlFile1">
                            <label for="exampleFormControlTextarea1">Ingresa tu publicacion</label>
                            <textarea class="form-control" name="texto" id="exampleFormControlTextarea1" rows="3"></textarea>
                            <button type="submit" name="enviarP" class="btn btn-primary mb-2 mt-4">Enviar Publicacion</button>
                            <?php if (!empty($errores)): ?>
                                <div class="alert alert-warning" role="alert">
                                    <?php echo $errores;?>
                                </div>
                            <?php endif ?>
                            <?php if (!empty($postOk)): ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo $postOk;?>
                                </div>
                            <?php endif ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            </div><!--Col-->

    

                                    

<!--Se muestra cuando tenga publicaciones-->
      <!--  <div class="card mb-3" >
            <img class="card-img-top" src="publicaciones/13/2020-07-16 03-12-42-1C.jpg"  alt="Card image cap">
            <div class="card-body">
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <p class="card-text"><small class="text-muted">Publicado Por: </small></p>
            </div>
        </div>  -->
       <?php mostrarPublicaciones(); ?>                           
<!--Se muestra cuando tenga publicaciones-->

        </div><!--Row-->

    </div><!--container-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
