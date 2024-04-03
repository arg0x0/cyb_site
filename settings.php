<?php
    
    $PATH_TO_KEY="C:\\KEYS\\CYB_KEY.php";
    $DB_SERVER="localhost:3306";
    $DB_NAME="cyb";
    $DB_USER="cyb";
    $DB_PWD_ENCRYPTED="bgnePCWaNRR75ROxWzF1lA==";

    include($PATH_TO_KEY);
    $DB_PWD=openssl_decrypt($DB_PWD_ENCRYPTED,"AES-128-CBC",$ENCRYPT_KEY);
    
?>