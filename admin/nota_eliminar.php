<?php
session_start();
if($_SESSION['variable_raro']==false){
    header("location:index.php");
}
include("conexion.php");
$bd = new BD();
$bd->conectarse();

$cvnota= $_GET["cvnota"];

$sql= "select imagen from notas where cvnota=".$cvnota.""; 
$resultado=$bd->ejecutarSQL($sql);
$nfilas=mysqli_num_rows($resultado);
if($nfilas>0){
 $fila=mysqli_fetch_array($resultado);
 unlink("../images/".$fila["imagen"]);
}
$sql="delete from notas where cvnota=".$cvnota."";
$eliminado=$bd->ejecutarSQL($sql);
if($eliminado){
    header("location:index.php?opcion=-1&texto=Nota eliminada&op=10");
}else{
    header("location:index.php?opcion=-1&texto=Hubo un error, nota no eliminada&op=10");
}

?>