<!-- 
    **  Handles disconnect user
-->

<?php 
ini_set('display_errors', 0);
session_start();
    unset($_SESSION['cart']);
    session_destroy();
header('Location: ../index.php');
exit;
?>
