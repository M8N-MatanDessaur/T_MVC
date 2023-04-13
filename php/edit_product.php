<?php
require_once('../classes/Database.class.php');
require_once('../classes/Tea.class.php');
require_once('../classes/User.class.php');
require_once('../classes/AdminUser.class.php');
require_once('../classes/Cart.class.php');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['_id'];
    $name = $input['Name'];
    $description = $input['Description'];
    $price = $input['Price'];
    $quantity = $input['Quantity'];

    $db = new Database();
    $connection = $db->getConnection();
    $query = $connection->prepare("UPDATE teas SET Name = ?, Description = ?, Price = ?, Quantity = ? WHERE _id = ?");
    $query->bind_param("ssdis", $name, $description, $price, $quantity, $id);
    $result = $query->execute();

    if ($result) {
        http_response_code(200);
        echo json_encode(['message' => 'Product updated successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to update product']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
?>
