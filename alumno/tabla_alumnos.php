<?php 
include 'conexion.php';
$idmateria=$_POST['materia'];


session_start();
error_reporting(0);
$varsesion= $_SESSION["txtusuario"];
if($varsesion== null || $varsesion=''){
	header("Location: ../login\index.php");
    die();
}
$user= $_SESSION["txtusuario"];
 ?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Mostrar notas</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/tabla.css">
</head>

	<header>
			  <div class="btnAtras"> <a id="atras" class="fa fa-arrow-circle-left" href="indexAlumnos.php"></a>  </div>
			  <div class="titulo"><h1>VISUALIZACIÓN DE NOTAS</h1></div>
              <nav>
                <a id="btnfiltro" href="buscador.php"> <i class="fa fa-filter"></i> Filtros</a>
              </nav>
    </header>


<body>
<div class="indicador">
	<?php
$materia = mysqli_query($mysqli, "SELECT Materia FROM Materias, Usuarios WHERE Materias.Id_materia = $idmateria and Usuarios.Usuario='$user'");
$mostrar = mysqli_fetch_array($materia);
echo "<h1>Materia: " . $mostrar['Materia'] . "</h1>";
	?>
</div>

<div class="btnTodas"> <button class="btnMostrarOcultarTodas" id="btnMostrarOcultarTodas" onclick="alternarMostrarTodas();">
  <span></span><span></span><span></span><span></span>Mostrar / Ocultar todas las unidades
</button>
</div>

<div class="cerrarsesion"> <a class="logout-link" href="../login/cerrarsesion.php">Cerrar sesión</a>  </div>



<div class="izquierda"> <!--DIV GENERAL PARA UNIDADES 1,2 Y 3-->
<!------------------------------------------------------------------------------------------------------------->	
<div class="unidad1">
<h1>UNIDAD DIDÁCTICA: 1</h1>	
	 <div class="btnMostrar"> <button id="boton" onclick="alternarMostrarU1();">
	 <span></span><span></span><span></span><span></span>Mostrar / Ocultar</button>  </div>

		<div id="u1"> 

	<table border="1" >

		<tr>
			<th>Materia</th>
			<th>Tipo de Nota</th>
			<th>Fecha Nota</th>
			<th>Nota</th>
			
		</tr>
					<?php 
					$sql="Select * from Notas
					JOIN Alumnos on Alumnos.Id_alumno=Notas.Id_alumno
					JOIN Materias on Materias.Id_materia=Notas.Id_materia
					JOIN Cursos on Cursos.Id_curso=Alumnos.Id_curso
					join Usuarios on Usuarios.Id_usuario=Alumnos.Id_usuario
					JOIN Unidades on Unidades.Id_unidad=Notas.Id_unidad
					JOIN TiposDeNota on TiposDeNota.Id_tipo=Notas.Id_tipo
					WHERE Materias.Id_materia=$idmateria and Usuarios.Usuario='$user' and Unidades.Unidad='1'
					Order by Notas.Fecha_nota";
					$result=mysqli_query($mysqli,$sql);
					while($mostrar=mysqli_fetch_array($result)){
					?>	
		<tr>
			<td><?php echo $mostrar['Materia'] ?></td>
			<td><?php echo $mostrar['Tipo'] ?></td>
			<td><?php echo $mostrar['Fecha_nota'] ?></td>
			<td><?php echo floatval($mostrar['Nota']) ?></td>

		</tr>

					<?php 
					}
					?>
	</table>

</div>
</div>
<!------------------------------------------------------------------------------------------------------------->
<br><div class="unidad2">
<h1>UNIDAD DIDÁCTICA: 2</h1>	
	<div class="btnMostrar"> <button id="boton" onclick="alternarMostrarU2();">
	<span></span><span></span><span></span><span></span>Mostrar / Ocultar</button> </div>
		<div id="u2"> 

	<table border="1" >

		<tr>
			<th>Materia</th>
			<th>Tipo de Nota</th>
			<th>Fecha Nota</th>
			<th>Nota</th>
			
		</tr>
					<?php 
					$sql="Select * from Notas
					JOIN Alumnos on Alumnos.Id_alumno=Notas.Id_alumno
					JOIN Materias on Materias.Id_materia=Notas.Id_materia
					JOIN Cursos on Cursos.Id_curso=Alumnos.Id_curso
					join Usuarios on Usuarios.Id_usuario=Alumnos.Id_usuario
					JOIN Unidades on Unidades.Id_unidad=Notas.Id_unidad
					JOIN TiposDeNota on TiposDeNota.Id_tipo=Notas.Id_tipo
					WHERE Materias.Id_materia=$idmateria and Usuarios.Usuario='$user' and Unidades.Unidad='2'
					Order by Notas.Fecha_nota";
					$result=mysqli_query($mysqli,$sql);
					while($mostrar=mysqli_fetch_array($result)){
					?>	
		<tr>
			<td><?php echo $mostrar['Materia'] ?></td>
			<td><?php echo $mostrar['Tipo'] ?></td>
			<td><?php echo $mostrar['Fecha_nota'] ?></td>
			<td><?php echo floatval($mostrar['Nota']) ?></td>

		</tr>

					<?php 
					}
					?>
	</table>

