<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>留言管理</title>
    </head>

 <body>
 <h1>欢迎进入留言管理, <?php 
 /**
 * @Author: darkless
 * @Date:   2015-12-16 13:47:25
 * @Last Modified by:   darkless
 * @Last Modified time: 2015-12-16 15:57:40
 */
 session_start();
 if(!$_SESSION['username']){
    header('location: login.php');
    exit;
 }
 ?>
 </h1>
 <?php
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
 ?>
 <fieldset style="width: 200px; padding: 20px;">
     <legend>回复本条留言</legend>
     <form action="handle.php" method="post" accept-charset="utf-8" name="replyForm" id="reply">
        <textarea class="replay" name="reply" rows="5" cols="40" style="resize: none;"><?=$get_array['reply']?></textarea>
        <p>
            <input type="hidden" name="id" value="<?=$get_array['id']?>" />
            <input type="submit" name="submit" value="回复">
            <a href="handle.php?action=delete&id=<?=$get_array['id']?>" style="text-decoration: none; color: #000;">删除此留言</a>
        </p>
     </form>
 </fieldset>
 <?php
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
            echo '[<a href="console.php?p='. $i. '">'. $i. '</a>]';
           
        }
     }
     echo '<br>总共有'. $counted_msg['count']. '条留言';
 }

 function _get($str){
    $val = !empty($_GET[$str])?$_GET[$str]:null;
    return $val;
 }
 ?>
 </body>
 </html>