<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .login-block{
            display: block;
        }
        .login-container {
            display: flex;
            justify-content:left;
        }
        button{
            width: 158px;
            margin-bottom: 6px;
            margin-top: 6px;
        }
        span{
            width:170px;
        }
        input{
            width: 150px;
            margin-bottom: 6px;
            margin-top: 6px;
            margin-left: 20px;
        }
    </style>
    <script>
        var csrf_token="<?=session_id()?>";
        
        const alphabet_up = "ABCDEFGHIJKLMNOPQRSTUVWXYZ".split("");
        const alphabet_low="abcdefghijklmnopqrstuvwxyz".split("");
        const alphabet_spec="\,\!\,\"\#\$\%\&\'\(\)\*\+\,\-\.\/\:\;\<\=\>\?\@\[\]\^\_\`".split("");
        const numbers="0123456789".split("");
        function reg(){
            var email=document.getElementById("email").value;
            var user_login=document.getElementById("login").value;
            if(!email){
                alert("Введите почту");
            }
            else{            
                if (!user_login){
                    alert("Поле Логин не должно быть пустым");
                }
                else if (user_login.match(/\s/)){
                    alert("Поле Логин не должно содержать пробелы");
                }
                else{
                    //password_check=pwd_check();
                    //Проверяем логин
                    var xhr=new XMLHttpRequest();
                    var url = "api/reg.php?type="+'1'+"&user_login="+user_login+"&csrf_token="+csrf_token;
                    xhr.open("GET",url);
                    xhr.onload=function(){
                        console.log(xhr.responseText);
                        result=xhr.responseText;
                        if (result=="yes"){
                            
                            var pwd=document.getElementById("password").value;
                            if (pwd.length<=6){
                                alert("Слишком короткий пароль, введите минимум 8 символов");
                            }
                            else{
                                pwd_result=pwd_check();
                                //alert(pwd_result);
                                if (pwd_result!=4){
                                    alert("Слабый пароль, необходимо использовать латинские заглавные буквы и прописные буквы, цифры и спецсимволы");
                                }
                                else{
                                    var pwd_control=document.getElementById("password_control").value;
                                    if (pwd==pwd_control){
                                        //alert("Отличный пароль");
                                        var xhr2=new XMLHttpRequest();
                                        var url2 = "api/reg.php?type="+'2'+"&user_login="+user_login+"&user_pass="+pwd+"&email="+email+"&csrf_token="+csrf_token;
                                        xhr2.open("POST",url2);
                                        xhr2.onload=function(){
                                            console.log(xhr2.responseText);
                                            result2=xhr2.responseText;
                                            alert(result2);
                                        }
                                        xhr2.send();
                                    }
                                    else{
                                        alert("пароли не совпадают");
                                    }                                
                                }
                            }
                        }
                        else{
                            alert("Логин уже используется");
                        }
                        //document.getElementById("an").innerText=result;
                    }
                    xhr.send();
                    
                }
            }
        }
        function pwd_check(){
            var k_up=0;
            var k_low=0;
            var k_spec=0;
            var k_num=0;
            var pwd=document.getElementById("password").value;
            for(var i=0;i<alphabet_up.length;i++){
                if (pwd.indexOf(alphabet_up[i])!== -1){
                    k_up=1;
                }
            }
            for(var i=0;i<alphabet_low.length;i++){
                if (pwd.indexOf(alphabet_low[i])!== -1){
                    k_low=1;
                }
            }
            for(var i=0;i<alphabet_spec.length;i++){
                if (pwd.indexOf(alphabet_spec[i])!== -1){
                    k_spec=1;
                }
            }
            for(var i=0;i<numbers.length;i++){
                if (pwd.indexOf(numbers[i])!== -1){
                    k_num=1;
                }
            }
            return k_up+k_low+k_spec+k_num;

        }
    </script>
</head>
<body>
    <h1>Регистрация нового пользователя</h1>
    <div class="login-block">
        <div class="login-container">
            <span>Логин:</span>
            <input type="text" id="login" autocomplete="FALSE">
        </div>

        <div class="login-container">
            <span>Пароль:</span>
            <input type="password" id="password" autocomplete="FALSE">
        </div>
        <div class="login-container">
            <span>Подтверждение пароля:</span>
            <input type="password" id="password_control" autocomplete="FALSE">
        </div>
        <div class="login-container">
            <span>Email:</span>
            <input type="text" id="email" autocomplete="FALSE">
        </div>
    </div></br>

    <button id="reg" onclick="reg()">Registration</button>
    <p id="an"> </p>
    <a href="home1.php">На домашнюю страницу</a><br/>
</body>
</html>