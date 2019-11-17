<!-- BEARBEITER:    Pascal Steffens
     INFO:          Damit ein Favorit dem persönlichen Profil hinzugefügt werden kann, wird zunächst der Logged-In-Tag geprüft
                    Anschließend wird eine Datenbankverbindung initiiert
                    In dieser wird nun der Eintrag von der bestehenden Bierdatenbank über den Primarykey (Bier-ID) kopiert und
                        in die Favoriten hinzugefügt
                    Anschließend wird in das persönliche Profil gewechselt -->

<?php

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
    header("Location: login.php");
}

$conn = new mysqli("10.35.46.35:3306", "k119505_admin", "TbT2c6r*XyuJv@PivUhvL.NN", "k119505_sk8ingDB");

$result = $conn->query("SELECT * FROM favourite WHERE f_id = '" . $_GET['f_id'] . "'");

if($result->num_rows == 0){
    $conn->query("INSERT INTO favourite VALUES ('','" . $_SESSION['u_id'] . "','" . $_GET['b_id'] . "')");
}


header("Location: dashboard.php");

?>
