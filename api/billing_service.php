<?php
    
    session_start();
    if (!isset($_SESSION["user"])){
        echo '<meta http-equiv="refresh" content="3, URL=../home1.php">';
        die("требуется логин");
    }
    $user=$_SESSION["user"];

    header("Content-Type: application/json; charset=UTF-8");
    
    
    $sql="SELECT Login,CalcDate,Result FROM calcs
    WHERE Login=?
    ORDER BY CalcDate DESC";

    //Логируем в БД
    include("../settings.php");

    $conn=mysqli_connect($DB_SERVER, $DB_USER, $DB_PWD,$DB_NAME);    
    //Подготатавливаем выражение
    $stmt=mysqli_prepare($conn,$sql);
    // Передаем значения параметра (ss - типы string у одного параметра)
    mysqli_stmt_bind_param($stmt,"s",$user);
    // Выполняем выражение
    mysqli_stmt_execute($stmt);
    // Извлекаем результат
    $result=mysqli_stmt_get_result($stmt);
    $data=mysqli_fetch_all($result);
    
    mysqli_close($conn);

    echo(json_encode($data));
    //var_dump($data);
    //echo($data);

?>