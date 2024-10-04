
<?php include("template/cabecera.php");?>
<?php include("../db.php");?>

<?php

session_start();
error_reporting(0);

$SQL_sentence = $conexion->prepare("SELECT * FROM usuarios WHERE id=:id_user");
$SQL_sentence->bindparam(":id_user", $_SESSION["id_user"]);
$SQL_sentence->execute();
$user = $SQL_sentence->fetch(pdo::FETCH_LAZY);

?>

<form method="post" action="miperfil2.php">
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Usuario</label>
  <input type="text" name="user" class="form-control" id="exampleFormControlInput1" value="<?php echo $user["nombre"];?>" placeholder="Ingrese usuario">
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Contraseña</label>
  <input type="text" name="pswd" class="form-control" id="exampleFormControlInput1" value="<?php echo $user["pswd"];?>">
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Número de seguidores</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $user["n_seguidores"];?>">
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Número de cuentas seguidas</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $user["nc_seguidas"];?>">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Descripción personal</label>
  <textarea class="form-control" name="descp" id="exampleFormControlTextarea1" rows="3"><?php echo $user["desc_personal"];?></textarea>
</div>
<button type="submit" class="btn btn-info">Actualizar</button>
</form>
<form method="post" action="delete_my.php">
  <button type="submit" name="eliminar" value="eliminar" class="btn btn-info">Eliminar cuenta</button>
</form> 
<br>

<?php include("template/pie.php");?>