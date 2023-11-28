<?php 
include 'conexion.php';

session_start();
error_reporting(0);
$varsesion= $_SESSION["txtusuario"];
if($varsesion== null || $varsesion=''){
	header("Location: ../login/index.php");
    die();
}

$getunidades=mysqli_query($mysqli,"Select * from Unidades");
$gettipos=mysqli_query($mysqli,"Select * from TiposDeNota where tipo NOT IN('Promedio Final', 'Cierre de unidad')");
 ?>
 
<?php
$alumno = $_GET['alumno'];
$idmateria = $_GET['idmateria'];
$idalumno = $_GET['idalumno'];
$idcurso = $_GET['idcurso'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSERTAR</title>
    <link rel="stylesheet" href="../css/insertar.css">
</head>

<header>
    <div class="btnAtras"><a href="tabla2.php?idmateria=<?php echo $idmateria ?>&idcurso=<?php echo $idcurso ?>">Atrás</a></div>
    <div class="titulo"><h1>Inserción de Notas</h1></div>
    <nav>
        <a href="buscador.php">Buscar</a>
    </nav>
</header>

<body>

    <div class="insertar">
        
    <form action="spinsertar.php" method="post">

        <label>Nota:</label> <input type="number" name="nota" min="1" max="10" required>
        <label>Fecha:</label> <input type="date" name="fecha">
        <label>Alumno:</label> <input type="text" name="apellido" value="<?php echo $alumno;?>" disabled> 
       
        <input type="hidden" name="idmateria" value="<?php echo $idmateria;?>">
        <input type="hidden" name="idcurso" value="<?php echo $idcurso;?>">

        <label>Unidad Didáctica:</label>
        <select name="unidad">
            <?php while($unidad = mysqli_fetch_array($getunidades)) { ?>
                <option value="<?php echo $unidad['Id_unidad']?>"><?php echo $unidad['Unidad']?></option>
            <?php } ?>
        </select>

        <label>Tipo de Nota:</label>
        <select name="tipo">
            <?php while($tipo = mysqli_fetch_array($gettipos)) { ?>
                <option value="<?php echo $tipo['Id_tipo']?>"><?php echo $tipo['Tipo']?></option>
            <?php } ?>
        </select>

        <input type="hidden" name="idmateria" value="<?php echo $idmateria;?>"> 
        <input type="hidden" name="idalumno" value="<?php echo $idalumno;?>"> 

        <input type="submit" value="INSERTAR"> 
    
    </form>
    
    </div>

</body>
</html>
