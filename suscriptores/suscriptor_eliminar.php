<?php
session_start();
if($_SESSION['variable_raro']==false){
    header("location:index.php");
}
include("conexion.php");
$bd = new BD();
$bd->conectarse();

$cvsuscriptor= $_GET["cvsuscriptor"];


$sql= "delete from suscriptores where cvsuscriptor=".$cvsuscriptor.""; 
$eliminado= $bd->ejecutarSQL($sql);

if($eliminado){
    header("location:index.php?opcion=-1&texto=SUSCRIPTOR ELIMINADO CORRECTAMENTE&op=103");

}else{
    header("location:index.php?opcion=-1&texto=HUBO UN ERROR AL ELIMINAR SUSCRIPTOR&op=103");

}


?>