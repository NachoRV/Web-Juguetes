<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Mis Juguetes</title>
        <link rel="stylesheet" type="text/css" href="CSS/GeneralCSS.css">
             
    </head>
    <body id= "body">
    
  <div id="Contenedor">
        <?php

            include ("PHP/header.php");
            include ("PHP/accionescatalogo.php");
      // incluimos la conexion de BBDD
             include ("PHP/conexionBBDD.php");
      
      //modificamos el registro 
      
            if (isset($_POST['modificar'])){
                
                $nombre = $_POST['nombre'];
                $tematica = $_POST['tematica'];
                $edad = $_POST['edad_min'];
                $tienda = $_POST['tienda'];
                $precio = $_POST['precio'];
                $id = $_POST['id'];
                
                if ($_FILES['imagen']["name"] == ""){
                    
                    $query = "SELECT * from juguete WHERE id_juguete = ".$_POST['id']."";
                    $result = $con->query($query);
                    $row_producto = $result->fetch_assoc();
                    
                   $imagen = $row_producto['imagen'];
                    
                }else {
                    
                $name = $_FILES['imagen']["name"];
                $nuevo_path="catalogo/".$name;
                $tmp_name = $_FILES['imagen']['tmp_name'];
                $imagen = $nuevo_path;
                  if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
           echo "imagen ". $_FILES['imagen']['name'] ." subido con éxtio.\n";
          
           
        } else {
           echo "Posible ataque del archivo subido: ";
           echo "imagen '". $_FILES['imagen']['tmp_name'] . "'.";
        }

                if (!move_uploaded_file($tmp_name,$nuevo_path)){
                    echo("fichero subido");
                
                }
                    
                }
                                
                
                $query = "UPDATE juguete SET nombre= '$nombre', tematica= '$tematica', edad_minima= '$edad', imagen='$imagen', tienda= '$tienda',precio = $precio  WHERE id_juguete = $id";
               
                $resultado = $con->query($query);
                
                if ($resultado)
                    echo  "<div class='row'>
                <div class = 'col-4'></div>
				<div class = 'col-4'>
                <span class = 'msg'><strong>Producto Actualizado</strong><span></div>
                <div class = 'col-4'></div></div>";
            else
                
                    echo "error al actualizar " .$query; 
         }
     
      // si no se selecciona producto se carga este if, una vez seleccionado se carga el else 
            if (!isset($_POST['select'])){
                
             ?>
      <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
        
        <form acction= "<? echo $_SERVER['PHP_SELF'];?>" method="POST" name = "for_selec_modifica_producto" >
            <fileset>
                <div>
                    <lavel>Produrcto:</lavel>
                    <select name = "producto">
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
                <input type = "submit" value="buscar" name ="select" class= "boton">
            </fileset>   
      </form> 
          </div>
          <div class="col-4"></div>
        <?php    
            }else{
        ?>
      <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
         <form acction= "<? echo $_SERVER['PHP_SELF'];?>" method="POST" name = "for_modificar_juguete" enctype="multipart/form-data" > 
             <fileset>
                 <?php 
                    $query = "SELECT * FROM juguete INNER JOIN tienda ON juguete.tienda = tienda.id_tienda WHERE juguete.id_juguete =".$_POST['producto']."";
                    $result = $con->query($query);
                    $row_producto = $result->fetch_assoc();
                ?>
                 <input type="hidden" name="id" value= "<?= $row_producto['id_juguete']?>">
                <div>
                    <img id="image" width="400" height="400" src = "<?= $row_producto['imagen']?>"><br>
                    <input type="file" name="imagen" id="upload">
                     
                </div>
                 <div>
                    <label>Nombre:</label>
                    <input type ="text" name ="nombre" value= "<?= $row_producto['nombre']?>"></input>
                 </div>
                <div>
                    <label>Tematica:</label>
                    <input type ="text" name ="tematica" value= "<?= $row_producto['tematica']?>"></input>
                 </div>
                 <div>
                    <label>Edad Minima:</label>
                    <input type ="number" name ="edad_min" value= "<?= $row_producto['edad_minima']?>"></input>
                 </div>
                <div>
                    <label>Precio:</label>
                    <input type ="text" name ="precio" value= "<?= $row_producto['precio']?>"></input>
                 </div>
                 <div>
                    <label>Tienda:</label>
                    <select name = "tienda">
                        <option value="<?= $row_producto['id_tienda']?>"> <?= $row_producto['ubicacion']." - ".$row_producto['direccion'] ?> </option>
                        <?php 
                            $select = "SELECT * from tienda"; 
                            $result = $con->query($select);
                            while($row=$result->fetch_array()){
                                
                           ?>     
                              <option value="<?= $row['id_tienda']?>" > <?= $row['ubicacion']." - ".$row['direccion'] ?></option>
                            <?php 
                                
                            }
                            ?>
                     </select>
                     
                </div>
                 <div>

                </div>
                
             </fileset>
            <div>
            <input class= "boton" type="submit" name="modificar" value="Modificar">
            </div>
         </form>  
      </div>
          <div class="col-4"></div>

        <?php
            }
        ?>

            <?php
            
            include ("PHP/footer.php");

            ?>
       
        <script>
        
            document.getElementById("upload").onchange = function() {
              var reader = new FileReader(); //instanciamos el objeto de la api FileReader

              reader.onload = function(e) {
                //en el evento onload del FileReader, asignamos el path a el src del elemento imagen de html
                document.getElementById("image").src = e.target.result;
              };

              // read the image file as a data URL.
              reader.readAsDataURL(this.files[0]);
            };

        </script>


    </body>
    </html>