<?php
session_start();
include("conexion.php");
$bd = new BD();
$bd->conectarse();

$usuario= $_POST['usuario'];
$password= $_POST['password'];

$sql = "select * from administradores 
where usuario='".$usuario."' and password=AES_ENCRYPT('".$password."','*fran') and estado=1";  /* AES_ENCRYPT('".$password."','*fran') | '".$password."' */

$resultado = $bd->ejecutarSQL($sql);
$nfilas = mysqli_num_rows($resultado);
if($nfilas>0){
    $_SESSION['variable_raro']=true;
}else{
    $_SESSION['variable_raro']=false;
}
header("location:index.php");
?>