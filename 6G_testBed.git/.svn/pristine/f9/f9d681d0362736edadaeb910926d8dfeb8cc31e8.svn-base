<!doctype HTML>

<?PHP
    include_once("include/dbLink.php");
    
    //Get Node List
    $NodeSql       = "SELECT * FROM nodeNetWorkPerfParaTbl";
    $NodeSqlResult = mysql_query($NodeSql);
    $NodeRowList   = array();
    $NodeRowCnt    = 0;
    while($NodeRow = mysql_fetch_array($NodeSqlResult))
    {
        $NodeRowList[] = $NodeRow;
        $NodeRowCnt++;
    }

    $jsonNodeList = json_encode($NodeRowList);
    mysql_free_result($NodeSqlResult);

    //portList
    $NodeID = $_POST['SelNodeID'];
    $NodeID = 1;
    $PrtSql       = "SELECT * FROM nodeNetWorkPerfParaTbl WHERE nodeID = $NodeID";
    $PrtSqlResult = mysql_query($PrtSql);
    $PrtRowList   = array();
    $PrtRowCnt    = 0;
    while($PrtRow = mysql_fetch_array($PrtSqlResult))
    {
        $PrtRowList[] = $PrtRow;
        $PrtRowCnt++;
    }

    $jsonPrtList = json_encode($PrtRowList);
    mysql_free_result($PrtSqlResult);
    
    //Network Parameters
    $PortID = $_POST['SelPortID'];
    $PortID = 0;
    $paraSql       = "SELECT * FROM nodeNetWorkPerfParaTbl WHERE nodeID = $NodeID AND portID = $PortID";
    $paraSqlResult = mysql_query($paraSql);
    $paraRowList   = array();
    $paraRowCnt    = 0;
    while($paraRow = mysql_fetch_array($paraSqlResult))
    {
        $paraRowList[] = $paraRow;
        $paraRowCnt++;
    }

    $jsonParaList = json_encode($paraRowList);
    mysql_free_result($paraSqlResult);
   //
    mysql_close($connect);
?>


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
        <div class="table-container">
            <div class="devTblHdr">Nework Performance Parameters Statistics</div>
            <div>
                <form name="nodeNet" id="nodeNet" method="post" action="">
                    <table>
                        <tr>
                            <td style="width: 205px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">NodeID:<?PHP echo("$NodeID");?></td>
                            <td style="width: 180px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">
                                <select name="SelNodeID" id="SelNodeID" style="width: 180px;">
                                </select>
                            </td>
                            <td style="width: 150px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">PortID:<?PHP echo("$PortID");?></td>
                            <td style="width: 180px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">
                                <select name="SelPortID" id="SelPortID" style="width: 180px;">
                                </select>
                            </td>
                            <td style="width: 120px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">Status</td>
                            <td style="width: 147px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">
                                <output></output>
                            </td>
                        </tr>
                    </table>
                </form>
                <form name="Network" id="Network" method="GET" action="<?php echo $_SERVER['$PHP_SELF']; ?>" style="margin-top: 1px;">
                    <table>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center;">Name</td>
                            <td style="width: 180px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center;">Value</td>
                            <td style="width: 600px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center;">comments</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">MTU</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="mtu" id="mtu" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">MTU:Maxmum Transmission Unit</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">Rate</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="rate" id="rate" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">Rate,bits number per second</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">BandWidth</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="BandWidth" id="BandWidth" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">BandWidth, maximum transmission rate</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">Throughput</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="throughput" id="throughput" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">The amount of material or items passing through a system or process.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">Delay</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="delay" id="delay" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;"></td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">RTT</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="rtt" id="rtt" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">Rapid Transformational Therapy</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">Ratio</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="ratio" id="ratio" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;"></td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">TxPktNo</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="TxPktNo" id="TxPktNo" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">The number of Tx packets</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">TxByteNo</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="TxByteNo" id="TxByteNo" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">The number of Tx bytes</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">TxPktErrNo</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="TxPktErrNo" id="TxPktErrNo" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">The number of Tx error packets</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">TxByteErrNo</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="TxByteErrNo" id="TxByteErrNo" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">The number of Tx error bytes</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">RxPktNo</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="RxPktNo" id="RxPktNo" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">he number of Rx packets</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">RxByteNo</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="RxByteNo" id="RxByteNo" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">The number of Rx bytes</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">RxPktErrNo</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="RxPktErrNo" id="RxPktErrNo" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">The number of Rx error Packets</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">RxByteErrNo</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="RxByteErrNo" id="RxByteErrNo" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">The number of Rx error bytes</td>
                        </tr>
                    </table>
                </form>
            </div>
            <div style="margin-bottom: 20px;"> </div>
        </div>
    </body>
