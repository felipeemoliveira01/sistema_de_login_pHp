<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    die("vaza porra😡🤬👨‍👨‍👧‍👦👉 <p><a href=\"index.php\">entra</a></p>");
}
?>
