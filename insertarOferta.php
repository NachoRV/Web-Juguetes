<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8"/>
    <title>Mis Juguetes</title>
    <link rel="stylesheet" type="text/css" href="CSS/GeneralCSS.css">

</head>

<body id="body">

    <div id="Contenedor_insertar">
        <?php

            include ("PHP/header.php");
            include ("PHP/accionesofertas.php");
            include ("PHP/conexionBBDD.php");
            
      if (isset($_POST['enviar'])){
      	// recuperamos los datos del juguete de la oferta y su id y la tienda
      	
      	$query = "SELECT * from juguete WHERE id_juguete = ".$_POST['producto']."";
      	$result = $con->query($query);
      	$row_producto = $result->fetch_assoc();
      	$idJuguetre = $row_producto['id_juguete'];
      	$idTienda = $row_producto['tienda'];
      	
          // recuperamos los datos del formulario 
               
                $fechainicio = $_POST['fechaInicio'];
                $fechafin = $_POST['fechaFin'];
                $porcentaje = $_POST['porcentaje'];
                
                
          // Creamos y ejecutamos el insert
          
                	
                $ins = "INSERT into oferta values (DEFAULT,$fechainicio,'$fechafin','$idJuguetre','$idTienda','$porcentaje ')";
                $resultado_ins = $con->query($ins)
                    or die("error al insertar los registros" .$ins); 
                
                    $queryupdate = "UPDATE juguete SET oferta = 1 WHERE id_juguete = $idJuguetre";
                    
                    $resultado = $con->query($queryupdate);
          
         
          
      }
      
             ?>

            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                <form acction="<? echo $_SERVER['PHP_SELF'];?>" method="POST" name="insertarOferta">
                    <fieldset>
                        <div>
                            <label>Juguete:</label>
                            <select name="producto">
                        <option value=""> Selecciona un Producto </option>
                        <?php 
                            $select = "SELECT * from juguete"; 
                            $result = $con->query($select);
                            while($row=$result->fetch_array()){
                                
                           ?>     
                              <option value="<?= $row['id_juguete']?>" > <?= $row['nombre']?></option>
                            <?php 
                                
                            }
                            ?>
                    </select>
                        </div>
                        <div>
                            <label>Fecha de inicio:</label>
                            <input type="date" name="fechaInicio"required>
                        </div>
                        <div>
                            <label>Fecha fin:</label>
                            <input type="date" name="fechaFin" required>
                        </div>
                        <div>
                            <label>Porcentaje:</label>
                            <input type="number" name="porcentaje" required>
                        </div>
                    </fieldset>

                    <input class="boton" type="submit" name="enviar" value="Enviar">


                </form>
    <div class="col-4"></div>
    </div>
            </div>

            <?php
            
            include ("PHP/footer.php");

            ?>
    </div>
    
</body>

</html>
