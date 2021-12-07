<?php
session_start();
if($_SESSION['variable_raro']==false){
    header("location:index.php");
}
include("conexion.php");
include("opciones.php");
$bd = new BD();
$bd->conectarse();

/* se recuperan los datos de las cajas y se mandan a la bd */
$titulo= $_POST["titulo"];
$nota= $_POST["nota"];
$posicion= $_POST["posicion"]; 

$sql = "select MAX(cvnota)+1 AS cvn from notas";
    $resultado = $bd->ejecutarSQL($sql);
    $nfilas = mysqli_num_rows($resultado);

if($nfilas>0){
    $fila=mysqli_fetch_array($resultado);
    if($fila["cvn"]==NULL){
        $cvnota=1;
    }else{
        $cvnota=$fila["cvn"];
    }
}else{
    $cvnota=1;
}
$sql="insert notas(cvnota,titulo,nota,posicion) 
values (".$cvnota.",'".$titulo."','".$nota."',".$posicion.")";

$insertado=$bd->ejecutarSQL($sql);
if($insertado){
    $nombrearchivo=nombrearchivo($cvnota,'imagen','nota');
    $respuesta=cargararchivo('imagen','../images/'.$nombrearchivo);
    if($respuesta==1){
        $sql="update notas set imagen='".$nombrearchivo."' where cvnota=".$cvnota."";
        $modificado=$bd->ejecutarSQL($sql);
        if($modificado){
            header("location:index.php?opcion=-1&texto=Nota registrada&op=101");
        }else{
            $sql="delete notas where cvnota=".$cvnota."";
            $eliminado=$bd->$ejecutarSQL($sql);
            if($eliminado){
                header("location:index.php?opcion=-1&texto=Nota no registrada&op=10");

            }else{
                header("location:index.php?opcion=-1&texto=Nota no registrada,error al registrar la nota&op=10");
            }
        }
    }else{
        $sql="delete notas where cvnota=".$cvnota."";
        $eliminado=$bd->$ejecutarSQL($sql);
        if($eliminado){
            header("location:index.php?opcion=-1&texto=Nota no registrada&op=10");

        }else{
            header("location:index.php?opcion=-1&texto=Nota no registrada,error al registrar la nota: ".$respuesta."&op=10");
        }
    }
}else{
    header("location:index.php?opcion=-1&texto=Nota no registrada&op=10");
}


?>