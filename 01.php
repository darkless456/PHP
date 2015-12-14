<?php
/**
 * @Author: darkless
 * @Date:   2015-08-11 09:18:40
 * @Last Modified by:   darkless
 * @Last Modified time: 2015-08-20 11:48:10
 */

////echo phpinfo(); input system info  include sql php server version
echo $_SERVER['HTTP_USER_AGENT']."<br/>";
echo "<br/>"

// judge the type of browser

if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE){
    echo "use IE <br/>";
} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE){
    echo "use Chrome <br/>";
} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Gecko') !== FALSE){
    echo "use Firefox <br/>";
}

?>