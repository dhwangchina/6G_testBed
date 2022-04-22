<!doctype HTML>
<?PHP
    include_once("include/dbLink.php");

    //Get parameters
    $curNodeID  = $_GET["NodeID"];
    $curRadioID = $_GET["RadioID"];

    //Current Value
    $checkSql     = "SELECT * FROM devRadioParaTbl WHERE devID='".$curNodeID."' AND radioID='".$curRadioID."' ";
    $checkResult  = mysql_query($checkSql);
    $checkRowList = array();
    $checkRowCnt  = 0;
    while($checkRow = mysql_fetch_array($checkResult))
    {
        $checkRowList[] = $checkRow;
        $checkRowCnt++;
    }
    
    $jsonCurRadioData = json_encode($checkRowList);
    mysql_free_result($checkResult);

    if(0 == $checkRowCnt)
    {
        echo("<script> 
                alert('OOP. The record($curNodeID,$curRadioID) existed. Return to add it.');
                window.location.href='devRadioParaAdd.php';
              </script>");
    }

    //Add record
    if(isset($_REQUEST["addSubmit"]))
    {
        $nCellType     = $_POST["cellType"];
        $neNBName      = $_POST["eNBName"];
        $nFrameType    = $_POST["frameType"];
        $nTddConfig    = $_POST["tddConfig"];
        $nPrefixType   = $_POST["prefixType"];
        $nEutraBand    = $_POST["eutraBand"];
        $nTxFreq       = $_POST["txFreq"];
        $nRxFreq       = $_POST["rxFreq"];
        $nTxPwr        = $_POST["txPwr"];
        $nRxFreqOffset = $_POST["rxFreqOffset"];
        $nCellID       = $_POST["cellID"];
        $nNumRbDl      = $_POST["numRbDl"];
        $nMbSfbCellID  = $_POST["mbSfbCellID"];
        $nAntePorts    = $_POST["antePorts"];
        $nTxAnteNum    = $_POST["txAnteNum"];
        $nRxAnteNum    = $_POST["rxAnteNum"];
        $nTxGain       = $_POST["txGain"];
        $nRxGain       = $_POST["rxGain"];
            
        $updateSql = "UPDATE devRadioParaTbl SET
                                                cellType     = '".$nCellType."',
                                                eNBName      = '".$neNBName."',
                                                frameType    = '".$nFrameType."',
                                                tddConfig    = '".$nTddConfig."',
                                                prefixType   = '".$nPrefixType."',
                                                eutraBand    = '".$nEutraBand."',
                                                TxFreq       = '".$nTxFreq."',
                                                RxFreq       = '".$nRxFreq."',
                                                TxPwr        = '".$nTxPwr."',
                                                RxFreqOffset = '".$nRxFreqOffset."',
                                                CellID       = '".$nCellID."',
                                                NumRbDl      = '".$nNumRbDl."',
                                                MbsfnCellID  = '".$nMbSfbCellID."',
                                                AntePorts    = '".$nAntePorts."',
                                                AnteTx       = '".$nTxAnteNum."',
                                                AnteRx       = '".$nRxAnteNum."',
                                                TxGain       = '".$nTxGain."',
                                                RxGain       = '".$nRxGain."',
                                                timestamp    = now()
                                          WHERE devID = '".$nNodeID."' AND radioID='".$nRadioID."' ";

        $$updateSqlResult = mysql_query($updateSql);
        if($$updateSqlResult)
        {
            echo("
                <script>
                    alert('Congrats. Radio Parameters are added successfully');
                    window.location.href = './devRadioParaConf.php';
                </script>
                ");
        }
        else
        {
            echo("
                <script>
                    alert('OOPs. Radio Parameters are added failure.');
                    window.location.href = './devRadioParaMod.php?NodeID='+$nNodeID+'&RadioID'+$nRadioID;
                </script>
                ");
        }
        mysql_free_result($$updateSqlResult);
    }
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
            <div class="devTblHdr">Modify Device Radio Parameters</div>
            <div>
                <form method="post" action="">
                    <table>
                        <tr>
                            <td style='width: 105px; height: 30px; font-size: 14px; font-weight: bold; color: white; text-align: center; background-color: blue; border-color: grey;'>Item</td>
                            <td style='width: 155px; height: 30px; font-size: 14px; font-weight: bold; color: white; text-align: center; background-color: blue; border-color: grey;'>Value</td>
                            <td style='width: 745px; height: 30px; font-size: 14px; font-weight: bold; color: white; text-align: center; background-color: blue; border-color: grey;'>Comments</td>
                        </tr>
                    </table>
                    <table style="margin-top: 2px;">
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>NodeID</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="number" style="height: 15px; background-color: white;" name="nodeID" id="nodeID" min="0" value="<?PHP echo("$curNodeID");?>" disabled="disabled"/>
                            </td>
                            <td style='width: 740px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Node Identifier</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>RadioID</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="number" style="height: 15px; background-color: white;" name="radioID" id="radioID" min="0" value="<?PHP echo("$curRadioID");?>" disabled="disabled"/>
                            </td>
                            <td style='width: 740px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Radio Identifier</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>Cell Type </td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="radio" style="height: 15px; background-color: white; vertical-align: middle;" name="cellType" id="cellType" value="0" checked="0"/>M_ENB&nbsp;
                                <input type="radio" style="height: 15px; background-color: white; vertical-align: middle;" name="cellType" id="cellType" value="1"/>H_ENB
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>CELL_MACRO_ENB,CELL_HOME_ENB</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>eNB Name</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="text" style="height: 15px; background-color: white; size: 64;" name="eNBName" id="eNBName" value=""/>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>eNodeB Name</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>Frame Type</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="radio" style="height: 15px; vertical-align: middle;" name="frameType" id="frameType" value="0" checked="0"/>TDD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" style="height: 15px; vertical-align: middle;" name="frameType" id="frameType" value="1"/>FDD
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Radio Frame Type</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>Tdd Config</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="number" style="height: 15px; background-color: white;" name="tddConfig" id="tddConfig" min="0" max="7" value=""/>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Tdd Config</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>Prefix Type</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="radio" style="height: 15px; vertical-align: middle;;" name="prefixType" id="prefixType" value="0" checked="0"/>Normal
                                <input type="radio" style="height: 15px; vertical-align: middle;" name="prefixType" id="prefixType" value="1"/>Extend
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Prefix Type</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>eUTRA Band</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="number" style="height: 15px; background-color: white;" name="eutraBand" id="eutraBand" min="0" value=""/>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>eUTRA Band</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>TxFreq</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="number" style="height: 15px; background-color: white;" name="txFreq" id="txFreq" min="0" value=""/>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Tx Frequency Value(Hz)</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>RxFreq</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="number" style="height: 15px; background-color: white;" name="rxFreq" id="rxFreq" min="0" value=""/>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Rx Frequency Value(Hz)</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>TxPwr</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="number" style="height: 15px; background-color: white;" name="txPwr" id="txPwr" value=""/>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Tx Power Value(dB)</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>RxFreqOffset</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="number" style="height: 15px; background-color: white;" name="rxFreqOffset" id="rxFreqOffset" min="0" value=""/>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Rx Frequency Offset Value(Hz)</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>CellID</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="number" style="height: 15px; background-color: white;" name="cellID" id="cellID" min="0" max="563" value=""/>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Cell Identifier</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>NumRbDl</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="number" style="height: 15px; background-color: white;" name="numRbDl" id="numRbDl" min="0" value=""/>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Downlink RB Number</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>MbsfnCellID</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="number" style="height: 15px; background-color: white;" name="mbSfbCellID" id="mbSfbCellID" min="0" value=""/>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>MBMS SFN Cell Identifier</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>AntePorts</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="number" style="height: 15px; background-color: white;" name="antePorts" id="antePorts" min="0" value=""/>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Antenna Port Number</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>AnteTx</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="number" style="height: 15px; background-color: white;" name="txAnteNum" id="txAnteNum" min="0" value=""/>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Tx Antenna Number</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>AnteRx</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="number" style="height: 15px; background-color: white;" name="rxAnteNum" id="rxAnteNum" min="0" value=""/>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Rx Antenna Number</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>TxGain</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="number" style="height: 15px; background-color: white;" name="txGain" id="txGain" min="0" value=""/>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Tx Gain Value</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>RxGain</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="number" style="height: 15px; background-color: white;" name="rxGain" id="rxGain" min="0" value=""/>
                            </td>
                            <td style='width: 720px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Rx Gain Value</td>
                        </tr>
                    </table>
                    <button type="submit" class="submitBtn" name="addSubmit" id="addSubmit" value="addSubmit">Submit</button>
                    <a href="./devRadioParaConf.php"><input type="button" class="linkLeftBtn" name="addBtn" id="addBtn" value="Back"/></a>
               </form>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
var gCurRadioData = eval(<?PHP echo("$jsonCurRadioData");?>);
var gNodeID  = <?PHP echo("$curNodeID");?>;
var gRadioID = <?PHP echo("$curRadioID");?>

$(document).ready(function(){
    showCurRadioData();
});

function showCurRadioData()
{
    var iLoop = 0;
    
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
    
    for(iLoop = 0; iLoop < gCurRadioData.length; iLoop++)
    {
        if(gCurRadioData[iLoop].devID == gNodeID && gCurRadioData[iLoop].radioID == gRadioID)
        {
            document.getElementById('cellType').value     = gCurRadioData[iLoop].cellType;
            document.getElementById('eNBName').value      = gCurRadioData[iLoop].eNBName;
            document.getElementById('frameType').value    = (gCurRadioData[iLoop].frameType == 0)? "TDD":"FDD";
            document.getElementById('tddConfig').value    = gCurRadioData[iLoop].tddConfig;
            document.getElementById('prefixType').value   = (gCurRadioData[iLoop].prefixType == 0)? "NORMAL":"EXTEND";
            document.getElementById('eutraBand').value    = gCurRadioData[iLoop].eutraBand;
            document.getElementById('txFreq').value       = gCurRadioData[iLoop].TxFreq;
            document.getElementById('rxFreq').value       = gCurRadioData[iLoop].RxFreq;
            document.getElementById('txPwr').value        = gCurRadioData[iLoop].TxPwr;
            document.getElementById('rxFreqOffset').value = gCurRadioData[iLoop].RxFreqOffset;
            document.getElementById('cellID').value       = gCurRadioData[iLoop].CellID;
            document.getElementById('numRbDl').value      = gCurRadioData[iLoop].NumRbDl;
            document.getElementById('mbSfbCellID').value  = gCurRadioData[iLoop].MbsfnCellID;
            document.getElementById('antePorts').value    = gCurRadioData[iLoop].AntePorts;
            document.getElementById('txAnteNum').value    = gCurRadioData[iLoop].AnteTx;
            document.getElementById('rxAnteNum').value    = gCurRadioData[iLoop].AnteRx;
            document.getElementById('txGain').value       = gCurRadioData[iLoop].TxGain;
            document.getElementById('rxGain').value       = gCurRadioData[iLoop].RxGain;
            break;
        }
    }
}
</script>

