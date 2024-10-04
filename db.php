
<?php
#Conexion a DB

$host = "localhost";
$db = "tarea2";
$user = "root"; #Por defecto 
$pass = "";

try{
    #port debe ser el mismo que el mysql de xampp.
    $conexion = new PDO("mysql:host=$host;port=3306;dbname=$db", $user, $pass);
    /*if($conexion){
        echo "Conectado... a sistema";
    }*/
}
catch(Exception $ex) {
    echo $ex->getMessage();
}
?>