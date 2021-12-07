<?php
session_start();
if($_SESSION['variable_raro']==false){
    header("location:index.php");
}
include("conexion.php");
include("opciones.php");
$bd = new BD();
$bd->conectarse();

$cvnota= $_POST["cvnota"];
$titulo= $_POST["titulo"];
$nota= $_POST["nota"]; 
$posicion= $_POST["posicion"];
$estado= $_POST["estado"]; 

$nombrearchivo=nombrearchivo($cvnota,'imagen', 'nota');
if($nombrearchivo!=""){
    $sql = "select imagen from notas where cvnota=".$cvnota."";
    $resultado = $bd->ejecutarSQL($sql);
    $nfilas = mysqli_num_rows($resultado);
    if($nfilas>0){
        $fila=mysqli_fetch_array($resultado);
        unlink("../images/".$fila["imagen"]);

    }
    $respuesta=cargararchivo('imagen', '../images'.$nombrearchivo);
    if($respuesta==1){
        $sql="update notas set titulo='".$titulo."',nota='".$nota."',posicion=".$posicion.",estado=".$estado.",imagen='".$nombrearchivo."' where cvnota=".$cvnota."";
        $modificado= $bd->ejecutarSQL($sql);
        if($modificado){
            header("location:index.php?opcion=-1&texto=NOTA MODIFICADA E IMAGEN CARGADA CORRECTAMENTE&op=10");

        }else{
            header("location:index.php?opcion=-1&texto=HUBO UN ERROR NOTA NO MODIFICADA E IMAGEN NO CARGADA&op=10");
        }
    }else{
        header("location:index.php?opcion=-1&texto=HUBO UN ERROR NOTA NO MODIFICADA:".$respuesta."&op=10");
    }
}else{
    $sql="update notas set titulo='".$titulo."',nota='".$nota."',posicion=".$posicion.",estado=".$estado." where cvnota=".$cvnota."";
    $modificado=$bd->ejecutarSQL($sql);
    if($modificado){
        header("location:index.php?opcion=-1&texto=NOTA MODIFICADA&op=10");
    }else{
        header("location:index.php?opcion=-1&texto=NOTA NO MODIFICADA&op=10");
    }
}

?>