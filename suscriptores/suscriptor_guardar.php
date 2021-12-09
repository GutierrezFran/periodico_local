<?php
session_start();
if($_SESSION['variable_raro']==false){
    header("location:index.php");
}
include("conexion.php");
$bd = new BD();
$bd->conectarse();

/* se recuperan los datos de las cajas y se mandan a la bd */
$nombre= $_POST["nombre"];
$celular= $_POST["celular"];
$correo= $_POST["correo"];
$usuario= $_POST["usuario"];
$password= $_POST["password"];

$sql= "insert suscriptores (nombre,celular,correo,fechasuscripcion,usuario, password) values 
('".$nombre."','".$celular."','".$correo."',now(),'".$usuario."',AES_ENCRYPT('".$password."','*fran'))"; /* *fran es un codigo de encriptacion y desencript */
$insertado= $bd->ejecutarSQL($sql);

if($insertado){
    header("location:index.php?opcion=-1&texto=SUSCRIPTOR REGISTRADO CORRECTAMENTE");

}else{
    header("location:index.php?opcion=-1&texto=HUBO UN ERROR EN EL REGISTRO DEL SUSCRIPTOR&op=103");

}


?>