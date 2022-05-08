<?PHP
/*********************************************
 * FileName---: timeoutCheck.php
 * Function---: 
 * Version----: V 0.0.1
 * Time-------: 20/11/2021
 * Author-----: Duohua(Edward) Wang
 * Email------: dhwangchina@gmail.com
 * Copyright--: All rights reserverd By Duohua(Edward) Wang
 **********************************************
 */
 
//ini_set('date.timezone','Asia/Shanghai');
//date_default_timezone_set("Etc/GMT-9");
//echo date('Y-m-d H:i',0);
include_once("../common/global.php");
include_once("../common/commLib.php");
include_once("../include/dbLink.php");

$timezone = date_default_timezone_get();

while(true)
{
    $timeSql    = "SELECT devID, timestamp FROM devNetworkTbl WHERE status = 1";
    $timeResult = mysql_query($timeSql);
    $timeList   = array();
    $timeCnt    = 0;
    while($Row = mysql_fetch_array($timeResult))
    {
        $timeList[] = $Row;
        $timeCnt++;
    }
    
    for($index = 0; $index < $timeCnt; $index++)
    {
        $timeStamp = strtotime($timeList[$index]['timestamp']);
//        printf("timestamp:%d\n",$timeStamp);
//        printf("time     :%d\n",time());
        if(time() - $timeStamp > C_TIMEOUT_SECOND)
        {
            printf("%d\n",time() - $timeStamp);
            $devID = $timeList[$index]['devID'];
            $chkSql = "UPDATE devNetworkTbl SET status = 0, timestamp = now() WHERE devID = $devID";
            $result = mysql_query($chkSql);
        }
    }
    
    mysql_free_result($timeResult);

    sleep(1);
}




?>