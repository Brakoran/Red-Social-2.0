<?php

$errores = "";      //variable para almacenar errores
$registroOk = "";   //variable indicar que se registro exitosamente

$usuarioIng ="";    //Variable para almacenar el usuario ingresado desde el FORM.
$nombreIng ="";     //Variable para almacenar el nombre ingresado desde el FORM.
$apellidoIng ="";   //Variable para almacenar el apellido ingresado desde el FORM.
$claveIng = "";     //Variable para almacenar la clave ingresada desde el FORM.
$confirmaClave =""; //Variable para almacenar la la confirmacion de la clave  ingresada desde el FORM.

$usuarioLogin=""; //Variable para el login de usuario
$claveLogin="";   //Variable para la clave del login de usuario

$nombreMostrar ="";  //Nombre para mostrar una vez Logeado
$apellidoMostrar ="";//Apellido para mostrar una vez logeado 
$usuarioGlobal=""; //Usuario para usar de forma global

$postOk=""; //Variable donde se alojara el succes de la carga


$archivosAdmitidos= array('image/png', 'image/jpg', 'image/jpeg'); //Variable para definir los tipos de archivos admitidos
$tamanoAdmitido= 1024 * 1024 * 1; //Variable de tamano maximo admitido
//$carpetaImgUser= "publicaciones/"; //variable de la carpeta donde se alojaran las imagenes
$archivoUsuario = ""; //La ruta de los archivos de los usuarios
$nombreTemporal =""; //Variable para almacenar los nombres temporales de los archivos

$carpetaUser ="publicaciones/"; //carpeta para cada usuario


?>