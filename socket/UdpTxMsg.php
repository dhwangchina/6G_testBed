<?PHP
/*
* File  : UdpTxMsg.php
* Author: Duohua(Edward) Wang
* Email : dhwangchina@gmail.com
* Time  : 18/11/2021
*/

include_once("../common/global.php");
include_once("../common/commLib.php");

ini_set('error_reporting', E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

// Set time limit to indefinite execution
set_time_limit (0);

// Set Enviroment Var

$txByteNum = 0;
$byteBuf   = array(0x00, 0x11, 0x22, 0x33, 0x44, 0x55, 0x66, 0x77, 0x88, 0x99, 0xAA, 0xA1, 0xA2, 0xA3, 0x00, 0x11, 0x22, 0x33, 0x44, 0x55, 0x66, 0x77, 0x88, 0x99, 0xAA, 0xA1, 0xA2, 0xA3);
$StrBuf    = '';
$StrBufLen = 0;

// Create a UDP Stream socket
$sockedID = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP); 
if($sockedID < 0)
{
    echo("Error. socket_create() return failure.\n");
}

//$retVal = socket_bind($sockedID, $gAddrIPv4, $gPortID); 
//if(false == $retVal)
//{
//    echo("Error. socket_bind() return falure.\n");
//}

$StrBuf    = Byte2Str($byteBuf);
$StrBufLen = strlen($StrBuf);
while(true)
{
    $txByteNum = socket_sendto($sockedID, $StrBuf, $StrBufLen, 0, $gAddrIPv4, $gPortID);
    echo("txByteNum:$txByteNum\n");
    sleep(1);
}

socket_close($sockedID);
?>