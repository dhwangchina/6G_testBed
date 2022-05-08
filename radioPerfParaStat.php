<?PHP
/*********************************************
 * FileName---: radioPerfParaStat.php
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
    $NodeSql       = "SELECT * FROM nodeRadioPerfParaTbl ORDER BY nodeID";
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
            <div class="devTblHdr">Radio Performance Parameters Statistics</div>
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
                            <td style="width: 150px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">RadioID:
                                <output style="color: white;" name="selectedRadioID" id="selectedRadioID"></output>
                            </td>
                            <td style="width: 180px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">
                                <select style="width: 180px;" name="SelRadioID" id="SelRadioID" onchange="selRadioID(this.options[this.selectedIndex].text)">
                                </select>
                            </td>
                            <td style="width: 120px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">Status</td>
                            <td style="width: 152px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">
                                <output name="statusStr" id="statusStr" style="color: white;"></output>
                            </td>
                        </tr>
                    </table>
                <!--/form>
                <form name="nodeRadio" id="nodeRadio" method="GET" action="<?php echo $_SERVER['$PHP_SELF']; ?>" style="margin-top: 1px;"-->
                    <table style="margin-top: 2px;">
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center;">Name</td>
                            <td style="width: 180px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center;">Value</td>
                            <td style="width: 600px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center;">comments</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">TxPower</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="TxPwr" id="TxPwr" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">TxPower, refers to the energy of radio waves in a given frequency range. The unit is dBm. Rf transmission with low power and short distance.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">RxPower</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="RxPwr" id="RxPwr" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">Received power refers to the signal intensity (in dBm) that a receiver can receive and still work normally.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">SNR</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="SNR" id="SNR" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">SNR, generally used at the receiving end, refers to the signal-to-noise ratio threshold that a demodulator can demodulate without exceeding a certain bit error rate,The unit is dB.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">RSSI</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="RSSI" id="RSSI" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">RSSI:Received Signal Strength Indication an optional part of the wireless transmission layer used to determine link quality and whether to increase broadcast transmission Strength.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">Throughput</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="thrghput" id="thrghput" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">Throughput refers to the amount of data successfully transferred per unit of time to a network, device, port, virtual circuit, or other facility.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">BLER</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="bler" id="bler" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">BLER(Block Error Rate) is the percentage of faulty blocks in all blocks sent.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">ACLR/ACPR</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="aclr" id="aclr" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">ACLR is defined as the ratio of filtered average power centered on the frequency of a specified channel to filtered average power centered on the frequency of adjacent channels.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">SEM</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="sem" id="sem" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">SEM, Spectrum Emission Mask, is to provide a "spectrum template", and then measure the spectrum leakage in the transmitter band to see if there is a point beyond the template limit.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">EVM</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="evm" id="evm" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">EVM, Error Vector Magnitude, which is defined as the ratio of the RMS of the average power of the Error Vector signal to the RMS of the average power of the ideal signal, expressed in the form of %.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">PAR</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="par" id="par" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">PAR(Peak-to-Average Ratio), PAPR(Peak-to-Average Power Ratio), is a measure of a waveform equal to the ratio of the waveform's amplitude squared divided by its effective value (RMS) squared.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">Blocking</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="blocking" id="blocking" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">Blocking is divided into in-band and out-of-band, mainly because RF front-end generally has a band filter, which can inhibit the Blocking out of band. However, regardless of in-band or out-of-band, Blocking signals are generally dot-frequency without modulation.Blocking means that a large signal interferes with a small signal.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">AM Suppression</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="amSuppr" id="amSuppr" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">AM Suppression is a unique indicator of the GSM system. In terms of description, interference signals are TDMA signals similar to GSM signals, which are synchronized with useful signals and have fixed delay.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">Adjacent Channel Suppression</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="adjChSuppr" id="adjChSuppr" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">Adjacent (Alternative) Channel Suppression (Selectivity) is called Adjacent Channel Selectivity. In cellular systems, our network in addition to considering the same frequency, but also its adjacent frequency area, because of the frequency spectrum of the transmitter signal into adjacent frequency of regeneration will be very strong, and the spectrum regeneration is actually have correlation with emission signal, namely with the receiver system is likely to confuse this part of the regeneration spectrum with is useful for signal demodulation.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">Co-Channel Suppression</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="coChSuppr" id="coChSuppr" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">Co-channel Suppression (Selectivity) is absolute cofrequency Suppression, which generally refers to the interference mode between two cofrequency cells.</td>
                        </tr>
                        <tr>                            
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;">Rx Sensitivity</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="RxSensiv" id="RxSensiv" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">Rx sensitivity is the lowest electromagnetic wave energy that can be recognized by the receiver, in dBm.</td>
                        </tr>
                        <!--tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right: 5px;"> </td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">
                                <output name="" id="" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;"></td>
                       </tr-->
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
var gRadioPerfXmlHttp = null;
var gRadioJsonObj = null;

$(document).ready(function(){
    genNodeList();
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
        index  = Loopi+ 1;
        $("#SelNodeID").append("<option value='" + index + "'>" + nodeID + "</option>");
    }
}

function selNodeID(vNodeID)
{
    document.getElementById('selectedNodeID').value = vNodeID;
    gNodeID = vNodeID;
    genRadioList(vNodeID);
}

function genRadioList(vNodeID)
{
    var radioID = 0;
    var ulLoop  = 0;
    var index   = 0;

    $("#SelRadioID").empty();
    $("#SelRadioID").append("<option value='0'>Select RadioID</option>");

    for(ulLoop = 0; ulLoop < nodeList.length; ulLoop++)
    {
        if(nodeList[ulLoop].nodeID == vNodeID)
        {
            radioID = nodeList[ulLoop].radioID;
            index   = ulLoop + 1;
            $("#SelRadioID").append("<option value='" + index + "'>" + radioID + "</option>");
        }
    }
}

function selRadioID(vRadioID)
{
    document.getElementById('selectedRadioID').value = vRadioID;
    setInterval(function(){
                            radioPerf_AjaxQuery(gNodeID,vRadioID);
                    
                            showRadioPara(gNodeID,vRadioID);
                          }, 
                          1* 1000);
}

function RadioGetXmlHttpObj()
{
    var xmlHttp = null;
    
    try
    {
        // Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    }
    
    catch (e)
    {
        //Internet Explorer
        try
        {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
    
        catch (e)
        {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    
    return xmlHttp;
}

function radioPerf_AjaxQuery(vNodeID,vRadioID)
{
    var nodeID  = parseInt(vNodeID);
    var radioID = parseInt(vRadioID);
    
    gRadioPerfXmlHttp = RadioGetXmlHttpObj();
    if(null == gRadioPerfXmlHttp)
    {
        alert ("Browser does not support HTTP Request");
        return;
    }

    var url = "./AjaxRsp/radioPerfQuery.php";
    url = url + "?NodeID=" + nodeID + "&RadioID=" + radioID;

    gRadioPerfXmlHttp.onreadystatechange = xmlStateChanged;
    gRadioPerfXmlHttp.open("GET",url,false);
    gRadioPerfXmlHttp.send(null);
}

function xmlStateChanged()
{
    /*
    * https://www.programminghunter.com/article/30761670894/
    * 每当 XMLHTTP 对象的状态发生改变，则执行该函数。
    * 在xmlhttp.readyState==4 && xmlhttp.status==200时，用响应文本填充需要查询的内容。
    * xmlhttp.readyState有5种状态：
    * 1. 0->请求未初始化（还没有调用 open()）。
    * 2. 1->请求已经建立，但是还没有发送（还没有调用 send()）。
    * 3. 2->请求已发送，正在处理中（通常现在可以从响应中获取内容头）。
    * 4. 3->请求在处理中；通常响应中已有部分数据可用了，但是服务器还没有完成响应的生成。
    * 5. 4->响应已完成；您可以获取并使用服务器的响应了。
    * 参考：http://www.cnblogs.com/fsjohnhuang/articles/2345653.html
    
    * xmlhttp.status的状态码：
    * 1. 100-199->用于指定客户端应相应的某些动作。 
    * 2. 200-299->用于表示请求成功。 
    * 3. 300-399->用于已经移动的文件并且常被包含在定位头信息中指定新的地址信息。 
    * 4. 400-499->用于指出客户端的错误。 
    * 5. 500-599->用于支持服务器错误。
    * 参考：http://www.cnblogs.com/lxinxuan/archive/2009/10/22/1588053.html
    */

    if (200 == gRadioPerfXmlHttp.status && 4 == gRadioPerfXmlHttp.readyState)
    {
        gRadioJsonObj = null;
        gRadioJsonObj = eval(<?PHP echo("gRadioPerfXmlHttp.responseText");?>);
    }
}

