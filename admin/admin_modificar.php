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
$estado= $_POST["estado"];


$sql= "update administradores set nombre='".$nombre."',
password=AES_ENCRYPT('".$password."','*fran'),estado='".$estado."' where usuario='".$usuario."'";
$modificado= $bd->ejecutarSQL($sql);

if($modificado){
    header("location:index.php?opcion=-1&texto=ADMINISTRADOR MODIFICADO CORRECTAMENTE&op=1");

}else{
    header("location:index.php?opcion=-1&texto=HUBO UN ERROR EN LA MODIFICACION&op=1");

}


?>