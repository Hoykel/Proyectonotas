<?php
include 'conexion.php';
error_reporting(0);

$nombre = $_POST["txtusuario"];
$pass = $_POST["txtpassword"];

session_start();
$_SESSION["txtusuario"]=$nombre;



$query = mysqli_query($mysqli,"SELECT * FROM Usuarios WHERE Usuario= '".$nombre."' and Contraseña= '".$pass."'");
$mostrar = mysqli_fetch_array($query);

if($mostrar['Id_perfil']==1){ 			//ALUMNO
    header("location:../alumno/indexAlumnos.php");
}else

if($mostrar['Id_perfil']==2){ 			//PROFESOR
                    header("location:../profesor/pr.php");
}
else
if($mostrar['Id_perfil']==3){ 			//ADMINISTRATIVO
header("location:../Administrativa/index.php");
}
else 
if ($mostrar == 0) 					//DATOS INCORRECTOS
{
	echo '<script language="javascript">alert("Los datos son incorrectos");window.location.href="index.php"</script>';

}

	
?>