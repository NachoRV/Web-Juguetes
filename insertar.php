<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Mis Juguetes</title>
    <link rel="stylesheet" type="text/css" href="CSS/GeneralCSS.css">

</head>

<body id="body">

    
        <?php

            include ("PHP/header.php");
            include ("PHP/accionescatalogo.php");
            include ("PHP/conexionBBDD.php");
            if (isset($_POST['enviar'])){
      
      //  para subir la imagen.
            
                $name = $_FILES['imagen']["name"];
                $nuevo_path="catalogo/".$name;
                $tmp_name = $_FILES['imagen']['tmp_name'];
                ;
          
                  if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
           echo "<div class='row'><div class = 'col-4'></div>
           <div class = 'col-4'><span class = 'msg'>imagen ". $_FILES['imagen']['name'] ." subido con éxtio.\n</strong><span></div><div class = 'col-4'></div></div>    ";
          
           
        } else {
           echo "Posible ataque del archivo subido: ";
           echo "imagen '". $_FILES['imagen']['tmp_name'] . "'.";
        }

                if (move_uploaded_file($tmp_name,$nuevo_path)){
                    echo "<div class='row'>
                <div class = 'col-4'></div>
				<div class = 'col-4'>
                <span class = 'msg'><strong>Producto Añadido</strong><span></div>
                <div class = 'col-4'></div></div>";
                
                }
              
          // recuperamos los datos del formulario 
          
                $nombre = $_POST['nombre'];
                $edad = $_POST['edad_min'];
                $tienda = $_POST['tienda'];
                $tematica = $_POST['tematica'];
                $precio =$_POST['precio'];
               
                
          // ejecutamos el insert
          
                $ins = "INSERT into juguete values (DEFAULT,'$nombre','$tematica','$edad','$nuevo_path','$tienda',DEFAULT,'$precio')";
                $resultado_ins = $con->query($ins)
                or die("error al insertar los registros" .$ins ."-". $tienda);      
      }
      
             ?>

            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                    <form acction="<? echo $_SERVER['PHP_SELF'];?>" method="POST" name="for_insertar" enctype="multipart/form-data">
                        <fieldset>
                            <div>
                                <img id="image" width="400" height="400"> <br>
                                <input type="file" name="imagen" id="upload" required>
                            </div>
                            <div>
                                <label>Nmbre:</label>
                                <input type="text" name="nombre" required>
                            </div>
                            <div>
                                <label>Precio:</label>
                                <input type="text" name="precio" required>
                            </div>
                            <div>
                                <label>Tematica:</label>
                                <input type="text" name="tematica" required>
                            </div>
                            <div>
                                <label>Edad Minima:</label>
                                <input type="text" name="edad_min" required>
                            </div>
                            <div>
                                <div>
                                    <label>Tienda:</label>
                                    <select name="tienda">
                        <option value=""> Selecciona Tienda </option>
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
 


    <!-- Script para previsualizar la imagen -->
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
