
<?php include("template/cabecera.php");?>
<?php include("../db.php");

session_start();
error_reporting(0);

$usuario = (isset($_REQUEST["user"]))?$_REQUEST["user"]:"";
$pswd = (isset($_REQUEST["pswd"]))?$_REQUEST["pswd"]:"";
$descp = (isset($_REQUEST["descp"]))?$_REQUEST["descp"]:"";
$delete = (isset($_REQUEST["eliminar"]))?$_REQUEST["eliminar"]:"";;

if($delete != ""){
    echo $delete;
}

$SQL_sentence = $conexion->prepare("UPDATE usuarios SET 
nombre=:nombre,pswd=:pswd,desc_personal=:descp WHERE id=:id_user");
$SQL_sentence->bindparam(":id_user", $_SESSION["id_user"]);
$SQL_sentence->bindparam(":nombre", $usuario);
$SQL_sentence->bindparam(":pswd", $pswd);
$SQL_sentence->bindparam(":descp", $descp);
$SQL_sentence->execute();
header("Location:miperfil.php");
?>


<?php include("template/pie.php");?>