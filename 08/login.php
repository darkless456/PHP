<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
<?php
/**
 * @Author: darkless
 * @Date:   2015-12-14 13:07:08
 * @Last Modified by:   darkless
 * @Last Modified time: 2015-12-14 14:31:59
 */
 session_start();

 if(_get('action') == "logout"){
    unset($_SESSION['userid']);
    unset($_SESSION['username']);
    echo '注销登录成功！点击此处 <a href="login.html">登录</a>';
    exit();
 }

 if(!isset($_POST['submit'])){
    exit('非法访问');
 }

 $username = htmlspecialchars($_POST['username']);
 $password = md5($_POST['password']);

 include('connection.php');

 $check_name = @mysql_query("SELECT uid FROM user WHERE username='$username' and password='$password' limit 1;"); 

 if($result = mysql_fetch_array($check_name)){
    $_SESSION['username'] = $username;
    $_SESSION['userid'] = $result['uid'];
    echo "点击", "<a href='console.php'>此处</a>", "进入后台";
    exit;
 } else{
    exit("登陆失败,请". "<a href='javascript:history.back(-1);'>返回</a>'". "重试");
 }

 // Notice: Undefined index 解决
 function _get($str){
    $val = !empty($_GET[$str]) ? $_GET[$str] : null;
    return $val;
 }
 ?>
 </html>