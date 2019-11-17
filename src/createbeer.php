<!-- BEARBEITER:    Christoph Klausmann
     INFO:          Um einen neuen Eintrag in der Bierdatenbank anzulegen wird zunächst eine neue Datenbankverbindung initiiert
                    Anschließend werden die Werte von den Eingabefeldern in die Attribute der Tabelle geschrieben und anschließend wieder
                        auf die Hauptseite der Bierdatenbank index.php gewechselt -->

<?php
$conn = new mysqli("10.35.46.35:3306", "k119505_admin", "TbT2c6r*XyuJv@PivUhvL.NN", "k119505_sk8ingDB");

$img=addslashes(file_get_contents($_FILES['b_img']['tmp_name']));

$conn->query("INSERT INTO beer VALUES ('','" . $_POST['b_name'] . "','" . $_POST['b_variety'] . "', '" . $_POST['b_origin'] . "', '" . $_POST['b_strength'] . "', '" . $_POST['b_price'] . "', '$img')");

header("Location: index.php");

?>
