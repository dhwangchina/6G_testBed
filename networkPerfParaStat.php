<?PHP
/*********************************************
 * FileName---: networkPerfParaStat.php
 * Function---: 
 * Version----: V 0.0.1
 * Time-------: 20/11/2021
 * Author-----: Duohua(Edward) Wang
 * Email------: dhwangchina@gmail.com
 * Copyright--: All rights reserverd By Duohua(Edward) Wang
 **********************************************
 */
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
        <div class="table-container">
            <div class="devTblHdr">Nework Performance Parameters Statistics</div>
            <div>
                <form name="nodeNet" id="nodeNet" method="post" action="">
                    <table>
                        <tr>
                            <td style="width: 205px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">NodeID:
                                <output style="color: white;" name="selectedNodeID" id="selectedNodeID"></output>
                            </td>
                            <td style="width: 180px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">
                                <select style="width: 180px;" name="SelNodeID" id="SelNodeID" onchange="selNodeID(this.options[this.selectedIndex].text)">
                                </select>
                            </td>
                            <td style="width: 150px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">PortID:
                                <output style="color: white;" name="selectedPortID" id="selectedPortID"></output>
                            </td>
                            <td style="width: 180px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">
                                <select  style="width: 180px;" name="SelPortID" id="SelPortID" onchange="selPortID(this.options[this.selectedIndex].text)">
                                </select>
                            </td>
                            <td style="width: 120px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">Status</td>
                            <td style="width: 152px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">
                                <output></output>
                            </td>
                        </tr>
                    </table>
                <!--/form>
                <form name="Network" id="Network" method="GET" action="<?php echo $_SERVER['$PHP_SELF']; ?>" style="margin-top: 1px;"-->
                    <table style="margin-top: 2px;">
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center;">Name</td>
                            <td style="width: 180px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center;">Value</td>
                            <td style="width: 600px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center;">comments</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">MTU</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="mtu" id="mtu" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">MTU:Maxmum Transmission Unit</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">Rate</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="rate" id="rate" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">Rate,bits number per second</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">BandWidth</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="BandWidth" id="BandWidth" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">BandWidth, maximum transmission rate</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">Throughput</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="throughput" id="throughput" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">The amount of material or items passing through a system or process.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">Delay</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="delay" id="delay" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;"></td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">RTT</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="rtt" id="rtt" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">Rapid Transformational Therapy</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">Ratio</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="ratio" id="ratio" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;"></td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">TxPktNo</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="TxPktNo" id="TxPktNo" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">The number of Tx packets</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">TxByteNo</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="TxByteNo" id="TxByteNo" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">The number of Tx bytes</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">TxPktErrNo</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="TxPktErrNo" id="TxPktErrNo" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">The number of Tx error packets</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">TxByteErrNo</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="TxByteErrNo" id="TxByteErrNo" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">The number of Tx error bytes</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">RxPktNo</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="RxPktNo" id="RxPktNo" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">he number of Rx packets</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">RxByteNo</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="RxByteNo" id="RxByteNo" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">The number of Rx bytes</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">RxPktErrNo</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="RxPktErrNo" id="RxPktErrNo" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">The number of Rx error Packets</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">RxByteErrNo</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="RxByteErrNo" id="RxByteErrNo" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">The number of Rx error bytes</td>
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
var gNodeID  = 0;

$(document).ready(function(){
    var ret = false;
    ret = genNodeList();
});


function genNodeList()
{
    var nodeID = 0;
    var Loopi  = 0;
    var index  = 0;
    var arrNodeID = new Array();
    var arrNum    = 0;
    var arrTmp    = [];

    $("#SelNodeID").append("<option value='0'>Select NodeID</option>");
    
    if(nodeList.length == 0)
    {
        return false;
    }

    for(Loopi = 0; Loopi < nodeList.length; Loopi++)
    {
        arrNodeID.push(nodeList[Loopi].nodeID);
    }

    arrTmp = delRedundEle_f(arrNodeID);
    for(Loopi = 0; Loopi < arrTmp.length; Loopi++)
    {
        nodeID = arrTmp[Loopi];
        index = Loopi + 1;
        $("#SelNodeID").append("<option value='" + index + "'>" + nodeID + "</option>");
    }

    return true;
}

function selNodeID(vNodeID)
{
    document.getElementById('selectedNodeID').value = vNodeID;
    gNodeID = vNodeID;
    genPortIDList(vNodeID);
}

function genPortIDList(vNodeID)
{
    var portID = 0;
    var Loopi  = 0;
    var index  = 0;

    $("#SelPortID").empty();
    $("#SelPortID").append("<option value='0'>Select PortID</option>");

    for(Loopi = 0; Loopi < nodeList.length; Loopi++)
    {
        if(nodeList[Loopi].nodeID != vNodeID)
        {
            continue;
        }
        else
        {
            portID = nodeList[Loopi].portID;
            index = Loopi + 1;
            $("#SelPortID").append("<option value='" + index + "'>" + portID + "</option>");
        }
    }

    return true;
}

function selPortID(vPortID)
{
    document.getElementById('selectedPortID').value = vPortID;
    showNetworkPortPara(gNodeID,vPortID);
}

function showNetworkPortPara(vNodeID,vPortID)
{
    var iLoop = 0;
    
    document.getElementById("mtu").value          = "Undefined";
    document.getElementById("rate").value         = "Undefined";
    document.getElementById("BandWidth").value    = "Undefined";
    document.getElementById("throughput").value   = "Undefined";
    document.getElementById("delay").value        = "Undefined";
    document.getElementById("rtt").value          = "Undefined";
    document.getElementById("ratio").value        = "Undefined";
    document.getElementById("TxPktNo").value      = "Undefined";
    document.getElementById("TxByteNo").value     = "Undefined";
    document.getElementById("TxPktErrNo").value   = "Undefined";
    document.getElementById("TxByteErrNo").value  = "Undefined";
    document.getElementById("RxPktNo").value      = "Undefined";
    document.getElementById("RxByteNo").value     = "Undefined";
    document.getElementById("RxPktErrNo").value   = "Undefined";
    document.getElementById("RxByteErrNo").value  = "Undefined";
    
    for(iLoop = 0; iLoop < nodeList.length; iLoop++)
    {
        if(nodeList[iLoop].nodeID == vNodeID && nodeList[iLoop].portID == vPortID)
        {
            document.getElementById("mtu").value          = nodeList[iLoop].mtu;
            document.getElementById("rate").value         = nodeList[iLoop].rate;
            document.getElementById("BandWidth").value    = nodeList[iLoop].BandWidth;
            document.getElementById("throughput").value   = nodeList[iLoop].throughput;
            document.getElementById("delay").value        = nodeList[iLoop].delay;
            document.getElementById("rtt").value          = nodeList[iLoop].rtt;
            document.getElementById("ratio").value        = nodeList[iLoop].ratio;
            document.getElementById("TxPktNo").value      = nodeList[iLoop].TxPktNo;
            document.getElementById("TxByteNo").value     = nodeList[iLoop].TxByteNo;
            document.getElementById("TxPktErrNo").value   = nodeList[iLoop].TxPktErrNo;
            document.getElementById("TxByteErrNo").value  = nodeList[iLoop].TxByteErrNo;
            document.getElementById("RxPktNo").value      = nodeList[iLoop].RxPktNo;
            document.getElementById("RxByteNo").value     = nodeList[iLoop].RxByteNo;
            document.getElementById("RxPktErrNo").value   = nodeList[iLoop].RxPktErrNo;
            document.getElementById("RxByteErrNo").value  = nodeList[iLoop].RxByteErrNo;
        }
    }
}

</script>
