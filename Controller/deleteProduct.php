<!-- 
    **  Handles deleting product from database [ADMIN]
-->

<?php 
ini_set('display_errors', 0);
require_once '../autoloader.php'; // Load classes automatically
$db = new Database();
$db->deleteProduct($_POST['id']);
?>