<?php ini_set('display_errors', 0);
require_once './autoloader.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./assets/styles/style.css">
    <title>Document</title>
</head>

<body style="max-width: 100%;margin: 0; padding: 0;">
    <?php include('./views/Identification.php') ?>
    <section class="page-layout">
        <?php include('./views/Sidebar.php') ?>
        <?php include('./views/aboutustext.php')?>
    </section>
</body>

</html>