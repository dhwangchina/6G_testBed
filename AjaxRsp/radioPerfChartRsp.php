<?PHP
/*
* Get Node Radio Parameters of KPI from database
*/
    include_once("../include/dbLink.php");
    
    $NodeID  = $_GET["NodeID"];
    $RadioID = $_GET["RadioID"];

    $RadioSql       = "SELECT * FROM radioKPITbl WHERE nodeID='".$NodeID."' AND radioID='".$RadioID."' ";
    $RadioSqlResult = mysql_query($RadioSql);
    if(false == $RadioSqlResult)
    {
        echo("Error. mysql_query() return false.\n");
        return;
    }
    
    $RadioRowList   = array();
    $RadioRowCnt    = 0;
    while($RadioRow = mysql_fetch_array($RadioSqlResult))
    {
        $RadioRowList[] = $RadioRow;
        $RadioRowCnt++;
    }

    $jsonRadioList = json_encode($RadioRowList);
    mysql_free_result($RadioSqlResult);
    echo("$jsonRadioList");
    
    mysql_close($connect);
?>