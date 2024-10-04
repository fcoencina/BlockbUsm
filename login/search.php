
<?php include("template/cabecera.php");?>
<?php include("../db.php");?>

<?php

session_start();
error_reporting(0);

$searching = $_REQUEST["mibusqueda"];

#SELECT * FROM `peliculas` WHERE nombre LIKE '%L%';

$SQL_sentence = $conexion->prepare("SELECT * FROM peliculas WHERE nombre LIKE '%$searching%';");
$SQL_sentence->execute();
$films = $SQL_sentence->fetchAll(pdo::FETCH_ASSOC);

$SQL_sentence2 = $conexion->prepare("SELECT * FROM usuarios WHERE nombre LIKE '%$searching%';");
$SQL_sentence2->execute();
$users = $SQL_sentence2->fetchAll(pdo::FETCH_ASSOC);

?>
<div class="row">
    <div class="col-md-6">
        <ul class="list-group">
            <li class="list-group-item">Películas</li>
            <br>
            <?php foreach ($films as $film){?>
                <li class="list-group-item"><?php echo $film["nombre"]?></li> 
            <?php }?>
            <a class="btn btn-primary" href="peliculas.php" role="button">Ir a películas</a>
        </ul>
    </div>
    <div class="col-md-6">
        <ul class="list-group">
            <li class="list-group-item">Usuarios</li>
            <br>
            <?php 
            foreach ($users as $user){
                if($user["nombre"] != $_SESSION["usuario"]){?>
                    <li class="list-group-item"><?php echo $user["nombre"];?></li> 
                    <form method="post" action="ver_usuario.php">
                        <button name="iduser" value="<?php echo $user["id"]?>" class="btn btn-primary" type="submit">Conocer a <?php echo $user["nombre"]?></button>
                    </form>
                    <br>
            <?php } }?>
        </ul>
    </div>
</div>

<?php include("template/pie.php");?>