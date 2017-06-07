<?php
// Vamos a mostrar un xml
header('Content-type: application/xml');

// Se llamará ofertas xml
header('Content-Disposition: attachment; filename="ofertas.xml"');

// La fuente de xml se encuentra en ofertas xml
readfile('ofertas.xml');
?>