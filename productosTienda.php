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
            include ("PHP/conexionBBDD.php"); 
      
          // recuperamos los datos del formulario 
            
          if (!isset ($_POST['select'])){
             
        ?>
        <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
            <form acction="<? echo $_SERVER['PHP_SELF'];?>" method="POST" name="for_selec_tienda_producto">
                <fieldset>
                    <div>
                        <h3>Selecciona una tienda:</h3><br>
                        <label>Tienda:</label>
                        <select name="tienda">
                        <option value=""> Selecciona una Tienda </option>
                        <?php 
                            $select = "SELECT * from tienda"; 
                            $result = $con->query($select);
                            while($row=$result->fetch_array()){
                                
                           ?>     
                              <option value="<?= $row['id_tienda']?>" ><?= $row['ubicacion']." - ".$row['direccion'] ?></option>
                            <?php    
                            }
                            ?>
                    </select>
                    </div>
                    <input type="submit" value="Buscar" name="select" class="boton">
                </fieldset>
            </form>
            </div>
            <div class="col-4"></div>
            
            <?php 
          }else{
            
              $query = "SELECT * from juguete INNER JOIN tienda ON juguete.tienda = tienda.id_tienda WHERE tienda = ".$_POST['tienda']."";
                    $resultado = $con->query($query)
                        or die("Error");
                    
     ?>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
     <?php
      //imprmimos los datos por pantalla 
      
      while ($row = $resultado->fetch_array()){
          
         if ($row['oferta'] >0){
            
            $querySelect = "SELECT * from oferta WHERE oferta.id_oferta = ".$row['id_juguete']."";
                    $result = $con->query($querySelect );
                    $row_producto = $result->fetch_assoc();
            
      		echo '<div class = "producto">';
      		echo '<img src ="'.$row['imagen'].'"/>';
            echo '<h4>!OFERTA!</h4>';
            echo 'Fecha de inicio: '.$row_producto['fecha_inicio'].'<br>';
            echo 'Fecha de Fin: '.$row_producto['fecha_fin'].'<br>';
      		echo 'Nombre: '.$row['nombre'];
      		echo'<br> Edad: '.$row['edad_minima'];
      		echo '<br> Tematica: '.$row['tematica'];
      		echo '<br> Precio: '.$row['precio'].' €';
      		echo '<br> Tienda: '.$row['ubicacion'].' - '.$row['direccion'].'</div>';
      	
      	} else{
      		
      		echo '<div class = "producto">';
      		echo '<br><img src ="'.$row['imagen'].'"/><br>';
      		echo 'Nombre: '.$row['nombre'];
      		echo'<br> Edad: '.$row['edad_minima'];
      		echo '<br> Tematica: '.$row['tematica'];
      		echo '<br> Precio: '.$row['precio'].' €';
      		echo '<br> Tienda: '.$row['ubicacion'].' - '.$row['direccion'].'</div>';
      		
      	}
      }
          }
               mysqli_close ( $con );
          ?>
    </div>
    <div class="col-1"></div>
    </div>
    <?php
            
            include ("PHP/footer.php");

?>
        </div>
    </div>
</body>

</html>