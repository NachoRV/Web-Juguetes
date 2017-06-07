<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Mis Juguetes</title>
    <link rel="stylesheet" type="text/css" href="CSS/GeneralCSS.css">
    <script>
        function habilitar(carnet) {
            if (carnet == "Si") {

                document.getElementById("coche").disabled = false;
                document.getElementById("coche1").disabled = false;

            } else {

                document.getElementById("coche").disabled = true;
                document.getElementById("coche1").disabled = true;


            }

        }

    </script>

</head>

<body id="bodyformulario">
    <div id="Contenedor">
        <?php

        include ("PHP/header.php");
        
        $error= false;
        $msgCarnet="";
        $msgBoxNombre ="";
        $msgBoxApellidos = "";
        $nombre="";
        $apellidos = "";
        $edad= "";
        $fechaNacimiento = "";
        $direccion = "";
        $cp = "";
        $ciudad = "";
        $carnet = "";
        $coche = "";
        $correo = "";
        $correo2 = "";
        $condiciones = "";
        $msgEdad2= "";
        $msgEdad1="";
        $msgFecha="";
        $msgDireccion= "";
        $msgCp1 = "";
        $msgCp2 ="";
        $msgEmail1="";
        $msgEmail= "";
        $msgEmail2= "";
        $msgEmail3= "";
        $email="";
        $msgCondiciones="";
        $msgCoche="";
        
        if (isset ($_POST['enviar'])){
            
        $nombre= $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $edad= $_POST['edad'];
        $fechaNacimiento = $_POST['fecha'];
        $direccion = $_POST['direccion'];
        $cp = $_POST['cp'];
        $ciudad = $_POST['ciudad'];
        $carnet = $_POST['carnet'];
        $coche = $_POST['coche'];
        $correo = $_POST['correo'];
        $correo2 = $_POST['correo2'];
          
       if (isset ($_POST['condiciones'])){
           
           $condiciones = $_POST['condiciones'];
           
       }else {
           
           $msgCondiciones ="Acepta las condiciones";
           $error= true;
       }
        
        if ($nombre == ""){
            
            $msgBoxNombre = "Introduzca su nombre";
            $error= true;
        }
        
        if ($apellidos == ""){
            
            $msgBoxApellidos = "Introduce los apellidos";
            $error= true;
        }
        if ($edad ==""){
            
            $msgEdad1 = "Introduce la edad";
            $error= true;
            
        } elseif (($edad<18) || ($edad >65)){
            
            $msgEdad2 = "Edad fuerad de rango (18 -65)";
            $error= true;
        }
        
            if ($fechaNacimiento == ""){
                
                $msgFecha = "La fecha no es una fecha valida";
                $error= true;
            }
            
            if ($direccion == ""){
                
                $msgDireccion = "La direccion no puede estar vacía";
                $error= true;
            }
            
            if ((strlen($cp) < 5) || (strlen($cp) < 5)){
                
                $msgCp1 = "Introduce el codigo postal recuerda que tiene que tener 5 posiciones numericas";
                $error= true;
                
            } elseif(!is_numeric($cp)){
                
                $msgCp2 = "El código postal tiene que ser un numero";
                $error= true;
                
            } 
            if ((strlen($correo)>1)){
                
               if  ((substr_count($email,"@")) !== 0){
                
                $msgEmail1 = " Email incorrecto, falta la @";
                $error= true;
                   
               }elseif (substr_count($email,".") < 0){
                
                $msgEmail2 = " Email incorrecto, falta el .xxx";
                $error= true;
                   
               }
                        
                            
            } else {
                
                $msgEmail = "El correo no puede estar vacio ni contener un unico caracter"; 
                $error= true;
            }
            
            if ($correo !== $correo2){
                
                $msgEmail3 = "los correos no coinciden";
                $error= true;
            }
            
              if ($coche == ""){
                
                $msgCoche = "Por favor indica si tienes coche<s";
                $error= true;
            }
            if ($carnet == ""){
                
                $msgCarnet = "Por favor indica si tienes carnet";
                $error= true;
            }
            
            if ($error == false){
            
     echo "<div class='row'>
        <div class = 'col-12'>  
        <h1 '>Gracias por confiar en nosotros</h1>
        </div>
        <div class = 'col-3'></div> 
        <div class = 'col-6' id='datos'>
        
        <h2>Estos son tus datos</h2>
            <p> Nombre: $nombre <br> Apellidos:
        $apellidos <br> Edad:
        $edad <br> Fecha de Nacimiento: 
        $fechaNacimiento <br> Direccion: 
        $direccion <br> C.P:
        $cp<br> Ciudad: 
        $ciudad<br> Carnet de conducir:
        $carnet <br> coche:
        $coche  <br> Email:
        $correo
        
        </P>  ";
               
        }

        }
        
        if ((!isset ($_POST['enviar'])) || $error== true) {
            
        ?>
            <div class="row">
                <div class="col-12">
                    <h1>Trabaja con nosotros</h1>
                </div>

                <div class="col-3"></div>
                <div class="col-6" id="formulario">

                    <form acction="<? echo $_SERVER['PHP_SELF'];?>" method="POST" name="TrabajaConNosotros">
                        <fieldset>
                            <legend>Datos Personales</legend>
                            <div>
                                <label>Nombre:</label>
                                <input type="text" name='nombre' value="<?php echo "$nombre";?>" >
                                <span><?php echo $msgBoxNombre;?></span>
                            </div>
                            <div>
                                <label>Apellidos:</label>
                                <input type="text" name="apellidos" value="<?php echo "$apellidos";?>">
                                <span><?php echo $msgBoxApellidos; ?></span>
                            </div>
                            <div>
                                <label>Edad:</label>
                                <input type="number" name="edad" value="<?php echo "$edad"; ?>">
                                <span> <?php echo $msgEdad1;?> <?php echo $msgEdad2;?> </span>
                            </div>
                            <div>
                                <label>Fecha de Nacimiento</label>
                                <input type="date" name="fecha" value="<?php echo "$fechaNacimiento";?>">
                                <span><?php echo $msgFecha;?> </span>
                            </div>
                            <div>
                                <label>Dirección</label>
                                <input type="text" name="direccion" value="<?php echo "$direccion";?>">
                                <span><?php echo $msgDireccion;?> </span>
                            </div>
                            <div>
                                <label>Código Postal:</label>
                                <input type="number" name="cp" value="<?php echo "$cp"; ?>">
                                <span><?php echo $msgCp1;?><?php echo $msgCp2;?> </span>
                            </div>
                            <div>
                                <label>Ciudad:</label>
                                <select name="ciudad">
                    <option value="seleciona">--- Selecciona una ciudad---</option>
    <?php 
       
        $ciudades = array("A Coruña"," Albacete"," Alicante"," Almería"," Araba"," Asturias"," Ávila"," Badajoz"," Barcelona"," Burgos"," Cáceres"," Cádiz"," Cantabria"," Castellón"," Ciudad Real"," Córdoba"," Cuenca"," Girona"," Gipuzkoa"," Granada"," Guadalajara","Huelva"," Huesca"," Baleares"," Jaén"," La Rioja"," Las Palmas"," León"," Lérida"," Lugo"," Madrid"," Málaga"," Murcia"," Navarra"," Orense"," Palencia"," Pontevedra"," Salamanca"," Segovia"," Sevilla"," Soria"," Tarragona"," Santa Cruz de Tenerife"," Teruel"," Toledo"," Valencia"," Valladolid"," Vizcaya"," Zamora"," Zaragoza");
           
                for ($i=0; $i<count($ciudades);$i++) {
                    
     ?>
                 <option value="<?php echo $ciudades[$i]?>" <?php if ($ciudad ==$ciudades[$i]){ echo "selected"; }?>> <?php echo $ciudades[$i]?></option>
                    
               <?php    } ?>
                    
                   
                </select>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Datos Profesionales</legend>
                            <div>
                                <label>Carnet de conducir</label>
                                <input type="radio" id="carnet" name="carnet" value="Si" <?php if($carnet=="Si" ) { echo "checked"; }?> onchange="habilitar(this.value);">Si
                                <input type="radio" id="carnet" name="carnet" value="No" <?php if($carnet=="No" ){ echo "checked"; }?> onchange="habilitar(this.value);">No
                                <span><?php echo $msgCarnet;?></span>
                            </div>
                            <div>
                                <label>Coche:</label>
                                <input type="radio" id="coche" name="coche" value="Si" <?php if($coche=="Si" ) { echo "checked"; }?> disabled=true>Si
                                <input type="radio" id="coche1" name="coche" value="No" <?php if(($coche=="No" )||($coche=="" )) { echo "checked"; }?> disabled=true>No
                                <span><?php echo $msgCoche;?></span>
                            </div>
                            <div>
                                <label>Correo electronico:</label>
                                <input type="Text" name="correo" value="<?php echo "$correo";?>">
                                <span><?php echo $msgEmail;?><?php echo $msgEmail1;?><?php echo $msgEmail2;?></span>
                            </div>
                            <div>
                                <label> Confirma Correo: </label>
                                <input type="Text" name="correo2">
                                <span><?php echo $msgEmail3;?></span>
                            </div>
                        </fieldset>
                        <div>
                            <input type="checkbox" name="condiciones" value="si">
                            <label>Acepto las condiciones</label>
                            <span><?php echo $msgCondiciones;?></span>
                        </div>

                        <input class="boton" type="submit" name="enviar" value="Enviar">
                        <input class="boton" type="reset" name="borrar" value="Borrar">
                    </form>
                </div>
                <?php
        }
            ?>
                    <div class="col-3"></div>
            </div>
    </div>
    <?php     
            
            include ("PHP/footer.php");

            ?>

</body>

</html>
