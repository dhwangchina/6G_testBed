<?PHP
/*
* File  : UdpRxMsg.php
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
$addrIPv4  = '172.20.10.6';
$portID    = 10086;

$rxStrBuf  = '';
$rxByteArr = array();
$rxByteNum = 0;


// Create a UDP Stream socket
$sockedID = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP); /*;SOCK_STREAM, DGRAM, SOCK_SEQPACKET, SOCK_RAW,SOCK_RDM;*/
if($sockedID < 0)
{
    echo("Error. socket_create() return failure.\n");
}

$retVal = socket_bind($sockedID, $addrIPv4, $portID); 
if(false == $retVal)
{
    echo("Error. socket_bind() return falure.\n");
}

$devMacArr = array();
$srcIpArr  = array();
$srcPortID = 0;
$msgID     = 0x0000;
$msgLen    = 0;
$netType   = 0;
$netRole   = 0;
$byteIndex = 0;
/*  Message Header structure
*_________________________________
*|          Source Mac           |
*|               |   Source IPv4 |
*|               |   Source Port |
*|    msgID      |    msgLen     |
*|netType|netRole|    Rsvd       |
*|            Payload            |
*|            .......            |
*_____________Payload____________|
*/

while(true)
{
    $rxByteNum = socket_recvfrom($sockedID, $rxStrBuf, C_UDP_RX_BUF_LEN, 0, $addrIPv4, $portID);
    if($rxByteNum <= 0)
    {
        continue;
    }
    
    //transform string into byte array
    $rxByteArr = Str2Bytes($rxStrBuf);
    
    showBuf($rxByteArr, $rxByteNum);
    
    //parse message header
    msgHdrParse($rxByteArr,$devMacArr,$srcIpArr,$srcPortID,$msgID,$msgLen,$netType,$netRole);
    
    printf("MAC----->%02X:%02X:%02X:%02X:%02X:%02X\n",$devMacArr[0],$devMacArr[1],$devMacArr[2],$devMacArr[3],$devMacArr[4],$devMacArr[5]);
    printf("IPv4---->%d.%d.%d.%d\n",$srcIpArr[0],$srcIpArr[1],$srcIpArr[2],$srcIpArr[3]);
    printf("srcPort->0x%04X\n",$srcPortID);
    printf("msgID--->0x%04X\n",$msgID);
    printf("msgLen-->0x%04X\n",$msgLen);
    printf("netType->0x%02X\n",$netType);
    printf("netRole->0x%02X\n",$netRole);
    
    //Parse message body
    switch($msgID)
    {
        case 0x0000:
            printf("OK. Message(0x%04X) is coming\n",$msgID);
            break;
        case 0x0002:
            printf("OK. Message(0x%04X) is coming\n",$msgID);
            break;
        case 0x0004:
            printf("OK. Message(0x%04X) is coming\n",$msgID);
            break;
        case 0x0006:
            printf("OK. Message(0x%04X) is coming\n",$msgID);
            break;
        case 0x0008:
            printf("OK. Message(0x%04X) is coming\n",$msgID);
            break;
        case 0x000A:
        case 0x000a:
            printf("OK. Message(0x%04X) is coming\n",$msgID);
            break;
        case 0x6677:
            printf("OK. Message(0x%04X) is coming\n",$msgID);
            break;
        case 0xA2A3:
            printf("OK. Message(0x%04X) is coming\n",$msgID);
            break;     
        default:
            printf("OOP. UNdefined Message(0x%04X)\n",$msgID);
            break;
    }
    
    sleep(1);
}

// Close the master sockets
socket_close($sockedID);

?>


