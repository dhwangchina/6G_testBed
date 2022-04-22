<!doctype HTML>
<?PHP
    include_once("include/dbLink.php");
    
    //Get NodeB List
    $sql     = "SELECT * FROM devNetworkTbl WHERE netRole=8 ORDER BY devID";
    $Result  = mysql_query($sql);
    $RowList = array();
    $RowCnt  = 0;
    while($Row = mysql_fetch_array($Result))
    {
        $RowList[] = $Row;
        $RowCnt++;
    }

    $jsonHomedNodeList = json_encode($RowList);
    
    if(isset($_REQUEST['addSubmit']))
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
            $HomedNodeID = $_POST['HomedNodeID'];
        }
        
        $MacAddr     = $_POST['MacAddr'];
        $IPv4Addr    = $_POST['IPv4Addr'];
        $portID      = $_POST['portID'];
        $status      = 0;
        
        $addSql       = "INSERT INTO devNetworkTbl VALUES('".$devID."','".$netType."','".$netRole."','".$HomedNodeID."','".$MacAddr."','".$IPv4Addr."','".$portID."','".$status."',now())";
        $addSqlResult = mysql_query($addSql);
        if($addSqlResult)
        {
            echo("<script>
                          alert('OK. Add Device Network Parameters successfully!');
                          window.location.href='devNetParaConf.php';
                  </script>");
        }
        else
        {
            echo("<script>
                          alert('Oop. Add Device Network Parameters Failure!');
                          window.location.href='devNetParaAdd.php';
                 </script>");
        }
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
            <div class="devTblHdr" style="font-family: fantasy; font-weight: bold; color: white;">Add Device Network Parameters
            </div>
            <div>
                <form method="post" action="">
                    <table>
                        <tr>
                            <td style="width: 100px; font-family: fantasy; font-size: 14px; font-weight: normal; text-align: right; color: white; padding-right: 5px;">Device ID</td>
                            <td style="width: 200px; font-family: fantasy; font-size: 12px; font-weight: normal; text-align: left;">
                                <input type="number" style="width: 195px;" width="147" size="20" name="devID" id="devID" min="0" max="65535" value="0"/>
                            </td>
                            <td style="width: 700px; font-family: fantasy; font-size: 12px; font-weight: normal; color: white; padding-left: 3px;">Device Identifier, number range is 0~65535
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px; font-family: fantasy; font-size: 14px; font-weight: normal; text-align: right; color: white; padding-right: 5px;">Net Type</td>
                            <td style="width: 200px; font-family: fantasy; font-size: 12px; font-weight: normal; text-align: left;">
                                <select name="netType" id="netType" style="width: 199px;">
                                    <option value="255">Select NetType</option>
                                    <option value="0">WLAN</option>
                                    <option value="1">3G</option>
                                    <option value="2">LTE</option>
                                    <option value="3">LTE-A</option>
                                    <option value="4">5GNR</option>
                                    <option value="5" selected="true">6G</option>
                                </select>
                                <!--
                                <input style="transform: scale(0.5,0.5);" type="radio" name="netType" id="netType" value="0" />WLAN
                                <input style="transform: scale(0.5,0.5);" type="radio" name="netType" id="netType" value="1" />3G
                                <input style="transform: scale(0.5,0.5);" type="radio" name="netType" id="netType" value="2" />LTE
                                <input style="transform: scale(0.5,0.5);" type="radio" name="netType" id="netType" value="3" />LTE-A
                                
                                <input type="radio" style="vertical-align:middle;" name="netType" id="netType" value="4" /><a style="color: white;">5GNR</a>
                                <input type="radio" style="vertical-align:middle;" name="netType" id="netType" value="5" checked="true"/><a style="color: white;">6G</a>
                                -->
                            </td>
                            <td style="width: 700px; font-family: Time new romon; font-size: 12px; font-weight: normal; color: white; padding-left: 3px;">Net Type is the Communication system that the device is involved in.
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px; font-family: fantasy; font-size: 14px; font-weight: normal; text-align: right; color: white; padding-right: 5px;">Net Role</td>
                            <td style="width: 200px; font-family: fantasy; font-size: 12px; font-weight: normal; text-align: left;">
                                <select name="netRole" id="netRole" style="width: 199px;">
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
                                <!--
                                <input type="radio" style="transform: scale(0.5,0.5); float: left;" type="radio" name="netRole" id="netRole" value="0" />AP
                                <input type="radio" style="transform: scale(0.5,0.5); float: left;" type="radio" name="netRole" id="netRole" value="1"/>STA
                                <input type="radio" style="transform: scale(0.5,0.5); float: left;" type="radio" name="netRole" id="netRole" value="2"/>3gNB
                                <input type="radio" style="transform: scale(0.5,0.5); float: left;" type="radio" name="netRole" id="netRole" value="3"/>3gUE
                                <input type="radio" style="transform: scale(0.5,0.5); float: left;" type="radio" name="netRole" id="netRole" value="4"/>4gNB
                                <input type="radio" style="transform: scale(0.5,0.5); float: left;" type="radio" name="netRole" id="netRole" value="5"/>4gUE
                                <input type="radio" style="vertical-align:middle;" name="netRole" id="netRole" value="6"/><a style="color: white;">5gNB</a>
                                <input type="radio" style="vertical-align:middle;" name="netRole" id="netRole" value="7"/><a style="color: white;">5gUE</a>
                                <input type="radio" style="vertical-align:middle;" name="netRole" id="netRole" value="8" checked="true"/><a style="color: white;">6gNB</a>
                                <input type="radio" style="vertical-align:middle;" name="netRole" id="netRole" value="9"/><a style="color: white;">6gUE</a>
                                -->
                            </td>
                            <td style="width: 700px; font-family: fantasy; font-size: 12px; font-weight: normal; color: white; padding-left: 3px;">Net Role is the task that the device is acted as.
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px; font-family: fantasy; font-size: 14px; font-weight: normal; text-align: right; color: white; padding-right: 5px;">HomedNodeID</td>
                            <td style="width: 200px; font-family: fantasy; font-size: 12px; font-weight: normal; text-align: left;">
                                <select style="width: 199px;" name="homedNodeIDList" id="homedNodeIDList">
                                </select>
                            </td>
                            <td style="width: 700px; font-family: fantasy; font-size: 12px; font-weight: normal; color: white; padding-left: 3px;">HomedNodeID is the owner of the terminal, especially eNodeB.
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px; font-family: fantasy; font-size: 14px; font-weight: normal; text-align: right; color: white; padding-right: 5px;">Device MAC</td>
                            <td style="width: 200px; font-family: fantasy; font-size: 12px; font-weight: normal; text-align: left;">
                                <input type="text" style="width: 195px;" name="MacAddr" id="MacAddr" size="17" value="00:00:00:00:00:00"/>
                            <td style="width: 700px; font-family: fantasy; font-size: 12px; font-weight: normal; color: white; padding-left: 3px;">Device MAC is the Ethernet address that is used to cennect to network.
                            </td>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px; font-family: fantasy; font-size: 14px; font-weight: normal; text-align: right; color: white; padding-right: 5px;">Device IPv4</td>
                            <td style="width: 200px; font-family: fantasy; font-size: 12px; font-weight: normal; text-align: left;">
                                <input type="text" style="width: 195px;" name="IPv4Addr" id="IPv4Addr" size="17" value="0.0.0.0"/>
                            </td>
                            <td style="width: 700px; font-family: fantasy; font-size: 12px; font-weight: normal; color: white; padding-left: 3px;">Device IPv4 is the Ipv4 address that is used to cennect to network.
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px; font-family: fantasy; font-size: 14px; font-weight: normal; text-align: right; color: white; padding-right: 5px;">Device PortID</td>
                            <td style="width: 200px; font-family: fantasy; font-size: 12px; font-weight: normal; text-align: left;">
                                <input type="number" style="width: 195px;" name="portID" id="portID" min="0" max="65535" placeholder="portID" value="0"/>
                            </td>
                            <td style="width: 700px; font-family: fantasy; font-size: 12px; font-weight: normal; color: white; padding-left: 3px;">Device PortID is the UDP portID that is used to cennect to network.
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="submitBtn" name="addSubmit" id="addSubmit" value="addSubmit">Submit</button>
                    <a href="devNetParaConf.php"><input type="button" class="linkLeftBtn" name="linkBtn" id="linkBtn" value="Back"/></a>
                </form>

            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
var NodeBList = eval(<?PHP echo("$jsonHomedNodeList");?>);

$(document).ready(function(){
    CreateHomedNodeID();
});

function CreateHomedNodeID()
{
    var nodeBID  = 0;
    var ulLoop   = 0;

    $("#homedNodeIDList").append("<option value=''>Select BaseID</option>");
    for(ulLoop = 0; ulLoop < NodeBList.length; ulLoop++)
    {
        nodeBID = NodeBList[ulLoop].devID;
        $("#homedNodeIDList").append("<option value='"+ulLoop+"'>"+nodeBID+"</option>");
    }
    
    return;
}
</script>