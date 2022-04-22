<!doctype HTML>
<?PHP
    include_once("include/dbLink.php");
    
    $dNodeID  = $_GET["NodeID"];
    $dRadioID = $_GET["RadioID"];

    //Node List
    $delSql       = "DELETE FROM devRadioParaTbl WHERE devID='".$dNodeID."' AND radioID='".$dRadioID."' ";
    $delSqlResult = mysql_query($delSql);
    echo("
         <script>
            window.location.href='./devRadioParaConf.php';
         </script>
         ");
    mysql_free_result($delSqlResult);
    mysql_close($connect);
?>
<script type="text/javascript">

</script>

