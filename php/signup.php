<?php
    require_once('../classes/Database.class.php');
    require_once('../classes/Tea.class.php');
    require_once('../classes/User.class.php');
    require_once('../classes/AdminUser.class.php');
    require_once('../classes/Cart.class.php');
    ?>
<?php
// Get form data
$fullName = $_POST['fullName'];
$email = $_POST['email'];
$password = $_POST['password'];

// Create new user object
$user = new User(null, $fullName, $email, $password);

// Save user to database
$user->save();

// Check if user is an admin
if (isset($_POST['isAdmin'])) {
    $admin = new AdminUser(null, $fullName, $email, $password);
    // Save admin to database
    $admin->save();
}

// Redirect to login page
header('Location: ../login.php');
exit;
?>