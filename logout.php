<?php
session_start();
session_destroy();
header("Location: guest.php");
exit();
?>
