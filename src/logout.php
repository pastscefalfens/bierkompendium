<!--  BEARBEITER: Patrick Grahm
      Die Session und die zugehörigen Variablen werden gelöscht.-->
<?php
session_start();
session_destroy();
header("Location: index.php");
?>
