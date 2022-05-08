<?PHP
/*********************************************
 * FileName---: usrsConf.php
 * Function---: 
 * Version----: V 0.0.1
 * Time-------: 12/10/2021
 * Author-----: Duohua(Edward) Wang
 * Email------: dhwangchina@gmail.com
 * Copyright--: All rights reserverd By Duohua(Edward) Wang
 **********************************************
 */

    include_once("include/dbLink.php");
    //
    $Sql       = "SELECT * FROM usersInfoTbl";
    $SqlResult = mysql_query($Sql) or print("Error in usersInfoTbl:") .mysql_error();
    $rowList   = array();
    $rowCnt    = 0;
    
    while($row = mysql_fetch_array($SqlResult))
    {
        $rowList[] = $row;
        $rowCnt++;
    }
    
    $jsonUsrList = json_encode($rowList);
    
    mysql_free_result($SqlResult);
    mysql_close($connect);

?>


<!doctype HTML>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>6G testBed</title>
        <link rel="stylesheet" type="text/css" href="css/main_01.css"/>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
       	<script src="js/mmenu/jquery-1.9.1.min.js"></script>
        <script src="js/common_js/comm.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>
    
    <body>
        <div id="usrBGD">
            <div style="font-family: fantasy; font-size: 16px; font-weight: bold; margin-left: 10px; color: white;">User Info</div>
            <div>
                <form method="post" action="">
                    <table>
                        <tr>
                            <td style="width: 100px; height: 30px; font-family: fantasy; font-size: 14px; font-weight: bold; text-align: center; color: white; background-color:blue; border-color: grey;">UserID</td>
                            <td style="width: 200px; height: 30px; font-family: fantasy; font-size: 14px; font-weight: bold; text-align: center; color: white; background-color:blue; border-color: grey;">UserName</td>
                            <td style="width: 300px; height: 30px; font-family: fantasy; font-size: 14px; font-weight: bold; text-align: center; color: white; background-color:blue; border-color: grey;">UserMail</td>
                            <td style="width: 150px; height: 30px; font-family: fantasy; font-size: 14px; font-weight: bold; text-align: center; color: white; background-color:blue; border-color: grey;">UserCreateTime</td>
                            <td style="width: 150px; height: 30px; font-family: fantasy; font-size: 14px; font-weight: bold; text-align: center; color: white; background-color:blue; border-color: grey;">LoginTime</td>
                            <td style="width: 100px; height: 30px; font-family: fantasy; font-size: 14px; font-weight: bold; text-align: center; color: white; background-color:blue; border-color: grey;">Operation</td>
                        </tr>
                    </table>
                </form>
            </div>
            <div id="usrInfoList" style="margin-top: 1px;"></div>
            <div class="linkBtn">
                <a href="./usrsAdd.php"><input type="button" class="linkLeftBtn" name="linkBtn" id="linkBtn" value="Add"/></a>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
var usrInfo = eval(<?PHP echo("$jsonUsrList");?>); 

$(document).ready(function(){
    showUsrInfo();
    freshPage(1);
});

function showUsrInfo()
{
    var tblInfo = "";
    var ulLoop  = 0;
    
    if(0 == usrInfo.length)
    {
        tblInfo += "<div style='text-align:center; color:white'>No Data</div>";
        usrInfoList.innerHTML = tblInfo;
        return;
    }
    
    tblInfo += "<form method='post' action=''>\
                    <table>";
    for(ulLoop = 0; ulLoop < usrInfo.length; ulLoop++)
    {
        usrID = usrInfo[ulLoop].usrid;
        tblInfo += "<tr>\
                        <td style='width: 100px; font-family: fantasy; font-size: 12px; font-weight: normal; text-align: center; color: white;'>"+usrID+"</td>\
                        <td style='width: 200px; font-family: fantasy; font-size: 12px; font-weight: normal; text-align: center; color: white;'>"+usrInfo[ulLoop].name+"</td>\
                        <td style='width: 300px; font-family: fantasy; font-size: 12px; font-weight: normal; text-align: center; color: white;'>"+usrInfo[ulLoop].umail+"</td>\
                        <td style='width: 150px; font-family: fantasy; font-size: 12px; font-weight: normal; text-align: center; color: white;'>"+usrInfo[ulLoop].timestamp+"</td>\
                        <td style='width: 150px; font-family: fantasy; font-size: 12px; font-weight: normal; text-align: center; color: white;'>"+usrInfo[ulLoop].logTmStamp+"</td>\
                        <td style='width: 100px; font-family: fantasy; font-size: 12px; font-weight: normal; text-align: center; color: white;'>\
                        <a href='usrsMod.php?usrID="+usrID+"' style='color: gold;'>Mod</a>/<a href='usrsDel.php?usrID="+usrID+"' style='color: gold;'>Del</a>\
                        </td>\
                    </tr>";
    }
    tblInfo += "</table>\
        </form>";
    usrInfoList.innerHTML = tblInfo;
    return;
}


</script>