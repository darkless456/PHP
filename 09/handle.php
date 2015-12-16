<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
<?php
/**
 * @Author: darkless
 * @Date:   2015-12-16 15:02:27
 * @Last Modified by:   darkless
 * @Last Modified time: 2015-12-16 15:52:03
 */
 session_start();
 if(!$_SESSION['username']){
    header('location: login.php');
    exit;
 }
 
 require("connection.php");
 // 更新回复
 if($_POST){
    if(get_magic_quotes_gpc()){
        $reply = htmlspecialchars(trim($_POST['reply']));
    } else{
        $reply = addslashes(trim($_POST['reply']));
    }

    $replytime = $reply?time():'NULL';
    $update = mysql_query("UPDATE msgbook SET reply='$reply', replytime=$replytime WHERE id=$_POST[id];");
    if($update){
        echo '<script language="javascript">alert("回复成功！");self.location="console.php"</script>';
    } else{
        exit('留言失败：'.mysql_error().'[ <a href="javascript:history.back()">返 回</a> ]');
    }
 }    

// 删除留言
if($_GET['action']=='delete'){
    $delete = mysql_query("DELETE FROM msgbook WHERE id=$_GET[id];");
    if($delete){
        echo '<script language="javascript">alert("删除成功！");self.location="console.php"</script>';  
    } else{
        exit('删除失败'.mysql_errno().'[ <a href="javascript:history.back(-1)">返回</a> ]');
    }
}

 function _get($str){
    $val = !empty($_GET[$str])?$_GET[$str]:null;
    return $val;
 }
 ?>
 </html>