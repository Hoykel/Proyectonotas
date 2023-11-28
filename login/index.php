<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Inicio de sesión</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Open+Sans:ital,wght@0,500;1,300;1,400;1,500&family=Roboto:ital,wght@0,300;0,400;1,300;1,900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="../css/login.css">
</head>

<body>
  <header>
    <div class="logo">
      <img src="../img/itapu.png" alt="ITAPU">
      <h2>ITAPU</h2>
    </div> 
    <nav>
      <a href="http://www.itapu.edu.ar/">Inicio</a>
      <a href="http://www.itapu.edu.ar/QuienesSomos/quienesSomos.html">Sobre Nosotros</a>
      <a href="http://www.itapu.edu.ar/ComunidadEducativa/comunidadEducativa.html">Contacto</a>
      <a href="http://www.itapu.edu.ar/OfertaEducativa/ofertaEducativa.html">Ayuda</a>
    </nav>
  </header>

  <div class="login-container">
    <form class="loginform" method="post" action="login.php">
      <div class="form-group">
        <label for="txtusuario" class="form-label">Usuario</label>
        <input type="text" name="txtusuario" required />
      </div>

      <div class="form-group">
        <label for="txtpassword" class="form-label">Contraseña</label>
        <input name="txtpassword" type="password" required />
      </div>

      <input name="btningresar" type="submit" value="Ingresar" />
    </form>
  </div>

  <footer>
    <div class="ft1">
      <div class="txtfooter">
        <p>&copy; Copyright 2023 ITAPU
          <ul>
            <li>Código Postal: X5923AJC</li>
            <li>General Deheza - Córdoba - Argentina</li>
            <li>Tel: (0358) 4057800/801/802 (Líneas Rotativas)</li>
            <li>E-mail: info@itapu.edu.ar</li>
            <li>Dirección: Boulevard Almirante Brown 217</li>
          </ul>
        </p>
      </div>
      <section class="buttons">
        <a href="#" class="fa fa-facebook"></a>
        <a href="#" class="fa fa-twitter"></a>
        <a href="#" class="fa fa-envelope"></a>
        <a href="#" class="fa fa-youtube"></a>
      </section>
    </div>
  </footer>

</body>
</html>
