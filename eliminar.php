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
            include ("PHP/accionescatalogo.php");
      // incluimos la conexion de BBDD
             include ("PHP/conexionBBDD.php");
      
      //modificamos el registro 
      
            if (isset($_POST['borrar'])){
                
                
                    
                    $query = "DELETE FROM juguete WHERE id_juguete = ".$_POST['id']."";
                    $result = $con->query($query);
                  
                                        
                   if ($result){
                       
                 echo "<div class='row'>
                <div class = 'col-4'></div>
				<div class = 'col-4'>
                <span class = 'msg'><strong>Producto Elimindo</strong><span></div>
                <div class = 'col-4'></div></div>";
            }
  
            }
      // si no se selecciona producto se carga este if, una vez seleccionado se carga el else 
            if (!isset($_POST['select'])){
                
             ?>
          <div class="row">
                <div class="col-4"></div>
                <div class="col-4">

            <form acction="<? echo $_SERVER['PHP_SELF'];?>" method="POST" name="for_selec_modifica_producto2">
                <fieldset>
                    <div>
                        <label>Produrcto:</label>
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
                    <input type="submit" value="buscar" name="select" class="boton">
                </fieldset>
            </form>
                      <div class="col-4"></div>
              </div>
            <?php    
            }else{
        ?>
              <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
            <form acction="<? echo $_SERVER['PHP_SELF'];?>" method="POST" name="for_elimina_juguete" enctype="multipart/form-data">
                <fieldset>
                    <?php 
                    $query = "SELECT * FROM juguete INNER JOIN tienda ON juguete.tienda = tienda.id_tienda WHERE juguete.id_juguete =".$_POST['producto']."";
                    $result = $con->query($query);
                    $row_producto = $result->fetch_assoc();
                ?>
                    <input type="hidden" name="id" value="<?= $row_producto['id_juguete']?>">
                    <div>
                        <img id="image" width="400" height="400" src="<?= $row_producto['imagen']?>" </img><br>
                        <input type="file" name="imagen" id="upload">

                    </div>
                    <div>
                        <label>Nombre:</label>
                        <input type="text" name="nombre" value="<?= $row_producto['nombre']?>"></input>
                    </div>
                    <div>
                        <label>Tematica:</label>
                        <input type="text" name="tematica" value="<?= $row_producto['tematica']?>"></input>
                    </div>
                    <div>
                        <label>Edad Minima:</label>
                        <input type="text" name="edad_min" value="<?= $row_producto['edad_minima']?>"></input>
                    </div>
                    <div>
                        <label>Tienda:</label>
                        <input type="text" name="tienda" value= "<?= $row_producto['ubicacion']." - ".$row_producto['direccion'] ?>"></input>
                    </div>
                </fieldset>

                <input class="boton" type="submit" name="borrar" value="Borrar">

            </form>
            <div class="col-4"></div>
              </div>

            <?php
            }
        ?>

                <?php
            
            include ("PHP/footer.php");

            ?>
    </div>

</body>

</html>
