<?PHP
/*********************************************
 * FileName---: home.php
 * Function---: 
 * Version----: V 0.0.1
 * Time-------: 20/11/2021
 * Author-----: Duohua(Edward) Wang
 * Email------: dhwangchina@gmail.com
 * Copyright--: All rights reserverd By Duohua(Edward) Wang
 **********************************************
 */
    date_default_timezone_set('UTC');

    include_once('./common/commLib.php');
    session_start();

    checkLogin();

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <title>6G testBed</title>
        <link rel="stylesheet" type="text/css" href="css/main_00.css"/>
        <link rel="stylesheet" type="text/css" href="css/style_01.css"/>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="js/common_js/comm.js"></script>
    </head>
    
    <body>
        <!----topBox------>
        <div class="topBox">
            <div id="logo">
                <!--a href="#menu"> <img src="images/6G_logo_002.png" width="10%" height="100%" alt="" /> </a-->
                <img src="images/6G_logo_002.png" width="10%" height="100%" alt="" />
                <img id="satImg" src="images/satelite_001.png" width="20%" height="100%" style="float:right;" alt=""/>
            </div>
        </div>
        <!----mainBox------>
        <div class="mainBox">
            <!----mainLeftBox------>
            <div class="mainLeftBox">
                <!--ul data-role="listview" data-icon="false"-->
                <ul>
                    <li class="list01 Selected">
                        <a href="#" style="font-size:16px; margin-left: 20px; color: white;">View</a>
                        <li>
                            <a href="javascript:void(0);" onmousedown="showContent('Description.php')" style="font-size:14px; margin-left: 40px; color: white;">&raquo;&raquo;Description</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" onmousedown="showContent('devStatus.php')" style="font-size:14px; margin-left: 40px; color: white;">&raquo;&raquo;Devices Status</a>
                        </li>
                    </li>
                    <li class="list03">
                        <a href="#" style="font-size:16px; margin-left: 20px; color: white;">ParaConf</a>
                        <li>
                            <a href="javascript:void(0);" onmousedown="showContent('devNetParaConf.php')" style="font-size:14px; margin-left: 40px; color: white;">&raquo;&raquo;NetParaConf</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" onmousedown="showContent('devRadioParaConf.php')" style="font-size:14px; margin-left: 40px; color: white;">&raquo;&raquo;RadioParaConf</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" onmousedown="showContent('devTrafficParaConf.php')" style="font-size:14px; margin-left: 40px; color: white;">&raquo;&raquo;TrafficParaConf</a>
                        </li>
                    </li>
                    <li class="list04">
                        <a href="#" style="font-size:16px; margin-left: 20px; color: white;">Performance</a>
                        <li>
                            <a href="javascript:void(0);" onmousedown="showContent('networkPerfParaStat.php')" style="font-size:14px; margin-left: 40px; color: white;">&raquo;&raquo;Network ParaStats</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" onmousedown="showContent('radioPerfParaStat.php')" style="font-size:14px; margin-left: 40px; color: white;">&raquo;&raquo;Radio ParaStats</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" onmousedown="showContent('radioPerfChart.php')" style="font-size:14px; margin-left: 40px; color: white;">&raquo;&raquo;Radio KPI Charts</a>
                        </li>
                    </li>                    
                    <li><a href="#" style="font-size:16px; margin-left: 20px; color: white;">Maintainance</a>
                        <li>
                            <a href="javascript:void(0);" onmousedown="showContent('eventLog.php')" style="font-size:14px; margin-left: 40px; color: white;">&raquo;&raquo;Event</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" onmousedown="showContent('alarmLog.php')" style="font-size:14px; margin-left: 40px; color: white;">&raquo;&raquo;Alarm</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" onmousedown="showContent('logLog.php')" style="font-size:14px; margin-left: 40px; color: white;">&raquo;&raquo;Log</a>
                        </li>
                    </li>
                    <li class="list06">
                        <a href="#" style="font-size:16px; margin-left: 20px; color: white;">Users Management</a>
                        <li>
                            <a href="javascript:void(0);" onmousedown="showContent('usrsConf.php')" style="font-size:14px; margin-left: 40px; color: white;">&raquo;&raquo;User List</a>
                        </li>
                    </li>
                    <li class="list08">
                        <a href="javascript:void(0);" onmousedown="showContent('about.php')" style="font-size:16px; margin-left: 20px; color: white;">About</a>
                    </li>
                </ul>
                <hr />
                <p style="font-size: 10px; color: white;">&raquo;&raquo;Hi, "<?PHP echo $_SESSION['valid_user'].'@'.date('d F Y h:i:s');?>"</p>
                <p><a style="font-size: 12px; color: red; float: left;" href="logout.php">&raquo;&raquo;Logout</a></p>
            </div>
            <!----mainRightBox------>
            <div class="mainRightBox" style="scrolling=auto; align=center">
                <iframe class="rightIframe" name="iFrame" id="rightSideContent" src="" >
                </iframe>  
            </div>
        </div>

        <!----footBox------>
        <div class="footBox">
            <footer style="color: white;"><h4>All Rights Reserved &copy;2021-2022</h4></footer>
        </div>
    </body>
</html>

<script type="text/javascript">

$(document).ready(function(){
    //$('nav#menu').mmenu();
    //freshPage(1);
    //menuFresh();
});


function menuFresh() 
{
    $('nav#menu').mmenu();
}

//use iframe to show URL
function showContent(url)
{
    var content = document.getElementById("rightSideContent");

    content.src = url;
}

</script>
