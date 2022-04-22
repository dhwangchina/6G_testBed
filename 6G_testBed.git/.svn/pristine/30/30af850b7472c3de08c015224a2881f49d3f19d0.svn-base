<!doctype HTML>
<?PHP
    include_once("include/dbLink.php");
    //Get devID by URL
    $divID = $_GET['divID'];
    $divID = trim($divID);
    //Get device info parameters
    $modSql     = "SELECT * FROM devNetworkTbl WHERE devID = $divID";
    $modResult  = mysql_query($modSql);
    $devInfoList = array();
    $ParaRowCnt  = 0;
    while($ParaRow = mysql_fetch_array($modResult))
    {
        $devInfoList[] = $ParaRow;
        $ParaRowCnt++;
    }

    $jsonDevInfoList = json_encode($devInfoList);
    mysql_free_result($modResult);
    
    //Get NodeB List
    $nodeBSql= "SELECT * FROM devNetworkTbl WHERE netRole=8 ORDER BY devID";
    $Result  = mysql_query($nodeBSql);
    $RowList = array();
    $RowCnt  = 0;
    while($Row = mysql_fetch_array($Result))
    {
        $RowList[] = $Row;
        $RowCnt++;
    }
    
    $jsonHomedNodeList = json_encode($RowList);
    mysql_free_result($Result);
    
    if(isset($_REQUEST['modSubmit']))
    {
        $devID       = $_POST['devID'];
        $netType     = $_POST['netType'];
        $netRole     = $_POST['netRole'];
        if(0 == $netRole % 2)
        {
            $HomedNodeID = $devID;
        }
        else
        {
            $HomedNodeID = $_POST['homedNodeBID'];
        }
        
        $MacAddr     = $_POST['MacAddr'];
        $IPv4Addr    = $_POST['IPv4Addr'];
        $portID      = $_POST['portID'];
        $status      = 1;
        $modSql      = "UPDATE devNetworkTbl SET
                                                  netType    = '".$netType."',
                                                  netRole    = '".$netRole."',
                                                  homedDevID = '".$HomedNodeID."',
                                                  macAddr    = '".$MacAddr."',
                                                  IPv4Addr   = '".$IPv4Addr."',
                                                  portID     = '".$portID."',
                                                  status     = '".$status."',
                                                  timestamp  = now()
                                              WHERE devID = '".$devID."' ";
        $modSqlResult = mysql_query($modSql);
        if($modSqlResult)
        {            
            echo("<script>
                          alert('OK. Mod Device Network Parameters successfully!');
                          window.location.href='devNetParaConf.php';
                  </script>");
        }
        else
        {
            echo("<script>
                          alert('Oop. Mod Device Network Parameters Failure!');
                          window.location.href='devNetParaMod.php';
                 </script>");
        }
        mysql_free_result($modSqlResult);
    }
    mysql_close($connect);
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
            <div class="devTblHdr" style="font-family: fantasy; font-weight: bold; color: white;">Modify Device Network Parameters
            </div>
            <div>
                <form method="post" action="">
                    <table>
                        <tr>
                            <td style="width: 100px; font-family: fantasy; font-size: 14px; font-weight: normal; text-align: right; color: white; padding-right: 5px;">Device ID</td>
                            <td style="width: 200px; font-family: fantasy; font-size: 12px; font-weight: normal; text-align: left;">
                                <output style="width: 200px; color: white; margin-left: 3px;" name="devID" id="devID" form="false"><?PHP echo"$divID";?></output>
                            </td>
                            <td style="width: 700px; font-family: fantasy; font-size: 12px; font-weight: normal; color: white; padding-left: 3px;">Device Identifier, number range is 0~65535
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px; font-family: fantasy; font-size: 14px; font-weight: normal; text-align: right; color: white; padding-right: 5px;">Net Type</td>
                            <td style="width: 200px; font-family: fantasy; font-size: 12px; font-weight: normal; text-align: left;">
                                <select name="netType" id="netType" style="width: 200px;">
                                    <option value="255">Select NetType</option>
                                    <option value="0">WLAN</option>
                                    <option value="1">3G</option>
                                    <option value="2">LTE</option>
                                    <option value="3">LTE-A</option>
                                    <option value="4">5GNR</option>
                                    <option value="5" selected="true">6G</option>
                                </select>
                            </td>
                            <td style="width: 700px; font-family: Time new romon; font-size: 12px; font-weight: normal; color: white; padding-left: 3px;">Net Type is the Communication system that the device is involved in.
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px; font-family: fantasy; font-size: 14px; font-weight: normal; text-align: right; color: white; padding-right: 5px;">Net Role</td>
                            <td style="width: 200px; font-family: fantasy; font-size: 12px; font-weight: normal; text-align: left;">
                                <select name="netRole" id="netRole" style="width: 200px;">
                                    <option value="255">Select NetRole</option>
                                    <option value="0">AP</option>
                                    <option value="1">STA</option>
                                    <option value="2">3gNB</option>
                                    <option value="3">3gUE</option>
                                    <option value="4">4gNB</option>
                                    <option value="5">4gUE</option>
                                    <option value="6">5gNB</option>
                                    <option value="7">5gUE</option>
                                    <option value="8" selected="true">6gNB</option>
                                    <option value="9">6gUE</option>
                                </select>
                            </td>
                            <td style="width: 700px; font-family: fantasy; font-size: 12px; font-weight: normal; color: white; padding-left: 3px;">Net Role is the task that the device is acted as.
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px; font-family: fantasy; font-size: 14px; font-weight: normal; text-align: right; color: white; padding-right: 5px;">HomedNodeID</td>
                            <td style="width: 200px; font-family: fantasy; font-size: 12px; font-weight: normal; text-align: left;">
                                <select style="width: 199px;" name="homedNodeBID" id="homedNodeBID">
                                </select>
                            </td>
                            <td style="width: 700px; font-family: fantasy; font-size: 12px; font-weight: normal; color: white; padding-left: 3px;">HomedNodeID is the owner of the terminal, especially eNodeB.
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px; font-family: fantasy; font-size: 14px; font-weight: normal; text-align: right; color: white; padding-right: 5px;">Device MAC</td>
                            <td style="width: 200px; font-family: fantasy; font-size: 12px; font-weight: normal; text-align: left;">
                                <input type="text" style="width: 197px;" name="MacAddr" id="MacAddr" size="17" value="00:00:00:00:00:00"/>
                            <td style="width: 700px; font-family: fantasy; font-size: 12px; font-weight: normal; color: white; padding-left: 3px;">Device MAC is the Ethernet address that is used to cennect to network.
                            </td>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px; font-family: fantasy; font-size: 14px; font-weight: normal; text-align: right; color: white; padding-right: 5px;">Device IPv4</td>
                            <td style="width: 200px; font-family: fantasy; font-size: 12px; font-weight: normal; text-align: left;">
                                <input type="text" style="width: 197px;" name="IPv4Addr" id="IPv4Addr" size="17" value="0.0.0.0"/>
                            </td>
                            <td style="width: 700px; font-family: fantasy; font-size: 12px; font-weight: normal; color: white; padding-left: 3px;">Device IPv4 is the Ipv4 address that is used to cennect to network.
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px; font-family: fantasy; font-size: 14px; font-weight: normal; text-align: right; color: white; padding-right: 5px;">Device PortID</td>
                            <td style="width: 200px; font-family: fantasy; font-size: 12px; font-weight: normal; text-align: left;">
                                <input type="number" style="width: 197px;" name="portID" id="portID" min="0" max="65535" placeholder="portID" value="0"/>
                            </td>
                            <td style="width: 700px; font-family: fantasy; font-size: 12px; font-weight: normal; color: white; padding-left: 3px;">Device PortID is the UDP portID that is used to cennect to network.
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="submitBtn" name="modSubmit" id="modSubmit" value="modSubmit">Submit</button>
                    <a href="devNetParaConf.php"><input type="button" class="linkLeftBtn" name="linkBtn" id="linkBtn" value="Back"/></a>
                </form>

            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
var NodeBList   = eval(<?PHP echo("$jsonHomedNodeList");?>);
var devInfoList = eval(<?PHP echo("$jsonDevInfoList");?>);

$(document).ready(function(){
    CreateHomedNodeIDList();

    showLastDevInfo();
});

function CreateHomedNodeIDList()
{
    var nodeBID  = 0;
    var ulLoop   = 0;

    $("#homedNodeBID").append("<option value='255'>Select BaseID</option>");
    for(ulLoop = 0; ulLoop < NodeBList.length; ulLoop++)
    {
        nodeBID = NodeBList[ulLoop].devID;
        $("#homedNodeBID").append("<option value='"+ulLoop+"'>"+nodeBID+"</option>");
    }
    
    return;
}

function showLastDevInfo()
{
    if(1 == devInfoList.length)
    {
        document.getElementById("netType").value      = devInfoList[0].netType;
        document.getElementById("netRole").value      = devInfoList[0].netRole;
        document.getElementById("homedNodeBID").value = devInfoList[0].homedDevID;
        document.getElementById("MacAddr").value      = devInfoList[0].macAddr;
        document.getElementById("IPv4Addr").value     = devInfoList[0].IPv4Addr;
        document.getElementById("portID").value       = devInfoList[0].portID;
    }
    return;
}

</script>