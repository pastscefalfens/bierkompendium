<!-- BEARBEITER:    Patrick Grahm
	 INFO:          Um ein Bier aus den Favoriuten zu entfernen wird zunächst eine Datenbankverbindung initiiert
					Anschließend wird per Primarykey abgeglichen, welcher Eintrag gelöscht werden soll
					Nach erfolgreichem Löschen wird auf das Dashboard zurückgewechselt -->


<?php

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
    header("Location: login.php");
}

if (isset($_GET["f_id"])) {
$conn = new mysqli("10.35.46.35:3306", "k119505_admin", "TbT2c6r*XyuJv@PivUhvL.NN", "k119505_sk8ingDB");

    $result = $conn->query("SELECT * FROM favourite WHERE f_id ='" . $_GET['f_id'] . "'");
    
    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($_SESSION['u_id'] == $row['u_id']) {
                $conn->query("DELETE FROM favourite WHERE f_id ='" . $_GET['f_id'] . "'");
            }
        }
    }
}

header("Location: dashboard.php");
?>