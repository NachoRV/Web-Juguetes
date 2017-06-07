<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Mis Juguetes</title>
    <link rel="stylesheet" type="text/css" href="CSS/GeneralCSS.css">
</head>
<body id="body">

    <div id="generaxml">

        <?php
            include ("PHP/header.php"); 
            include ("PHP/accionesofertas.php");

            if (!isset($_POST['gerente'])){
        ?>
                <div class= "row">
                <div class= "col-4"></div>
                <div class= "col-4" id = "forNombre">

                <form  action ="<?php echo $_SERVER['PHP_SELF'];?>" method = 'POST' name ='SelectGerente'>
                    <fieldset>
                        <legend>Seleciona tu nombre</legend>
                        <select id = "nomTrabajador" name="trabajador">
                            <option value="Nacho">Nacho</option>
                            <option value="Patricia">Patricia</option>
                            <option value="Carla">Carla</option>
                            <option value="Laura">Laura</option>
                        </select>
                        <input type = "submit" class="boton" value = "Seleccionar" name="gerente">
                    </fieldset> 
                </form>
                </div>
                <div class= "col-4"></div>
                </div>
 
        <?php  

// confirmamos si existe el fichero xml
            }else {

            if (file_exists('ofertas.xml')){

// en caso de existir recuperamos los datos y ejecutamos la funcion para actualizarlo

                $xml = simplexml_load_file('ofertas.xml');
                $idXML = $xml->idXML;
                $date = $xml->fechaCreacion;
                $idXML = $idXML + 1;
                $fechaact = date('Y/m/d H:i:s');
                $trabajador = $_POST['trabajador'];

                crearXML($idXML,$date);


                creaTXT($idXML,$date,$fechaact,$trabajador);

                echo "<h1>Archivos actualizados</h1>";

            } else {
// en caso contrario lo creamos y mostramos mensaje
            $idXML = 1;
            $date = date('Y/m/d H:i:s');

            $fechaact = date('Y/m/d H:i:s');
            $trabajador = $_POST['trabajador'];

             creaTXT($idXML,$date,$fechaact,$trabajador);

            crearXML($idXML,$date);
            echo "<h1>Archivos creados</h1>"; 

            }

        }

          
    // funcion que cres xml

           function crearXML($idXML,$date){

    //incluimos la conexion para recuperar los datos de la BBDD

            include("PHP/conexionBBDD.php");
            
    /*recuperamos los datos de oferta luego recupero el nombre y ubicacion, me daba error la sentencia SQL para recuperar todos los datos en una sola consulta*/

            $query = "select * from oferta";
            $stmt = $con->prepare($query);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id_oferta,$fecha_inicio,$fecha_fin,$id_producto,$id_tienda,$descuent);

//empezamos a crear el xml

            $xml = new DOMDocument('1.0','UTF-8');

            $fechaact = date('Y/m/d H:i:s');
            $document = $xml -> createElement('document');
            $document = $xml->appendChild($document);

            $fecha = $xml -> createElement('fechaCreacion',$date);
            $fecha = $document->appendChild($fecha);
            $fechaActualizacion = $xml -> createElement('fechaActualizacion',$fechaact);
            $fechaActualizacion = $document->appendChild($fechaActualizacion);
            $idActualizacion = $xml -> createElement('idXML',$idXML);
            $idActualizacion = $document->appendChild($idActualizacion);
            $ofertas = $xml -> createElement('ofertas');
            $ofertas = $document->appendChild($ofertas);

            while($stmt->fetch()){

               
//recupero el nombre del juguete

            $query2 = "SELECT nombre FROM juguete WHERE id_juguete=" .$id_producto;
            $result = $con->query($query2);
            $row_producto = $result->fetch_assoc();

//recupero la ubicacion de la tienda

            $query3 = "SELECT ubicacion FROM tienda WHERE id_tienda=" .$id_tienda;
            $result = $con->query($query3);
            $row_producto1 = $result->fetch_assoc();
           
            

                $oferta = $xml->createElement('oferta');
                $oferta = $ofertas->appendChild($oferta);

                $nodo_idOferta = $xml -> createElement('idOferta',$id_oferta);
                $nodo_idOferta = $oferta->appendChild($nodo_idOferta);
                $nodo_fechain = $xml-> createElement('fechaInicio',$fecha_inicio);
                $nodo_fechain = $oferta->appendChild($nodo_fechain);
                $nodo_fechafin = $xml->createElement('fechaFin',$fecha_fin);
                $nodo_fechafin = $oferta -> appendChild($nodo_fechafin);
                $nodo_idproducto = $xml->createElement('idProducto',$id_producto);
                $nodo_idproducto = $oferta->appendChild($nodo_idproducto);
                $nodo_nombre = $xml->createElement('Juguete',$row_producto['nombre']);
                $nodo_nombre = $oferta->appendChild($nodo_nombre);
                $nodo_idtienda = $xml->createElement('idTienda',$id_tienda);
                $nodo_idtienda = $oferta->appendChild($nodo_idtienda);
                $nodo_tienda = $xml->createElement('tienda',$row_producto1['ubicacion']);
                $nodo_tienda = $oferta->appendChild($nodo_tienda);

            }

            $con->close();

    //creamos el xml en el servidor

            $xml->formatOutput = true;
            $el_xml  = $xml->saveXML();
            $xml-> save('ofertas.xml');  

           }   
                 
    // Creamos la funcion del fichero txt

    function creaTXT($idXML,$date,$fechaact,$trabajador){

        $file = fopen("crea.txt","w") or die("ha habido un error al crear el archivo");
        fputs($file, "ID: ".$idXML.PHP_EOL);
        fputs($file,"Fecha de Creacion: ".$date.PHP_EOL);
        fputs($file,"Fecha de Actualizacion: ".$fechaact.PHP_EOL);
        fputs($file, "Trabajador: ".$trabajador.PHP_EOL);
        fclose($file);

    //

    }
       ?>
       </div>   
    <?php
            include ("PHP/footer.php");

            ?>
    
</body>

</html>
