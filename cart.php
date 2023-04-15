<?php ini_set('display_errors', 0);
require_once './autoloader.php';  // Load classes automatically
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>T&nbsp;&nbsp;|&nbsp;&nbsp;Cart</title>
    <link rel="stylesheet" href="./assets/styles/style.css">
</head>

<body>
    <?php include('./views/Identification.php') ?>
    <section class="page-layout">
        <?php include('./views/Sidebar.php') ?>
        <?php include('./views/cartcontainer.php') ?>
    </section>
</body>

</html>