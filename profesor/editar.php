<?php 
include 'conexion.php';

session_start();
error_reporting(0);
$varsesion= $_SESSION["txtusuario"];
if($varsesion == null || $varsesion == ''){
	header("Location: ../login/index.php");
    die();
}

$idnota = $_GET['idnota'];
$nota = $_GET['nota'];
$fecha = $_GET['fecha'];
$alumno = $_GET['alumno'];
$unidad = $_GET['unidad'];
$tipo = $_GET['tipo'];

$idmateria = $_GET['idmateria'];
$idcurso = $_GET['idcurso'];

// Reemplazamos las comas por puntos para asegurar el formato adecuado (por ejemplo, 8,00 -> 8.00)
$nota = str_replace(',', '.', $nota);
// Convertimos la nota a un número flotante
$nota = floatval($nota);

// Si la nota tiene decimales diferentes de cero, se mostrará con el formato de decimal
if ($nota != round($nota)) {
    $nota = number_format($nota, 2);
} else {
    // Si la nota tiene decimales igual a cero, se mostrará como entero
    $nota = number_format($nota, 0);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR</title>
    <link rel="stylesheet" href="../css/editar.css">
</head>

<header>
  <div class="btnAtras"><a href="tabla2.php?idmateria=<?php echo $idmateria ?>&idcurso=<?php echo $idcurso ?>">Atrás</a></div>
  <div class="titulo"><h1>Modificación de Notas</h1></div>
  <nav>
    <a href="buscador.php">Buscar</a>
  </nav>
</header>

<body>

<div class="editar">
  <form action="speditar.php" method="post">
    <input type="hidden" name="idnota" value="<?php echo $idnota; ?>">
    <label>Nota:</label> <input required type="number" name="nota" min="1" max="10" value="<?php echo $nota; ?>">
    <label>Fecha:</label><input type="date" name="fecha" value="<?php echo $fecha; ?>">
    <label>Alumno:</label><input type="text" name="alumno" value="<?php echo $alumno; ?>" disabled>
    <label>Unidad:</label><input type="text" name="unidad" value="<?php echo $unidad; ?>" disabled>
    <label>Tipo de nota:</label><input type="text" name="tipo" value="<?php echo $tipo; ?>" disabled>
    <input type="hidden" name="idmateria" value="<?php echo $idmateria; ?>">
    <input type="hidden" name="idcurso" value="<?php echo $idcurso; ?>">
    <input type="submit" value="ACTUALIZAR">
  </form>
</div>

</body>
</html>
