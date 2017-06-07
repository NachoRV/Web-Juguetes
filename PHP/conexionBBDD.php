<?php

/*trabajo
// datos para la coneccion a mysql 
define('DB_SERVER','localhost'); 
define('DB_NAME','jugueteria'); 
define('DB_USER','root'); 
define('DB_PASS','rootroot'); 

/*
//casa 
define('DB_SERVER','localhost:8889'); 
define('DB_NAME','jugueteria'); 
define('DB_USER','root'); 
define('DB_PASS','root'); 


//servidor
*/
// datos para la coneccion a mysql 
define('DB_SERVER','localhost'); 
define('DB_NAME','u377382806_jugue'); 
define('DB_USER','u377382806_nacho'); 
define('DB_PASS','nacho1'); 

//conexion con la base de datos

$con = new mysqli(DB_SERVER,DB_USER, DB_PASS,DB_NAME);

if ($con-> connect_errno){
    
    echo "error en la conexion";
    
}


?>