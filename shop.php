<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/styles/style.css">
    <title>T&nbsp;&nbsp;|&nbsp;&nbsp;Our products</title>
</head>

<?php
ini_set('display_errors', 0);
include('./includes/includes.php');
session_start();
session_regenerate_id();

// if client is connected, create a cart object in session
if (isset($_SESSION['user'])) {
    $cart = $_SESSION['cart'];
}
// else bring user to login page
else {
    header('Location: ./login.php');
}
?>

<body>
    <?php include('./views/Identification.php') ?>
    <section class="page-layout">
        <?php include('./views/Sidebar.php') ?>
        <?php include('./views/Shop.php') ?>
    </section>
</body>

</html>