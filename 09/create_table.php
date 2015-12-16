<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
<?php
/**
 * @Author: darkless
 * @Date:   2015-12-15 10:53:21
 * @Last Modified by:   darkless
 * @Last Modified time: 2015-12-16 13:27:30
 */
 include("connection.php");

 if(mysql_select_db('db_09', $link)){
    mysql_query("drop database db_09;", $link);
 }

 mysql_query("create database db_09", $link);
 mysql_select_db("db_09", $link);

 $sql  = "CREATE TABLE msgbook(";
 $sql .= "id mediumint(8) unsigned NOT NULL auto_increment,";
 $sql .= "nickname char(16) NOT NULL default '',";
 $sql .= "email varchar(40),";
 $sql .= "msg text NOT NULL default '',";
 $sql .= "posttime int(10) unsigned NOT NULL default '0',";
 $sql .= "reply text,";
 $sql .= "replytime int(10) unsigned,";
 $sql .= "PRIMARY KEY(id)";
 $sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

 $tb = @mysql_query($sql);

 if(!$tb){
    die("Create table msgbook failure, Error Code: ". mysql_errno());
 } else{
    echo "Create new database <b>db_09</b> successfully!<br/><br/>";
 }

 $posttime = time();
 $replytime = time() + 100;
 $inst = "INSERT INTO msgbook(nickname, email, msg, posttime, reply, replytime)VALUES('admin', 'admin@mail.com', 'first message', $posttime, '测试回复', $replytime);";
 $inst2 = "INSERT INTO msgbook(nickname, email, msg, posttime)VALUES('admin', '', '中文测试', $posttime);";
 $inst3 = "INSERT INTO msgbook(nickname, email, msg, posttime)VALUES('中文名', 'china@gmail.com', '中文名测试留言', $posttime);";
 $inst4 = "INSERT INTO msgbook(nickname, email, msg, posttime)VALUES('Kevin', 'kevin@hotmail.com', 'company manager', $posttime);";
 $inst5 = "INSERT INTO msgbook(nickname, email, msg, posttime)VALUES('盈桥服饰有限公司', 'admin@ven-bridge.com', '长留言，这是一条非常长的留言，总共有好几行的长条留言，用于测试显示的效果。系统备份 用 DISM 命令进行系统备份与还原不需要任何第三方软件，备份后的镜像文件格式为wim，备份文件占用空间小（比 Ghost 小很多），而且可进行增量备份。缺陷：不支持热备份，备份与还原需要在 Win7 以上的 PE 或 第二系统中进行。', $posttime);";

 $inst_array = array($inst, $inst2, $inst3, $inst4, $inst5);

 for($i=0; $i<count($inst_array); $i++){
     mysql_query($inst_array[$i]);
     $j = $i+1;
     echo "插入第".$j."条测试留言。<br/>";
 }

 $user  = "CREATE TABLE user(";
 $user .= "uid mediumint(8) unsigned NOT NULL auto_increment,";
 $user .= "username varchar(16) NOT NULL default '',";
 $user .= "password char(32) NOT NULL default '',";
 $user .= "PRIMARY KEY(uid)";
 $user .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

 $ub = @mysql_query($user);
 if($ub){
    echo "<br>员工表创建成功";
 } else{
    echo "<br>创建失败，错误代码：", mysql_errno();
 }
 $username = 'admin';
 $password = md5('123456');
 mysql_query("INSERT INTO user(username, password)VALUES('$username', '$password');");
 ?>
 </html>