
<?php include("template/cabecera.php");?>
<?php include("../db.php");?>

<?php

$SQL_sentence = $conexion->prepare("SELECT * FROM usuarios;");
$SQL_sentence->execute();
$users = $SQL_sentence->fetchAll(pdo::FETCH_ASSOC);

?>

<?php 
foreach ($users as $user){
    if($user["nombre"] != $_SESSION["usuario"]){?>
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"><?php echo $user["nombre"]?></h5>
    <h6 class="card-subtitle mb-2 text-muted"><?php echo "Seguidores: ".$user["n_seguidores"]." Seguidos: ".$user["nc_seguidas"]?></h6>
    <p class="card-text"><?php echo $user["desc_personal"]?></p>
    <form action="agregar_segdo.php" method="post">
      <button name="iduser" value="<?php echo $user["id"];?>" type="submit" class="btn btn-primary">Seguir</button>
    </form>
  </div>
</div>
<?php }}?>
<?php include("template/pie.php");?>