<?PHP
/*********************************************
 * FileName---: devRadioParaConf.php
 * Function---: 
 * Version----: V 0.0.1
 * Time-------: 20/11/2021
 * Author-----: Duohua(Edward) Wang
 * Email------: dhwangchina@gmail.com
 * Copyright--: All rights reserverd By Duohua(Edward) Wang
 **********************************************
 */
    include_once("include/dbLink.php");
    
    //Node List
    $sql     = "SELECT * FROM devRadioParaTbl ORDER BY devID";
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

<!doctype HTML>
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
            <div class="devTblHdr">Device Radio Parameters</div>
            <div>
                <form name="nodeInfo" id="nodeInfo" method="post" action="./devRadioParaConf.php">
                    <table>
                        <tr>
                            <td style="width: 205px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">NodeID:
                                <output name="selectedDevID" id="selectedDevID" style="color: white;"></output>
                            </td>
                            <td style="width: 180px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">
                                <select name="SelNodeID" id="SelNodeID" onchange="selDevID(this.options[this.selectedIndex].text)" style="width:180px;">
                                </select>
                            </td>
                            <td style="width: 150px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">RadioID:
                                <output name="SelectedRadioID" id="SelectedRadioID" style="color: white;"></output>
                            </td>
                            <td style="width: 180px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">
                                <select name="SelRadioID" id="SelRadioID" onchange="selRadioID(this.options[this.selectedIndex].text)" style="width:180px;">
                                </select>
                            </td>
                            <td style="width: 120px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">Status</td>
                            <td style="width: 147px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">
                                <!--input type="submit" name="check" id="check" style="width: 150px;"/-->
                                <output name="statusStr" id="statusStr" style="color: white;"></output>
                            </td>
                        </tr>
                    </table>
                <!--/form>
                <form name='radioParaConf' id='radioParaConf' method='post' action=''-->
                    <table style="margin-top: 2px;">
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>RadioID</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <output name="radioID" id="radioID" style="color: white;"></output>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Radio Identifier</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>Cell Type </td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <output name="cellType" id="cellType" style="color: white;"></output>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>CELL_MACRO_ENB,CELL_HOME_ENB</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>eNB Name</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <output name="eNBName" id="eNBName" style="color: white;"></output>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>eNodeB Name</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>Frame Type</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <output name="frameType" id="frameType" style="color: white;"></output>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Radio Frame Type</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>Tdd Config</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <output name="tddConfig" id="tddConfig" style="color: white;"></output>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Tdd Config</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>Prefix Type</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <output name="prefixType" id="prefixType" style="color: white;"></output>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Prefix Type</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>eUTRA Band</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <output name="eutraBand" id="eutraBand" style="color: white;"></output>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>eUTRA Band</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>TxFreq</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <output name="txFreq" id="txFreq" style="color: white;"></output>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Tx Frequency Value(Hz)</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>RxFreq</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <output name="rxFreq" id="rxFreq" style="color: white;"></output>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Rx Frequency Value(Hz)</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>TxPwr</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <output name="txPwr" id="txPwr" style="color: white;"></output>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Tx Power Value(dB)</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>RxFreqOffset</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <output name="rxFreqOffset" id="rxFreqOffset" style="color: white;"></output>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Rx Frequency Offset Value(Hz)</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>CellID</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <output name="cellID" id="cellID" style="color: white;"></output>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Cell Identifier</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>NumRbDl</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <output name="numRbDl" id="numRbDl" style="color: white;"></output>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Downlink RB Number</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>MbsfnCellID</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <output name="mbSfbCellID" id="mbSfbCellID" style="color: white;"></output>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>MBMS SFN Cell Identifier</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>AntePorts</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <output name="antePorts" id="antePorts" style="color: white;"></output>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Antenna Port Number</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>AnteTx</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <output name="txAnteNum" id="txAnteNum" style="color: white;"></output>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Tx Antenna Number</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>AnteRx</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <output name="rxAnteNum" id="rxAnteNum" style="color: white;"></output>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Rx Antenna Number</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>TxGain</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <output name="txGain" id="txGain" style="color: white;"></output>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Tx Gain Value</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>RxGain</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <output name="rxGain" id="rxGain" style="color: white;"></output>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Rx Gain Value</td>
                        </tr>
                    </table>
               </form>
            </div>
            <div class="linkBtn">
                <!--a href="./devNetParaAdd.php" class="linkbutton" style="right: 45px; margin-right: 20px;">Add</a-->
                <a href="./devRadioParaAdd.php"><input type="button" class="linkLeftBtn" name="addBtn" id="addBtn" value="Add"/></a>
                <a href='javascript:turn2Modify()'><input type="button" class="linkLeftBtn" name="modBtn" id="modBtn" value="Mod"/></a>
                <input type="button" class="linkLeftBtn" name="delBtn" id="delBtn" value="Del" onclick="turn2del()"/>
                <!--a href="./devRadioParaMod.php"><input type="button" class="linkLeftBtn" name="modBtn" id="modBtn" value="Mod"/></a-->
                <!--a href="./devRadioParaDel.php"><input type="button" class="linkLeftBtn" name="delBtn" id="delBtn" value="Del"/></a-->
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
var gNodeList = eval(<?PHP echo("$jsonDevInfoList");?>);
var gNodeID   = 0;
var gRadioID  = 0;

