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
        $this->createConnection();
        $this->createTables();
        $this->seedDatabase();
        $this->seedUsers();
    }

    // Creates a new instance of mysqli | Creates the connection to the database
    private function createConnection()
    {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database);

        // Check connection
        if ($this->connection->connect_error) {
            throw new Exception("Connection failed: " . $this->connection->connect_error);
        }
    }

    // Create Teas and Users tables if not exists
    private function createTables()
    {
        $this->connection->query("CREATE TABLE IF NOT EXISTS teas(_id int(11) AUTO_INCREMENT, Name varchar(25), Description varchar(100), Price double(4,4) NULL, Quantity int(10) NULL, Image varchar(100) NULL, PRIMARY KEY (_id))");
        $this->connection->query("CREATE TABLE IF NOT EXISTS users(_id int(11) AUTO_INCREMENT, FullName varchar(50), Email varchar(100), Password varchar(100), Admin binary(1) NULL, PRIMARY KEY (_id))");
    }

    // Gets the connection 
    public function getConnection()
    {
        return $this->connection;
    }

    // When not using close the connection
    public function __destruct()
    {
        $this->connection->close();
    }

    // Gets all products from database and returns an associative array
    public function getAllProducts()
    {
        $query = $this->connection->prepare("SELECT * FROM teas");
        $query->execute();
        $result = $query->get_result(); // Stores the result in the $result variable.
        return $result->fetch_all(MYSQLI_ASSOC); // Fetches all rows from the result set as an associative array (with column names as keys)
    }

    // Gets the scoped product by id from database and returns it
    public function getProductById($product_id)
    {
        $query = $this->connection->prepare("SELECT * FROM teas WHERE _id = ?");
        $query->bind_param("i", $product_id);
        $query->execute();
        $result = $query->get_result();

        return $result;
    }


    // Shows products as productCards 
    public function showProductsCards()
    {
        $sql = "SELECT _id, Name, Description, Price, Quantity, Image FROM teas";
        $result = $this->connection->query($sql);

        // Display all products
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product = new Tea($row['_id'], $row['Name'], $row['Description'], $row['Price'], $row['Quantity'], $row['Image']);
                $this->productCard($product->getImage(), $product->getName(), $product->getDescription(), $product->getPrice(), $product->getId());
            }
        } else {
            echo 'No products found.';
        }
    }

    // productsCards 
    public function productCard($image, $name, $description, $price, $id)
    {
        echo '<div class="product">';
        echo '<img src="assets/images/' . $image . '" alt="' . $name . '" height="150">';
        echo '<h3>' . $name . '</h3>';
        echo '<p class="desc">' . $description . '</p>';
        echo '<p class="price">$' . number_format($price, 4) . '/g</p>';
        echo '<form method="post">';
        echo '<input type="hidden" name="product-id" value="' . $id . '">';
        echo '<div class="inputGroup">';
        echo '<select class="qte" name="quantity" ><option value="100">100g</option><option value="500">500g</option><option value="1000">1000g</option></select>';
        echo '</div>';
        echo '<button type="submit" name="add-to-cart"><svg width="45" height="45" fill="#3a732f" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2.25c-5.376 0-9.75 4.374-9.75 9.75s4.374 9.75 9.75 9.75 9.75-4.374 9.75-9.75S17.376 2.25 12 2.25Zm4.5 10.5h-3.75v3.75h-1.5v-3.75H7.5v-1.5h3.75V7.5h1.5v3.75h3.75v1.5Z"></path></svg></button>';
        echo '</form>';
        echo '</div>';
    }

    // Adds the new product to the database
    public function addProductToDatabase()
    {
        if (isset($_POST['add'])) {
            $name = $_POST['Name'];
            $price = $_POST['Price'];
            $quantity = $_POST['Quantity'];
            $Description = $_POST['Description'];
            $image = $_FILES['Image'];
            $imageName = basename($image['name']);
            $imagePath = '../assets/images/' . $imageName;

            if (move_uploaded_file($image['tmp_name'], $imagePath)) {
                $query = $this->connection->prepare("INSERT INTO teas (Name, Description, Price, Quantity, Image) VALUES (?, ?, ?, ?, ?)");
                $query->bind_param("ssdis", $name, $Description,  $price, $quantity, $imageName);
                $query->execute();

                echo '<script>window.location.href = "../admin.php";</script>';
            } else {
                echo "Failed to upload image.";
            }
        }
    }

    // Edits a product from the database
    public function editProduct()
    {
        // updates a record in a database based on a JSON input received via a POST request
        $input = json_decode(file_get_contents('php://input'), true); // Gets the raw data from the request body
        // Puts data from sent JSON into variables
        $id = $input['_id'];
        $name = $input['Name'];
        $description = $input['Description'];
        $price = $input['Price'];
        $quantity = $input['Quantity'];

        $query = $this->connection->prepare("UPDATE teas SET Name = ?, Description = ?, Price = ?, Quantity = ? WHERE _id = ?");
        $query->bind_param("ssdis", $name, $description, $price, $quantity, $id);
        $query->execute();
    }

    // Deletes a product from the database
    public function deleteProduct($id)
    {
        $query = $this->connection->prepare("DELETE FROM teas WHERE _id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        echo '<script>window.location.href = "../admin.php";</script>';
    }


    // Seed tables
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
    /// End Seed tables
}
