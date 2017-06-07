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
           
        
        ?>
        <div class= "row">
        <div class= "col-4"></div>
        <div class= "col-4" id= "lecturaxml">
        <h3 id= tituloXML> Lectura del XML</h3><br>
    
        <?php

    //ejecutamos la fuincion leer 

      leer();

      ?>

      <h3 id= tituloXML> Lectura del TXT</h3><br>

      <?php

      leerTXT();

        ?>
        </div>

        <?php

        function leer(){
            
            //cargamos el fichero
    
            $xml = simplexml_load_file('ofertas.xml');

        //CREAMOS LA SALIDA Y LA IMPRIMIMOS POR PANTALLA

            $salida ="";

            $salida .= "<b> Fecha de Creacion</b> " . $xml->fechaCreacion. "<br>"; 
            $salida .= "<b> Fecha de actualizacion </b>". $xml->fechaActualizacion. "<br>";
            $salida .= "<b> id fichero </b>" .$xml->idXML. "<br><br>";

            foreach ($xml->ofertas->oferta as $key) {
                
                $salida .= "<b> id Oferta: </b>" .$key->idOferta. "</br>".
                            "<b> Fecha inicio </b>" .$key->fechaInicio. "</br>".
                            "<b> Fecha Fin: </b>" .$key->fechaFin. "</br>".
                            "<b> Id Producto: </b>" .$key->idProducto. "</br>".
                            "<b> Juguete: </b>" .$key->Juguete. "</br>".
                            "<b> Id Tienda </b>" .$key->idTienda. "</br>".
                            "<b> Direccion: </b>" .$key->tienda. "</br></br></br>";


            }
            echo $salida;
        }

 // funcion leer TXT

        function leerTXT(){


           $file = fopen("crea.txt", "r") or die("error al leer el txt");
           while(!feof($file)){

                $line = fgets($file);
                echo     $line."<br>";

           }


        }

          ?>
          <div class= "col-4"></div>
          </div>

          <?php
    
            include ("PHP/footer.php");

            ?>
    </div>
</body>

</html>
