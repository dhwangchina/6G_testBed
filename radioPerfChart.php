<!doctype HTML>

<?PHP
    include_once("include/dbLink.php");
    
    //Get Node List
    $NodeSql       = "SELECT * FROM radioKPITbl";
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
    
    //Get RadioIDList
    $NodeID         = trim($_POST['SelNodeID']);
    $NodeID   = 1;
    $RadioSql       = "SELECT * FROM radioKPITbl WHERE nodeID = $NodeID";
    $RadioSqlResult = mysql_query($RadioSql);
    $RadioRowList   = array();
    $RadioRowCnt    = 0;
    while($RadioRow = mysql_fetch_array($RadioSqlResult))
    {
        $RadioRowList[] = $RadioRow;
        $RadioRowCnt++;
    }

    $jsonRadioList = json_encode($RadioRowList);
    mysql_free_result($RadioSqlResult);
    //Get Radio Parameters
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
            <!--div id="chart0" style="width: 510px; height: 200px;"></div-->
            <div>
                <form name="nodeNet" id="nodeNet" method="post" action="">
                    <table>
                        <tr>
                            <td style="width: 205px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">NodeID:<?PHP echo("$NodeID");?></td>
                            <td style="width: 180px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">
                                <select name="SelNodeID" id="SelNodeID" style="width: 180px;">
                                </select>
                            </td>
                            <td style="width: 150px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">RadioID:<?PHP echo("$RadioID");?></td>
                            <td style="width: 180px; height: 30px; font-family: fantasy;font-size: 14px; font-weight: bold; color: white; text-align: center; background-color:blue; border-color: grey;">
                                <select name="SelRadioID" id="SelRadioID" style="width: 180px;">
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
            <div id="chart0" style="width: 492px; height: 200px; margin-left:  10px; margin-top: 1px; float: left;"> </div>
            <div id="chart1" style="width: 495px; height: 200px; margin-left: 504px; margin-top: 1px; float: center;"> </div>
            <div id="chart2" style="width: 492px; height: 200px; margin-left:  10px; margin-top: 1px; float: left;"> </div>
            <div id="chart3" style="width: 495px; height: 200px; margin-left: 504px; margin-top: 1px; float: center;"> </div>
            <div id="chart4" style="width: 492px; height: 200px; margin-left:  10px; margin-top: 1px; float: left;"> </div>
            <div id="chart5" style="width: 495px; height: 200px; margin-left: 504px; margin-top: 1px; float: center;"> </div>
            <div style="margin-bottom: 20px;"></div>
        </div>
    </body>
</html>

<script type="text/javascript">
var nodeList  = eval(<?PHP echo("$jsonNodeList");?>);
var radioList = eval(<?PHP echo("$jsonRadioList");?>);



$(document).ready(function(){
    var ret = false;
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
    
    var arrNodeID = new Array();
    var arrNum    = 0;
    var arrTmp    = [];

    $("#SelNodeID").append("<option value=''>Select NodeID</option>");
    
    if(nodeList.length == 0)
    {
        return false;
    }
    //
    for(Loopi = 0; Loopi < nodeList.length; Loopi++)
    {
        arrNodeID.push(nodeList[Loopi].nodeID);
    }

    arrTmp = delRedundEle_f(arrNodeID);
    for(Loopi = 0; Loopi < arrTmp.length; Loopi++)
    {
        nodeID = arrTmp[Loopi];
        $("#SelNodeID").append("<option value='"+Loopi+"'>"+nodeID+"</option>");
    }

    return true;
}

function postNodeID()
{
    var selObj  = document.getElementById("SelNodeID");
    
    var index  = selObj.selectedIndex;
    var nodeID = selObj.options[index].value;
    //alert(nodeID);
//    var nodeID = document.getElementById("SelNodeID").value;

    window.location.href = "perf_radioParaStat.php?nodeID="+nodeID;
}

function genRadioList()
{
    var radioID = 0;
    var ulLoop  = 0;

    $("#SelRadioID").append("<option value='255'>Select RadioID</option>");
    if(0 == radioList.length)
    {
        return false;
    }

    for(ulLoop = 0; ulLoop < radioList.length; ulLoop++)
    {
        radioID = radioList[ulLoop].radioID;
        $("#SelRadioID").append("<option value='"+ulLoop+"'>"+radioID+"</option>");
    }

    return true;
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
//var chart = Highcharts.chart('container', 
var chart = Highcharts.chart('chart0', 
{
	chart: 
    {
		type: 'area',/*column：柱状图;line/spline：折线图;spline：曲线图;bar：条形图;pie：饼图;area：区块图 */
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
					var y = Math.random();
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
            text:'time'
        },
        //labels:'XXXX',
		type: 'datetime',
		tickPixelInterval: 10,
        //max: '10',
        //min:'0', 
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
			text: 'Bler'
		},
        tickPixelInterval: 0.1,
        lineColor:'red'
	},
    credits:{
        enabled: false
    },
	tooltip: 
    {
		formatter: function () 
        {
			return '<b>' + this.series.name + '</b><br/>' +
				Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
				Highcharts.numberFormat(this.y, 2);
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
		name: 'Bler',
		data: (function () {
			// 生成随机值
			var data = [];
			var time = (new Date()).getTime();
			var i;
			for (i = -19; i <= 0; i += 1) 
            {
				data.push({
					x: time + i * 1000,
					y: Math.random()
				});
			}
			return data;
		}())
	}]
});


