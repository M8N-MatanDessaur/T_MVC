<!-- 
    **  Handles signup user and create user in database
 -->

<?php ini_set('display_errors', 0);
require_once('../classes/Database.class.php');
require_once('../classes/Tea.class.php');
require_once('../classes/User.class.php');
require_once('../classes/AdminUser.class.php');
require_once('../classes/Cart.class.php');

$fullName = htmlspecialchars($_POST['fullName']);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = htmlspecialchars($_POST['password']);


// Create new user object
$user = new User(null, $fullName, $email, $password);

// Save user to database
$user->save();

// Check if user is an admin
if (isset($_POST['isAdmin'])) {
    // Create and save admin using the same data as the user
    $admin = new AdminUser(null, $fullName, $email, $password);
    $admin->save();
}

// Redirect to login page
header('Location: ../login.php');
exit;
?>
