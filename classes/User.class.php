<?php
class User
{
    private $id;
    private $fullName;
    private $email;
    private $password;
    private $_isAdmin = false;

    public function __construct($id, $fullName, $email, $password)
    {
        $this->id = $id;
        $this->fullName = $fullName;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function verifyAdmin(){
        return $this->_isAdmin;
    }


    public static function findByEmailAndPassword($email, $password)
    {
        $db = new Database();
        $con = $db->getConnection();

        $query = $con->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
        $query->bind_param('ss', $email, $password);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows == 0) {
            return null;
        }


        $row = $result->fetch_assoc();

        if ($row['Admin'] !== null) {
            $user = new AdminUser($row['_id'], $row['FullName'], $row['Email'], $row['Password']);
            
        } else {
            $user = new User($row['_id'], $row['FullName'], $row['Email'], $row['Password']);
        }

        return $user;
    }

    public function save()
    {
        $db = new Database();
        $conn = $db->getConnection();

        $query = $conn->prepare('INSERT INTO users (FullName, Email, Password) VALUES (?, ?, ?)');
        $query->bind_param('sss', $this->fullName, $this->email, $this->password);
        $query->execute();
    }
}
