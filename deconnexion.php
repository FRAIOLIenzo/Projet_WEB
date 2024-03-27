<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location: Se_Connecter.php");
exit();
?>
