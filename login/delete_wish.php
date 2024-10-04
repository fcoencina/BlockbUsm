
<?php include("template/cabecera.php");?>
<?php include("../db.php");?>

<?php

$delete_id = $_REQUEST["peli_id"];

$SQL_sentence = $conexion->prepare("DELETE FROM wishlist
WHERE fk_userID=:id_user and fk_filmID=:id_peli");
$SQL_sentence->bindparam(":id_user", $_SESSION["id_user"]);
$SQL_sentence->bindparam(":id_peli", $delete_id);
$SQL_sentence->execute();
header("Location:wishlist.php");

?>


<?php include("template/pie.php");?>