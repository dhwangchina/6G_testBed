<!doctype HTML>

<?PHP
    include_once("./include/dbLink.php");
    
    //Get Node List
    $NodeSql       = "SELECT * FROM radioKPITbl ORDER BY nodeID";
    $NodeSqlResult = mysql_query($NodeSql);
    $NodeRowList   = array();
    $NodeRowCnt    = 0;
    while($NodeRow = mysql_fetch_array($NodeSqlResult))
    {
        $NodeRowList[] = $NodeRow;
        $NodeRowCnt++;
    }

    $jsonNodeList = json_encode($NodeRowList);
    mysql_free_result($NodeSqlResult);

    mysql_close($connect);
?>


<html>
    <head>
        <meta charset="utf-8"/>
        <title>6G testBed</title>
        <link rel="stylesheet" type="text/css" href="css/main_01.css"/>
        <!--link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" /-->
           <script src="js/mmenu/jquery-1.9.1.min.js"></script>
        <script src="js/common_js/comm.js"></script>
        <script src="js/highchart/highcharts.src.js"></script>
        <script src="js/highchart/exporting.js"></script>
        <!--script src="js/highchart/highcharts-zh_CN.js"></script-->
        <script src="js/highchart/offline-exporting.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>
    
    <body>
        <!--div class="table-container"-->
        <div>
            <div class="devTblHdr">Performance Charts</div>
            <div>
                <form name="nodeNet" id="nodeNet" method="post" action="">
                    <table>
                        <tr>
                            <td style="width: 205px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">NodeID:
                                <output style="color: white;" name="selectedNodeID" id="selectedNodeID"></output>
                            </td>
                            <td style="width: 180px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">
                                <select style="width: 180px;" name="SelNodeID" id="SelNodeID" onchange="selNodeID(this.options[this.selectedIndex].text)">
                                </select>
                            </td>
                            <td style="width: 150px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">RadioID:
                                <output style="color: white;" name="selectedRadioID" id="selectedRadioID"></output>
                            </td>
                            <td style="width: 180px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">
                                <select name="SelRadioID" id="SelRadioID" style="width: 180px;" onchange="selRadioID(this.options[this.selectedIndex].text)">
                                </select>
                            </td>
                            <td style="width: 120px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">Status</td>
                            <td style="width: 147px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">
                                <output></output>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div id="chart1" style="width: 492px; height: 200px; margin-left:  10px; margin-top: 1px; float: left;"> </div>
            <div id="chartThroughput" style="width: 495px; height: 200px; margin-left: 504px; margin-top: 1px; float: center;"> </div>
            <div id="chartRssi" style="width: 492px; height: 200px; margin-left:  10px; margin-top: 1px; float: left;"> </div>
            <div id="chartSnr" style="width: 495px; height: 200px; margin-left: 504px; margin-top: 1px; float: center;"> </div>
            <div id="chartRxPwr" style="width: 492px; height: 200px; margin-left:  10px; margin-top: 1px; float: left;"> </div>
            <div id="chartEvm" style="width: 495px; height: 200px; margin-left: 504px; margin-top: 1px; float: center;"> </div>
            <div style="margin-bottom: 20px;"></div>
        </div>
    </body>
</html>

<script type="text/javascript">
var nodeList  = eval(<?PHP echo("$jsonNodeList");?>);
var gXmlHttp = null;
var gJsonObj = null;
var gNodeID  = 0;
var gRadioID = 0;
var gBler    = 0;
var gThrput  = 0;
var gRssi    = 0;
var gSnr     = 0;
var gRxPwr   = 0;
var gEvm     = 0;


$(document).ready(function(){
    var ret     = false;
    var nodeID  = 0;
    var radioID = 0;
    
    ret = genNodeList();
    if(true == ret)
    {
        genRadioList();
    }
});

