<?PHP
    include_once("../include/dbLink.php");
    while(true)
    {
        $vBler     = rand(5,20);
        $vThrghput = rand(500,1000);
        $vSnr      = rand(20,30);
        $vRssi     = rand(30,38);
        $vEvm      = rand(5,10);
        $vRxPwr    = rand(100,300);
        
        $sqlUpdate = "UPDATE radioKPITbl SET
                                              bler      = $vBler,
                                              thrghput  = $vThrghput, 
                                              snr       = $vSnr,
                                              rssi      = $vRssi,
                                              evm       = $vEvm,
                                              rxPwr     = $vRxPwr,
                                              timestamp = now()
                                         WHERE nodeID = 1 AND radioID = 1";
        $sqkUpdateResult = mysql_query($sqlUpdate);
        //mysql_free_result($sqkUpdateResult);
        sleep(1);
    }
    //mysql_close($connect);
?>