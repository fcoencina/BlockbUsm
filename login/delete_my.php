
<?php include("template/cabecera.php");?>
<?php include("../db.php");?>

<?php

session_start();
error_reporting(0);

$delete = (isset($_REQUEST["eliminar"]))?$_REQUEST["eliminar"]:"";

if($delete != ""){
    $SQL_sentence = $conexion->prepare("DELETE FROM usuarios
    WHERE id=:id_user");
    $SQL_sentence->bindparam(":id_user", $_SESSION["id_user"]);
    $SQL_sentence->execute();
    header("Location:../index.php");
}

?>

<?php include("template/pie.php");?>