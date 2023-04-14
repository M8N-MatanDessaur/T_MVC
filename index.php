<?php ini_set('display_errors', 0);
require_once './autoloader.php'; // Load classes
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/styles/style.css">
    <title>T&nbsp;&nbsp;|&nbsp;&nbsp;Welcome</title>
</head>

<body>
    <?php include('./views/Identification.php') ?>
    <section class="page-layout">
        <?php include('./views/Sidebar.php') ?>
        <?php include('./views/Main.php') ?>
    </section>
</body>

</html>