<!-- 
    **  Handles login user
 -->

<?php 
ini_set('display_errors', 0);
require_once '../autoloader.php'; // Load classes automatically
session_start();

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// Search for user in database usin static method
$user = User::findByEmailAndPassword($email, $password);

if ($user == null) {
    header('Location: ../login');
} else {
    if($user->verifyAdmin()){
        session_start();
        $_SESSION['user'] = $user;
        $_SESSION['cart'] =  new Cart();
        header('Location:../admin.php');
        exit;
    }
    else{
    // If user is found and password is correct, log them in
    $_SESSION['user'] = $user;
    $_SESSION['cart'] =  new Cart();

    // Redirect to shop
    header('Location:../shop.php');
    exit;
    }
}
?>
