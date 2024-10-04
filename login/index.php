
<?php include("template/cabecera.php");?>

<?php

session_start();
error_reporting(0);

#$_SESSION["usuario"]."<br>";
#$_SESSION["pswd"];

?>

<div class="col-md-12">
    <div class="jumbotron">
        <h1 class="display-3">Bienvenido <?php echo $_SESSION["usuario"];?></h1>
        <hr class="my-2">
        <p></p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="#" role="button">Jumbo action name</a>
        </p>
    </div>
</div>

<?php include("template/pie.php");?>