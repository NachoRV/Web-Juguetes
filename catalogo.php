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
                  
        
          
      //incluimos fichero de conexion 
      
            include ("PHP/conexionBBDD.php");
      
      //codigo para la consulta de seleccion
           $sel= "SELECT * FROM juguete INNER JOIN tienda ON juguete.tienda = tienda.id_tienda";
           // $sel = "SELECT * FROM juguete ";
            $resultado_sel = $con->query($sel)
                or die ("Error en la consulta");
            
      
                 
           include ("PHP/accionescatalogo.php");
       ?>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <?php
      //imprmimos los datos por pantalla 
      
      while ($row = $resultado_sel->fetch_array()){//guarda cada fila en un array
      	
        
      	
      	if ($row['oferta'] >0){
            
            $querySelect = "SELECT * from oferta WHERE oferta.id_oferta = ".$row['id_juguete']."";
                    $result = $con->query($querySelect);
                    $row_producto = $result->fetch_assoc();
            
            //para dar formato a la fecha 
            
            $fecha1 = $row_producto['fecha_inicio'];
            $date  = date_create($fecha1);
            
            $fecha2 = $row_producto['fecha_fin'];
            $date2  = date_create($fecha2);
            
      		echo '<div class = "producto">';
      		echo '<img src ="'.$row['imagen'].'"/>';
            echo '<h4>!OFERTA!</h4>';
            echo 'Fecha de inicio: '.date_format($date, 'd-m-Y').'<br>';
            echo 'Fecha de Fin: '.date_format($date2, 'd-m-Y').'<br>';
      		echo 'Nombre: '.$row['nombre'];
      		echo'<br> Edad: '.$row['edad_minima'];
      		echo '<br> Tematica: '.$row['tematica'];
      		echo '<br> Precio: '.$row['precio'].' €';
      		echo '<br> Tienda: '.$row['ubicacion'].' - '.$row['direccion'].'</div>';
      	
      	} else{
      		
      		echo '<div class = "producto">';
      		echo '<br><img src ="'.$row['imagen'].'"/><br><br>';
      		echo 'Nombre: '.$row['nombre'];
      		echo'<br> Edad: '.$row['edad_minima'];
      		echo '<br> Tematica: '.$row['tematica'];
      		echo '<br> Precio: '.$row['precio'].' €';
      		echo '<br>Tienda: '.$row['ubicacion'].' - '.$row['direccion'].'<br><br></div>';
            
      		
      	}
          
		
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
