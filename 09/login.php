<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>登陆管理后台</title>
    <style>
    * {margin: 0; padding: 0;}
    body{font-size: 14px;}
    form{width: 225px; margin: 15px; border: 1px solid #ccc; padding: 15px;}
    p{margin-bottom: 10px;}
    label{float: left; width: 70px;}
    .password{width: 150px;}
    .submit{padding: 5px;}
    </style>
</head>
<?php
session_start();
require("connection.php");

if($_POST){
    $password = md5(trim($_POST['password']));
    $username = trim($_POST['username']);

    $check_query = mysql_query("SELECT uid FROM user WHERE username='$username' AND password='$password';");
    if($check_array = mysql_fetch_array($check_query)){
        $_SESSION['username'] = $username;
        $_SESSION['userid'] = $check_array['uid'];
        // 重定向至留言管理界面
        header("Location: console.php");
        exit;
    } else{
        exit('密码错误!');
    }
}


?>
<body>
    <form name="login" action="" method="post" accept-charset="utf-8" onsubmit="return inputCheck(this);">
        <p>
            <input type="hidden" name="username" class="username" value="admin"></input>
        </p>
        <p>
            <label for="">密码：</label>
            <input type="password" name="password" class="password" placeholder="输入管理员密码" />
        </p>
        <p>
            <input type="submit" name="submit" class="submit" value="登陆" />
        </p>
    </form>
</body>
<script>
    function inputCheck(form){
        if(form.password.value == ''){
            alert('密码不能为空');
            form.password.focus();
            return false;
        }
    }
</script>

</html>
