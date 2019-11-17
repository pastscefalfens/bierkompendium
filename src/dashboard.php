<?php

session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: login_form.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1,ü shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Bierkompendium - WWI18B4 - GSK</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
          <li class="nav-item">
            <a class="nav-link" href="index.php">Sortenübersicht</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#Favoriten">Favoriten</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="bg-primary text-white">
    <div class="container text-center">
      <h1>Bierkompendium</h1>
      <p class="lead">Deine Lieblingssorten</p>
    </div>
  </header>

  <section id="Favoriten">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Sorten:</h2>
          <?php

          $conn = new mysqli("10.35.46.35:3306", "k119505_admin", "TbT2c6r*XyuJv@PivUhvL.NN", "k119505_sk8ingDB");

          $conn->query("CREATE TABLE IF NOT EXISTS favourite (f_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                                   u_id INT(11) NOT NULL,
                                                   b_id INT(11) NOT NULL)");

          $sql = "SELECT * FROM beer, favourite WHERE beer.b_id = favourite.b_id AND favourite.u_id = '". $_SESSION['u_id'] . "';";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {

          		?>
          		<a>Bier-ID: <?php echo $row["b_id"]; ?></a><br>
          		<a>Biername: <?php echo $row["name"]; ?></a><br>
          		<a>Sorte: <?php echo $row["variety"]; ?></a><br>
          		<a>Herkunft: <?php echo $row["origin"]; ?></a><br>
          		<a>Alkoholgehalt: <?php echo $row["strength"]; ?></a><br>
          		<a>Preis pro Liter: <?php echo $row["price"]; ?></a><br>
                  <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'" width=200px heigth=200px /><br>'; ?>
          		<a href="deletefavourite.php?f_id=<?php echo $row["f_id"]; ?>">Favorit entfernen</a><br>
          	<br><br>
          		<?php
              }
          } else {
              echo "0 results";
          }

          $conn->close();
          ?>

        </div>
      </div>
    </div>
  </section>


  <!-- Footer -->
  <footer class="py-5 bg-dark">
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

</body>

</html>