</div>
</div>
<!------------------------------------------------------------------------------------------------------------->
<br><div class="unidad3">
<h1>UNIDAD DIDÁCTICA: 3</h1>	
	<div class="btnMostrar"><button id="boton" onclick="alternarMostrarU3();">
	<span></span><span></span><span></span><span></span>Mostrar / Ocultar</button></div>
		<div id="u3"> 

	<table border="1" >

		<tr>
			<th>Materia</th>
			<th>Tipo de Nota</th>
			<th>Fecha Nota</th>
			<th>Nota</th>
			
		</tr>
					<?php 
					$sql="Select * from Notas
					JOIN Alumnos on Alumnos.Id_alumno=Notas.Id_alumno
					JOIN Materias on Materias.Id_materia=Notas.Id_materia
					JOIN Cursos on Cursos.Id_curso=Alumnos.Id_curso
					join Usuarios on Usuarios.Id_usuario=Alumnos.Id_usuario
					JOIN Unidades on Unidades.Id_unidad=Notas.Id_unidad
					JOIN TiposDeNota on TiposDeNota.Id_tipo=Notas.Id_tipo
					WHERE Materias.Id_materia=$idmateria and Usuarios.Usuario='$user' and Unidades.Unidad='3'
					Order by Notas.Fecha_nota";
					$result=mysqli_query($mysqli,$sql);
					while($mostrar=mysqli_fetch_array($result)){
					?>	
		<tr>
			<td><?php echo $mostrar['Materia'] ?></td>
			<td><?php echo $mostrar['Tipo'] ?></td>
			<td><?php echo $mostrar['Fecha_nota'] ?></td>
			<td><?php echo floatval($mostrar['Nota']) ?></td>

		</tr>

					<?php 
					}
					?>
	</table>

</div>
</div>
<!------------------------------------------------------------------------------------------------------------->
</div> <!----CIERRE DIV GENERAL PARA UNIDADES 1,2 Y 3-------------->



<div class="derecha"> <!--DIV GENERAL PARA UNIDADES 4,5 y 6-->
<!------------------------------------------------------------------------------------------------------------->
<div class="unidad4">
<h1>UNIDAD DIDÁCTICA: 4</h1>
	<div class="btnMostrar"><button id="boton" onclick="alternarMostrarU4();">
	<span></span><span></span><span></span><span></span>Mostrar / Ocultar</button></div>
		<div id="u4"> 

	<table border="1" >

		<tr>
			<th>Materia</th>
			<th>Tipo de Nota</th>
			<th>Fecha Nota</th>
			<th>Nota</th>
			
		</tr>
					<?php 
					$sql="Select * from Notas
					JOIN Alumnos on Alumnos.Id_alumno=Notas.Id_alumno
					JOIN Materias on Materias.Id_materia=Notas.Id_materia
					JOIN Cursos on Cursos.Id_curso=Alumnos.Id_curso
					join Usuarios on Usuarios.Id_usuario=Alumnos.Id_usuario
					JOIN Unidades on Unidades.Id_unidad=Notas.Id_unidad
					JOIN TiposDeNota on TiposDeNota.Id_tipo=Notas.Id_tipo
					WHERE Materias.Id_materia=$idmateria and Usuarios.Usuario='$user' and Unidades.Unidad='4'
					Order by Notas.Fecha_nota";
					$result=mysqli_query($mysqli,$sql);
					while($mostrar=mysqli_fetch_array($result)){
					?>	
		<tr>
			<td><?php echo $mostrar['Materia'] ?></td>
			<td><?php echo $mostrar['Tipo'] ?></td>
			<td><?php echo $mostrar['Fecha_nota'] ?></td>
			<td><?php echo floatval($mostrar['Nota']) ?></td>

		</tr>

					<?php 
					}
					?>
	</table>

