<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Mis Juguetes</title>
    <link rel="stylesheet" type="text/css" href="CSS/GeneralCSS.css">


</head>

<body id="body">

    <div id="Contenedor_juguetes">


        <?php
            include ("PHP/header.php"); 
            include ("PHP/accionesofertas.php");
            
                  
        
          
      //incluimos fichero de conexion 
      
            include ("PHP/conexionBBDD.php");
      
      //codigo para la consulta de seleccion
      
            $sel = "SELECT * FROM juguete INNER JOIN tienda ON juguete.tienda = tienda.id_tienda where oferta>0";
            $resultado_sel = $con->query($sel)
                or die ("Error en la consulta");
            
      
                 
           
       ?>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <?php
      //imprmimos los datos por pantalla 
      
      while ($row = $resultado_sel->fetch_array()){//guarda cada fila en un array
          
             $querySelect = "SELECT * from oferta WHERE oferta.id_oferta = ".$row['id_juguete']."";
                    $result = $con->query($querySelect );
                    $row_producto = $result->fetch_assoc();
          
             $fecha1 = $row_producto['fecha_inicio'];
            $date  = date_create($fecha1);
            
            $fecha2 = $row_producto['fecha_fin'];
            $date2  = date_create($fecha2);
          
            echo '<div class = "producto"><img src ="'.$row['imagen'].'"/>';
            echo '<h4>!OFERTA!</h4>';
            echo 'Fecha de inicio: '.date_format($date, 'd-m-Y').'<br>';
            echo 'Fecha de Fin: '.date_format($date2, 'd-m-Y');
            echo '<br> Nombre: '.$row['nombre'];
            echo'<br> Edad: '.$row['edad_minima'];
            echo '<br> Tematica: '.$row['tematica'];
            echo '<br> Tienda: '.$row['ubicacion'].' - '.$row['direccion'].'</div>';
      }      
              mysqli_close ( $con );
            ?>
                </div>
                <div class="col-1"></div>
            </div>

    </div>
    <?php
            include ("PHP/footer.php");

            ?>
</body>

</html>
