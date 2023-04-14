<!-- 
    **  Handles edit product using form inouts and script [ADMIN]
 -->

<?php ini_set('display_errors', 0);
require_once '../autoloader.php';
require_once('../classes/Database.class.php');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

function executeQuery($query, $params) {
    $db = new Database();
    $connection = $db->getConnection();
    $stmt = $connection->prepare($query);
    $stmt->bind_param(...$params);
    return $stmt->execute();
}

function sendJsonResponse($code, $data) {
    http_response_code($code);
    echo json_encode($data);
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['_id'];
        $name = $input['Name'];
        $description = $input['Description'];
        $price = $input['Price'];
        $quantity = $input['Quantity'];

        $query = "UPDATE teas SET Name = ?, Description = ?, Price = ?, Quantity = ? WHERE _id = ?";
        $params = ["ssdis", $name, $description, $price, $quantity, $id];

        if (executeQuery($query, $params)) {
            sendJsonResponse(200, ['message' => 'Product updated successfully']);
        } else {
            sendJsonResponse(500, ['error' => 'Failed to update product']);
        }
        break;

    default:
        sendJsonResponse(405, ['error' => 'Method not allowed']);
}
?>
