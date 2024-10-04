
<?php include("template/cabecera.php");?>
<?php include("../db.php");?>

<?php

session_start();
error_reporting(0);

$SQL_sentence = $conexion->prepare("SELECT * FROM usuarios_seguidores WHERE fk_userID=:id_user;");
$SQL_sentence->bindparam(":id_user", $_SESSION["id_user"]);
$SQL_sentence->execute();
$seguidos = $SQL_sentence->fetchAll(pdo::FETCH_ASSOC);

if(empty($seguidos)){
    echo "No tiene usuarios seguidos";
}
else{
    foreach ($seguidos as $seguido){
        $SQL_sentence2 = $conexion->prepare("SELECT * FROM usuarios WHERE id=:id_user;");
        $SQL_sentence2->bindparam(":id_user", $seguido["fk_segID"]);
        $SQL_sentence2->execute();
        $user = $SQL_sentence2->fetch(pdo::FETCH_LAZY);?>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $user["nombre"]?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo "Seguidores: ".$user["n_seguidores"]." Seguidos: ".$user["nc_seguidas"]?></h6>
                <p class="card-text"><?php echo $user["desc_personal"]?></p>
                <a href="#" class="card-link">Seguir</a>
            </div>
        </div>
<?php }}?>

<?php include("template/pie.php");?>