<!doctype HTML>
<?PHP
    include_once("include/dbLink.php");
    
    $sql     = "SELECT * FROM devNetworkTbl ORDER BY devID";
    $Result  = mysql_query($sql);
    $RowList = array();
    $RowCnt  = 0;
    while($Row = mysql_fetch_array($Result))
    {
        $RowList[] = $Row;
        $RowCnt++;
    }

    $jsonDevInfoList = json_encode($RowList);
    mysql_free_result($Result);
    mysql_close($connect);
?>

<html>
    <head>
        <meta charset="utf-8"/>
        <title>6G testBed</title>
        <link rel="stylesheet" type="text/css" href="css/main_01.css"/>
        <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script--> 
        <script src="js/mmenu/jquery-1.9.1.min.js"></script>
        <script src="js/common_js/comm.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    </head>
    <body>
        <div class="table-container">
            <div class="devTblHdr">Devices Network Parameters</div>
            <div>
                <form method='post' action=''>
                    <table>
                        <tr>
                            <td style='width:  60px; height: 30px; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;'>ID</td>
                            <td style='width: 100px; height: 30px; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;'>NetType</td>
                            <td style='width: 100px; height: 30px; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;'>NetRole</td>
                            <td style='width: 150px; height: 30px; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;'>HomedNodeID</td>
                            <td style='width: 180px; height: 30px; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;'>MAC</td>
                            <td style='width: 180px; height: 30px; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;'>IP</td>
                            <td style='width: 100px; height: 30px; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;'>Port</td>
                            <td style='width: 100px; height: 30px; font-size: 16px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;'>Oper</td>
                        </tr>
                    </table>
               </form>
            </div>
            <div id="devNetParaList" style="margin-top: 1px;"></div>
            <div class="linkBtn">
                <!--a href="./devNetParaAdd.php" class="linkbutton" style="right: 45px; margin-right: 20px;">Add</a-->
                <a href="./devNetParaAdd.php"><input type="button" class="linkLeftBtn" name="linkBtn" id="linkBtn" value="Add"/></a>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
var devInfoList = eval(<?PHP echo($jsonDevInfoList); ?>);

$(document).ready(function(){
    devInfoSeek(devInfoList);
    freshPage(5);
});

function devInfoSeek(vDevList)
{
    var tblInfo     = "";
    var netTypeName = "Undefined";
    var netRoleName = "Undefined";
    var devID       = 0;
    var ulLoop      = 0;
   
    if(0 == vDevList.length)
    {
        tblInfo += "<div style='text-align:center; color:white'>No Data</div>";

        devNetParaList.innerHTML = tblInfo;
        return;
    }

    tblInfo += "<form method='post' action=''>\
                    <table>";
    for(ulLoop = 0; ulLoop < vDevList.length; ulLoop++)
    {
        netTypeName = getNetTypeNameByTypeID(vDevList[ulLoop].netType);
        netRoleName = getNetRoleNameByRoleID(vDevList[ulLoop].netRole);
        devID       = vDevList[ulLoop].devID;
        tblInfo += "<tr>\
                        <td style='width:  60px; font-size: 12px; font-weight: normal; color: white; text-align: center;'>"+devID+"</td>\
                        <td style='width: 100px; font-size: 12px; font-weight: normal; color: white; text-align: center;'>"+netTypeName+"</td>\
                        <td style='width: 100px; font-size: 12px; font-weight: normal; color: white; text-align: center;'>"+netRoleName+"</td>\
                        <td style='width: 150px; font-size: 12px; font-weight: normal; color: white; text-align: center;'>"+vDevList[ulLoop].homedDevID+"</td>\
                        <td style='width: 180px; font-size: 12px; font-weight: normal; color: white; text-align: center;'>"+vDevList[ulLoop].macAddr+"</td>\
                        <td style='width: 180px; font-size: 12px; font-weight: normal; color: white; text-align: center;'>"+vDevList[ulLoop].IPv4Addr+"</td>\
                        <td style='width: 100px; font-size: 12px; font-weight: normal; color: white; text-align: center;'>"+vDevList[ulLoop].portID+"</td>\
                        <td style='width: 100px; font-size: 12px; font-weight: normal; color: white; text-align: center;'>\
                            <a href='devNetParaMod.php?divID="+devID+"' style='color: gold;'>Mod</a>/\
                            <a href='devNetParaDel.php?divID="+devID+"' style='color: gold;'>Del</a>\
                        </td>\
                    </tr>";
    }

    tblInfo += "</table>\
                </form>";
    
    devNetParaList.innerHTML = tblInfo;
}

</script>

