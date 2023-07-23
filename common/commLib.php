<?PHP
/*********************************************
 * FileName---: commLib.php
 * Function---: 
 * Version----: V 0.0.1
 * Time-------: 18/11/2021
 * Author-----: Duohua(Edward) Wang
 * Email------: dhwangchina@gmail.com
 * Copyright--: All rights reserverd By Duohua(Edward) Wang
 **********************************************
 */

function valid_email($address)
{
    //if(preg_match('/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.a-zA-Z0-9\-\.]+$/',$address))
    if(ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$',$address))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function checkLogin()
{
    if (!isset($_SESSION['valid_user']))
    {
    	echo "<script language=javascript>alert ('You should log in first, Please');</script>";
    	//$_SESSION['userurl'] = $_SERVER['REQUEST_URI'];
    	echo '<script language=javascript>window.location.href="index.php"</script>';
    }
}

function showBuf($buf,$bufLen)
{
    $index = 0;
    
    printf("\n");
    
    for($index = 0; $index < $bufLen; $index++)
    {
        printf("%02X ", $buf[$index]);
        if(0 == ($index + 1) % 16)
        {
            printf("\n");
        }
    }
    printf("\n");
}

function int32ToBytes($val) 
{ 
    $byteArr = array(); 
    
    $byteArr[0] = ($val       & 0xff); 
    $byteArr[1] = ($val >> 8  & 0xff); 
    $byteArr[2] = ($val >> 16 & 0xff); 
    $byteArr[3] = ($val >> 24 & 0xff); 
    
    return $byteArr; 
}

function int16ToBytes($val) 
{ 
    $byteArr = array();
    
    $byteArr[0] = ($val      & 0xff); 
    $byteArr[1] = ($val >> 8 & 0xff); 
    return $byteArr; 
}

function int8ToBytes($val) 
{ 
    $byteArr = array();
    
    $byteArr[0] = ($val      & 0xff); 

    return $byteArr; 
} 

function bytesToInt32($bytes, &$index)
{ 
    $retVal = 0; 
    
    $retVal  = $bytes[$index + 3] & 0xff; 
    $retVal <<= 8; 
    $retVal |= $bytes[$index + 2] & 0xff; 
    $retVal <<= 8; 
    $retVal |= $bytes[$index + 1] & 0xff; 
    $retVal <<= 8; 
    $retVal |= $bytes[$index + 0] & 0xff; 
    
    $index += 4;
    
    return $retVal; 
} 

function bytesToInt16($bytes, &$index)
{ 
    $retVal = 0; 
    
    $retVal |= $bytes[$index + 1] & 0xff; 
    $retVal <<= 8; 
    $retVal |= $bytes[$index + 0] & 0xff; 
    
    $index += 2;
    return $retVal; 
}

function bytesToInt8($bytes, &$index)
{ 
    $retVal = 0; 
     
    $retVal = $bytes[$index]; 
    
    $index += 1;
    
    return $retVal; 
} 

function Str2Bytes($string) 
{ 
    $bytesArr = array();
    
    for($index = 0; $index < strlen($string); $index++)
    { 
        $bytesArr[] = ord($string[$index]); 
    } 
    
    return $bytesArr; 
} 

function Byte2Str($bytes) 
{ 
    $retStr = ''; 
    
    foreach($bytes as $ch) 
    { 
        $retStr .= chr($ch); 
    } 
  
    return $retStr; 
} 

function getMacFromMsgHdr($bytes,&$index)
{
    $retMacArr = array();
    
    $retMacArr[0] = $bytes[$index];
    $index += 1;
    $retMacArr[1] = $bytes[$index];
    $index += 1;
    $retMacArr[2] = $bytes[$index];
    $index += 1;
    $retMacArr[3] = $bytes[$index];
    $index += 1;
    $retMacArr[4] = $bytes[$index];
    $index += 1;
    $retMacArr[5] = $bytes[$index];
    $index += 1;
    
    return $retMacArr;
}

function php_h2ns($Int16)
{
    $retShortInt = 0;
    
    $retShortInt  = (($Int16 >> 0) & 0xFF) << 8;
    $retShortInt += (($Int16 >> 8) & 0xFF) << 0;
    
    return $retShortInt;
}

function php_n2hs($Int16)
{
    $retShortInt = 0;
    
    $retShortInt  = (($Int16 >> 0) & 0xFF) << 8;
    $retShortInt += (($Int16 >> 8) & 0xFF) << 0;
    
    return $retShortInt;
}

function php_n2hl($Int32)
{
    $retShortInt = 0;
    
    $retShortInt  = (($Int32  >> 0) & 0xFF) << 24;
    $retShortInt += (($Int32 >>  8) & 0xFF) << 16;
    $retShortInt += (($Int32 >> 16) & 0xFF) <<  8;
    $retShortInt += (($Int32 >> 24) & 0xFF) <<  0;
    
    return $retShortInt;
}

function php_h2nl($Int32)
{
    $retShortInt = 0;
    
    $retShortInt  = (($Int32 >>  0) & 0xFF) << 24;
    $retShortInt += (($Int32 >>  8) & 0xFF) << 16;
    $retShortInt += (($Int32 >> 16) & 0xFF) <<  8;
    $retShortInt += (($Int32 >> 24) & 0xFF) <<  0;
    
    return $retShortInt;
}

function msgHdrGen($vMacArr,$vSrcIPv4,$vSrcPort,$vMsgID,$vMsgBodyLen,$vNetType,$vNetRole)
{
    $retMsgHdr = array();
    $rsvdDara  = 0xDEDE;
    
    $retMsgHdr = array_merge($retMsgHdr,$vMacArr);
    $retMsgHdr = array_merge($retMsgHdr,$vSrcIPv4);
    $retMsgHdr = array_merge($retMsgHdr,int16ToBytes(php_h2ns($vSrcPort)));
    $retMsgHdr = array_merge($retMsgHdr,int16ToBytes(php_h2ns($vMsgID)));
    $retMsgHdr = array_merge($retMsgHdr,int16ToBytes(php_h2ns($vMsgBodyLen)));
    $retMsgHdr = array_merge($retMsgHdr,int8ToBytes($vNetType));
    $retMsgHdr = array_merge($retMsgHdr,int8ToBytes($vNetRole));
    $retMsgHdr = array_merge($retMsgHdr,int16ToBytes(php_h2ns($rsvdDara)));
    
    return $retMsgHdr;
}

function msgHdrParse($vMsgHdr,&$vMacArr,&$vSrcIPv4,&$vSrcPort,&$vMsgID,&$vMsgBodyLen,&$vNetType,&$vNetRole)
{
    for($index = 0; $index < C_MAC_LEN; $index++)
    {
        $vMacArr[$index] = $vMsgHdr[$index];
    }
    
    $vSrcIPv4[0] = $vMsgHdr[$index];
    $index += 1;
    $vSrcIPv4[1] = $vMsgHdr[$index];
    $index += 1;
    $vSrcIPv4[2] = $vMsgHdr[$index];
    $index += 1;
    $vSrcIPv4[3] = $vMsgHdr[$index];
    $index += 1;
    $vSrcPort    = bytesToInt16($vMsgHdr,$index);
    $vSrcPort    = php_n2hs($vSrcPort);
    $vMsgID      = bytesToInt16($vMsgHdr,$index);
    $vMsgID      = php_n2hs($vMsgID);
    $vMsgBodyLen = bytesToInt16($vMsgHdr,$index);
    $vMsgBodyLen = php_n2hs($vMsgBodyLen);
    $vNetType    = bytesToInt8($vMsgHdr,$index);
    $vNetRole    = bytesToInt8($vMsgHdr,$index);
    $resvdData   = bytesToInt16($vMsgHdr,$index);
}

function msgTxUdpdata($vStrBuf, $vStrBufLen, $vSocketID, $vIPv4Addr,$vUdpPortID)
{
    $retVal = socket_sendto($vSocketID, $vStrBuf, $vStrBufLen, 0, $vIPv4Addr, $vUdpPortID);
    if($retVal <= 0)
    {
        printf("Message Send Error:\n");
        showBuf(Str2Bytes($vStrBuf),$vStrBufLen);
    }
    
    return $retVal;
}

?>