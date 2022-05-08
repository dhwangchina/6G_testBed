<?PHP
/*********************************************
 * FileName---: devNetParaDel.php
 * Function---: 
 * Version----: V 0.0.1
 * Time-------: 20/11/2021
 * Author-----: Duohua(Edward) Wang
 * Email------: dhwangchina@gmail.com
 * Copyright--: All rights reserverd By Duohua(Edward) Wang
 **********************************************
 */
    include_once("include/dbLink.php");
    
    $devID = $_GET['divID'];
    $devID = trim($devID);

    $delSql       = "DELETE FROM devNetworkTbl WHERE devID = $devID";
    $delSqlResult = mysql_query($delSql);
    if(!$delSqlResult)
    {
        echo("<script>alert('Oop. Delete the parameters of device failure!');</script>");
    }
    
    mysql_close($connect);
    
    echo("<script>window.location.href='devNetParaConf.php';</script>");
?>