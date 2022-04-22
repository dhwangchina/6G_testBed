<!doctype HTML>

<?PHP
    include_once("include/dbLink.php");
    
    //Get Node List
    $NodeSql       = "SELECT * FROM nodeRadioPerfParaTbl";
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
    
    //Get RadioIDList
    $NodeID         = trim($_POST['SelNodeID']);
    $NodeID   = 1;
    $RadioSql       = "SELECT * FROM nodeRadioPerfParaTbl WHERE nodeID = $NodeID";
    $RadioSqlResult = mysql_query($RadioSql);
    $RadioRowList   = array();
    $RadioRowCnt    = 0;
    while($RadioRow = mysql_fetch_array($RadioSqlResult))
    {
        $RadioRowList[] = $RadioRow;
        $RadioRowCnt++;
    }

    $jsonRadioList = json_encode($RadioRowList);
    mysql_free_result($RadioSqlResult);
    //Get Radio Parameters
    if((0 != $RadioRowCnt)&&(0 != $NodeRowCnt))
    {
        $NodeID  = 1;
        $RadioID = 0;
        
        $rParaSql       = "SELECT * FROM nodeRadioPerfParaTbl WHERE nodeID = $NodeID AND radioID = $RadioID";
        $rParaSqlResult = mysql_query($rParaSql);
        $rParaList      = array();
        $rParaRowCnt    = 0;
        while($rParaRow = mysql_fetch_array($rParaSqlResult))
        {
            $rParaList[] = $rParaRow;
            $rParaRowCnt++;
        }
    
        $jsonrParaList = json_encode($rParaList);
        mysql_free_result($rParaSqlResult);
    }
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
            <div class="devTblHdr">Radio Performance Parameters Statistics</div>
            <div>
                <form name="nodeNet" id="nodeNet" method="post" action="">
                    <table>
                        <tr>
                            <td style="width: 205px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">NodeID:<?PHP echo("$NodeID");?></td>
                            <td style="width: 180px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">
                                <select name="SelNodeID" id="SelNodeID" style="width: 180px;">
                                </select>
                            </td>
                            <td style="width: 150px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">RadioID:<?PHP echo("$RadioID");?></td>
                            <td style="width: 180px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">
                                <select name="SelRadioID" id="SelRadioID" style="width: 180px;">
                                </select>
                            </td>
                            <td style="width: 120px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">Status</td>
                            <td style="width: 147px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">
                                <output></output>
                            </td>
                        </tr>
                    </table>
                </form>
                <form name="nodeRadio" id="nodeRadio" method="GET" action="<?php echo $_SERVER['$PHP_SELF']; ?>" style="margin-top: 1px;">
                    <table>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center;">Name</td>
                            <td style="width: 180px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center;">Value</td>
                            <td style="width: 600px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center;">comments</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">TxPower</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="TxPwr" id="TxPwr" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">TxPower, refers to the energy of radio waves in a given frequency range. The unit is dBm. Rf transmission with low power and short distance.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">RxPower</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="RxPwr" id="RxPwr" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">Received power refers to the signal intensity (in dBm) that a receiver can receive and still work normally.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">SNR</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="SNR" id="SNR" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">SNR, generally used at the receiving end, refers to the signal-to-noise ratio threshold that a demodulator can demodulate without exceeding a certain bit error rate,The unit is dB.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">RSSI</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="RSSI" id="RSSI" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">RSSI:Received Signal Strength Indication an optional part of the wireless transmission layer used to determine link quality and whether to increase broadcast transmission Strength.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">Throughput</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="thrghput" id="thrghput" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">Throughput refers to the amount of data successfully transferred per unit of time to a network, device, port, virtual circuit, or other facility.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">BLER</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="bler" id="bler" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">BLER(Block Error Rate) is the percentage of faulty blocks in all blocks sent.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">ACLR/ACPR</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="aclr" id="aclr" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">ACLR is defined as the ratio of filtered average power centered on the frequency of a specified channel to filtered average power centered on the frequency of adjacent channels.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">SEM</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="sem" id="sem" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">SEM, Spectrum Emission Mask, is to provide a "spectrum template", and then measure the spectrum leakage in the transmitter band to see if there is a point beyond the template limit.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">EVM</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="evm" id="evm" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">EVM, Error Vector Magnitude, which is defined as the ratio of the RMS of the average power of the Error Vector signal to the RMS of the average power of the ideal signal, expressed in the form of %.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">PAR</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="par" id="par" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">PAR(Peak-to-Average Ratio), PAPR(Peak-to-Average Power Ratio), is a measure of a waveform equal to the ratio of the waveform's amplitude squared divided by its effective value (RMS) squared.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">Blocking</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="blocking" id="blocking" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">Blocking is divided into in-band and out-of-band, mainly because RF front-end generally has a band filter, which can inhibit the Blocking out of band. However, regardless of in-band or out-of-band, Blocking signals are generally dot-frequency without modulation.Blocking means that a large signal interferes with a small signal.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">AM Suppression</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="amSuppr" id="amSuppr" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">AM Suppression is a unique indicator of the GSM system. In terms of description, interference signals are TDMA signals similar to GSM signals, which are synchronized with useful signals and have fixed delay.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">Adjacent Channel Suppression</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="adjChSuppr" id="adjChSuppr" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">Adjacent (Alternative) Channel Suppression (Selectivity) is called Adjacent Channel Selectivity. In cellular systems, our network in addition to considering the same frequency, but also its adjacent frequency area, because of the frequency spectrum of the transmitter signal into adjacent frequency of regeneration will be very strong, and the spectrum regeneration is actually have correlation with emission signal, namely with the receiver system is likely to confuse this part of the regeneration spectrum with is useful for signal demodulation.</td>
                        </tr>
                        <tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">Co-Channel Suppression</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="coChSuppr" id="coChSuppr" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">Co-channel Suppression (Selectivity) is absolute cofrequency Suppression, which generally refers to the interference mode between two cofrequency cells.</td>
                        </tr>
                        <tr>                            
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;">Rx Sensitivity</td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
                                <output name="RxSensiv" id="RxSensiv" style="color: white;"></output>
                            </td>
                            <td style="width: 600px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left;">Rx sensitivity is the lowest electromagnetic wave energy that can be recognized by the receiver, in dBm.</td>
                        </tr>
                        <!--tr>
                            <td style="width: 200px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: left; padding-left: 5px;"> </td>
                            <td style="width: 100px; font-family: fantasy;font-size: 12px; font-weight: normal; color: white; text-align: center;">
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
var nodeList  = eval(<?PHP echo("$jsonNodeList");?>);
var radioList = eval(<?PHP echo("$jsonRadioList");?>);
var rParaList = eval(<?PHP echo("$jsonrParaList");?>);