function genNodeList()
{
    var nodeID = 0;
    var Loopi  = 0;
    var index  = 0;
    var arrNodeID = new Array();
    var arrNum    = 0;
    var arrTmp    = [];

    $("#SelNodeID").append("<option value='0'>Select NodeID</option>");
    
    if(nodeList.length == 0)
    {
        return false;
    }

    for(Loopi = 0; Loopi < nodeList.length; Loopi++)
    {
        arrNodeID.push(nodeList[Loopi].nodeID);
    }

    arrTmp = delRedundEle_f(arrNodeID);
    for(Loopi = 0; Loopi < arrTmp.length; Loopi++)
    {
        nodeID = arrTmp[Loopi];
        index  = Loopi + 1;
        $("#SelNodeID").append("<option value='" + index + "'>" + nodeID + "</option>");
    }

    return true;
}

function selNodeID(vNodeID)
{
    document.getElementById("selectedNodeID").value = vNodeID;
    gNodeID = vNodeID;
    genRadioList(vNodeID);
}

function genRadioList(vNodeID)
{
    var radioID = 0;
    var ulLoop  = 0;
    var index   = 0;

    $("#SelRadioID").empty();
    $("#SelRadioID").append("<option value='0'>Select RadioID</option>");
    if(0 == nodeList.length)
    {
        return false;
    }

    for(ulLoop = 0; ulLoop < nodeList.length; ulLoop++)
    {
        if(vNodeID == nodeList[ulLoop].nodeID)
        {
            radioID = nodeList[ulLoop].radioID;
            index   = ulLoop + 1;
            $("#SelRadioID").append("<option value='" + index + "'>" + radioID + "</option>");
        }
    }

    return true;
}

function selRadioID(vRadioID)
{
    document.getElementById("selectedRadioID").value = vRadioID;
    gRadioID = vRadioID;
    setInterval(function(){
                            AjaxQuery(gNodeID,gRadioID);

                            GetRadioPara(gNodeID,gRadioID);
                          },
                          1 * 1000);
}

function GetRadioPara(vNodeID,vRadioID)
{
    if(1 != gJsonObj.length || vNodeID != gJsonObj[0].nodeID || vRadioID != gJsonObj[0].radioID)
    {   
        gBler   = 10; 
        gThrput = 0;
        gRssi   = 0;
        gSnr    = 0;
        gRxPwr  = 0;
        gEvm    = 0;
        return;
    }

    gBler   = parseInt(gJsonObj[0].bler); 
    gThrput = parseInt(gJsonObj[0].thrghput);
    gRssi   = parseInt(gJsonObj[0].rssi);
    gSnr    = parseInt(gJsonObj[0].snr);
    gRxPwr  = parseInt(gJsonObj[0].rxPwr);
    gEvm    = parseInt(gJsonObj[0].evm);
}

function AjaxQuery(vNodeID,vRadioID)
{
    gXmlHttp = GetXmlHttpObj();
    if(null == gXmlHttp)
    {
        alert ("Browser does not support HTTP Request");
        return;
    }

    var url = "./AjaxRsp/radioPerfChartRsp.php";
    url = url + "?NodeID=" + vNodeID + "&RadioID=" + vRadioID;

    gXmlHttp.onreadystatechange = stateChanged;
    gXmlHttp.open("GET",url,false);
    gXmlHttp.send(null);
}

