<?php
// Проверяем жетон безопасности (=сессионную переменную)
    session_start();
    if (!isset($_SESSION["user"])){
        die("требуется логин");
    }
    
    $csrf_token=$_REQUEST["csrf_token"];
    if ($csrf_token!=session_id()){
        die("возможная попытка CSRF");
    }
    $login=$_SESSION["user"];

    // Получаем параметры запроса (например,из строки запроса)
    $x=$_REQUEST["x"];
    $y=$_REQUEST["y"];
    $z=$x+$y;
    
    
    // логируем в БД
    include("../settings.php");
    // Необходимо переписать на параметрическое выражение
    $sql="
    INSERT INTO calcs(Login,Result) VALUES('$login',$z)
    ";
    $conn=mysqli_connect($DB_SERVER, $DB_USER, $DB_PWD,$DB_NAME);
    mysqli_query($conn,$sql);
    
    //Имитация задержки
    sleep(3);
    //вернули результат тому, кто его запросил (скорее всего js)
    echo($z);
?>