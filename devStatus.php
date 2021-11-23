<!doctype HTML>

<?PHP
/*
* File  : devStatus.php
* Author: Duohua(Edward) Wang
* Email : dhwangchina@gmail.com
* Time  : 18/10/2021
*/
    include_once("include/dbLink.php");
    
    $sql     = "SELECT * FROM devNetworkTbl WHERE status=1";
    $Result  = mysql_query($sql);
    $RowList = array();
    $RowCnt  = 0;
    while($Row = mysql_fetch_array($Result))
    {
        $RowList[] = $Row;
        $RowCnt++;
    }

    $jsonDevList = json_encode($RowList);
    mysql_free_result($Result);
    mysql_close($connect);
?>

<html>
    <head>
        <meta charset="utf-8"/>
        <title>Devices Online Statistics</title>
        <link rel="stylesheet" type="text/css" href="css/main_01.css"/>
        
       	<script src="js/mmenu/jquery-1.9.1.min.js"></script>
        <script src="js/common_js/comm.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <!--script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> 
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script-->
    </head>

    <body>
        <div class="devInfoTbl" style="width: 100%; height: 500px; background-image: url(images/home-bg.png); background-repeat: repeat;">
            <div id="devTblHdr" style="font-family: fantasy; font-size: 14; font-weight: bold; color: white; margin-left: 10px;">Devices Online Statistics</div>
            <div>
                <form method="post" action="">
                    <table>
                       <tr>
                           <td style='width:  60px; height: 30px; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;'>ID</td>
                           <td style='width: 100px; height: 30px; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;'>Net Type</td>
                           <td style='width: 100px; height: 30px; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;'>Net Role</td>
                           <td style='width: 150px; height: 30px; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;'>HomedNodeID</td>
                           <td style='width: 180px; height: 30px; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;'>MAC</td>
                           <td style='width: 180px; height: 30px; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;'>IP</td>
                           <td style='width: 100px; height: 30px; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;'>PortID</td>
                           <td style='width: 100px; height: 30px; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;'>Status</td>
                       </tr>
                    </table>
                </form>
            </div>
            <div id="devTblContent" style="margin-top: 1px;">
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">

var devInfoList = eval(<?PHP echo($jsonDevList); ?>);

$(document).ready(function(){
    devOnlineInfo(devInfoList);
    freshPage(1);
});

function devOnlineInfo(vDevList)
{
    var tblInfo     = "";
    var netTypeName = "Undefined";
    var netRoleName = "Undefined";
    var devStatus   = "Undefined";
    var ulLoop  = 0;
       
    if(0 == vDevList.length)
    {
        tblInfo += "<div style='text-align:center; color:white'>No Data</div>";
        devTblContent.innerHTML = tblInfo;
        return;
    }

    tblInfo += "<form method='post' action=''>\
                    <table>";
                    
    for(ulLoop = 0; ulLoop < vDevList.length; ulLoop++)
    {
        netTypeName = getNetTypeNameByTypeID(vDevList[ulLoop].netType);
        netRoleName = getNetRoleNameByRoleID(vDevList[ulLoop].netRole);
        devStatus   = (vDevList[ulLoop].status == 0)? "Offline":"<a style='color:red'>Online</a>";
        
        tblInfo += "<tr>\
                    <td style='width: 60px; font-size: 12px; font-weight: normal; color: white; text-align: center;'>"+vDevList[ulLoop].devID+"</td>\
                    <td style='width: 100px; font-size: 12px; font-weight: normal; color: white; text-align: center;'>"+netTypeName+"</td>\
                    <td style='width: 100px; font-size: 12px; font-weight: normal; color: white; text-align: center;'>"+netRoleName+"</td>\
                    <td style='width: 150px; font-size: 12px; font-weight: normal; color: white; text-align: center;'>"+vDevList[ulLoop].homedDevID+"</td>\
                    <td style='width: 180px; font-size: 12px; font-weight: normal; color: white; text-align: center;'>"+vDevList[ulLoop].macAddr+"</td>\
                    <td style='width: 180px; font-size: 12px; font-weight: normal; color: white; text-align: center;'>"+vDevList[ulLoop].IPv4Addr+"</td>\
                    <td style='width: 100px; font-size: 12px; font-weight: normal; color: white; text-align: center;'>"+vDevList[ulLoop].portID+"</td>\
                    <td style='width: 100px; font-size: 12px; font-weight: normal; color: white; text-align: center;'>"+devStatus+"</td>\
                    </tr>";
    }

    tblInfo += "</table>\
               </form>";
    
    devTblContent.innerHTML = tblInfo;
}



</script>
