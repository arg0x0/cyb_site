<!DOCTYPE php>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Логин</title>
    <style>
        input {
            width: 120px;
            margin-bottom: 6px;
            margin-top: 6px;
            text-align: center;
        }
        button{
            width: 120px;
            margin-bottom: 6px;
            margin-top: 6px;
        }
        .selected {
            background-color: pink;
        }
    </style>
</head>
<body>
    <h1>Введите ваши данные</h1>
    <form action="check_login.php" method="POST">
        <input name="user"></br>
        <input type="password" name="pwd"></br>
        <button name="go">Войти</button>
    </form>
</body>
</html>