function GetXmlHttpObj()
{
    var xmlHttp = null;
    
    try
    {
        // Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    }
    
    catch (e)
    {
        //Internet Explorer
        try
        {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
    
        catch (e)
        {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    
    return xmlHttp;
}

function stateChanged()
{
    /*
    * https://www.programminghunter.com/article/30761670894/
    * 每当 XMLHTTP 对象的状态发生改变，则执行该函数。
    * 在xmlhttp.readyState==4 && xmlhttp.status==200时，用响应文本填充需要查询的内容。
    * xmlhttp.readyState有5种状态：
    * 1. 0->请求未初始化（还没有调用 open()）。
    * 2. 1->请求已经建立，但是还没有发送（还没有调用 send()）。
    * 3. 2->请求已发送，正在处理中（通常现在可以从响应中获取内容头）。
    * 4. 3->请求在处理中；通常响应中已有部分数据可用了，但是服务器还没有完成响应的生成。
    * 5. 4->响应已完成；您可以获取并使用服务器的响应了。
    * 参考：http://www.cnblogs.com/fsjohnhuang/articles/2345653.html
    
    * xmlhttp.status的状态码：
    * 1. 100-199->用于指定客户端应相应的某些动作。 
    * 2. 200-299->用于表示请求成功。 
    * 3. 300-399->用于已经移动的文件并且常被包含在定位头信息中指定新的地址信息。 
    * 4. 400-499->用于指出客户端的错误。 
    * 5. 500-599->用于支持服务器错误。
    * 参考：http://www.cnblogs.com/lxinxuan/archive/2009/10/22/1588053.html
    */

    if (200 == gXmlHttp.status && 4 == gXmlHttp.readyState)
    {
        gJsonObj = null;
        gJsonObj = eval(<?PHP echo("gXmlHttp.responseText");?>);
    }
}

Highcharts.setOptions({
    global: 
    {
        useUTC: false
    },
    color:'white'
});

function activeLastPointToolip(chart) 
{
    var points = chart.series[0].points;
    chart.tooltip.refresh(points[points.length -1]);
}

var dafaultMenuItem = Highcharts.getOptions().exporting.buttons.contextButton.menuItems;
console.log(dafaultMenuItem);

var chart = Highcharts.chart('chart1', 
{
    chart: 
    {
        type: 'areaspline',/*column：柱状图;line/spline：折线图;spline：曲线图;bar：条形图;pie：饼图;area：区块图 */
        marginRight: 10,
        events: 
        {
            load: function() 
            {
                var series = this.series[0];
                var chart  = this;
                activeLastPointToolip(chart);
                setInterval(function () 
                {
                    var x = (new Date()).getTime();
                    var y = gBler;
                    series.addPoint([x, y], true, true);
                    activeLastPointToolip(chart);
                }, 1*1000);
            }
        }
    },
    title: 
    {
        text:'Bler'/*,
        align: center,
        verticalAlign: top,
        margin: 15,
        floating: true
        style: {color:'white', fontSize: '16px'}
       */
    },
    xAxis: 
    {
        title:
        {
            text:'<b>time(s)</b>',
            align:'middle'
        },
        //labels:'XXXX',
        type: 'datetime',
        tickPixelInterval: 10,
        //max: '10',
        //min:0, 
        gridLineColor:'red',
        gridLineDashStyle:'1',
        //gridLineWidth:'2px',
        lineColor:'red'
        //lineWidth:'2px'
    },
    yAxis: 
    {
        title: 
        {
            text: '<b>Bler(%)</b>'
        },
        //type:'linear',
//        plotLines:[{
//            color:'red',           //线的颜色，定义为红色
//            dashStyle:'solid',     //默认值，这里定义为实线
//            value:3,               //定义在那个值上显示标示线，这里是在x轴上刻度为3的值处垂直化一条线
//            width:2                //标示线的宽度，2px
//        }],
        tickPixelInterval: 0.1,
        //max:100,
        min:0,
        gridLineWidth:'1px',
        lineColor:'red'
        //lineWidth:'2px'
    },
    credits:
    {
        enabled: false
    },
    tooltip: 
    {
        formatter: function () 
        {
            return '<b>' + this.series.name + ':</b>' +
                Highcharts.numberFormat(this.y, 2) + '%' + '<br/>' + 
                Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x);
        }
    },
    legend: 
    {
        enabled: false
    },
    exporting: 
    {
        buttons: 
        {
            contextButton: 
            {
                menuItems: [
                    dafaultMenuItem[0],
                    {
                        //separator: true
                    },
                    dafaultMenuItem[2],
                    {
                        //separator: true
                    },
                    dafaultMenuItem[3],
                    {
                        text: 'Download PDF',
                        onclick: function() 
                        {
                            this.exportChart({
                                type: 'application/pdf'
                            });
                        }
                    },
                    dafaultMenuItem[4],
                    {
                        text: 'Customize',
                        onclick: function() 
                        {
                            alert('Customized Item');
                        }
                    },
                    dafaultMenuItem[5],
                    dafaultMenuItem[1],
                    {
                        text: 'Link',
                        onclick: function() 
                        {
                            window.location.href= 'https://www.linkedin.com/in/duohuawang-4319a299';
                        }
                    }
                ]
            }
        }
    },
    plotOptions: 
    {
        area: 
        {
            fillColor: 
            {
                linearGradient: 
                {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 1
                },
                stops: 
                [
                    [0, new Highcharts.getOptions().colors[8]],
                    [1, new Highcharts.Color(Highcharts.getOptions().colors[8]).setOpacity(0).get('rgba')]
                ]
            },
            marker: 
            {
                radius: 2
            },
            lineWidth: 1,
            states: 
            {
                hover: 
                {
                    lineWidth: 1
                }
            },
            threshold: null
        }
    },
    series: [{
        name: 'Bler',
        data: (function () 
        {
            var data = [];
            var time = (new Date()).getTime();
            var i;
            for (i = -19; i <= 0; i += 1) 
            {
                data.push({
                    x: time + i * 1000,
                    y: gBler
                });
            }
            return data;
        }())
    }]
});


var chart = Highcharts.chart('chartThroughput', 
{
    chart: 
    {
        type: 'areaspline',
        marginRight: 10,
        events: 
        {
            load: function () 
            {
                var series = this.series[0];
                var chart  = this;
                activeLastPointToolip(chart);
                setInterval(function () 
                {
                    var x = (new Date()).getTime();
                    var y = gThrput;
                    series.addPoint([x, y], true, true);
                    activeLastPointToolip(chart);
                }, 1*1000);
            }
        }
    },
    title: 
    {
        text:'Throughput'/*,
        align: center,
        verticalAlign: top,
        margin: 15,
        floating: true
        style: {color:'white', fontSize: '16px'}
       */
    },
    xAxis: 
    {
        title:
        {
            text:'<b>time(s)</b>'
        },
        //labels:'XXXX',
        type: 'datetime',
        tickPixelInterval: 10,
        //max:'10',
        //min:'0',
        //gridLineColor:'red',
        //gridLineWidth:'2px',
        lineColor:'red'
        //lineWidth:'2px'
    },
    yAxis: 
    {
        title: 
        {
            text: '<b>Throughput</b>'
        },
        tickPixelInterval: 10,
        lineColor:'red'
    },
    credits:
    {
        enabled: false
    },
    tooltip: 
    {
        formatter: function () 
        {
            return '<b>' + this.series.name + ':</b>' +
                Highcharts.numberFormat(this.y, 2) + 'bps' + '<br/>' +
                Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x);
        }
    },
    legend: 
    {
        enabled: false
    },
    exporting: 
    {
        buttons: 
        {
            contextButton: 
            {
                menuItems: [
                    dafaultMenuItem[0],
                    {
                        //separator: true
                    },
                    dafaultMenuItem[2],
                    {
                        //separator: true
                    },
                    dafaultMenuItem[3],
                    {
                        text: 'Download PDF',
                        onclick: function() 
                        {
                            this.exportChart({
                                type: 'application/pdf'
                            });
                        }
                    },
                    dafaultMenuItem[4],
                    {
                        text: 'Customize',
                        onclick: function() 
                        {
                            alert('Customized Item');
                        }
                    },
                    dafaultMenuItem[5],
                    dafaultMenuItem[1],
                    {
                        text: 'Link',
                        onclick: function() 
                        {
                            window.location.href= 'https://www.linkedin.com/in/duohuawang-4319a299';
                        }
                    }
                ]
            }
        }
    },
    series: [{
        name: 'Throughput',
        data: (function(){
            var data = [];
            var time = (new Date()).getTime();
            var i;
            for (i = -19; i <= 0; i += 1) 
            {
                data.push({
                    x: time + i * 1000,
                    y: gThrput
                });
            }
            return data;
        }())
    }]
});

var chart = Highcharts.chart('chartRssi', 
{
    chart: 
    {
        type: 'areaspline',
        marginRight: 10,
        events: 
        {
            load: function () 
            {
                var series = this.series[0];
                var chart  = this;
                activeLastPointToolip(chart);
                setInterval(function () 
                {
                    var x = (new Date()).getTime();
                    var y = gRssi;
                    series.addPoint([x, y], true, true);
                    activeLastPointToolip(chart);
                }, 1*1000);
            }
        }
    },
    title: 
    {
        text:'RSSI'/*,
        align: center,
        verticalAlign: top,
        margin: 15,
        floating: true
        style: {color:'white', fontSize: '16px'}
       */
    },
    xAxis: 
    {
        title:
        {
            text:'<b>time(s)</b>'
        },
        //labels:'XXXX',
        type: 'datetime',
        tickPixelInterval: 10,
        //max:'10',
        //min:'0',
        //gridLineColor:'red',
        //gridLineWidth:'2px',
        lineColor:'red'
        //lineWidth:'2px'
    },
    yAxis: 
    {
        title: 
        {
            text: '<b>RSSI(dBm)</b>'
        },
        tickPixelInterval: 10,
        lineColor:'red'
    },
    credits:
    {
        enabled: false
    },
    tooltip: 
    {
        formatter: function () 
        {
            return '<b>' + this.series.name + ':</b>' +
                Highcharts.numberFormat(this.y, 2) + 'dBm' + '<br/>' +
                Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x);
        }
    },
    legend: 
    {
        enabled: false
    },
    exporting: 
    {
        buttons: 
        {
            contextButton: 
            {
                menuItems: [
                    dafaultMenuItem[0],
                    {
                        //separator: true
                    },
                    dafaultMenuItem[2],
                    {
                        //separator: true
                    },
                    dafaultMenuItem[3],
                    {
                        text: 'Download PDF',
                        onclick: function() 
                        {
                            this.exportChart({
                                type: 'application/pdf'
                            });
                        }
                    },
                    dafaultMenuItem[4],
                    {
                        text: 'Customize',
                        onclick: function() 
                        {
                            alert('Customized Item');
                        }
                    },
                    dafaultMenuItem[5],
                    dafaultMenuItem[1],
                    {
                        text: 'Link',
                        onclick: function() 
                        {
                            window.location.href= 'https://www.linkedin.com/in/duohuawang-4319a299';
                        }
                    }
                ]
            }
        }
    },
    series: [{
        name: 'RSSI',
        data: (function () {
            var data = [];
            var time = (new Date()).getTime();
            var i;
            for (i = -19; i <= 0; i += 1) 
            {
                data.push({
                    x: time + i * 1000,
                    y: gRssi
                });
            }
            return data;
        }())
    }]
});

var chart = Highcharts.chart('chartSnr', 
{
    chart: 
    {
        type: 'areaspline',
        marginRight: 10,
        events: 
        {
            load: function () 
            {
                var series = this.series[0];
                var chart  = this;
                activeLastPointToolip(chart);
                setInterval(function () 
                {
                    var x = (new Date()).getTime();
                    var y = gSnr;
                    series.addPoint([x, y], true, true);
                    activeLastPointToolip(chart);
                }, 1*1000);
            }
        }
    },
    title: 
    {
        text:'SNR'/*,
        align: center,
        verticalAlign: top,
        margin: 15,
        floating: true
        style: {color:'white', fontSize: '16px'}
       */
    },
    xAxis: 
    {
        title:
        {
            text:'<b>time(s)</b>'
        },
        //labels:'XXXX',
        type: 'datetime',
        tickPixelInterval: 10,
        //max:'10',
        //min:'0',
        //gridLineColor:'red',
        //gridLineWidth:'2px',
        lineColor:'red'
        //lineWidth:'2px'
    },
    yAxis: 
    {
        title: 
        {
            text: '<b>SNR(dB)</b>'
        },
        tickPixelInterval: 10,
        lineColor:'red'
    },
    credits:
    {
        enabled: false
    },
    tooltip: 
    {
        formatter: function () 
        {
            return '<b>' + this.series.name + ':</b>' +
                Highcharts.numberFormat(this.y, 2) + 'dB' + '<br/>' +
                Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x);
        }
    },
    legend: 
    {
        enabled: false
    },
    exporting: 
    {
        buttons: 
        {
            contextButton: 
            {
                menuItems: [
                    dafaultMenuItem[0],
                    {
                        //separator: true
                    },
                    dafaultMenuItem[2],
                    {
                        //separator: true
                    },
                    dafaultMenuItem[3],
                    {
                        text: 'Download PDF',
                        onclick: function() 
                        {
                            this.exportChart({
                                type: 'application/pdf'
                            });
                        }
                    },
                    dafaultMenuItem[4],
                    {
                        text: 'Customize',
                        onclick: function() 
                        {
                            alert('Customized Item');
                        }
                    },
                    dafaultMenuItem[5],
                    dafaultMenuItem[1],
                    {
                        text: 'Link',
                        onclick: function() 
                        {
                            window.location.href= 'https://www.linkedin.com/in/duohuawang-4319a299';
                        }
                    }
                ]
            }
        }
    },
    series: [{
        name: 'SNR',
        data: (function () {
            var data = [];
            var time = (new Date()).getTime();
            var i;
            for (i = -19; i <= 0; i += 1) 
            {
                data.push({
                    x: time + i * 1000,
                    y: gSnr
                });
            }
            return data;
        }())
    }]
});

