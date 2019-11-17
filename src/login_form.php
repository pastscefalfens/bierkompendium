<?php

session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    header("Location: dashboard.php");
}

$conn = new mysqli("10.35.46.35:3306", "k119505_admin", "TbT2c6r*XyuJv@PivUhvL.NN", "k119505_sk8ingDB");

mysqli_select_db($conn, "k119505_sk8ingDB");

$conn->query("CREATE TABLE IF NOT EXISTS user (u_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                         username VARCHAR(255) NOT NULL,
                                         email VARCHAR(255) NOT NULL,
                                         password VARCHAR(255))");

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Bierkompendium - WWI18B4 - GSK</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/login--style.css">

  <!-- Custom styles for this template -->
  <link href="css/scrolling-nav.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="index.php">Bierkompendium</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
        </ul>
      </div>
    </div>
  </nav>

  <?php
  if (isset($_SESSION['reg']) && $_SESSION['reg'] == false){
      echo '<div class="alert warning"> Benutzername oder Email existiert bereits. </div>';
      $_SESSION['reg'] = null;
  }
  if (isset($_SESSION['reg']) && $_SESSION['reg'] == true){
      echo '<div class="alert success"> Erfolgreich registriert. </div>';
      $_SESSION['reg'] = null;
  }
  if (isset($_SESSION['pw']) && $_SESSION['pw'] == false){
      echo '<div class="alert warning"> Benutzername oder Passwort ist inkorrekt. </div>';
      $_SESSION['pw'] = null;
  }
  ?>

<div class="login-page">
  <div class="form">
      <ul class="tab-group">
          <li class="tab active"><a href="#login">login</a></li>
          <li class="tab"><a href="#signup">register</a></li>
      </ul>

          <div class="tab-content">
          <div id="login">
              <form action="login.php" method="post">
                  <input type="text" name="login_username" placeholder="Benutzername" required autocomplete="off">
                  <input type="password" name="login_password" placeholder="Passwort" required autocomplete="off">
                  <button>login</button>
              </form>
          </div>

          <div id="signup">
              <form action="register.php" method="post">
                  <input type="text" name="register_username" placeholder="Benutzername" required autocomplete="off">
                  <input type="email" name="register_email" placeholder="E-Mail" required autocomplete="off">
                  <input type="password" name="register_password" placeholder="Passwort" required autocomplete="off">
                  <button>register</button>
              </form>
          </div>
          </div>
    </div>
  </div>
</div>
  <!-- Footer -->
  <footer class="py-5 bg-dark" style="position:absolute;bottom:0;width:100%;">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Bierkompendium - WWI18B4 - GSK</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="js/scrolling-nav.js"></script>
  <script src='js/jquery-3.2.0.min.js'></script>
  <script src="js/index.js"></script>

</body>

</html>
