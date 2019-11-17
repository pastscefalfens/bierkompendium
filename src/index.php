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

  <!-- Custom styles for this template -->
  <link href="css/scrolling-nav.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- BEARBEITER: Gruppe
       INFO: Die Index.html diente der Ersterstellung der Eingabemaske für neue Biere
             Wir arbeiten fortlaufen mit PHP/Bootstrap-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">Bierkompendium</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#Sortenübersicht">Sortenübersicht</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#Sorteneditor">Sorte hinzufügen</a>
          </li>
          <!-- Diese Felder dienen den Login- bzw. Logout-Buttons, sowie der Unterscheidung, dass im ausgeloggten
              Zustand nur der "Login" Button zu Verfügung steht und im eingeloggten Zustand die Buttons "Mein Profil"
              und "Logout" -->
          <?php
            session_start();
            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                echo '<li class="nav-item"><a class="nav-link" href="dashboard.php">Mein Profil</a></li><li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';
            }
            else {
                echo '<a class="nav-link" href="login_form.php">Login</a>';
            }
            ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="bg-primary text-white">
    <div class="container text-center">
      <h1>Bierkompendium</h1>
      <p class="lead">Eine Auswahl der besten Biere Deutschlands</p>
    </div>
  </header>

  <section id="Sortenübersicht">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Sorten:</h2>

          <!-- BEARBEITER: Pascal Steffens
               INFO:       im nachfolgenden Abschnitt wird zunächst eine Verbindung zur SQL-Datenbank geöffnet
                           Es wird anschließend eine Abfrage gestartet, welche über den primarykey der "Bierid" (b_id) die restlichen zugehörigen Attribute wie Sorte,
                           Herkunft, Alkoholstärke, Preis und Produktbild abfrägt
                           Mittels der IF-Abfrage werden die zurückgegebenen Ergebnisse ausgegegben, sofern welche vorhanden sind (ansonsten "0 results")
                           Anschließend wird die Datenbankabfrageverbindung geschlossen-->

          <?php
          $conn = new mysqli("10.35.46.35:3306", "k119505_admin", "TbT2c6r*XyuJv@PivUhvL.NN", "k119505_sk8ingDB");


          mysqli_select_db($conn, "k119505_sk8ingDB");
          $conn->query("CREATE TABLE IF NOT EXISTS beer (b_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                                   name VARCHAR(255) NOT NULL,
          										 variety VARCHAR(255) NOT NULL,
          										 origin VARCHAR(255) NOT NULL,
          										 strength VARCHAR(255) NOT NULL,
                                                   price VARCHAR(255) NOT NULL,
                                                   image MEDIUMBLOB)");

          $sql = "SELECT * FROM beer";
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
          		<a href="deletebeer.php?b_id=<?php echo $row["b_id"]; ?>">Eintrag löschen</a><br>
          		<a href="addfavourite.php?b_id=<?php echo $row["b_id"]; ?>">Zu Favoriten hinzufügen</a><br>
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


  <!-- BEARBEITER: Patrick Grahm
       INFO:       In diesem Bereich werden die Felder zum Eingeben von Daten in die Bierdatenbank dargestellt
                   Über den Button "Datei hochladen" kann ein Eintragsbild hinzugefügt werden
                   Der Button "Hinzufügen" bestätigt den Upload des Datenbankeintrages -->
  <section id="Sorteneditor" class="bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Sorte hinzufügen</h2>
          <form action="createbeer.php" method="post" enctype="multipart/form-data">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="b_name">Biername</label>
                <input type="text" class="form-control" name="b_name" placeholder="Name">
                <label for="b_variety">Sorte</label>
                <input type="text" class="form-control" name="b_variety" placeholder="Sorte">
                <label for="b_origin">Herkunft</label>
                <input type="text" class="form-control" name="b_origin" placeholder="Herkunftsland">

              </div>
              <div class="form-group col-md-6">
                <label for="b_strength">Alkoholgehalt</label>
                <input type="text" class="form-control" name="b_strength" placeholder="Alkoholstärke in pro Mille">
                <label for="b_price">Preis pro Liter</label>
                <input type="text" class="form-control" name="b_price" placeholder="Preis in €">
                <label>Bild<br></label>
                <div>
                <label for="b_img">
                  <input type="file" name="b_img" size="50" accept="png">
                </label>
                </div>
                </div>
              <button type="submit" class="btn btn-primary">Hinzufügen</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </section>


  <!-- BEARBEITER: Gruppe
       INFO: Implementation von Bootstrap, wird benötigt um diese Funktionen und Styles verwenden zu können -->

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
