<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Mis Juguetes</title>
    <link rel="stylesheet" type="text/css" href="CSS/GeneralCSS.css">


</head>

<body id="body">

    <div id="Contenedor_tiendas">

        <?php

            include ("PHP/header.php");
             include ("PHP/accionestiendas.php");
      //incluimos fichero de conexion 
      
            include ("PHP/conexionBBDD.php");
      
      //codigo para la consulta de seleccion
      
            $sel = "SELECT * FROM tienda";
            $resultado_sel = $con->query($sel)
                or die ("Error en la consulta");
           
       ?>
            <div class="row" id="tabla_tiendas">
                <div class="col-3"></div>
                <div class="col-6" class="tabla">

                    <?php
              
      //imprmimos los datos por pantalla 
         echo "<table>";
         echo '<tr><th> Ciudad</th>';
         echo'<th> Direccion </th></tr>'; 
         while ($row = $resultado_sel->fetch_array()){//guarda cada fila en un array
          
          
          echo '<div><tr><td>'.$row['ubicacion'].'</td>';
          echo '<td>'.$row['direccion'].'</td></tr>';
         
      }        
              echo "</table>";
              mysqli_close ( $con );
            ?>
                </div>
                <div class="col-3"></div>
            </div>

    </div>
    <?php
            include ("PHP/footer.php");

      ?>
</body>

</html>
