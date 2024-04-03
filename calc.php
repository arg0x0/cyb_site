<?php
    session_start();
    if (!isset($_SESSION["user"])){
        echo '<meta http-equiv="refresh" content="3, URL=home1.php">';
        die("требуется логин");
    }
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
    <script>
        var csrf_token="<?=session_id()?>"; 
        function plus(){
            // РЕализовать асинхронный вывод ожидания
            document.getElementById("z").value="Wait!";
            var x,y,z
            x=parseInt(document.getElementById("x").value);
            y=parseInt(document.getElementById("y").value);

            var xhr=new XMLHttpRequest();
            var url = "api/plus.php?x="+x+"&y="+y+"&csrf_token="+csrf_token;
            xhr.open("GET",url);
            xhr.onload=function(){
                console.log(xhr.responseText);
                z=xhr.responseText;
                document.getElementById("z").value=z;
                document.getElementById("plus").classList.add("selected");
                document.getElementById("minus").classList.remove("selected"); 
            }
            xhr.send();
        }
        function minus(){
            x=parseInt(document.getElementById("x").value);
            y=parseInt(document.getElementById("y").value);

            var xhr=new XMLHttpRequest();
            var url = "api/minus.php?x="+x+"&y="+y;
            xhr.open("GET",url,false);
            xhr.open("GET",url);
            xhr.onload=function(){
                console.log(xhr.responseText);
                z=xhr.responseText;
                document.getElementById("z").value=z;
                document.getElementById("plus").classList.add("selected");
                document.getElementById("minus").classList.remove("selected"); 
            }
            xhr.send();
        }

    </script>
</head>
<body>
    <h1>Калькулятор с запросом веб-сервисов через JS</h1>
    <input id="x" autocomplete="FALSE"/><br/>
    <input id="y" autocomplete="FALSE"><br/>
    <button id="plus" onclick="plus()">+</button>
    <button id="minus" onclick="minus()">-</button><br/>
    <input id="z">
</body>
</html>