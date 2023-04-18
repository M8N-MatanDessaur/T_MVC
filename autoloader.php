<!-- 
    ** Autoloader function loads
    ** the needed classes from the
    ** classes directory
-->

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function ($class) {
    // Define the base directory for your class files
    $baseDir = __DIR__ . '/classes/';

    // Append the base directory and the .class.php extension to the class name
    $classFile = $baseDir . $class . '.class.php';

    // Check if the class file exists and require it
    if (file_exists($classFile)) {
        require_once($classFile);
    } else {
        // Optionally, throw an exception if the class file is not found
        throw new Exception("Class file not found: " . $classFile);
    }
});

?>