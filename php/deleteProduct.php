<!-- 
    **  Handles delete product [ADMIN]
 -->

<?php ini_set('display_errors', 0);
require_once('../classes/Database.class.php');
$db = new Database();
$connection = $db->getConnection();

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $query = $connection->prepare("DELETE FROM teas WHERE _id = ?");
    $query->bind_param("i", $id);
    $query->execute();

    echo '<script>window.location.href = "../admin.php";</script>';
}
?>