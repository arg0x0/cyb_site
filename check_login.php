<?php
    include("settings.php");
    session_start();

    $user=$_REQUEST["user"];
    $pwd=$_REQUEST["pwd"];
    $e_pwd_hash="8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92";
    $pwd_hash=hash('sha256',$pwd);

    //Нарушения правил безопасности:
    //1. Опасность SQLInjection
    //2. Секреты в коде 
    //3. Нарушен принцип наименьших привелегий, использование административной учетной записи root

    //Для защиты от SQLInjection применяются параметрические запросы. В php они называются prepared statements.
    //В выражении ниже ? - параметры которые нужно 
    $sql="SELECT Login FROM Logins
            WHERE Login=? 
            AND PwdHash=?
            ";

    //echo $sql;



    
    $conn=mysqli_connect($DB_SERVER, $DB_USER, $DB_PWD,$DB_NAME);    
    //Подготатавливаем выражение
    $stmt=mysqli_prepare($conn,$sql);
    // Передаем значения параметров (ss - типы string у двух параметров)
    mysqli_stmt_bind_param($stmt,"ss",$user,$pwd_hash);
    // Выполняем выражение
    mysqli_stmt_execute($stmt);
    // Извлекаем результат
    $result=mysqli_stmt_get_result($stmt);
    $data=mysqli_fetch_assoc($result);

    //$data=mysqli_stmt_fetch($result);
    //$result=mysqli_query($conn,$sql);
    //$data=mysqli_fetch_assoc($result);
    // var_dump($data);


    if (is_null($data)){
        echo "Bad user or password";
        echo '<meta http-equiv="refresh" content="3, URL=login.php">';
    }
    else{
        echo "<h2>Привет $user!</h2>";
        $_SESSION["user"]=$user;
        echo '<meta http-equiv="refresh" content="3, URL=home1.php">';
    }
    mysqli_close($conn);








    // if ($pwd_hash==$e_pwd_hash) {
    //     echo "Привет, $user!";
    // }
    // else{
    //     echo "Неверный логин или пароль";
    // }
    // echo "User $user password $pwd";



