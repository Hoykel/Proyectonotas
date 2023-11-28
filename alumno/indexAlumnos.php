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

$getmaterias=mysqli_query($mysqli, "select distinct Usuarios.Usuario,Materias.* from Usuarios
join Alumnos on Alumnos.Id_usuario=Usuarios.Id_usuario
join Notas on Notas.Id_alumno=Alumnos.Id_alumno
join Materias on Materias.Id_materia=Notas.Id_materia
where Usuarios.Usuario='$user'");

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Menú Alumnos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profes.css">
    <link rel="stylesheet" href="C:\xampp\htdocs\ProyectoNotas (1)\ProyectoNotas\css\Login responsive.css" media="(max-width: 800px)">
  </head>
  <body>
  <header>
              <div class="logo">
                  <img src="../img/itapu.png" alt="ITAPU">
                  <h2>ITAPU</h2>
              </div> 
              <div class="titulo"><h1>VISUALIZACIÓN DE NOTAS</h1></div>
              <nav>
                <a id="btnfiltro" href="buscador.php"> <i class="fa fa-filter"></i> Filtros</a>
              </nav>
    </header>

    <div class="cerrarsesion"> <a class="logout-link" href="../login/cerrarsesion.php">Cerrar sesión</a>  </div>
   <div class="indicador"> <h2><?php echo "Bienvenido: "." ".$user; ?></h2></div>

  <form action="tabla_alumnos.php" method="post" class="diseño">
  
  <div>
    <h1>Materia</h1>
    <select name="materia">
    <option value="0" selected disabled>Seleccione una materia</option>
        <?php
        while($mostrar = mysqli_fetch_array($getmaterias))
        {
        ?>
        <option value="<?php echo $mostrar['Id_materia']?>"><?php echo $mostrar['Materia']?></option>
        <?php
        }
        ?>
  </select>
</div>

<div>
<input type="submit" value="Buscar" onclick="return validarFormulario();">
</div>
</form>

	</div>


  <div class="vacio">

</div>

  
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
                <a href="#" class="fa fa-facebook"></a>
                <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fa fa-envelope"></a>
                <a href="#" class="fa fa-youtube"></a>
              </section>

</footer>



<script>
  function validarFormulario() {
    var materiaSelect = document.getElementsByName("materia")[0];

    if (materiaSelect.value === "0") {
      alert("Debe seleccionar una materia");
      return false; // Evita enviar el formulario
    }

    // Si todo está bien, el formulario se envía
    return true;
  }
</script>
  </body>
</html> 