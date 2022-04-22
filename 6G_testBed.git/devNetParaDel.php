<?PHP
    include_once("include/dbLink.php");
    
    $devID = $_GET['divID'];
    $devID = trim($devID);

    $delSql       = "DELETE FROM devNetworkTbl WHERE devID = $devID";
    $delSqlResult = mysql_query($delSql);
    if(!$delSqlResult)
    {
        echo("<script>alert('Oop. Delete the parameters of device failure!');</script>");
    }
    
    mysql_close($connect);
    
    echo("<script>window.location.href='devNetParaConf.php';</script>");
?>