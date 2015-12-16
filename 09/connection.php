<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    </head>
<?php
/**
 * @Author: darkless
 * @Date:   2015-12-15 10:48:40
 * @Last Modified by:   darkless
 * @Last Modified time: 2015-12-15 15:21:49
 */
 $link = @mysql_connect("localhost", "root", "");
 if(!$link){
     die("Connect to database failure!". mysql_errno());    
 }

 mysql_query("set charactor set 'utf8';");
 mysql_query("set names 'utf8';");
 date_default_timezone_set('PRC'); 

 mysql_select_db("db_09", $link);
 ?>
 </html>