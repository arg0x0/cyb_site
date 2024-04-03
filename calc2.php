<?php
    session_start();
    if (!isset($_SESSION["user"])){
        echo '<meta http-equiv="refresh" content="3, URL=home1.php">';
        die("требуется логин");
    }
    $login=$_SESSION["user"];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Калькулятор</title>
    <style>
        input {
            width: 120px;
            margin-bottom: 6px;
            margin-top: 6px;
            text-align: center;
        }
        button{
            width: 58px;
            margin-bottom: 6px;
            margin-top: 6px;
            margin-left: 2px;
        }
        .selected {
            background-color: pink;
        }
    </style>

</head>
<body>
    <h1>Калькулятор на PHP</h1>
    <?php
        $x="";
        $y="";
        $z="";
        if (isset($_REQUEST["x"])){
            $x=$_REQUEST["x"];
            $y=$_REQUEST["y"];
            if (isset($_REQUEST["plus"])){
                $z=$x+$y;
            }
            else{
                $z=$x-$y;
            }
            // логируем в БД
            include("settings.php");
            // Необходимо переписать на параметрическое выражение
            $sql="INSERT INTO calcs(Login,Result) VALUES('$login',$z)";
            $conn=mysqli_connect($DB_SERVER, $DB_USER, $DB_PWD,$DB_NAME);
            $result=mysqli_query($conn,$sql);





        }
        //echo("Result: $z");
    ?>
    <form>    
        <input name="x" value="<?=$x?>"/><br/>
        <input name="y" value="<?=$y?>"><br/>
        <button name="plus">+</button>
        <button name="minus">-</button><br/>
        <input value="<?=$z?>"/>
    </form>

</body>
</html>