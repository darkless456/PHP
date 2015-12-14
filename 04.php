<?php
/**
 * @Author: darkless
 * @Date:   2015-08-27 15:24:51
 * @Last Modified by:   darkless
 * @Last Modified time: 2015-09-08 12:58:06
 */
// 发布留言
$str = $_POST['msg'].','.$POST['email']."\n";

$fd = fopen("./data.txt", 'a');
fwrite($fd);
fclose($fd);
echo 'sc'

// 读取留言
// 

?>