function showRadioPara(vNodeID,vRadioID)
{
    var iLoop = 0;

    document.getElementById("TxPwr").value      = "Undefined";
    document.getElementById("RxPwr").value      = "Undefined";
    document.getElementById("SNR").value        = "Undefined";
    document.getElementById("RSSI").value       = "Undefined";
    document.getElementById("thrghput").value   = "Undefined";
    document.getElementById("bler").value       = "Undefined";
    document.getElementById("aclr").value       = "Undefined";
    document.getElementById("sem").value        = "Undefined";
    document.getElementById("evm").value        = "Undefined";
    document.getElementById("par").value        = "Undefined";
    document.getElementById("blocking").value   = "Undefined";
    document.getElementById("amSuppr").value    = "Undefined";
    document.getElementById("adjChSuppr").value = "Undefined";
    document.getElementById("coChSuppr").value  = "Undefined";
    document.getElementById("RxSensiv").value   = "Undefined";

    if(null == gRadioJsonObj || 1 != gRadioJsonObj.length)
    {
        //alert("Error. No data can be got.\n");
        return;
    }
    else if(gRadioJsonObj[iLoop].nodeID == vNodeID && gRadioJsonObj[iLoop].radioID == vRadioID)
    {
        document.getElementById("TxPwr").value      = gRadioJsonObj[iLoop].TxPwr;
        document.getElementById("RxPwr").value      = gRadioJsonObj[iLoop].RxPwr;
        document.getElementById("SNR").value        = gRadioJsonObj[iLoop].SNR;
        document.getElementById("RSSI").value       = gRadioJsonObj[iLoop].RSSI;
        document.getElementById("thrghput").value   = gRadioJsonObj[iLoop].thrghput;
        document.getElementById("bler").value       = gRadioJsonObj[iLoop].bler;
        document.getElementById("aclr").value       = gRadioJsonObj[iLoop].aclr;
        document.getElementById("sem").value        = gRadioJsonObj[iLoop].sem;
        document.getElementById("evm").value        = gRadioJsonObj[iLoop].evm;
        document.getElementById("par").value        = gRadioJsonObj[iLoop].par;
        document.getElementById("blocking").value   = gRadioJsonObj[iLoop].blocking;
        document.getElementById("amSuppr").value    = gRadioJsonObj[iLoop].amSuppr;
        document.getElementById("adjChSuppr").value = gRadioJsonObj[iLoop].adjChSuppr;
        document.getElementById("coChSuppr").value  = gRadioJsonObj[iLoop].coChSuppr;
        document.getElementById("RxSensiv").value   = gRadioJsonObj[iLoop].RxSensiv;
    }
}

</script>