$(document).ready(function(){
    var ret = false;
    ret = genNodeList();
    
    if(true == ret)
    {
        genRadioList();
        showRadioPara();
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

    window.location.href = "perf_radioParaStat.php?nodeID="+nodeID;
}

function genRadioList()
{
    var radioID = 0;
    var ulLoop  = 0;

    $("#SelRadioID").append("<option value='255'>Select RadioID</option>");
    if(0 == radioList.length)
    {
        return false;
    }

    for(ulLoop = 0; ulLoop < radioList.length; ulLoop++)
    {
        radioID = radioList[ulLoop].radioID;
        $("#SelRadioID").append("<option value='"+ulLoop+"'>"+radioID+"</option>");
    }

    return true;
}

function showRadioPara()
{
    if(1 != rParaList.length)
    {
        alert(rParaList.length);
        return false;
    }
    else
    {
        document.getElementById("TxPwr").value      = rParaList[0].TxPwr;
        document.getElementById("RxPwr").value      = rParaList[0].RxPwr;
        document.getElementById("SNR").value        = rParaList[0].SNR;
        document.getElementById("RSSI").value       = rParaList[0].RSSI;
        document.getElementById("thrghput").value   = rParaList[0].thrghput;
        document.getElementById("bler").value       = rParaList[0].bler;
        document.getElementById("aclr").value       = rParaList[0].aclr;
        document.getElementById("sem").value        = rParaList[0].sem;
        document.getElementById("evm").value        = rParaList[0].evm;
        document.getElementById("par").value        = rParaList[0].par;
        document.getElementById("blocking").value   = rParaList[0].blocking;
        document.getElementById("amSuppr").value    = rParaList[0].amSuppr;
        document.getElementById("adjChSuppr").value = rParaList[0].adjChSuppr;
        document.getElementById("coChSuppr").value  = rParaList[0].coChSuppr;
        document.getElementById("RxSensiv").value   = rParaList[0].RxSensiv;
    }
    
    return true; 
}
</script>
