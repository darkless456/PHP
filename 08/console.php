<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
<?php
/**
 * @Author: darkless
 * @Date:   2015-12-14 13:37:35
 * @Last Modified by:   darkless
 * @Last Modified time: 2015-12-14 14:20:15
 */
 session_start();

 if(!$_SESSION['userid']){
    header("Location:login.html");
    exit();
 }

 include("connection.php");

 $userid = $_SESSION['userid'];
 $username = $_SESSION['username'];
 // 双引号，为资源类型，单引号，为布尔型
 $tmp = mysql_query("SELECT * FROM user WHERE uid=$userid limit 1;");
 // var_dump($tmp);
 $result = mysql_fetch_array($tmp);

 echo "用户信息", '<br/>';
 echo "ID: ", $userid, '<br/>';
 echo "USERNAME: ", $username, '<br/>';
 echo "E-Mail: ", $result['email'], '<br/>';
 echo "REGDATE: ", date('Y-m-d H:m', $result['regdate']), '<br/>';
 echo "Click ", "<a href='login.php?action=logout'>Logout</a>"; 
 
 ?>
 </html>