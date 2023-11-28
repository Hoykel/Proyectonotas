<?php
$idnota = $_POST['idnota'];
$nota = $_POST['nota'];
$fecha = $_POST['fecha'];

$idmateria = $_POST['idmateria'];
$idcurso = $_POST['idcurso'];


$mysqli=mysqli_connect("localhost", "root", "",  "proyectonotas");
$sql = "UPDATE Notas set Nota=$nota, Fecha_nota='$fecha'WHERE Id_nota=$idnota";
$rta = mysqli_query($mysqli, $sql);

if(!$rta){
    echo "No se actualizó";
} else{
   // echo '<script language="javascript">alert("Los datos han sido actualizados, recargue la página para ver las actualizaciones");window.location.href="indexprofes.php"</script>';
header("Location: tabla2.php?idmateria=$idmateria&idcurso=$idcurso"); 
//echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
}

?>