</html>

<script type="text/javascript">
var nodeList = eval(<?PHP echo("$jsonNodeList");?>);
var portList = eval(<?PHP echo("$jsonPrtList"); ?>);
var ParaList = eval(<?PHP echo("$jsonParaList");?>);

$(document).ready(function(){
    var ret = false;
    ret = genNodeList();
    
    if(true == ret)
    {
        genPortIDList();
        showNetworkPortPara();
    }
});


function genNodeList()
{
    var nodeID = 0;
    var Loopi  = 0;
    
    var arrNodeID = new Array();
    var arrNum    = 0;
    var arrTmp    = [];

    $("#SelNodeID").append("<option value=''>Select NodeID</option>");
    
    if(nodeList.length == 0)
    {
        return false;
    }
    //
    for(Loopi = 0; Loopi < nodeList.length; Loopi++)
    {
        arrNodeID.push(nodeList[Loopi].nodeID);
    }

    arrTmp = delRedundEle_f(arrNodeID);
    for(Loopi = 0; Loopi < arrTmp.length; Loopi++)
    {
        nodeID = arrTmp[Loopi];
        $("#SelNodeID").append("<option value='"+Loopi+"'>"+nodeID+"</option>");
    }

    return true;
}

function postNodeID()
{
    var selObj  = document.getElementById("SelNodeID");
    
    var index  = selObj.selectedIndex;
    var nodeID = selObj.options[index].value;
    //alert(nodeID);
//    var nodeID = document.getElementById("SelNodeID").value;

    window.location.href = "perf_networkParaStat.php.php?nodeID="+nodeID;
}

function genPortIDList()
{
    var portID = 0;
    var ulLoop  = 0;

    $("#SelPortID").append("<option value='255'>Select PortID</option>");
    if(0 == portList.length)
    {
        return false;
    }

    for(ulLoop = 0; ulLoop < portList.length; ulLoop++)
    {
        portID = portList[ulLoop].portID;
        $("#SelPortID").append("<option value='"+ulLoop+"'>"+portID+"</option>");
    }

    return true;
}

function showNetworkPortPara()
{
    if(1 != ParaList.length)
    {
        return false;
    }
    else
    {
        document.getElementById("mtu").value          = ParaList[0].mtu;
        document.getElementById("rate").value         = ParaList[0].rate;
        document.getElementById("BandWidth").value    = ParaList[0].BandWidth;
        document.getElementById("throughput").value   = ParaList[0].throughput;
        document.getElementById("delay").value        = ParaList[0].delay;
        document.getElementById("rtt").value          = ParaList[0].rtt;
        document.getElementById("ratio").value        = ParaList[0].ratio;
        document.getElementById("TxPktNo").value      = ParaList[0].TxPktNo;
        document.getElementById("TxByteNo").value     = ParaList[0].TxByteNo;
        document.getElementById("TxPktErrNo").value   = ParaList[0].TxPktErrNo;
        document.getElementById("TxByteErrNo").value  = ParaList[0].TxByteErrNo;
        document.getElementById("RxPktNo").value      = ParaList[0].RxPktNo;
        document.getElementById("RxByteNo").value     = ParaList[0].RxByteNo;
        document.getElementById("RxPktErrNo").value   = ParaList[0].RxPktErrNo;
        document.getElementById("RxByteErrNo").value  = ParaList[0].RxByteErrNo;
    }

    return true;
}

</script>
