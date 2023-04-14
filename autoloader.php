<!-- 
    ** Autoloader function loads
    ** the needed classes from the
    ** classes directory
-->

<?php ini_set('display_errors', 0);
spl_autoload_register(function ($class) {
    $classFile = './classes/' . $class . '.class.php';
    if (file_exists($classFile)) {
        require_once($classFile);
    }
});
?>