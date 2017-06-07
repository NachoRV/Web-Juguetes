<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8"/>
    <title>Mis Juguetes</title>
    <link rel="stylesheet" type="text/css" href="CSS/GeneralCSS.css">

</head>

<body id="body">

    <div id="Contenedor">
        <?php

            include ("PHP/header.php");
            include ("PHP/accionestiendas.php");
              
          // recuperamos los datos del formulario 
          if (isset ($_POST['Enviar'])){
                $ciudad = $_POST['ciudad'];
                $direccion= $_POST['direccion'];
               
          // conectamos con la BBDD y creamos y ejecutamos el insert
          
                include ("PHP/conexionBBDD.php");
                $ins = "INSERT into tienda values (DEFAULT,'$ciudad','$direccion')";
                $resultado_ins = $con->query($ins)
                    or die("error al insertar los registros" );      
                
            if ($resultado_ins)
                echo "<div class='row'>
                <div class = 'col-4'></div>
				<div class = 'col-4'>
                <span class = 'msg'><strong>Registro añadido</strong><span></div>
                <div class = 'col-4'></div></div>";
          }
             ?>
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4" id="for_insertar_tienda">
                    <form acction="<? echo $_SERVER['PHP_SELF'];?>" method="POST" name="for_insertar_tienda">
                        <fieldset>

                            <div>
                                <label>Ciudad:</label>
                                <input type="text" size="30" name="ciudad" required>
                            </div>
                            <div>
                                <label>Direccion:</label>
                                <input type="text" size="30" name="direccion" required>
                            </div>
                        </fieldset>

                        <input id = "boton1" class="boton" type="submit" name="Enviar" value="Enviar">


                    </form>
                </div>
                <div class="col-4"></div>
            </div>

            <?php
            
            include ("PHP/footer.php");

            ?>
    </div>

</body>

</html>
