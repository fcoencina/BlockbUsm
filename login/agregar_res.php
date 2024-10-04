
<?php include("template/cabecera.php");?>

<?php
$id_pelicula = (isset($_REQUEST["peli_id"]))?$_REQUEST["peli_id"]:"";
?>

<div class="container">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-5">
              <br>
                <div class="card">
                    <div class="card-header">
                        Agregar reseña
                    </div>
                    <div class="card-body">
                        <form method="POST" action="subir_res.php">
                            <div class = "form-group">
                                <label for="cal">Calificación(entre 1 y 10)</label>
                                <input type="number" class="form-control" name="cal" placeholder="Ingrese calificación">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="comment">Comentario</label>
                                <br>
                                <input type="text" class="form-control" name="comment" placeholder="Ingrese comentario">
                            </div>
                            <br>
                            <small id="emailHelp" class="form-text text-muted">Nunca compartiremos tus datos con nadie.</small>
                            <br><br>
                            <button name="peli_id" value="<?php echo $id_pelicula?>" type="submit" class="btn btn-primary">Agregar reseña</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include("template/pie.php");?>