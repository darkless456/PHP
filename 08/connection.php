<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
<?php
/**
 * @Author: darkless
 * @Date:   2015-12-10 17:16:13
 * @Last Modified by:   darkless
 * @Last Modified time: 2015-12-14 11:45:10
 */
 $conn = @mysql_connect("localhost", "root", "");
 if(!$conn){
    die("连接数据库失败，错误代码是：". mysql_errno);
 }

 mysql_select_db("db_08", $conn);

 mysql_query("set charactor set 'utf-8';");
 mysql_query("set names 'utf-8';");

 // mysql_query("INSERT INTO user(username, password, email, regdate) VALUES('admin', '123456', 'admin@gmail.com', '2015');");
 
 ?>
 </html>