<?PHP
/*********************************************
 * FileName---: global.php
 * Function---: 
 * Version----: V 0.0.1
 * Time-------: 1/11/2021
 * Author-----: Duohua(Edward) Wang
 * Email------: dhwangchina@gmail.com
 * Copyright--: All rights reserverd By Duohua(Edward) Wang
 **********************************************
 */
 
define("MAX_USR_NUM"     , 65535);
define("C_UDP_RX_BUF_LEN",  8196);
define("C_MAC_LEN",            6);
define("C_IPV4_LEN",           4);
define("C_TIMEOUT_SECOND",   300);/*second*/




/* Global Vars*/
global $gAddrIPv4;
global $gPortID;

$gAddrIPv4 = '172.20.10.6';
$gPortID   = 10086;




?>