</div>
</div>
<!------------------------------------------------------------------------------------------------------------->
<br><div class="unidad5">
<h1>UNIDAD DIDÁCTICA: 5</h1>	
	<div class="btnMostrar"><button id="boton" onclick="alternarMostrarU5();">
	<span></span><span></span><span></span><span></span>Mostrar / Ocultar</button></div>
		<div id="u5"> 

	<table border="1" >

		<tr>
			<th>Materia</th>
			<th>Tipo de Nota</th>
			<th>Fecha Nota</th>
			<th>Nota</th>
			
		</tr>
					<?php 
					$sql="Select * from Notas
					JOIN Alumnos on Alumnos.Id_alumno=Notas.Id_alumno
					JOIN Materias on Materias.Id_materia=Notas.Id_materia
					JOIN Cursos on Cursos.Id_curso=Alumnos.Id_curso
					join Usuarios on Usuarios.Id_usuario=Alumnos.Id_usuario
					JOIN Unidades on Unidades.Id_unidad=Notas.Id_unidad
					JOIN TiposDeNota on TiposDeNota.Id_tipo=Notas.Id_tipo
					WHERE Materias.Id_materia=$idmateria and Usuarios.Usuario='$user' and Unidades.Unidad='5'
					Order by Notas.Fecha_nota";
					$result=mysqli_query($mysqli,$sql);
					while($mostrar=mysqli_fetch_array($result)){
					?>	
		<tr>
			<td><?php echo $mostrar['Materia'] ?></td>
			<td><?php echo $mostrar['Tipo'] ?></td>
			<td><?php echo $mostrar['Fecha_nota'] ?></td>
			<td><?php echo floatval($mostrar['Nota']) ?></td>

		</tr>

					<?php 
					}
					?>
	</table>

</div>
</div>
<!------------------------------------------------------------------------------------------------------------->	
<br><div class="unidad6">
<h1>UNIDAD DIDÁCTICA: 6</h1>
	<div class="btnMostrar"><button id="boton" onclick="alternarMostrarU6();">
	<span></span><span></span><span></span><span></span>Mostrar / Ocultar</button></div>
		<div id="u6"> 

	<table border="1" >

		<tr>
			<th>Materia</th>
			<th>Tipo de Nota</th>
			<th>Fecha Nota</th>
			<th>Nota</th>
			
		</tr>
					<?php 
					$sql="Select * from Notas
					JOIN Alumnos on Alumnos.Id_alumno=Notas.Id_alumno
					JOIN Materias on Materias.Id_materia=Notas.Id_materia
					JOIN Cursos on Cursos.Id_curso=Alumnos.Id_curso
					join Usuarios on Usuarios.Id_usuario=Alumnos.Id_usuario
					JOIN Unidades on Unidades.Id_unidad=Notas.Id_unidad
					JOIN TiposDeNota on TiposDeNota.Id_tipo=Notas.Id_tipo
					WHERE Materias.Id_materia=$idmateria and Usuarios.Usuario='$user' and Unidades.Unidad='6'
					Order by Notas.Fecha_nota";
					$result=mysqli_query($mysqli,$sql);
					while($mostrar=mysqli_fetch_array($result)){
					?>	
		<tr>
			<td><?php echo $mostrar['Materia'] ?></td>
			<td><?php echo $mostrar['Tipo'] ?></td>
			<td><?php echo $mostrar['Fecha_nota'] ?></td>
			<td><?php echo floatval($mostrar['Nota']) ?></td>

		</tr>

					<?php 
					}
					?>
	</table>

</div>
</div>
<!--------------------------------------------------------------------------------------------->
</div> <!----CIERRE DIV GENERAL PARA UNIDADES 4,5 Y 6-------------->

