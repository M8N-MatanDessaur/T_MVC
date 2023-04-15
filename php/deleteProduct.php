<!-- 
    **  Handles deleting product from database [ADMIN]
 -->

<?php ini_set('display_errors', 0);
require_once('../classes/Database.class.php');
$db = new Database();
$db->deleteProduct($_POST['id']);
?>