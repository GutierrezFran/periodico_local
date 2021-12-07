<?php
session_start();
$_SESSION['variable_raro']=false;
unset($_SESSION['variable_raro']);  /* se asegura que se cierra la sesion quitandolo del naveg */

header("location:index.php");  /* regresa al index.php despues de cerrar la sesion */

?>