<footer>
    <div class="ft1">
          <div class="txtfooter"><p>&copy Copyright 2023 ITAPU</p>
                <ul>
                  <li>Código Postal: X5923AJC 
                  <li>General Deheza - Córdoba - Argentina</li>
                  <li>Tel: (0358) 4057800/801/802 (Líneas Rotativas)</li>
                  <li> E-mail: info@itapu.edu.ar</li>
                  <li> Dirección: Boulevard Almirante Brown 217</li>
                </ul>
          </div>      
               <section class="buttons">
                <a href="https://www.facebook.com/ITAPUGD/?locale=es_LA" class="fa fa-facebook"></a>
                <a href="https://www.instagram.com/itapu_/?hl=es-la" class="fa fa-twitter"></a>
                 <a href="#" class="fa fa-envelope"></a>  Estos es el que no sabemos
                <a href="https://www.youtube.com/@institutotecnicoadrianp.ur4898" class="fa fa-youtube"></a>
              </section>

</footer>

<!-------------------------------SCRIPTS PARA BOTONES MOSTRAR Y OCULTAR------------------------------>
<script>
  function alternarMostrarU1() {
    var u1 = document.getElementById('u1');
    var estiloActual = window.getComputedStyle(u1).getPropertyValue('display');
    
    // Si el div está actualmente oculto, lo mostramos; de lo contrario, lo ocultamos
    u1.style.display = estiloActual === 'none' ? 'block' : 'none';
  }

  function alternarMostrarU2() {
    var u2 = document.getElementById('u2');
    var estiloActual = window.getComputedStyle(u2).getPropertyValue('display');
    u2.style.display = estiloActual === 'none' ? 'block' : 'none';
  }

  function alternarMostrarU3() {
    var u3 = document.getElementById('u3');
    var estiloActual = window.getComputedStyle(u3).getPropertyValue('display');
    u3.style.display = estiloActual === 'none' ? 'block' : 'none';
  }

  function alternarMostrarU4() {
    var u4 = document.getElementById('u4');
    var estiloActual = window.getComputedStyle(u4).getPropertyValue('display');
    u4.style.display = estiloActual === 'none' ? 'block' : 'none';
  }

  function alternarMostrarU5() {
    var u5 = document.getElementById('u5');
    var estiloActual = window.getComputedStyle(u5).getPropertyValue('display');
    u5.style.display = estiloActual === 'none' ? 'block' : 'none';
  }

  function alternarMostrarU6() {
    var u6 = document.getElementById('u6');
    var estiloActual = window.getComputedStyle(u6).getPropertyValue('display');
    u6.style.display = estiloActual === 'none' ? 'block' : 'none';
  }

  function alternarMostrarNuevaNota() {
    var u6 = document.getElementById('nuevanota');
    var estiloActual = window.getComputedStyle(nuevanota).getPropertyValue('display');
    u6.style.display = estiloActual === 'none' ? 'block' : 'none';
  }
</script>

<script>
  function alternarMostrarTodas() {
    var u1 = document.getElementById('u1');
    var u2 = document.getElementById('u2');
    var u3 = document.getElementById('u3');
    var u4 = document.getElementById('u4');
    var u5 = document.getElementById('u5');
    var u6 = document.getElementById('u6');

    var estiloActualU1 = window.getComputedStyle(u1).getPropertyValue('display');
    var estiloActualU2 = window.getComputedStyle(u2).getPropertyValue('display');
    var estiloActualU3 = window.getComputedStyle(u3).getPropertyValue('display');
    var estiloActualU4 = window.getComputedStyle(u4).getPropertyValue('display');
    var estiloActualU5 = window.getComputedStyle(u5).getPropertyValue('display');
    var estiloActualU6 = window.getComputedStyle(u6).getPropertyValue('display');

    // Si alguna unidad está oculta, las mostramos todas; de lo contrario, las ocultamos todas.
    var mostrarTodas = estiloActualU1 === 'none' || estiloActualU2 === 'none' || estiloActualU3 === 'none' || estiloActualU4 === 'none' || estiloActualU5 === 'none' || estiloActualU6 === 'none';

    u1.style.display = mostrarTodas ? 'block' : 'none';
    u2.style.display = mostrarTodas ? 'block' : 'none';
    u3.style.display = mostrarTodas ? 'block' : 'none';
    u4.style.display = mostrarTodas ? 'block' : 'none';
    u5.style.display = mostrarTodas ? 'block' : 'none';
    u6.style.display = mostrarTodas ? 'block' : 'none';
  }
</script>



<!-------------------------CIERRE SCRIPTS PARA BOTONES MOSTRAR Y OCULTAR------------------------------>

</body>
</html>