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

$getunidades=mysqli_query($mysqli,"Select * from Unidades");

/* HACER GET ALUMNOS */

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
<html>
<head>
  <title>Calcular Promedio de Unidad</title>
  <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/promedio.css">
</head>
<body>

  <div class="container">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required><br>

            <label for="materia">Materia:</label>
            <select id="materia" name="materia" required>
            <option selected disabled></option>
            <?php
            while($materia = mysqli_fetch_array($getmaterias)) {
            ?>
            <option value="<?php echo $materia['Id_materia']?>"><?php echo $materia['Materia']?></option>
            <?php
            }
            ?>
            </select><br>

            <label for="curso">Curso:</label>
            <select id="curso" name="curso" required>
            <option selected disabled></option>
            <?php
            while($curso = mysqli_fetch_array($getcursos)) {
            ?>
            <option value="<?php echo $curso['Id_curso']?>"><?php echo $curso['Descripcion']?></option>
            <?php
            }
            ?>
            </select><br>

            <label for="unidad">Unidad:</label>
            <select id="unidad" name="unidad" required>
            <option selected disabled></option>
            <?php
            while($unidad = mysqli_fetch_array($getunidades)) {
            ?>
            <option value="<?php echo $unidad['Id_unidad']?>"><?php echo $unidad['Unidad']?></option>
            <?php
            }
            ?>
            </select><br>

            <input type="submit" value="Calcular Promedio">
    </form>
    </div>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $curso_id = $_POST['curso'];
    $materia_id = $_POST['materia'];
    $unidad_id = $_POST['unidad'];

    // Obtener el nombre del curso
    $curso_query = mysqli_query($mysqli, "SELECT Descripcion FROM Cursos WHERE Id_curso = $curso_id");
    $curso_result = mysqli_fetch_assoc($curso_query);
    $curso_nombre = $curso_result['Descripcion'];

    // Obtener el nombre de la materia
    $materia_query = mysqli_query($mysqli, "SELECT Materia FROM Materias WHERE Id_materia = $materia_id");
    $materia_result = mysqli_fetch_assoc($materia_query);
    $materia_nombre = $materia_result['Materia'];

    // Obtener el nombre de la unidad
    $unidad_query = mysqli_query($mysqli, "SELECT Unidad FROM Unidades WHERE Id_unidad = $unidad_id");
    $unidad_result = mysqli_fetch_assoc($unidad_query);
    $unidad_nombre = $unidad_result['Unidad'];

    $query = "SELECT AVG(Notas.Nota) AS Promedio FROM Notas 
    JOIN Alumnos ON Alumnos.Id_alumno = Notas.id_alumno
    JOIN Unidades ON Unidades.Id_unidad = Notas.Id_unidad
    JOIN Cursos ON Cursos.id_curso = Alumnos.id_curso
    JOIN Materias ON Materias.id_materia = Notas.Id_materia
    WHERE Alumnos.Nombre1_alumno = '$nombre' AND Alumnos.Apellido1_alumno = '$apellido' AND Cursos.Id_curso = $curso_id AND Materias.Id_Materia = $materia_id AND Unidades.Id_Unidad =$unidad_id";
    
    $result = mysqli_query($mysqli, $query);

    if ($result) {
      $row = mysqli_fetch_assoc($result);
      $promedio = $row['Promedio'];
      
      echo "<h1>Resultados:</h1>";
      echo "<p>Nombre: $nombre</p>";
      echo "<p>Apellido: $apellido</p>";
      echo "<p>Curso: $curso_nombre</p>";
      echo "<p>Materia: $materia_nombre</p>";
      echo "<p>Unidad: $unidad_nombre</p>";
      echo "<p>Promedio de la Unidad: $promedio</p>";
    } else {
      echo "Error al realizar la consulta: " . mysqli_error($mysqli);
    }
  }
  ?>

</body>
</html>
