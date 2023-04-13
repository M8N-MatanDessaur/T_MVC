<?php
class Database
{
    private $host = "localhost";
    private $user = "root";
    private $password = "123";
    private $database = "T";
    private $connection;

    public function __construct()
    {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database);

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
            if ($this->connection->query("CREATE DATABASE IF NOT EXISTS T") === TRUE) {
            } else {
                echo "Error : " . $this->connection->error;
            }
            $this->connection->select_db($this->database);
        }
        $this->connection->query("CREATE TABLE IF NOT EXISTS teas(_id   int(11) Auto Increment, Name    varchar(25), Description   varchar(100), Price	double(4,4) NULL, Quantity  int(10) NULL,   Image	varchar(100) NULL)");
        $this->seedDatabase();
        $this->connection->query("CREATE TABLE IF NOT EXISTS users(_id	int(11) Auto Increment, FullName    varchar(50),    Email	varchar(100),   Password	varchar(100)    Admin	binary(1) NULL)");
        $this->seedUsers();
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function __destruct()
    {
        $this->connection->close();
    }


    public function getAllProducts()
    {
        // Get all products from the database
        $database = new Database();
        $connection = $database->getConnection();
        $sql = "SELECT _id, Name, Description, Price, Quantity, Image FROM teas";
        $result = $connection->query($sql);

        // Display all products
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product = new Tea($row['_id'], $row['Name'], $row['Description'], $row['Price'], $row['Quantity'], $row['Image']);
                showProductCard($product->getImage(), $product->getName(), $product->getDescription(), $product->getPrice(), $product->getId());
            }
        } else {
            echo 'No products found.';
        }
    }

    public function seedDatabase()
    {

        // Check if the table is empty
        $result = $this->connection->query("SELECT COUNT(*) AS count FROM teas");
        $row = $result->fetch_assoc();
        if ($row['count'] > 0) {
            return;
        } else {
            $teas = [
                [
                    'name' => 'Purple Tea',
                    'description' => 'A blend of green tea, white tea and african violets.',
                    'price' => 0.0957,
                    'quantity' => 100,
                    'image' => 'purpetea.png'
                ],
                [
                    'name' => 'White Tea',
                    'description' => 'Calming and refreshing white tea from china.',
                    'price' => 0.0999,
                    'quantity' => 100,
                    'image' => 'whitetea.png'
                ],
                [
                    'name' => 'Orange Tea',
                    'description' => 'A blend of green tea, orange peels and violets flowers, So refreshing.',
                    'price' => 0.0859,
                    'quantity' => 100,
                    'image' => 'orangenpurpletea.png'
                ],
                [
                    'name' => 'Green Tea',
                    'description' => 'Delicous green tea imported from a small village in japan.',
                    'price' => 0.0976,
                    'quantity' => 100,
                    'image' => 'test.png'
                ],
                [
                    'name' => 'Fruity Tea',
                    'description' => 'A blend of dried fruits and green tea. Great for a cold summer tea.',
                    'price' => 0.0900,
                    'quantity' => 100,
                    'image' => 'fruitytea.png'
                ],
                [
                    'name' => 'Black Tea',
                    'description' => '	Delicous black tea imported from a small village in india.',
                    'price' => 0.0999,
                    'quantity' => 100,
                    'image' => 'blacktea.png'
                ],
            ];

            foreach ($teas as $tea) {
                $query = $this->connection->prepare(
                    "INSERT INTO teas (Name, Description, Price, Quantity, Image) VALUES (?, ?, ?, ?, ?)"
                );
                $query->bind_param(
                    "ssdis",
                    $tea['name'],
                    $tea['description'],
                    $tea['price'],
                    $tea['quantity'],
                    $tea['image']
                );
                $query->execute();
            }
        }
    }


    public function seedUsers()
    {

        // Check if the table is empty
        $result = $this->connection->query("SELECT COUNT(*) AS count FROM users");
        $row = $result->fetch_assoc();
        if ($row['count'] > 0) {
            return;
        } else {
            $users = [
                [
                    'FullName' => 'Matan Dessaur',
                    'Email' => 'matandessaur@gmail.com',
                    'Password' => '123',
                    'Admin' => 1,
                ],
                [
                    'FullName' => 'Eric Gendron',
                    'Email' => 'ericgendron@gmail.com',
                    'Password' => '123',
                    'Admin' => 0,
                ]
            ];

            foreach ($users as $user) {
                $query = $this->connection->prepare(
                    "INSERT INTO users (FullName, Email, Password, Admin) VALUES (?, ?, ?, ?)"
                );
                $query->bind_param(
                    "sssi",
                    $user['FullName'],
                    $user['Email'],
                    $user['Password'],
                    $user['Admin'],
                );
                $query->execute();
            }
        }
    }
}
