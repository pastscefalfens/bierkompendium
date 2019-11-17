<!-- BEARBEITER: Patrick Grahm
     Es wird überprüft ob bereits ein Datenbankeintrag mit den eingegebenen Benutzerdaten besteht.
     Ist dies nicht der Fall wird der Benutzeraccount in der Datenbank angelegt. -->

<?php

session_start();

if(isset($_POST['register_username']) && isset($_POST['register_email']) && isset($_POST['register_password'])){

$conn = new mysqli("10.35.46.35:3306", "k119505_admin", "TbT2c6r*XyuJv@PivUhvL.NN", "k119505_sk8ingDB");

    $result = $conn->query("SELECT * FROM user WHERE username = '" . $_POST['register_username'] . "'");
    $result1 = $conn->query("SELECT * FROM user WHERE email = '" . $_POST['register_email'] . "'");

    if($result->num_rows > 0 || $result1->num_rows > 0){
        $_SESSION['reg'] = false;
    } else {
        $conn->query("INSERT INTO user VALUES ('','" . $_POST['register_username'] . "','" . $_POST['register_email'] . "','" . $_POST['register_password']. "')");
        $_SESSION['reg'] = true;
    }
}
    header("Location: login_form.php");
?>
