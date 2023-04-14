<!-- 
    **  Handles add product [ADMIN]
 -->
<?php ini_set('display_errors', 0);
require_once('../classes/Database.class.php');
$db = new Database();
$connection = $db->getConnection();
if (isset($_POST['add'])) {
    $name = $_POST['Name'];
    $price = $_POST['Price'];
    $quantity = $_POST['Quantity'];
    $Description = $_POST['Description'];
    $image = $_FILES['Image'];
    $imageName = basename($image['name']);
    $imagePath = '../assets/images/' . $imageName;

    if (move_uploaded_file($image['tmp_name'], $imagePath)) {
        $query = $connection->prepare("INSERT INTO teas (Name, Description, Price, Quantity, Image) VALUES (?, ?, ?, ?, ?)");
        $query->bind_param("ssdis", $name, $Description,  $price, $quantity, $imageName);
        $query->execute();

        echo '<script>window.location.href = "../admin.php";</script>';
    } else {
        echo "Failed to upload image.";
    }
}
?>