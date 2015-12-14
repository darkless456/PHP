<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
<?php
/**
 * @Author: darkless
 * @Date:   2015-11-27 12:04:12
 * @Last Modified by:   darkless
 * @Last Modified time: 2015-12-07 20:19:23
 */
 $conn = @mysql_connect("localhost", "root", "");

// 连接数据库
 if(!$conn){
    die("连接数据库失败"." --- "."<br>". mysql_errno());
 } else{
    echo "成功连接数据库"."<br>";
 }
 mysql_query("SET NAMES 'UTF8'");

// 先删除之前的自定义数据库
if(@mysql_select_db("testdb", $conn)){
    @mysql_query("drop database testdb", $conn);
    echo "已删除之前的自定义数据库"."<br>";
}
// 创建新数据库testdb
if(@mysql_query("create database testdb", $conn)){
    echo "-- 创建数据库成功"."<br><br>";
} else{
    die("创建数据库失败" . mysql_errno());
}

$db = @mysql_select_db("testdb");
if($db){
    echo "选择数据库成功" . '<br>';
} else{
    die("选择数据库失败" . mysql_errno());
}

// 创建表user

$sql  = "CREATE TABLE user(";
$sql .= "uid mediumint(8) unsigned NOT NULL auto_increment,";
$sql .= "name varchar(20) NOT NULL default '',";
$sql .= "password char(32) NOT NULL default '',";
$sql .= "email varchar(40) NOT NULL default '',";
$sql .= "regdate int(10) unsigned NOT NULL default '0',";
$sql .= "Primary key(uid), Unique key name(name), Key email(email)";
$sql .= ") Engine=MyISAM Default Charset=utf8 auto_increment=1;";

if(mysql_query($sql)){
    echo "CREATE TABLE SUCCESS" . '<br><br>';
} else{
    die("CREATE TABLE FAILURE" . " /  ERROR CODE: " . mysql_errno());
}

// 插入数据
$password = md5("123456"); //默认密码
$regdate = time(); //得到时间戳

$inp  = "INSERT INTO user(name, password, email, regdate)VALUES('Kevin', '$password', 'kevin@gmail.com', $regdate);";
$inp1 = "INSERT INTO user(name, password, email, regdate)VALUES('Jobs', '$password', 'jobs@163.com', $regdate);";
$inp2 = "INSERT INTO user(name, password, email, regdate)VALUES('Mark', '$password', 'mark@hotmail.com', $regdate);";
$inp3 = "INSERT INTO user(name, password, email, regdate)VALUES('Obama', '$password', 'obama123@gmail.com', $regdate);";
$inp4 = "INSERT INTO user(name, password, email, regdate)VALUES('Lily', '$password', 'lily@gmail.com', $regdate);";

// 批量插入数据
$inps = array($inp, $inp1, $inp2, $inp3, $inp4);
for($i=0; $i<=4; $i++){
    if(mysql_query($inps[$i])){
        echo "Insert data success [$i]" . "<br><br>";
    } else{
        die("Inserted failure" . " /  Error Code: " . mysql_errno());
    }
}

// 查询数据
date_default_timezone_set('PRC'); //设置北京市区，默认是格林威治时间
$result = mysql_query("SELECT * FROM user");  //返回资源标识符
while ($row = mysql_fetch_array($result)) { //格式化资源变量
    echo '姓名：' . $row['name'] . '<br>';
    echo 'Email：' . $row['email'] . '<br>';
    echo '注册日期：' . date('Y-m-d H:m:s', $row['regdate']) . '<br><br>';
};

 ?>
 </html>