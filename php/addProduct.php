<!-- 
    **  Handles adding product to database [ADMIN]
 -->

<?php ini_set('display_errors', 0);
require_once('../classes/Database.class.php');
$db = new Database();
$db->addProductToDatabase();
?>