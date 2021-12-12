<?php

$conexion=mysqli_connect("localhost","root","zxcvbnm","bd_webperiodico");



$nombre= $_POST["nombre"];
$celular= $_POST["celular"];
$correo= $_POST["correo"];
$usuario= $_POST["usuario"];
$password= $_POST["password"];

$sql= "insert suscriptores (nombre,celular,correo,fechasuscripcion,usuario, password) values 
('".$nombre."','".$celular."','".$correo."',now(),'".$usuario."',AES_ENCRYPT('".$password."','*fran'))"; /* *fran es un codigo de encriptacion y desencript */
$insertado= mysqli_query($conexion,$sql);


if($insertado){
    header("location:index.php?opcion=-1&texto=SUSCRIPTOR Registrado CORRECTAMENTE");

}else{
    header("location:index.php?opcion=-1&texto=HUBO UN ERROR AL REGISTRARSE");

}


?>