var chart = Highcharts.chart('chartRxPwr', 
{
    chart: 
    {
        type: 'areaspline',
        marginRight: 10,
        events: 
        {
            load: function () 
            {
                var series = this.series[0];
                var chart  = this;
                activeLastPointToolip(chart);
                setInterval(function () 
                {
                    var x = (new Date()).getTime();
                    var y = gRxPwr;
                    series.addPoint([x, y], true, true);
                    activeLastPointToolip(chart);
                }, 1*1000);
            }
        }
    },
    title: 
    {
        text:'RxPower'/*,
        align: center,
        verticalAlign: top,
        margin: 15,
        floating: true
        style: {color:'white', fontSize: '16px'}
       */
    },
    xAxis: 
    {
        title:
        {
            text:'<b>time(s)</b>'
        },
        //labels:'XXXX',
        type: 'datetime',
        tickPixelInterval: 10,
        //max:'10',
        //min:'0',
        //gridLineColor:'red',
        //gridLineWidth:'2px',
        lineColor:'red'
        //lineWidth:'2px'
    },
    yAxis: 
    {
        title: 
        {
            text: '<b>RxPower(dBm)</b>'
        },
        tickPixelInterval: 10,
        lineColor:'red'
    },
    credits:
    {
        enabled: false
    },
    tooltip: 
    {
        formatter: function () 
        {
            return '<b>' + this.series.name + ':</b>' +
                Highcharts.numberFormat(this.y, 2) + 'dBm' + '<br/>' +
                Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x);
        }
    },
    legend: 
    {
        enabled: false
    },
    exporting: 
    {
        buttons: 
        {
            contextButton: 
            {
                menuItems: [
                    dafaultMenuItem[0],
                    {
                        //separator: true
                    },
                    dafaultMenuItem[2],
                    {
                        //separator: true
                    },
                    dafaultMenuItem[3],
                    {
                        text: 'Download PDF',
                        onclick: function() 
                        {
                            this.exportChart({
                                type: 'application/pdf'
                            });
                        }
                    },
                    dafaultMenuItem[4],
                    {
                        text: 'Customize',
                        onclick: function() 
                        {
                            alert('Customized Item');
                        }
                    },
                    dafaultMenuItem[5],
                    dafaultMenuItem[1],
                    {
                        text: 'Link',
                        onclick: function() 
                        {
                            window.location.href= 'https://www.linkedin.com/in/duohuawang-4319a299';
                        }
                    }
                ]
            }
        }
    },
    series: [{
        name: 'RxPower',
        data: (function () {
            var data = [];
            var time = (new Date()).getTime();
            var i;
            for (i = -19; i <= 0; i += 1) 
            {
                data.push({
                    x: time + i * 1000,
                    y: gRxPwr
                });
            }
            return data;
        }())
    }]
});

