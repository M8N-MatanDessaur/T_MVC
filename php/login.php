<!-- 
    **  Handles login user
 -->

<?php ini_set('display_errors', 0);
require_once('../classes/Database.class.php');
require_once('../classes/Tea.class.php');
require_once('../classes/User.class.php');
require_once('../classes/AdminUser.class.php');
require_once('../classes/Cart.class.php');
session_start();

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// Search for user in database
$user = User::findByEmailAndPassword($email, $password);

if ($user == null) {
    header('Location: ../login');
} else {
    if($user->verifyAdmin()){
        session_start();
        $_SESSION['user'] = $user;
        header('Location:../admin.php');
        exit;
    }
    else{
    // If user is found and password is correct, log them in
    $_SESSION['user'] = $user;
    $_SESSION['cart'] =  new Cart();
    unset($_SESSION['cart']);

    // Redirect to dashboard
    header('Location:../shop.php');
    exit;
    }
}
?>
