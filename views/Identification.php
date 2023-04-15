<div id="identification">
<?php
if (isset($_SESSION['user'])) {
    // Show's user FullName if connected
    echo "<h2 style='color:#3a732f; font-size:1.2rem; margin: 0;'>" . $_SESSION['user']->getFullName() . "</h2>";
} else {
    // Show's nothing if not connected
    echo "";
}
?>
    <a href="../t/php/disconnect.php" style="height: 35px;">
        <svg width="35" height="35" fill="#3a732f" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2.25c-5.376 0-9.75 4.374-9.75 9.75s4.374 9.75 9.75 9.75 9.75-4.374 9.75-9.75S17.376 2.25 12 2.25Zm.094 4.5a3.375 3.375 0 1 1 0 6.75 3.375 3.375 0 0 1 0-6.75ZM12 20.25a8.23 8.23 0 0 1-6.055-2.653C6.359 15.45 10.08 15 12 15s5.64.45 6.055 2.596A8.228 8.228 0 0 1 12 20.25Z"></path>
        </svg>
    </a>
</div>