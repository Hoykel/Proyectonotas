<?php
include 'conexion.php';

session_start();
error_reporting(0);
$varsesion= $_SESSION["txtusuario"];
if($varsesion== null || $varsesion=''){
	header("Location: ../login/index.php");
    die();
}

$user= $_SESSION["txtusuario"];


$getmaterias=mysqli_query($mysqli, "Select distinct Usuarios.Usuario, Materias.* from Usuarios
join Profesores on Profesores.Id_usuario=Usuarios.Id_usuario
join MateriasProf on MateriasProf.Id_profesor=Profesores.Id_profesor
join Materias on Materias.Id_materia=MateriasProf.Id_materia
join CursoProf on CursoProf.Id_profesor=Profesores.Id_profesor
where Usuarios.Usuario='$user'");

$getcursos=mysqli_query($mysqli, "Select Usuarios.Usuario, Cursos.* from Usuarios
join Profesores on Profesores.Id_usuario=Usuarios.Id_usuario
join CursoProf on CursoProf.Id_profesor=Profesores.Id_profesor
join Cursos on Cursos.Id_curso=CursoProf.Id_curso
where Usuarios.Usuario='$user'");
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Menu</title>
    <link rel="shortcut icon" href="../img/itapu.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/profes.css">
  </head>
  <body>

    <header>
    <div class="logo">
                  <img src="../img/itapu.png" alt="ITAPU">
                  <h2>ITAPU</h2>
              </div> 
		<div class="titulo"><h1>ALTA, BAJA, MODIFICACIÓN Y VISUALIZACIÓN DE NOTAS</h1></div>
              <nav>
                <a id="btnfiltro" href="buscador.php"> <i class="fa fa-filter"></i> Filtros</a>
              </nav>
    </header>

   <div class="cerrarsesion"> <a class="logout-link" href="../login/cerrarsesion.php">Cerrar sesión</a>  </div>
   <div class="indicador"> <h2><?php echo "Bienvenido: "." ".$user; ?></h2></div>
   
   
   <div class="form-container">
    <form action="tabla.php" method="post" class="diseño">
      <div>
        <h1>Materia</h1>
        <select name="materia" id="materiaSelect">
          <option value="0" selected disabled>Seleccione una materia</option>
          <?php
          while($materia = mysqli_fetch_array($getmaterias)) {
            echo '<option value="' . $materia['Id_materia'] . '">' . $materia['Materia'] . '</option>';
          }
          ?>
        </select>




        <h1>Curso</h1>
        <select name="curso" id="cursoSelect">
          <option value="0" selected disabled>Seleccione un curso</option>
          <?php
          // Puedes dejar las opciones vacías, se llenarán dinámicamente
          ?>
        </select>
      </div>


      <br><input type="submit" value="Buscar" onclick="return validarFormulario();">
    </form>
  </div>

  <script>
    // Manejar cambios en el primer select (materia)
    document.getElementById('materiaSelect').addEventListener('change', function() {
      // Obtener el valor seleccionado en el primer select
      var selectedMateria = this.value;

      // Obtener el segundo select
      var cursoSelect = document.getElementById('cursoSelect');

      // Limpiar las opciones existentes en el segundo select
      cursoSelect.innerHTML = '<option value="0" selected disabled>Seleccione un curso</option>';

      // Llenar las opciones del segundo select basado en la materia seleccionada
      <?php
      // Obtener cursos relacionados con la materia seleccionada
      $getCursosByMateria = mysqli_query($mysqli, "SELECT Cursos.* FROM Cursos
      JOIN CursoProf ON CursoProf.Id_curso = Cursos.Id_curso
      JOIN Profesores ON CursoProf.Id_profesor = Profesores.Id_profesor
      JOIN MateriasProf ON MateriasProf.Id_profesor = Profesores.Id_profesor
      JOIN Materias ON Materias.Id_materia = MateriasProf.Id_materia
      JOIN cursomateria ON cursoprof.Id_curso=cursomateria.Id_curso
        WHERE Materias.Id_materia = 'seleccionar_id_materia';");

      while($curso = mysqli_fetch_array($getCursosByMateria)) {
        echo 'cursoSelect.innerHTML += \'<option value="' . $curso['Id_curso'] . '">' . $curso['Descripcion'] . '</option>\';';
      }
      ?>
    });
  </script>

  </body>
</html> 