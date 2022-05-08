<?PHP
/*********************************************
 * FileName---: logout.php
 * Function---: 
 * Version----: V 0.0.1
 * Time-------: 07/05/2022
 * Author-----: Duohua(Edward) Wang
 * Email------: dhwangchina@gmail.com
 * Copyright--: All rights reserverd By Duohua(Edward) Wang
 **********************************************
 */
    session_start();
    
    $old_user = $_SESSION['valid_user'];
    
    unset($_SESSION['valid_user']);
    session_destroy();
    
    $url = 'index.php';
    echo "<meta http-equiv='refresh' content='0.1;url=$url'>";//Jump to $url in 0.1 second 
    
?>
