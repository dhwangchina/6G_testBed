<?PHP
/*********************************************
 * FileName---: devRadioParaDel.php
 * Function---: 
 * Version----: V 0.0.1
 * Time-------: 20/11/2021
 * Author-----: Duohua(Edward) Wang
 * Email------: dhwangchina@gmail.com
 * Copyright--: All rights reserverd By Duohua(Edward) Wang
 **********************************************
 */
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
<!doctype HTML>

<script type="text/javascript">

</script>

