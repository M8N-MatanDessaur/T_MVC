<?php 
ini_set('display_errors', 0);
require_once './autoloader.php'; // Load classes automatically
session_start();

//CONSOLE.LOG SESSION
echo "<script>console.log(" . json_encode(var_export($_SESSION["cart_obj"], true)) . ");</script>";
echo "<script>console.log(" . json_encode(var_export($_SESSION["user"], true)) . ");</script>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/styles/style.css">
    <title>T&nbsp;&nbsp;|&nbsp;&nbsp;Our products</title>
</head>

<body>
    <?php include('./views/Identification.php') ?>
    <section class="page-layout">
        <?php include('./views/Sidebar.php') ?>
        <?php include('./views/Shop.php') ?>
    </section>
</body>

</html>