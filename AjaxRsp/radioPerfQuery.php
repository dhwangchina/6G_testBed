<?PHP
/*
* Get Node Radio Parameters from database
*/
    include_once("../include/dbLink.php");

    $NodeID  = $_GET["NodeID"];
    $RadioID = $_GET["RadioID"];

    $NodeSql       = "SELECT * FROM nodeRadioPerfParaTbl WHERE nodeID='".$NodeID."' AND radioID='".$RadioID."' ";
    $NodeSqlResult = mysql_query($NodeSql);
    if(false == $NodeSqlResult)
    {
        echo("Error. mysql_query() return false.\n");
        return;
    }
    
    $NodeRowList   = array();
    $NodeRowCnt    = 0;
    while($NodeRow = mysql_fetch_array($NodeSqlResult))
    {
        $NodeRowList[] = $NodeRow;
        $NodeRowCnt++;
    }

    $jsonNodeList = json_encode($NodeRowList);
    mysql_free_result($NodeSqlResult);
    echo("$jsonNodeList");
    mysql_close($connect);
?>