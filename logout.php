<?php
    session_start();
    unset($_SESSION["user"]);
    echo("Вы вышли");
    echo '<meta http-equiv="refresh" content="3, URL=home1.php">';
?>