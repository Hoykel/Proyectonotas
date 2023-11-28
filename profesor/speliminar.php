<?php
$idnota = $_GET['idnota'];

$idmateria = $_GET['idmateria'];
$idcurso = $_GET['idcurso'];

$mysqli=mysqli_connect("localhost", "root", "",  "proyectonotas");
$sql = "Delete from Notas WHERE Id_nota=$idnota";
$rta = mysqli_query($mysqli, $sql);

if(!$rta){
    echo "No se eliminó";
} else{
    //header("Location: pr.php");
    header("Location: tabla2.php?idmateria=$idmateria&idcurso=$idcurso"); 

}

?>