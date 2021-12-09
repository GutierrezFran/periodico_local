<?php
session_start();
if($_SESSION['variable_raro']==false){
    header("location:index.php");
}
include("conexion.php");
$bd = new BD();
$bd->conectarse();

$usuario= $_GET["usuario"];

$sql= "delete from administradores where usuario='".$usuario."'"; 
$eliminado= $bd->ejecutarSQL($sql);

if($eliminado){
    header("location:index.php?opcion=-1&texto=ADMINISTRADOR ELIMINADO CORRECTAMENTE&op=1");

}else{
    header("location:index.php?opcion=-1&texto=HUBO UN ERROR AL ELIMINAR&op=1");

}


?>