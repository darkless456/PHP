<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>提交留言</title>
    </head>
<?php
/**
 * @Author: darkless
 * @Date:   2015-12-15 15:51:24
 * @Last Modified by:   darkless
 * @Last Modified time: 2015-12-16 16:00:59
 */
 // 判断是否提交
 if(!isset($_POST['submit'])){
     exit("非法访问");
 }
 
 // 表单数据安全性检测
 // htmlspecialchars() 函数把一些特殊字符转换为 HTML 实体，返回一个字符串。
 if(get_magic_quotes_gpc()){
    $nickname = htmlspecialchars(trim($_POST['nickname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $msg = htmlspecialchars(trim($_POST['msg']));
 } else{
    $nickname = addslashes(htmlspecialchars(trim($_POST['nickname'])));
    $email = addslashes(htmlspecialchars(trim($_POST['email'])));
    $msg = addslashes(htmlspecialchars(trim($_POST['msg'])));
 }

 if(strlen($nickname) > 16){
    exit("昵称不能超过16个字符，<a href='javascript:history.back(-1)'>返回</a>请重新输入");
 }
 if(strlen($email) > 40){
    exit("邮箱不能超过40个字符，<a href='javascript:history.back(-1)'>返回</a>请重新输入");
 }

 // 检测没错误后写入数据库
 require("connection.php");

 $posttime = time();

 $inst  = "INSERT INTO msgbook(nickname, email, msg, posttime)VALUES";
 $inst .= "('$nickname', '$email', '$msg', $posttime);";

 if(mysql_query($inst)){
    ?>
    <body>
        <p>
            留言提交成功<br/>
            页面正在跳转。。。
        </p>
    </body>
    <?php
    header("location: index.php");
    exit;
 } else{
    echo "留言提交失败", mysql_errno(), "请<a href='javascript:history.back(-1)'>返回</a>之前页面";
 }
 ?>
 </html>