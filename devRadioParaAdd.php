<?PHP
/*********************************************
 * FileName---: devRadioParaAdd.php
 * Function---: 
 * Version----: V 0.0.1
 * Time-------: 20/11/2021
 * Author-----: Duohua(Edward) Wang
 * Email------: dhwangchina@gmail.com
 * Copyright--: All rights reserverd By Duohua(Edward) Wang
 **********************************************
 */
    include_once("include/dbLink.php");

    //Add record
    if(isset($_REQUEST["addSubmit"]))
    {
        $nNodeID       = $_POST["nodeID"];
        $nRadioID      = $_POST["radioID"];
        
        $checkSql     = "SELECT * FROM devRadioParaTbl WHERE devID='".$nNodeID."' AND radioID='".$nRadioID."' ";
        $checkResult  = mysql_query($checkSql);
        $checkRowList = array();
        $checkRowCnt  = 0;
        while($checkRow = mysql_fetch_array($checkResult))
        {
            $checkRowList[] = $checkRow;
            $checkRowCnt++;
        }
        mysql_free_result($checkResult);
        
        if(0 != $checkRowCnt)
        {
            echo("<script> 
                        alert('OOP. The record($nNodeID,$nRadioID) existed. Turn to modify it.');
                        window.location.href='devRadioParaMod.php?NodeID='+$nNodeID+'&RadioID='+$nRadioID;
                 </script>");
        }
        else
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
            
            $insertSql = "INSERT INTO devRadioParaTbl VALUES(
                                                             '".$nNodeID."',
                                                             '".$nRadioID."',
                                                             '".$nCellType."',
                                                             '".$neNBName."',
                                                             '".$nFrameType."',
                                                             '".$nTddConfig."',
                                                             '".$nPrefixType."',
                                                             '".$nEutraBand."',
                                                             '".$nTxFreq."',
                                                             '".$nRxFreq."',
                                                             '".$nTxPwr."',
                                                             '".$nRxFreqOffset."',
                                                             '".$nCellID."',
                                                             '".$nNumRbDl."',
                                                             '".$nMbSfbCellID."',
                                                             '".$nAntePorts."',
                                                             '".$nTxAnteNum."',
                                                             '".$nRxAnteNum."',
                                                             '".$nTxGain."',
                                                             '".$nRxGain."',
                                                             now())";
            $insertSqlResult = mysql_query($insertSql);
            if($insertSqlResult)
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
                        window.location.href = './devRadioParaAdd.php';
                     </script>
                     ");
            }
            mysql_free_result($insertSqlResult);
        }
    }

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
            <div class="devTblHdr">Add Device Radio Parameters</div>
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
                                <input type="number" style="height: 15px; background-color: white;" name="nodeID" id="nodeID" min="0" value=""/>
                            </td>
                            <td style='width: 740px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>Node Identifier</td>
                        </tr>
                        <tr>
                            <td style='width: 100px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: right; padding-right:5px;'>RadioID</td>
                            <td style='width: 150px; height: 20px; font-size: 12px; font-weight: normal; color: white; text-align: left;  padding-left:5px;'>
                                <input type="number" style="height: 15px; background-color: white;" name="radioID" id="radioID" min="0" value=""/>
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

</script>

