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
      // borrado de registro 
        
        if (isset ($_POST['borrar'])) {
            
            
            $query = "DELETE FROM tienda WHERE id_tienda = ".$_POST['id']."";
                    $result = $con->query($query);
                  
                                        
                   if ($result){
                       
                echo  "<div class='row'><div class = 'col-4'></div><div class = 'col-4'>
                <span class = 'msg'><strong>Tienda eliminada</strong><span></div>
                <div class = 'col-4'></div></div>";
            
                    }
        }
      
      // modificar registro
      if (isset($_POST['modificar'])){
          
          $ubicacion = $_POST['ubicacion'];
          $direccion = $_POST['direccion'];
          $id = $_POST['id'];
        $query = "UPDATE tienda SET ubicacion= '$ubicacion', direccion= '$direccion' WHERE id_tienda= $id";
               
                $resultado = $con->query($query);
                
                if ($resultado)
                    echo "<div class='row'>
                <div class = 'col-4'></div>
				<div class = 'col-4'>
                <span class = 'msg'><strong>Registro actualizado</strong><span></div>
                <div class = 'col-4'></div></div>";
            else
                
                echo "<div class='row'>
                <div class = 'col-4'></div>
				<div class = 'col-4'>
                <span class = 'msg'><strong>Error al actualizar el registro</strong><span></div>
                <div class = 'col-4'></div></div>";;
      }
          // recuperamos los datos del formulario 
          if (!isset ($_POST['select'])){
             
            ?>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
            <form acction="<? echo $_SERVER['PHP_SELF'];?>" method="POST" name="for_selec_tienda_producto">
                <fieldset>
                    <div>
                        <label>Tienda:</label>
                        <select name="tienda">
                        <option value=""> Selecciona uns Tienda </option>
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
                    <input type="submit" value="buscar" name="select" class="boton">
                </fieldset>
            </form>
            </div>
            <div class="col-4"></div>
            <?php 
          }else{
              
            
              $query = "SELECT * from tienda WHERE id_tienda = ".$_POST['tienda']."";
                    $result = $con->query($query);
                    $row_tienda = $result->fetch_assoc();
              ?>
            <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <form acction="<? echo $_SERVER['PHP_SELF'];?>" method="POST" name="for_Mod_tienda">
                    <fieldset>
                        <input type="hidden" name='id' value='<?= $row_tienda['id_tienda']?>'>
                        <div>
                            <label>Ciudad:</label>
                            <input type="text" name="ubicacion" value="<?= $row_tienda['ubicacion']?>">
                        </div>
                        <div>
                            <label>Direccion:</label>
                            <input type="text" name="direccion" value="<?= $row_tienda['direccion']?>">
                        </div>
                    </fieldset>

                    <input class="boton" type="submit" name="borrar" value="Borrar">
                    <input class="boton" type="submit" name="modificar" value="Modificar">

                </form>
                </div>
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
