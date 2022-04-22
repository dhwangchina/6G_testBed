<!doctype HTML>

<?PHP
/*
* File  : eventLog.php
* Author: Duohua(Edward) Wang
* Email : dhwangchina@gmail.com
* Time  : 16/10/2021
*/
    include_once("include/dbLink.php");
    //Get Nide Event Info
    $logSql       = "SELECT * FROM devEventTbl ORDER BY indx";
    $logSqlResult = mysql_query($logSql)  or die("MySQL error:". mysql_error());
    $logInfoList  = array();
    $recNum       = 0;
    while($recRow = mysql_fetch_array($logSqlResult))
    {
        $logInfoList[] = $recRow;
        $recNum++;
    }
    
    $jsonEventLog = json_encode($logInfoList);
    
    mysql_free_result($logSqlResult);
    mysql_close($connect);
    //
?>


<html>
    <head>
        <meta charset="utf-8"/>
        <title>6G testBed</title>
        <link rel="stylesheet" type="text/css" href="css/main_01.css"/>
       	<script src="js/mmenu/jquery-1.9.1.min.js"></script>
        <script src="js/common_js/comm.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>
    
    <body>
        <div class="table-container">
            <div class="devTblHdr">Devices Event Info</div>
            <div>
                <form method="post" action="">
                    <table>
                        <tr>
                            <td style="width:  80px; height: 30px; font-family: fantasy; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">Index</td>
                            <td style="width:  60px; height: 30px; font-family: fantasy; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">NodeID</td>
                            <td style="width: 100px; height: 30px; font-family: fantasy; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">EventLevel</td>
                            <td style="width: 600px; height: 30px; font-family: fantasy; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">EventInfo</td>
                            <td style="width: 160px; height: 30px; font-family: fantasy; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">TimeStamp</td>
                        </tr>
                    </table>
                </form>
            </div>
            <div id="eventInfoTbl" style="margin-top: 1px;"></div>
        </div>
    </body>
</html>

<script type="text/javascript">
var eventList = eval(<?PHP echo("$jsonEventLog");?>);
$(document).ready(function(){
    getEventInfo();
    freshPage(1);
});

function getEventInfo()
{
    var ulLoop  = 0;
    var tblInfo = "";

    if(0 == eventList.length)
    {
        tblInfo += "<div style='text-align:center; color:white'>No Data</div>";

        eventInfoTbl.innerHTML = tblInfo;
        return;
    }

    tblInfo += "<form method='post' action=''>\
                    <table>";

    for(ulLoop = 0; ulLoop < eventList.length; ulLoop++)
    {
        tblInfo += "<tr>\
                        <td style='width:  80px; height: 20px; font-family: fantasy; font-size: 14px; font-weight: bold; color: white; text-align: center;'>"+eventList[ulLoop].indx+"</td>\
                        <td style='width:  60px; height: 20px; font-family: fantasy; font-size: 14px; font-weight: bold; color: white; text-align: center;'>"+eventList[ulLoop].devID+"</td>\
                        <td style='width: 100px; height: 20px; font-family: fantasy; font-size: 14px; font-weight: bold; color: white; text-align: center;'>"+eventList[ulLoop].eventLevel+"</td>\
                        <td style='width: 600px; height: 20px; font-family: fantasy; font-size: 14px; font-weight: bold; color: white; text-align: left;'>"+eventList[ulLoop].eventInfo+"</td>\
                        <td style='width: 160px; height: 20px; font-family: fantasy; font-size: 14px; font-weight: bold; color: white; text-align: center;'>"+eventList[ulLoop].timestamp+"</td>\
                    </tr>";
    }
    tblInfo += "</table>\
                </form>";
    eventInfoTbl.innerHTML = tblInfo;
    return;
}



</script>
