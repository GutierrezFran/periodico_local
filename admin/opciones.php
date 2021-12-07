
<?php
function inicio(){
    if($_SESSION['variable_raro']==false){
        echo('
        <h2>Validar sesion</h2>
        <form name="frmlogin" action="validar.php" method="post">
        <input type="text" name="usuario" id="caja" placeholder="Usuario" required>
        <input type="password" name="password" id="caja" placeholder="Password" required>
        <button type="submit" name="validar" id="boton">INICIAR SESION</button>
        </form>
        ');
    }else{
        echo('
        <h2>BIENVENIDO A LA ADMINISTRACION DEL PERIODICO </br>AmaneceInformado.com</h2>

        <a id="a_admin" href="Cerrarsesion.php" class="icon-lock-filled">Cerrar sesion</a>
        ');

    }
}
function administradores(){
    $bd = new BD();
    $bd->conectarse();
    $sql = "select * from administradores order by nombre";
    $resultado = $bd->ejecutarSQL($sql);
    $nfilas = mysqli_num_rows($resultado);
        echo('
            <h2>Administradores</h2>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td id="fila-titulo">RFC</td>
                    <td id="fila-titulo">Administrador</td>
                    <td id="fila-titulo">Usuario</td>
                    <td id="fila-titulo">Estado</td>
                    <td id="fila-titulo">Eliminar</td>
                </tr>                    
            ');
                    for($c=0;$c<$nfilas;$c++){
                        $fila = mysqli_fetch_array($resultado);
                        if($c%2==0){
                            echo('<tr background-color="#ffebcd">');
                        }else{
                            echo('<tr>');
                        }

                        /* se extraen los datos de la BD de los siguientes campos */
                        echo('
                        
                            <td id="fila">'.$fila["rfc"].'</td>
                            <td id="fila"><a href="index.php?opcion=12&usuario='.$fila["usuario"].'">'.$fila["nombre"].'</a></td>
                            <td id="fila">'.$fila["usuario"].'</td>
                            <td id="fila">'.$fila["estado"].'</td>
                            <td id="fila"><button type="button" id="boton" name="eliminar" class="icon-trash" onclick="eliminar_admin(\''.$fila["usuario"].'\');" ></button></td>
                        </tr>
                        
                        ');
                    }
                    echo('
                        </table>
                        <a id="a_admin" href="index.php?opcion=11" class="icon-user-plus">Nuevo</a>
                    ');
}
function admin_nuevo(){
    echo('
    <h2>Registro de Administrador</h2>
    <form name="frmadmin" action="admin_guardar.php" method="post" onsubmit="return validarfrmadmin(frmadmin);">
        <input type="text" name="rfc" id="caja" placeholder="RFC" required>
        <input type="text" name="nombre" id="caja" placeholder="Nombre" required>
        <input type="text" name="usuario" id="caja" placeholder="Usuario" required>
        <input type="password" name="password" id="caja" placeholder="Password" required>
        <input type="password" name="cpassword" id="caja" placeholder="Confirma password" required>
        <button type="submit" name="registrar" id="boton" class="icon-user-plus">Registrar</button>
    </form>
    <a id="a_admin" href="index.php?opcion=1">Regresar</a>
    ');
}
function mensaje($texto, $op){
    echo('
    <h2>'.$texto.'</h2>
    <span class="icon-ok"style="font-size:30px"></span>
    <script lang="javascript" type="text/javascript">
        setTimeout("location.href=\'index.php?opcion='.$op.'\'",2000);
    </script>
    ');
}
function admin_modificar($usuario){
    $bd = new BD();
    $bd->conectarse();
    $sql = "select rfc,nombre,usuario,AES_DECRYPT(password,'*fran') AS password,estado from administradores where usuario='".$usuario."'";
    $resultado = $bd->ejecutarSQL($sql);
    $nfilas = mysqli_num_rows($resultado);

    if($nfilas>0){
        $fila=mysqli_fetch_array($resultado);

        if($fila["estado"]==1){
            $estado='
            <select name="estado" id="caja">
            <option value="1" selected="selected">Activo</option>
            <option value="2">Inactivo</option>
            </select>
            ';
        }else{
            $estado='
            <select name="estado" id="caja">
            <option value="1">Activo</option>
            <option value="2" selected="selected">Inactivo</option>
            </select>
            ';
        }

        echo('
        <h2>Modificar Administrador</h2>
        <form name="frmadmin" action="admin_modificar.php" method="post" onsubmit="return validarfrmadmin(frmadmin);">
        <input type="text" name="rfc" id="caja" placeholder="RFC" required value="'.$fila["rfc"].'">
        <input type="text" name="nombre" id="caja" placeholder="Nombre" required value="'.$fila["nombre"].'">
        <input type="text" name="usuario" id="caja" placeholder="Usuario" required value="'.$fila["usuario"].'" readonly="readonly">
        <input type="password" name="password" id="caja" placeholder="Password" required value="'.$fila["password"].'">
        <input type="password" name="cpassword" id="caja" placeholder="Confirma password" required value="'.$fila["password"].'">
        '.$estado.'
        <button type="submit" name="modificar" id="boton" class="icon-edit">Modificar</button>
        </form>
        <a id="a_admin" href="index.php?opcion=1">Regresar</a>
        ');
    }else{
        header("location:index.php?opcion=-1&texto=Administrador no encontrado&op=1");
    }
     
}
function notas(){
    $bd = new BD();
    $bd->conectarse();
    $sql = "select * from notas order by estado, posicion,cvnota DESC"; 
    $resultado = $bd->ejecutarSQL($sql);
    $nfilas = mysqli_num_rows($resultado);
    /* falta colocar id="" a la tabla para los estilos */
    echo('
    <h2>Notas</h2>
    <table cellpadding="0" cellspacing="0"> 
        <tr>
            <td id="fila-titulo">Titulo</td>
            <td id="fila-titulo">Imagen</td>
            <td id="fila-titulo">Estado</td>
            <td id="fila-titulo">Eliminar</td>
        </tr>                    
    ');
    for($c=0;$c<$nfilas;$c++){
        $fila = mysqli_fetch_array($resultado);
        if($c%2==0){
            echo('<tr background-color="#ffebcd">');
        }else{
            echo('<tr>');
        }

        /* se extraen los datos de la BD de los siguientes campos */
        echo('
        
            <td id="fila"><a href="index.php?opcion=102&cvnota='.$fila["cvnota"].'">'.substr($fila["titulo"],0,25).'</a></td>
            <td id="fila">'.$fila["imagen"].'</td>
            <td id="fila">'.$fila["estado"].'</td>
            <td id="fila"><button type="button" id="boton" name="eliminar" class="icon-trash" onclick="eliminar_nota(\''.$fila["cvnota"].'\');"></button></td>
        </tr>
        
        ');
    }    
    echo('
        
    </table>
    <a id="a_admin" href="index.php?opcion=101" class="icon-user-plus">Nuevo</a>
');
}
function nota(){
    echo('
        <h2>Registrar nota</h2>
    <form name="frmnota" action="nota_guardar.php" method="post" enctype="multipart/form-data" onsubmit="return validarfrmadmin(frmadmin);">
    
    <input type="text" name="titulo" id="caja" placeholder="Titulo de la nota" required>
    <textarea name="nota" id="caja" placeholder="Describe la nota" cols="20" rows="10" required></textarea>
    
    <fieldset>
    <legend>Imagen de la nota</legend>
    <input type="file" name="imagen" id="caja" required>
</fieldset>

<fieldset>
    <legend>Posicion de la nota</legend>
    <center>
        <label id="opcion">
            <input type="radio" name="posicion" value="1" checked="checked">Banner
        </label>
        <label id="opcion">
            <input type="radio" name="posicion" value="2">Comun
        </label>
    </center>
</fieldset>

<button type="submit" name="registrar" id="boton" class="icon-check">Registrar</button>
    </form>
    <a id="a_admin" href="index.php?opcion=10">Regresar</a>
');
}
function nombrearchivo($cv, $control_name, $prefijo){
    $punto=strpos($_FILES[$control_name]['name'],'.');
    $ext=substr($_FILES[$control_name]['name'],$punto+1,strlen($_FILES[$control_name]['name']));
    if($ext==""){
        $name="";
    }else{
        $name=$prefijo."_".$cv.'.'.$ext;

    }
    $name=strtolower($name);
    return $name;
}
function cargararchivo($control_name,$end_file_name){
    $error_msg="";
    if($_FILES[$control_name]['tmp_name']){
        if(move_uploaded_file($_FILES[$control_name]['tmp_name'],$end_file_name)){
            $error_msg="1";
        }else{
            $error_msg="Ocurrio un error al subir el archivo";
        }
    }else{
        $error_msg="Ocurrio un error,no subio el archivo";
    }
    return $error_msg;
}
function nota_modificar($cvnota){
    $bd = new BD();
    $bd->conectarse();
    $sql = "select * from notas where cvnota=".$cvnota.""; 
    $resultado = $bd->ejecutarSQL($sql);
    $nfilas = mysqli_num_rows($resultado);
    if($nfilas>0){
        $fila=mysqli_fetch_array($resultado);
        if($fila["estado"]==1){
            $estado='
            <select name="estado" id="caja">
            <option value="1" selected="selected">Activo</option>
            <option value="2">Inactivo</option>
            </select>
            ';
        }else{
            $estado='
            <select name="estado" id="caja">
            <option value="1">Activo</option>
            <option value="2" selected="selected">Inactivo</option>
            </select>
            ';
        }if($fila["posicion"]==1){
            $posicion='
            <label id="opcion">
            <input type="radio" name="posicion" value="1" checked="checked">Banner
            </label>
            <label id="opcion">
            <input type="radio" name="posicion" value="2">Comun
            </label>
            ';
        }else{
            $posicion='
            <label id="opcion">
            <input type="radio" name="posicion" value="1">Banner
            </label>
            <label id="opcion">
            <input type="radio" name="posicion" value="2" checked="checked">Comun
            </label>
            ';
        }
        echo('
        <h2>Modificar nota</h2>
        <form name="frmnota" action="nota_modificar.php" method="post" enctype="multipart/form-data" onsubmit="return validarfrmadmin(frmadmin);">
        
        <input type="text" name="titulo" id="caja" placeholder="Titulo de la nota" required value="'.$fila["titulo"].'">
        <textarea name="nota" id="caja" placeholder="Describe la nota" cols="20" rows="10" required>'.$fila["nota"].'</textarea>
        <img src"../images/'.$fila["imagen"].'" style="margin-top:10px" width="70%"/>

        <fieldset>
        <legend>Cambiar imagen de la nota</legend>
        <input type="file" name="imagen" id="caja" required>
        </fieldset>
    
        <fieldset>
        <legend>Posicion de la nota</legend>
        <center>
            '.$posicion.'
        </center>
        </fieldset>
        '.$estado.'
    
        <button type="submit" name="registrar" id="boton" class="icon-edit">Modificar</button>
        <input type="hidden" name="cvnota" value="'.$cvnota.'"/>
        </form>
        <a id="a_admin" href="index.php?opcion=10">Regresar</a>
        ');
    }else{
        header("location:index.php?opcion=-1&texto=Nota no encontrada&op=10");
    }
}
?>