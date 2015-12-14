<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>分页显示</title>
    </head>
<?php
/**
 * @Author: darkless
 * @Date:   2015-12-08 11:33:34
 * @Last Modified by:   darkless
 * @Last Modified time: 2015-12-14 13:36:28
 */

$link = @mysql_connect("localhost", "root", "") or die("连接数据库失败,错误代码是：" . mysql_errno());
@mysql_query("set names utf-8");

if(@mysql_select_db("db_07", $link)){
    @mysql_query("drop database db_07;", $link);
    echo "已删除之前的自定义数据库" . "<br/><br/>";
};

@mysql_query('create database db_07;', $link);
$db = @mysql_select_db("db_07") or die("创建新数据库失败，错误代码是：" . mysql_errno());

$sql  = "CREATE TABLE guestbook(";
$sql .= "id mediumint(8) unsigned NOT NULL auto_increment,";
$sql .= "name varchar(20) NOT NULL default '',";
$sql .= "email varchar(100) NOT NULL default '',";
$sql .= "content text NOT NULL,";
$sql .= "createtime int(10) unsigned NOT NULL default '0',";
$sql .= "PRIMARY KEY (id)";
$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

$inst = mysql_query($sql) or die("Create table failure. Error Code: " . mysql_errno());
//插入数据
$crtdate = time(); //得到时间戳

$inp  = "INSERT INTO guestbook(name, content, email, createtime)VALUES('admin', '测试', 'admin@gmail.com', $crtdate);";
$inp1 = "INSERT INTO guestbook(name, content, email, createtime)VALUES('user', '第一个用户', 'user@163.com', $crtdate);";
$inp2 = "INSERT INTO guestbook(name, content, email, createtime)VALUES('Mark', '新站的新来客', 'Mark@hotmail.com', $crtdate);";
$inp3 = "INSERT INTO guestbook(name, content, email, createtime)VALUES('Obama', '好厉害的名字', 'obama123@gmail.com', $crtdate);";
$inp4 = "INSERT INTO guestbook(name, content, email, createtime)VALUES('lucy', '好棒的网页', 'lucy@gmail.com', $crtdate);";
$inp5 = "INSERT INTO guestbook(name, content, email, createtime)VALUES('ming', '篮球不错的', 'ming@sohu.com', $crtdate);";
$inp6 = "INSERT INTO guestbook(name, content, email, createtime)VALUES('紫苑', 'so beautiful', 'purple@abc.com', $crtdate);";
$inp7 = "INSERT INTO guestbook(name, content, email, createtime)VALUES('青龙', 'I like this site', 'green@sina.com', $crtdate);";
$inp8 = "INSERT INTO guestbook(name, content, email, createtime)VALUES('白虎', 'white tiger', 'tiger@gmail.com', $crtdate);";
$inp9 = "INSERT INTO guestbook(name, content, email, createtime)VALUES('朱雀', 'what is this', 'bird@mail.com', $crtdate);";

// 批量插入数据
$inps = array($inp, $inp1, $inp2, $inp3, $inp4, $inp5, $inp6, $inp7, $inp8, $inp9);
for($i=0; $i<=9; $i++){
    mysql_query($inps[$i]) or die("Inserted failure" . " /  Error Code: " . mysql_errno());
};

//每页显示个数
$pageSize = 4;
//确定第几页
$p = $_GET['p']?$_GET['p']:1;
// $p = 2;
//limit参数(数据指针)
$offset = ($p-1)*$pageSize;
//查询数据
$select_data = mysql_query("SELECT * FROM guestbook ORDER BY id DESC LIMIT $offset, $pageSize;");
//输出数据（循环输出）
while($sd = mysql_fetch_array($select_data)){
    echo '<a href="', $sd['name'], '">', $sd['name'], '</a>&nbsp;';
    echo '发表于：', date("Y-m-d H:i", $sd['createtime']), "<br/>";
    echo '内容：<b>', $sd['content'], '</b><br/><hr/>';
}
//分页代码
// 计算留言总数

$count_result = mysql_query("SELECT count(*) as count FROM guestbook;");
$count = mysql_fetch_array($count_result);

// 计算页面总数
$pageNum = ceil($count['count']/$pageSize);
echo '总共有', $count['count'], '条留言。';

// 循环输出各页数目和链接
if($pageNum > 1){
    for($i=1;$i<=$pageNum;$i++){
        if($i==$p){
            echo '[', $i, ']';
        } else{
            echo '[<a href="07.php?p='. $i. '">'. $i. '</a>]'; 
        }
    }
}


?>
 </html>