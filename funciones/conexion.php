<?php

$conexion = new mysqli("","","","loginP");

if($conexion->connect_errno){
    $error[] = "Algo salio mal en la conexion DB.";
}

?>