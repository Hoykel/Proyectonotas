<?php
$nota = $_POST['nota'];
$fecha = $_POST['fecha'];
$idmateria = $_POST['idmateria'];
$idalumno = $_POST['idalumno'];
$idunidad = $_POST['unidad'];
$idtipo = $_POST['tipo'];

$idmateria = $_POST['idmateria'];
$idcurso = $_POST['idcurso'];

$mysqli=mysqli_connect("localhost", "root", "",  "proyectonotas");
$sql = "insert into Notas (Nota,Fecha_nota,Id_materia,Id_alumno,Id_unidad,Id_tipo)
VALUES ($nota, '$fecha', $idmateria, $idalumno,$idunidad,$idtipo)";
$rta = mysqli_query($mysqli, $sql);

if(!$rta){
    echo "No se insertó";
} else{
    header("Location: tabla2.php?idmateria=$idmateria&idcurso=$idcurso"); 
 //  echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
}

?>