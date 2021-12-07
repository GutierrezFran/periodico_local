<?php
session_start();
if($_SESSION['variable_raro']==false){
    header("location:index.php");
}
include("conexion.php");
$bd = new BD();
$bd->conectarse();

/* se recuperan los datos de las cajas y se mandan a la bd */
$rfc= $_POST["rfc"];
$nombre= $_POST["nombre"];
$usuario= $_POST["usuario"];
$password= $_POST["password"];

$sql= "insert administradores (rfc,nombre, usuario, password) values 
('".$rfc."','".$nombre."','".$usuario."',AES_ENCRYPT('".$password."','*fran'))"; /* *fran es un codigo de encriptacion y desencript */
$insertado= $bd->ejecutarSQL($sql);

if($insertado){
    header("location:index.php?opcion=-1&texto=ADMINISTRADOR REGISTRADO CORRECTAMENTE&op=1");

}else{
    header("location:index.php?opcion=-1&texto=HUBO UN ERROR EN EL REGISTRO&op=1");

}


?>