<?PHP
/*********************************************
 * FileName---: usrsDel.php
 * Function---: 
 * Version----: V 0.0.1
 * Time-------: 20/11/2021
 * Author-----: Duohua(Edward) Wang
 * Email------: dhwangchina@gmail.com
 * Copyright--: All rights reserverd By Duohua(Edward) Wang
 **********************************************
 */
    include_once("include/dbLink.php");
    
    $usrID = $_GET['usrID'];
    $usrID = trim($usrID);
    $Sql   = "DELETE FROM usersInfoTbl WHERE usrid = $usrID";
    $SqlResult = mysql_query($Sql);
    if(!$SqlResult)
    {
        echo("<script>alert('Oop. Delete the parameters of Users failure!');</script>");
    }
    
    mysql_close($connect);
    
    echo("<script>window.location.href='usrsConf.php';</script>");
?>