<?php
session_start();
include("conexion.php");
$bd = new BD();
$bd->conectarse();

$usuario= $_POST['usuario'];
$password= $_POST['password'];

$sql = "select * from suscriptores 
where usuario='".$usuario."' and password='".$password."' and estado=1";  /* AES_ENCRYPT('".$password."','*fran') */

$resultado = $bd->ejecutarSQL($sql);
$nfilas = mysqli_num_rows($resultado);
if($nfilas>0){
    $_SESSION['variable_raro']=true;
}else{
    $_SESSION['variable_raro']=false;
}
header("location:index.php");
?>