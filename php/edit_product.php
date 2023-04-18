<!-- 
    **  Handles editing product in database [ADMIN]
-->

<?php 
ini_set('display_errors', 0);
require_once '../autoloader.php'; // Load classes automatically
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$db = new Database();
$db->editProduct();
?>