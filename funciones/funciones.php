<?php

function datosLlenos($usuario,$clave,$claveconfim,$nombre,$apellido){

    if(!empty($usuario) && !empty($clave) && !empty($claveconfim) && !empty($nombre) && !empty($apellido)){
        
        return TRUE;

    }else{
        
        return FALSE;
    }
}

//--------------------------

function usuarioExiste($usuario){

    global $conexion;

    $sql = "SELECT id FROM usuarios WHERE usuario =?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s",$usuario);

    $stmt->execute();
    $stmt->store_result();

    $numeroDeFilas = $stmt->num_rows;
    $stmt->close();

    if($numeroDeFilas > 0){ //Si el numero de filas es mayor a 0
        return TRUE;

    }else{
        return FALSE;
    }

}

//-----------------------------------------


function contrasenasIguales($clavea, $claveb){

    if($clavea === $claveb){

        return TRUE;

    }else{
        return FALSE; 
    }
}


//--------------------------------------------------

function hashContrasena($contrasena){

    $hashcontra = password_hash($contrasena,PASSWORD_DEFAULT);
    return $hashcontra;
}

//-----------------------------------------------------

function registraUsuario($usuario,$clave,$nombre,$apellido){

    global $conexion;

    $fechaRegistro = date("Y-m-d-H:i:s");
    $id = NULL;
    $ultimaConexion = NULL;

    $sql = "INSERT INTO usuarios(usuario,clave,nombre,apellido,fechaRegistro) VALUES (?,?,?,?,?)";

    $stm = $conexion->prepare($sql);
    $stm->bind_param("sssss",$usuario,$clave,$nombre,$apellido,$fechaRegistro);

    if($stm->execute()){
        $stm->close();    
        return TRUE;
    }else{
        $stm->close(); 
        return FALSE;
    }

}
//--------------------------------------------


function loginNoVacio($usuario,$clave){

    if(!empty($usuario) && !empty($clave)){

        return TRUE;

    }else{

        return FALSE;
    }

}




function conectarUsuario($usuario,$clave){

   global $conexion, $errores;

    $sql = "SELECT id, clave FROM usuarios WHERE usuario = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s",$usuario); 
    $stmt->execute();
    
    $stmt->store_result();

    $numeroFilas = $stmt->num_rows;

    if($numeroFilas >0){

        $stmt->bind_result($idRecibido,$contraRecibida); //Aca guardamos los resultados que traimos de seleccionarlos
        $stmt->fetch();

        $contrasenaValidada = password_verify($clave,$contraRecibida); //Devuelve true si son iguales

        if($contrasenaValidada){
            
            $_SESSION["user"] = $idRecibido;
            return TRUE;

        }else{
            $errores .= "Usuario o clave incorrectas";
            return FALSE;
        }
    }else{
        $errores .= "Ese usuario no existe";
    }

    
}

//------------------------------------

function mostrarDatos($id){

    global $nombreMostrar,$conexion, $apellidoMostrar,$usuarioGlobal;

    $sql = "SELECT usuario, nombre, apellido FROM usuarios WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s",$id);
    $stmt->execute();

    $stmt->store_result();
    $stmt->bind_result($usuarioGlobal,$nombreMostrar,$apellidoMostrar);
    $stmt->fetch();
 
}

//--------------------------------------------

function actualizaFecha(){

global $conexion,$usuarioGlobal;
$fechaUltimaconexion = date("Y-m-d-H:i:s");
$usuario = "coco";

$sql ="UPDATE usuarios SET ultimaConexion = (?) WHERE usuario = (?)";
$stmt = $conexion->prepare($sql);

$stmt->bind_param("ss",$fechaUltimaconexion,$usuarioGlobal);
$stmt->execute();
$stmt->close();

}

//--------------------------------------------------------------------------------------------

function subirPublicacion($comentario,$imagen){


    global $conexion;
    $usuario_id = $_SESSION["user"];

    $sql = "INSERT INTO comentarios(contenido,imagen,usuario_id) VALUES (?,?,?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sss",$comentario,$imagen,$usuario_id);
    $stmt->execute();
    $stmt->close();

}


//----------------------------------------------------------------------------------

function mostrarPublicaciones(){
   
global $conexion;

$sql = "SELECT c.contenido, c.imagen, u.nombre, u.apellido FROM comentarios c INNER JOIN usuarios u WHERE c.usuario_id = u.id";

$stmt = $conexion->prepare($sql);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0){
 $stmt->bind_result($contenido,$imagen,$nombre,$apellido);

 while($stmt->fetch()){

    
    
    echo '<div class="card mb-3" >
        <img class="card-img-top" src="'.$imagen.'"alt="Card image cap">
    <div class="card-body">
        <p class="card-text">'.$contenido.'</p>
        <p class="card-text"><small class="text-muted">Publicado Por:'." ".$nombre." ".$apellido.'</small></p>
    </div>
    </div>'; 


 }


}

}

?>