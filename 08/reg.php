<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
<?php
/**
 * @Author: darkless
 * @Date:   2015-12-10 17:21:31
 * @Last Modified by:   darkless
 * @Last Modified time: 2015-12-14 13:39:29
 */
// 判断是否提交
if(!isset($_POST['submit'])){
    exit("非法访问");
}

// 获取注册页面信息
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
// $username = 'admin1';
// $password = '123456';
// $email = 'narcissu456@gmail.com';

// 注册信息判断
if(!preg_match('/^[\w\x80-\xff]{3,15}$/', $username)){
    exit('用户名不符合要求.<a href="javascript:history.back(-1);">返回</a>');
}

if(strlen($password) < 6){
    exit('密码不符合要求.<a href="javascript:history.back(-1);">返回</a>');
}

// if(!preg_match('/^w+([-+.]w+)*@w+([-.]w+)*.w+([-.]w+)*$/', $email)){
//     exit('Email格式不对.<a href="javascript:history.back(-1);">返回</a>');
// }
 
// 包含数据库连接文件
include('connection.php');

// 检测用户名是否存在
$check_name = mysql_query("select uid from user where username = '$username' limit 1");

if(mysql_fetch_array($check_name)){
    echo "错误，用户名已存在", '<a href="javascript:history.back(-1);">返回</a>';
    exit();
}

// 创建新用户
$password = MD5($password);
$regdate = time();

// 特别注意引号的使用!
$reg_user = "INSERT INTO user(username, password, email, regdate) VALUES('$username', '$password', '$email', $regdate);";

if(mysql_query($reg_user, $conn)){
    echo '注册成功，点击', '<a href="login.html">登陆</a>';
} else{
    echo '写入用户失败', mysql_errno(), '<br/>';
    echo '<a href="javascript:history.back(-1);">返回上一页</a>';
}

 ?>
 </html>