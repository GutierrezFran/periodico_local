<?php
session_start();
include("conexion.php");
include("opciones.php");
$bd = new BD();
$bd->conectarse();
if(!isset($_SESSION['variable_raro']) || $_SESSION['variable_raro']==false){
    $_SESSION['variable_raro']=false;
}
if(isset($_GET["opcion"])){
    $opcion= $_GET["opcion"];
}else{
    $opcion=0;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Esta es una pagina de administradores">
    <meta name="keywords" content="administradores, periodico">

    <script lang="javascript" type="text/javascript" src="funciones.js"></script>
    <link rel="stylesheet" href="../styles/style.css"> 
    <link rel="stylesheet" href="../styles/fontello.css">
           

    <title>Administradores</title>
</head>
<body>
    
        <header>
        <div class="container1">
            <h1 class="icon-home-1">Administración</h1>
            <input type="checkbox" id="menu-bar">
            <label for="menu-bar" class="icon-th"></label>
            <nav class="menu">
                <a href="index.php?opcion=0">Inicio</a>
                <a href="index.php?opcion=1">Administradores</a>
                <a href="index.php?opcion=2">Suscriptores</a>
                <a href="index.php?opcion=3">Notas</a>
                <a href="Cerrarsesion.php">Cerrar sesion</a>
                <a href=""></a>

            </nav>
        </div>
        </header>
        <main>
            <div class="cuerpo">
            <section>
                <?php
                if($opcion==-1){
                    $texto=$_GET["texto"];
                    $op=$_GET["op"];
                    mensaje($texto,$op);
                }else if($opcion==0){
                    inicio();
                }else if($opcion==1){ /* administradores */
                    if($_SESSION['variable_raro']==true){
                        administradores();
                    }else{
                        inicio();
                    }
                  
                }else if($opcion==3){ /* notas */
                    if($_SESSION['variable_raro']==true){
                        notas();
                    }else{
                        inicio();
                    }
                    /* para sucriptores */  
                }else if($opcion==2){
                    if($_SESSION['variable_raro']==true){
                        suscriptores();
                    }else{
                        inicio();
                    } 
                    
                }else if($opcion==11){
                    if($_SESSION['variable_raro']==true){
                        admin_nuevo();
                    }else{
                        inicio();
                    }
                    
                }else if($opcion==12){
                    if($_SESSION['variable_raro']==true){
                        $usuario = $_GET["usuario"];
                        admin_modificar($usuario);
                    }else{
                        inicio();
                    }
                    
                }else if($opcion==10){
                    if($_SESSION['variable_raro']==true){
                        notas();
                    }else{
                        inicio();
                    }
                    
                }else if($opcion==101){  /* nueva nota */
                    if($_SESSION['variable_raro']==true){
                        nota();
                    }else{
                        inicio();
                    }
                    
                }else if($opcion==102){
                    if($_SESSION['variable_raro']==true){
                        $cvnota=$_GET["cvnota"];
                        nota_modificar($cvnota);
                    }else{
                        inicio();
                    }
                    
                }else if($opcion==103){  /* listar suscriptores */
                    if($_SESSION['variable_raro']==true){
                        suscriptores();
                    }else{
                        inicio();
                    }
                    
                }
                                                           
                ?>               
    
            </section>
            </div>  
        </main>
    
</body>
</html>