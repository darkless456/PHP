<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>留言展示</title>
        <style>
            *{margin: 0; padding: 0;}
            body{font-size: 14px;}
            fieldset{margin: 30px; padding: 15px; width: 550px;}
            p{margin-bottom: 10px;}
            input.input{width: 350px;}
            label{float: left; width: 70px;}
            textarea{resize: none; width: 352px;}
        </style>
    </head>
    <body>
<?php
/**
 * @Author: darkless
 * @Date:   2015-12-15 13:29:38
 * @Last Modified by:   darkless
 * @Last Modified time: 2015-12-16 15:34:59
 */
 require("connection.php");
 require("config.php");

 // 确定当前页数
 $p = _get('p')?_get('p'):1;
 // $p = 1;
 // 数据指针
 $offset = ($p-1)*$pagesize;
 
 // 查询记录
 $selected_data = mysql_query("SELECT * FROM msgbook ORDER BY id DESC LIMIT $offset, $pagesize;");

 if(!$selected_data){
    exit("查询数据失败".mysql_errno());
 }
 // 输出数据
 while ($get_array = mysql_fetch_array($selected_data)){
     echo "<hr>";
     echo '<b>'.$get_array['nickname'].'</b>', " 用户"; 
     echo "发表于：", date("y-m-d H:i", $get_array['posttime']), '<br><br>';
     echo "内容：", nl2br($get_array['msg']), '<br><br>';
     if(!empty($get_array['reply'])){
        echo '--------------------------<br>';
        echo "回复于：", date("y-m-d H:i", $get_array['replytime']), '<br><br>';
        echo "内容：", nl2br($get_array['reply']), '<br><br>';
     }
 }
 

 // 分页显示
 // 留言总数
 $counted_msg = mysql_fetch_array(mysql_query("SELECT count(*) AS count FROM msgbook"));
 $count_page = ceil($counted_msg['0']/$pagesize); //计算留言页数

 if($count_page>1){
     for($i=1; $i<=$count_page; $i++){
        if($i==$p){
            echo "[", $i, "]";
        } else{
            echo '[<a href="index.php?p='. $i. '">'. $i. '</a>]';
        }
     }
     echo '<br>总共有'. $counted_msg['count']. '条留言';
 }

 function _get($str){
    $val = !empty($_GET[$str])?$_GET[$str]:null;
    return $val;
 }
 ?>

<!-- 留言表单 -->

<fieldset>
    <legend>用户留言</legend>
    <form action="submiting.php" id="post_msg" method="post" name="post_msg" accept-charset="utf-8" onsubmit="return inputCheck(this)">
        <p>
            <label for="nickname" class="label">昵称：</label>
            <input type="text" class="input" placeholder="请输入昵称" name="nickname" />
        </p>
        <p>
            <label for="email" class="label">E-Mail：</label>
            <input type="email" name="email" class="input" placeholder="请输入邮箱地址">
        </p>
        <p>
            <label for="msg" class="label">留言：</label>
            <textarea name="msg" class="input" rows="8" placeholder="请输入留言内容"></textarea>
        </p>
        <p>
            <input type="submit" name="submit" value="提交留言" />
        </p>
    </form>
</fieldset>
</body>
<script>
    function inputCheck(form){
        if(form.nickname.value == ''){
            alert("昵称不能为空");
            form.nickname.focus();
            return false;
        }

        if(form.msg.value == ''){
            alert("留言不能空");
            form.msg.focus();
            return false;
        }
    }
</script>
 </html>