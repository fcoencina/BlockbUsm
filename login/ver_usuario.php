
<?php include("template/cabecera.php");?>
<?php include("../db.php");?>

<?php 

$usuario_id = (isset($_REQUEST["iduser"]))?$_REQUEST["iduser"]:"";

$SQL_sentence = $conexion->prepare("SELECT * FROM usuarios WHERE id=:id_user;");
$SQL_sentence->bindparam(":id_user", $usuario_id);
$SQL_sentence->execute();
$user = $SQL_sentence->fetch(pdo::FETCH_LAZY);

?>

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"><?php echo $user["nombre"]?></h5>
    <h6 class="card-subtitle mb-2 text-muted"><?php echo "Seguidores: ".$user["n_seguidores"]." Seguidos:".$user["nc_seguidas"]?></h6>
    <p class="card-text"><?php echo $user["desc_personal"]?></p>
    <form action="agregar_segdo.php" method="post">
      <button name="iduser" value="<?php echo $usuario_id;?>" type="submit" class="btn btn-primary">Seguir</button>
    </form>
  </div>
</div>

<?php include("template/pie.php");?>