<?php
    include("conexion.php");
    $bd=new BD();
    $bd->conectarse();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sitio web de periodico local AmaneceInformado.com">
    <meta name="keywords" content="AmaneceInformado.com, periodico Huautla, Noticias huautla, Covid19">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="stylesheet" href="styles/fontello.css">

    <title>AmaneceInformado</title>
</head>
<body> 

    <header>
        <div class="container1">
            <h1 class="icon-home-1">AmaneceInformado.com</h1>
            <input type="checkbox" id="menu-bar">
            <label for="menu-bar" class="icon-th"></label>
            <nav class="menu">
                <a href="#">MUNICIPIO</a>
                <a href="covid19.html">COVID19</a>
                <a href="registro.html">SUSCRIBETE</a>
                <a href="index.php#contacto">CONTACTO</a>
                <!-- <a href="admin/index.php">ADMIN</a> -->
            </nav>
        </div>
    </header>   
    
    <main>
        <section class="section">
            <article class="article">
                <?php
                    $sql="select * from notas where estado=1 and posicion=1";
                    $resultado=$bd->ejecutarSQL($sql);
                    $nfilas=mysqli_num_rows($resultado);
                    $fila= mysqli_fetch_array($resultado);
                        echo('
                        <figure>
                        <img src="./images/'.$fila["imagen"].'" style="height:800px">
                        <figcaption>
                            <h1 style="position:absolute">'.$fila["titulo"].'</h1>
                            <h2>Esperan que limpien bien el pavimento una vez que
                                termine el tianguis este martes 2 de noviembre
                            </h2>
                        </figcaption>
                    </figure>
                        ');
                    
                ?>
                
            </article>
        </section>
        <section class="section2">
            <aside>
                <div class="login">
                    <hgroup>
                        <h2>BIENVENIDO A NUESTRO SITIO WEB DE NOTICIAS</h2>
                        <h3>Inicia sesion o registrate</h3>
                    </hgroup>
                    <form name="frmlogin" action="#" method="post" enctype="multipart/form-data">
                        <p><input type="text" name="usuario" placeholder="Usuario" required="required"></p>
                        <p><input type="password" name="password" placeholder="Password" required="required"></p>
                        <p><button type="submit" class="icon-lock-filled">Iniciar sesión</button></p>
                        <p><a href="registro.html" class="icon-user-plus">Registrate aqui...</a></p>
                    </form>
                </div>
            </aside>
        </section>  
        <section class="section3">
            <article class="article">
                <?php
                    $sql="select * from notas where estado=1 and posicion=2 order by cvnota desc";
                    $resultado=$bd->ejecutarSQL($sql);
                    $nfilas=mysqli_num_rows($resultado);
                    for ($i=0; $i <$nfilas ; $i++) { 
                        $fila=mysqli_fetch_array($resultado);
                        echo('
                    <hgroup>
                    <h4>ESTADO</h4>
                    <h3>'.$fila["nota"].'. 
                    </h3>
                </hgroup>
                <img src="images/'.$fila["imagen"].'">
                    ');
                    }
                ?>
            </article>
            
        </section>
        
    </main>  
    <footer class="pie" id="contacto">
        <div class="info-pie">
            <p><small>Todos los derechos reservados 2021 AmaneceInformado.com</small></p>
            <p><small><address>email: AmaneceInformado@gmail.com</address></small></p>
            <p><a href="#" class="icon-facebook-rect"></a>
                <a href="#" class="icon-twitter-bird"></a>
            </p>
        </div>
    </footer>  
    
</body>
</html>