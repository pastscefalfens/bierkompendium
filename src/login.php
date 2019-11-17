<!-- BEARBEITER: Patrick Grahm
     INFO:       Hier werden die eingegebenen Benutzerdaten mit der Datenbank abgegeglichen. Sind diese richtig wird die Session "logged_in" auf "true" gesetzt
                Ansonsten wird zurück auf die "login_form" verwiesen.-->

<?php

session_start();

if (isset($_POST['login_username']) && isset($_POST['login_password'])) {

$conn = new mysqli("10.35.46.35:3306", "k119505_admin", "TbT2c6r*XyuJv@PivUhvL.NN", "k119505_sk8ingDB");

    $result = $conn->query("SELECT * FROM user");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            if ($_POST['login_username'] == $row['username'] && $_POST['login_password'] == $row['password']) {

                $_SESSION['logged_in'] = true;
                $_SESSION['u_id'] = $row['u_id'];
                $_SESSION['username']  = $row['username'];

                header("Location: dashboard.php");
            }
        }
    }
}
header("Location: login_form.php");
$_SESSION['pw'] = false;
?>
