<!-- BEARBEITER:    Christoph Klausmann 
	 INFO:          Um ein Bier zu entfernen wird zunächst eine Datenbankverbindung initiiert
					Anschließend wird per Primarykey abgeglichen, welcher Eintrag gelöscht werden soll
					Nach erfolgreichem Löschen wird auf die Hauptseite index.php zurückgewechselt -->


<?php
$conn = new mysqli("10.35.46.35:3306", "k119505_admin", "TbT2c6r*XyuJv@PivUhvL.NN", "k119505_sk8ingDB");

$result = $conn->query("SELECT * FROM beer WHERE b_id = '" . $_GET['b_id'] . "'");

if($result->num_rows != 0) {
	$conn->query("DELETE FROM `beer` WHERE b_id='" . $_GET['b_id'] . "'");
}


header("Location: index.php");

?>
