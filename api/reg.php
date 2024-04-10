<?php
    // логируем в БД
    include("../settings.php");
    session_start();
    $csrf_token=$_REQUEST["csrf_token"];
    if ($csrf_token!=session_id()){
        die("возможная попытка CSRF");
    }
    $type=$_REQUEST["type"];
    if ($type==1){
        $user_login=$_REQUEST["user_login"];
        $sql="SELECT Login FROM Logins
            WHERE Login=?
            ";
        $conn=mysqli_connect($DB_SERVER, $DB_USER, $DB_PWD,$DB_NAME);    
        //Подготатавливаем выражение
        $stmt=mysqli_prepare($conn,$sql);
        // Передаем значения параметров (ss - типы string у двух параметров)
        mysqli_stmt_bind_param($stmt,"s",$user_login);
        // Выполняем выражение
        mysqli_stmt_execute($stmt);
        // Извлекаем результат
        $result=mysqli_stmt_get_result($stmt);
        $data=mysqli_fetch_assoc($result);

        if (is_null($data)){
            echo("yes");
        }
        else{
            echo("no");
        }
        mysqli_close($conn);
    }
    else{
        $user_login=$_REQUEST["user_login"];
        $user_password=openssl_encrypt($_REQUEST["user_pass"],"AES-128-CBC",'Pa$$w0rd');
        $user_email=$_REQUEST["email"];
        echo($user_login);
        echo($user_password);
        echo($user_email);
        $sql="INSERT INTO Logins 
            (Login, PwdHash, Email) 
            VALUES (?, ?, ?)
            ";
        $conn=mysqli_connect($DB_SERVER, $DB_USER, $DB_PWD,$DB_NAME);    
        //Подготатавливаем выражение
        $stmt=mysqli_prepare($conn,$sql);
        // Передаем значения параметров (ss - типы string у двух параметров)
        mysqli_stmt_bind_param($stmt,"sss",$user_login,$user_password,$user_email);
        // Выполняем выражение
        mysqli_stmt_execute($stmt);
        // Извлекаем результат
        $result=mysqli_stmt_get_result($stmt);
        $data=mysqli_fetch_assoc($result);
        echo($data);
        mysqli_close($conn);
    }
?>