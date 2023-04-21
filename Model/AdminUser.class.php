<?php
class AdminUser extends User{
    private $_isAdmin;
    public function __construct($id, $fullName, $Email, $Password){
        parent::__construct($id, $fullName, $Email, $Password);
        $this->_isAdmin = true; // sets isAdmin to true
    }

    // Verify if user is admin
    public function verifyAdmin(){
        return $this->_isAdmin;
    }
}
?>