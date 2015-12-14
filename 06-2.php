<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
<?php
/**
 * @Author: darkless
 * @Date:   2015-12-01 15:13:07
 * @Last Modified by:   darkless
 * @Last Modified time: 2015-12-01 15:17:14
 */
      //向MySQL数据库中发送一条创建数据表的SQL语句
     $link = @mysql_connect('localhost','root','');
     mysql_query("set names 'utf-8'");

     //判断连接数据库是否成功
     //注意加叹号，否则连接数据库失败，错误号为0，原因0
     if(!$link){
          die("连接数据库失败，错误号为：" . mysql_errno() . "失败原因" . mysql_errno()); 
     }
     mysql_query("create database test1", $link);
     //选择数据库
     $db = mysql_select_db("test1");

     //判断选择数据库是否成功
     if(!$db){
         die("选择数据库失败，错误号为:" . mysql_errno() . "失败原因" . mysql_errno());
     }

     //拼装创建表的SQL语句
     $sql  = "CREATE TABLE students(";
     $sql .= "stuID int(4) not null auto_increment primary key,";
     $sql .= "stuName varchar(20) not null,";
     $sql .= "stuSex tinyint not null default 1,";
     $sql .= "stuBirth date not null,";
     $sql .= "classId int(4) not null);";
     
     //执行创建表语句
     if(mysql_query($sql)){
         echo "创建表成功";
     }else{
         echo "创建表失败";
     }

     //操作完毕后关闭数据库连接
     mysql_close($link);
 
 ?>
 </html>