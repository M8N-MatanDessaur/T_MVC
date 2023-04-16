<!-- 
    **  Handles editing product in database [ADMIN]
-->

<?php 
ini_set('display_errors', 0);
require_once('../classes/Database.class.php');
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$db = new Database();
$db->editProduct();
?>