var chart = Highcharts.chart('chart1', 
{
	chart: 
    {
		type: 'area',
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
					var y = Math.random();
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
            text:'time'
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
			text: 'Throughput'
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
			return '<b>' + this.series.name + '</b><br/>' +
				Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
				Highcharts.numberFormat(this.y, 2);
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
		data: (function () {
			// 生成随机值
			var data = [];
			var time = (new Date()).getTime();
			var i;
			for (i = -19; i <= 0; i += 1) 
            {
				data.push({
					x: time + i * 1000,
					y: Math.random() * 200
				});
			}
			return data;
		}())
	}]
});

var chart = Highcharts.chart('chart2', 
{
	chart: 
    {
		type: 'spline',
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
					var y = Math.random();
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
            text:'time'
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
			text: 'RSSI'
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
			return '<b>' + this.series.name + '</b><br/>' +
				Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
				Highcharts.numberFormat(this.y, 2);
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
			// 生成随机值
			var data = [];
			var time = (new Date()).getTime();
			var i;
			for (i = -19; i <= 0; i += 1) 
            {
				data.push({
					x: time + i * 1000,
					y: Math.random() * 100
				});
			}
			return data;
		}())
	}]
});

var chart = Highcharts.chart('chart3', 
{
	chart: 
    {
		type: 'spline',
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
					var y = Math.random();
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
            text:'time'
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
			text: 'SNR'
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
			return '<b>' + this.series.name + '</b><br/>' +
				Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
				Highcharts.numberFormat(this.y, 2);
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
			// 生成随机值
			var data = [];
			var time = (new Date()).getTime();
			var i;
			for (i = -19; i <= 0; i += 1) 
            {
				data.push({
					x: time + i * 1000,
					y: Math.random() * 10
				});
			}
			return data;
		}())
	}]
});

var chart = Highcharts.chart('chart4', 
{
	chart: 
    {
		type: 'spline',
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
					var y = Math.random();
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
            text:'time'
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
			text: 'RxPower'
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
			return '<b>' + this.series.name + '</b><br/>' +
				Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
				Highcharts.numberFormat(this.y, 2);
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
			// 生成随机值
			var data = [];
			var time = (new Date()).getTime();
			var i;
			for (i = -19; i <= 0; i += 1) 
            {
				data.push({
					x: time + i * 1000,
					y: Math.random() * 33
				});
			}
			return data;
		}())
	}]
});

var chart = Highcharts.chart('chart5', 
{
	chart: 
    {
		type: 'spline',
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
					var y = Math.random();
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
            text:'time'
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
			text: 'EVM'
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
			return '<b>' + this.series.name + '</b><br/>' +
				Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
				Highcharts.numberFormat(this.y, 2);
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
		name: 'EVM',
		data: (function () {
			// 生成随机值
			var data = [];
			var time = (new Date()).getTime();
			var i;
			for (i = -19; i <= 0; i += 1) 
            {
				data.push({
					x: time + i * 1000,
					y: Math.random()
				});
			}
			return data;
		}())
	}]
});
</script>
