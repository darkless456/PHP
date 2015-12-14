<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
<?php
/**
 * @Author: darkless
 * @Date:   2015-12-10 12:06:37
 * @Last Modified by:   darkless
 * @Last Modified time: 2015-12-10 17:36:00
 */
$link = @mysql_connect("localhost", "root", "") or die("Connect to database failure, Error Code：" . mysql_errno());
@mysql_query("set names utf-8");

if(@mysql_select_db("db_08", $link)){
    @mysql_query("drop database db_08;", $link);
    echo "Deleted old database." . "<br/><br/>";
};

@mysql_query('create database db_08;', $link);
$db = @mysql_select_db("db_08") or die("Create new database failure，Error Code：" . mysql_errno());

$password = md5("123456");
$regdate = time();

$sql  = "CREATE TABLE user(";
$sql .= "uid mediumint(8) unsigned NOT NULL auto_increment,";
$sql .= "username char(20) NOT NULL default '',";
$sql .= "password char(32) NOT NULL default '',";
$sql .= "email varchar(40) NOT NULL default '',";
$sql .= "regdate int(10) unsigned NOT NULL default '0',";
$sql .= "PRIMARY KEY (uid)";
$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

$inst = mysql_query($sql) or die("Create table failure. Error Code: " . mysql_errno());
 
 ?>
 </html>