$(document).ready(function(){
    var retCode = false;
    
    retCode = genNodeList();
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
    
    if(0 == gNodeList.length)
    {
        return false;
    }

    for(Loopi = 0; Loopi < gNodeList.length; Loopi++)
    {
        arrNodeID.push(gNodeList[Loopi].devID);
    }

    arrTmp = delRedundEle_f(arrNodeID);
    for(Loopi = 0; Loopi < arrTmp.length; Loopi++)
    {
        nodeID = arrTmp[Loopi];
        index  = Loopi+1;
        $("#SelNodeID").append("<option value='" + index + "'>" + nodeID + "</option>");
    }

    return true;
}

function selDevID(vDevID)
{
    document.getElementById('selectedDevID').value = vDevID;
    gNodeID = vDevID;
    genRadioList(vDevID);
}

function genRadioList(vNodeID)
{
    var Loopi      = 0;
    var radioID    = 0;
    var arrRadioID = new Array();
    var arrNum     = 0;
    var arrTmp     = [];
    var index      = 0;

    $("#SelRadioID").empty();
    $("#SelRadioID").append("<option value='0'>Select RadioID</option>");

    if(0 == gNodeList.length)
    {
        return false;
    }

    for(Loopi = 0; Loopi < gNodeList.length; Loopi++)
    {
        if(vNodeID != gNodeList[Loopi].devID)
        {
            continue;
        }
        else
        {
            arrRadioID.push(gNodeList[Loopi].radioID);
        }
    }

    arrTmp = delRedundEle_f(arrRadioID);
    for(Loopi = 0; Loopi < arrTmp.length; Loopi++)
    {
        radioID = arrTmp[Loopi];
        index   = Loopi + 1;
        $("#SelRadioID").append("<option value='" + index + "'>" + radioID + "</option>");
    }    
}

function selRadioID(vRadioID)
{
    document.getElementById('SelectedRadioID').value = vRadioID;
    gRadioID = vRadioID;
    showRadioPara(gNodeID,gRadioID);
}

function showRadioPara(nodeID,radioID)
{
    var iLoop = 0;
    
    document.getElementById('radioID').value      = 'Undefined';
    document.getElementById('cellType').value     = 'Undefined';
    document.getElementById('eNBName').value      = 'Undefined';
    document.getElementById('frameType').value    = 'Undefined';
    document.getElementById('tddConfig').value    = 'Undefined';
    document.getElementById('prefixType').value   = 'Undefined';
    document.getElementById('eutraBand').value    = 'Undefined';
    document.getElementById('txFreq').value       = 'Undefined';
    document.getElementById('rxFreq').value       = 'Undefined';
    document.getElementById('txPwr').value        = 'Undefined';
    document.getElementById('rxFreqOffset').value = 'Undefined';
    document.getElementById('cellID').value       = 'Undefined';
    document.getElementById('numRbDl').value      = 'Undefined';
    document.getElementById('mbSfbCellID').value  = 'Undefined';
    document.getElementById('antePorts').value    = 'Undefined';
    document.getElementById('txAnteNum').value    = 'Undefined';
    document.getElementById('rxAnteNum').value    = 'Undefined';
    document.getElementById('txGain').value       = 'Undefined';
    document.getElementById('rxGain').value       = 'Undefined';
    
    for(iLoop = 0; iLoop < gNodeList.length; iLoop++)
    {
        if(gNodeList[iLoop].devID == nodeID && gNodeList[iLoop].radioID == radioID)
        {
            document.getElementById('radioID').value      = gNodeList[iLoop].radioID;
            document.getElementById('cellType').value     = (gNodeList[iLoop].cellType == 0)? "CELL_MACRO_ENB":"CELL_HOME_ENB";
            document.getElementById('eNBName').value      = gNodeList[iLoop].eNBName;
            document.getElementById('frameType').value    = (gNodeList[iLoop].frameType == 0)? "TDD":"FDD";
            document.getElementById('tddConfig').value    = gNodeList[iLoop].tddConfig;
            document.getElementById('prefixType').value   = (gNodeList[iLoop].prefixType == 0)? "NORMAL":"EXTEND";
            document.getElementById('eutraBand').value    = gNodeList[iLoop].eutraBand;
            document.getElementById('txFreq').value       = gNodeList[iLoop].TxFreq;
            document.getElementById('rxFreq').value       = gNodeList[iLoop].RxFreq;
            document.getElementById('txPwr').value        = gNodeList[iLoop].TxPwr;
            document.getElementById('rxFreqOffset').value = gNodeList[iLoop].RxFreqOffset;
            document.getElementById('cellID').value       = gNodeList[iLoop].CellID;
            document.getElementById('numRbDl').value      = gNodeList[iLoop].NumRbDl;
            document.getElementById('mbSfbCellID').value  = gNodeList[iLoop].MbsfnCellID;
            document.getElementById('antePorts').value    = gNodeList[iLoop].AntePorts;
            document.getElementById('txAnteNum').value    = gNodeList[iLoop].AnteTx;
            document.getElementById('rxAnteNum').value    = gNodeList[iLoop].AnteRx;
            document.getElementById('txGain').value       = gNodeList[iLoop].TxGain;
            document.getElementById('rxGain').value       = gNodeList[iLoop].RxGain;
            break;
        }
    }
}

function turn2Modify()
{   
    var nodeOptions  = $("#SelNodeID option:selected");
    var radioOptions = $("#SelRadioID option:selected");
//    alert(options.val());
//    alert(options.text());
//    alert(options.attr(''));


    if(0 == nodeOptions.val())
    {
        alert("Please specify a Node.\n");
    }
    else if(0 == radioOptions.val())
    {
        alert("Please specify a Radio.\n");
    }
    else
    {
        window.location.href = "./devRadioParaMod.php?NodeID=" + gNodeID + "&RadioID=" + gRadioID;
    }
    
}

function turn2del()
{
    var nodeOptions  = $("#SelNodeID option:selected");
    var radioOptions = $("#SelRadioID option:selected");
    
    if(0 == nodeOptions.val())
    {
        alert("Please specify a Node.\n");
    }
    else if(0 == radioOptions.val())
    {
        alert("Please specify a Radio.\n");
    }
    else
    {
        window.location.href = "./devRadioParaDel.php?NodeID=" + gNodeID + "&RadioID=" + gRadioID;
    }
}


</script>

