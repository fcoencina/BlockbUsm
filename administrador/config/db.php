
<?php
#Conexion a DB

$host = "localhost";
$db = "sitio";
$user = "root"; #Por defecto 
$pass = "";

try{
    #port debe ser el mismo que el mysql de xampp.
    $conexion = new PDO("mysql:host=$host;port=3308;dbname=$db", $user, $pass);
    /*if($conexion){
        echo "Conectado... a sistema";
    }*/
}
catch(Exception $ex) {
    echo $ex->getMessage();
}
?>