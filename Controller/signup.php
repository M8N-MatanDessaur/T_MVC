<!-- 
    **  Handles signup user and create user in database
 -->

<?php 
ini_set('display_errors', 0);
require_once '../autoloader.php'; // Load classes automatically

// htmlspecialchars :   Prevents cross-site scripting (XSS) attacks 
//                      by converting special characters to their HTML entities
// filter_input :       Used to remove any illegal characters from the email input and 
//                      to validate that it is in the correct format
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
header('Location: ../View/login.php');
exit;
?>