var chart = Highcharts.chart('chartEvm', 
{
    chart: 
    {
        type: 'areaspline',
        marginRight: 10,
        events: 
        {
            load: function () 
            {
                var series = this.series[0];
                var chart  = this;
                activeLastPointToolip(chart);
                setInterval(function () 
                {
                    var x = (new Date()).getTime();
                    var y = gEvm;
                    series.addPoint([x, y], true, true);
                    activeLastPointToolip(chart);
                }, 1*1000);
            }
        }
    },
    title: 
    {
        text:'EVM'/*,
        align: center,
        verticalAlign: top,
        margin: 15,
        floating: true
        style: {color:'white', fontSize: '16px'}
       */
    },
    xAxis: 
    {
        title:
        {
            text:'<b>time(s)</b>'
        },
        //labels:'XXXX',
        type: 'datetime',
        tickPixelInterval: 2,
        //max:'10',
        //min:'0',
        gridLineColor:'orange',
        gridLineWidth:'1px',
        lineColor:'red'
        //lineWidth:'2px'
    },
    yAxis: 
    {
        title: 
        {
            text: '<b>EVM(%)</b>'
        },
        tickPixelInterval: 2,
        gridLineColor:'orange',
        gridLineWidth:'1px',
        lineColor:'red'
    },
    credits:
    {
        enabled: false
    },
    tooltip: 
    {
        formatter: function () 
        {
            return '<b>' + this.series.name + '</b>' +
                Highcharts.numberFormat(this.y, 2) + '%' + '<br/>' +
                Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x);
        }
    },
    legend: 
    {
        enabled: false
    },
    exporting: 
    {
        buttons: 
        {
            contextButton: 
            {
                menuItems: [
                    dafaultMenuItem[0],
                    {
                        //separator: true
                    },
                    dafaultMenuItem[2],
                    {
                        //separator: true
                    },
                    dafaultMenuItem[3],
                    {
                        text: 'Download PDF',
                        onclick: function() 
                        {
                            this.exportChart({
                                type: 'application/pdf'
                            });
                        }
                    },
                    dafaultMenuItem[4],
                    {
                        text: 'Customize',
                        onclick: function() 
                        {
                            alert('Customized Item');
                        }
                    },
                    dafaultMenuItem[5],
                    dafaultMenuItem[1],
                    {
                        text: 'Link',
                        onclick: function() 
                        {
                            window.location.href= 'https://www.linkedin.com/in/duohuawang-4319a299';
                        }
                    }
                ]
            }
        }
    },
    plotoption:
    {
        area:
        {
            color:
            {
                linearGradient:
                {
                    x1:0,
                    y1:0,
                    x2:1,
                    y2:1
                },
                stops:
                [
                    [0,'#f5222d'],
                    [1,'#f5224f']
                ]
            },
        }
    },
    series: [
    {
        name: 'EVM',
        data: (function () {
            var data = [];
            var time = (new Date()).getTime();
            var i;
            for (i = -19; i <= 0; i += 1) 
            {
                data.push({
                    x: time + i * 1000,
                    y: gEvm
                });
            }
            return data;
        }())
    }]
});
</script>
