<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/buscador.css">
</head>
<body>
    <header>
        <div class="btnAtras"> <a id="atras" class="fa fa-arrow-circle-left" href="pr.php"></a>  </div>
		<div class="titulo"><h1>FILTROS</h1></div>
        <div class="logo"><img src="../img/itapu.png" alt="ITAPU"></div> 
    </header>

    <?php 
    include 'conexion.php';

    session_start();
    error_reporting(0);
    $varsesion = $_SESSION["txtusuario"];
    if ($varsesion == null || $varsesion = '') {
        header("Location: ../login/index.php");
        die();
    }

    $user = $_SESSION["txtusuario"];

    $getunidades = mysqli_query($mysqli, "Select * from Unidades");

    $gettipos = mysqli_query($mysqli, "Select * from TiposDeNota");

    $getmaterias = mysqli_query($mysqli, "Select distinct Usuarios.Usuario, Materias.* from Usuarios
    join Profesores on Profesores.Id_usuario=Usuarios.Id_usuario
    join MateriasProf on MateriasProf.Id_profesor=Profesores.Id_profesor
    join Materias on Materias.Id_materia=MateriasProf.Id_materia
    join CursoProf on CursoProf.Id_profesor=Profesores.Id_profesor
    where Usuarios.Usuario='$user'");

    $getcursos = mysqli_query($mysqli, "Select Usuarios.Usuario, Cursos.* from Usuarios
    join Profesores on Profesores.Id_usuario=Usuarios.Id_usuario
    join CursoProf on CursoProf.Id_profesor=Profesores.Id_profesor
    join Cursos on Cursos.Id_curso=CursoProf.Id_curso
    where Usuarios.Usuario='$user'");

    $filtros = array();
    $sql = "SELECT DISTINCT Alumnos.Nombre1_alumno, Alumnos.Apellido1_alumno, Unidades.Unidad, TiposDeNota.Tipo, Notas.Nota, Notas.Fecha_nota, Materias.*, Cursos.* FROM Usuarios
    JOIN Profesores ON Profesores.Id_usuario=Usuarios.Id_usuario
    JOIN MateriasProf ON MateriasProf.Id_profesor=Profesores.Id_profesor
    JOIN Materias ON Materias.Id_materia=MateriasProf.Id_materia
    JOIN CursoProf ON CursoProf.Id_profesor=Profesores.Id_profesor
    JOIN Notas ON Notas.Id_materia=Materias.Id_materia
    JOIN Alumnos ON Alumnos.Id_alumno=Notas.Id_alumno
    JOIN Unidades ON Unidades.Id_unidad=Notas.Id_unidad
    JOIN TiposDeNota ON TiposDeNota.Id_tipo=Notas.Id_tipo
    JOIN Cursos ON Cursos.Id_curso=Alumnos.Id_curso
    where Usuarios.Usuario='$user'";

    if (!empty($_POST["nombre"])) {
        $filtros[] = "Alumnos.Nombre1_alumno = '" . $_POST["nombre"] . "'";
    }
    if (!empty($_POST["apellido"])) {
        $filtros[] = "Alumnos.Apellido1_alumno = '" . $_POST["apellido"] . "'";
    }
    if (!empty($_POST["materia"])) {
        $filtros[] = "Materias.Id_materia = '" . $_POST["materia"] . "'";
    }
    if (!empty($_POST["curso"])) {
        $filtros[] = "Cursos.Id_curso = '" . $_POST["curso"] . "'";
    }
    if (!empty($_POST["desde"]) && !empty($_POST["hasta"])) {
        $filtros[] = "Notas.Fecha_nota BETWEEN '" . $_POST["desde"] . "' AND '" . $_POST["hasta"] . "'";
    }
    if (!empty($_POST["unidad"])) {
        $filtros[] = "Unidades.Id_unidad = '" . $_POST["unidad"] . "'";
    }
    if (!empty($_POST["tipo"])) {
        $filtros[] = "TiposDeNota.Id_tipo = '" . $_POST["tipo"] . "'";
    }

    if (!empty($filtros)) {
        $sql .= " AND " . implode(" AND ", $filtros);
    }
    $sql .= " ORDER BY Cursos.Id_curso, Alumnos.Apellido1_alumno, Unidades.Unidad, Notas.Fecha_nota";
    $busqueda = mysqli_query($mysqli, $sql);
    ?>
    <div class="container">
    <form method="POST" action="buscador.php">
    
    <input type="text" name="nombre" placeholder="Nombre">
    
 
    <input type="text" name="apellido" placeholder="Apellido">
   

    <select name="materia">
        <option value="" disabled selected>Seleccionar Materia</option>
        <?php
        while ($materia = mysqli_fetch_array($getmaterias)) {
        ?>
        <option value="<?php echo $materia['Id_materia']?>"><?php echo $materia['Materia']?></option>
        <?php
        }
        ?>
    </select>

    <select name="curso">
    <option value="" disabled selected>Seleccionar Curso</option>
        <?php
        while ($curso = mysqli_fetch_array($getcursos)) {
        ?>
        <option value="<?php echo $curso['Id_curso']?>"><?php echo $curso['Descripcion']?></option>
        <?php
        }
        ?>
    </select>

    <select name="unidad">
    <option value="" disabled selected>Seleccionar Unidad Didáctica</option>
        <?php
        while ($unidad = mysqli_fetch_array($getunidades)) {
        ?>
        <option value="<?php echo $unidad['Id_unidad']?>"><?php echo $unidad['Unidad']?></option>
        <?php
        }
        ?>
    </select>
    
    <select name="tipo">
    <option value="" disabled selected>Seleccionar Tipo de Nota</option>
        <?php
        while ($tipo = mysqli_fetch_array($gettipos)) {
        ?>
        <option value="<?php echo $tipo['Id_tipo']?>"><?php echo $tipo['Tipo']?></option>
        <?php
        }
        ?>
    </select>
    
    <label>Desde</label>
    <input type="date" name="desde" placeholder="Desde">
    
    <label>Hasta</label>
    <input type="date" name="hasta" placeholder="Hasta">

    <input type="submit" value="Buscar">
</form>

        <div class="tabla">
            <table>
                <thead>
                    <tr>
                        <th>Apellido</th>
                        <th>Nombre</th>
                        <th>Materia</th>
                        <th>Curso</th>
                        <th>Unidad Didáctica</th>
                        <th>Tipo de Nota</th>
                        <th>Fecha Nota</th>
                        <th>Nota</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($mostrar = mysqli_fetch_array($busqueda)) {
                    ?>
                    <tr>
                        <td><?php echo $mostrar['Apellido1_alumno'] ?></td>
                        <td><?php echo $mostrar['Nombre1_alumno'] ?></td>
                        <td><?php echo $mostrar['Materia'] ?></td>
                        <td><?php echo $mostrar['Descripcion'] ?></td>
                        <td><?php echo $mostrar['Unidad'] ?></td>
                        <td><?php echo $mostrar['Tipo'] ?></td>
                        <td><?php echo $mostrar['Fecha_nota'] ?></td>
                        <td><?php echo floatval($mostrar['Nota']) ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
