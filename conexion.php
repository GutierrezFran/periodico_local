<?php
class BD{
    var $conexion;
    function conectarse(){  /* php conecta con la bd en la parte publica*/
        global $conexion;
                           /* server apache,   usuario,    pass,     nombre_bd */
        $conexion=mysqli_connect("localhost",  "usuario2",  "usuario2",  "bd_webperiodico");
        if(!$conexion){
            die("Error de conexion".mysqli_connect_error());
        }
    }
    function ejecutarSQL($sql){
        global $conexion;
        $consulta = mysqli_query($conexion,$sql) or die(mysqli_error());
        
        return $consulta;
    }
}
?>