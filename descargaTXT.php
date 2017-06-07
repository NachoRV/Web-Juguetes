<?php
// Vamos a mostrar un xml
header('Content-type: application/txt');

// Se llamará ofertas xml
header('Content-Disposition: attachment; filename="crea.txt"');

// La fuente de xml se encuentra en ofertas xml
readfile('crea.txt');
?>