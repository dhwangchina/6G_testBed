/*********************************************
 * FileName---: common.js
 * Function---: 
 * Version----: V 0.0.1
 * Time-------: 20/10/2021
 * Author-----: Duohua(Edward) Wang
 * Email------: dhwangchina@gmail.com
 * Copyright--: All rights reserverd By Duohua(Edward) Wang
 **********************************************
*/

'use strict';
//Fresh Current page periodically
function freshPage(timSecVal)
{
    var curURL = window.location.href;
    
    setInterval(function(timSecVal){
        window.location.href = curURL;
    }, timSecVal * 1000);
}

//创建r行c列的表格
function createTbl(r,c) 
{ 
    var odiv   = document.getElementById("tab");
    var oTable = document.createElement("table");
    
    oTable.setAttribute("border", 1, 0);
    oTable.setAttribute("width", "600px");
    
    for (i = 0; i < r; i++) 
    {
        var tr = oTable.insertRow();
        for (j = 0; j < c; j++) 
        {
            var td = tr.insertCell();
            td.innerHTML = "第" + (i + 1) + "行，第" + (j + 1) + "列";
        }
    }
    odiv.appendChild(oTable);
}

/*Get Device NetType Name*/
function getNetTypeNameByTypeID(vNetTypeID)
{
    /*0:WLAN;1:3G;2:LTE;3:LTE-A;4:5GNR;5:6G*/
    
    var netTypeName = "Undefined";
    var netTypeID   = parseInt(vNetTypeID);

    switch(netTypeID)
    {
        case 0://WLAN
            netTypeName = "WLAN";
            break;
        
        case 1://3G
            netTypeName = "3G";
            break;
        
        case 2://LTE
            netTypeName = "LTE";
            break;
        
        case 3://LTE-A
            netTypeName = "LTE-A";
            break;
        
        case 4://5GNR
            netTypeName = "5GNR";
            break;
        
        case 5://6G
            netTypeName = "6G";
            break;
        
        default:
            netTypeName = "Undefined";
            break;
    }
    
    return netTypeName;
}

//Get Device Net Role Name
function getNetRoleNameByRoleID(vNetRoleID)
{
    /*0:AP;1:STA;2:3gNB;3:3gUE;4:4gNB;5:4gUE;6:5gNB;7:5gUE;8:6gNB;9:6gUE*/
    
    var netRoleName = "Undefined";
    var netRoleID   = parseInt(vNetRoleID);

    switch(netRoleID)
    {
        case 0://WLAN
            netRoleName = "AP";
            break;
        
        case 1://WLAN
            netRoleName = "STA";
            break;
        
        case 2://3G
            netRoleName = "3gNB";
            break;
        
        case 3://3G
            netRoleName = "3gUE";
            break;
        
        case 4://LTE
            netRoleName = "4gNB";
            break;
        
        case 5://LTE
            netRoleName = "4gUE";
            break;
        
        case 6://5GNR
            netRoleName = "5gNB";
            break;
        
        case 7://LTE
            netRoleName = "5gUE";
            break;
        
        case 8://LTE
            netRoleName = "6gNB";
            break;
        
        case 9://LTE
            netRoleName = "6gUE";
            break;
        
        default:
            netRoleName = "Undefined";
            break;
    }
    
    return netRoleName;
}
/*
function delRedundEle_00(var arrTmp)
{ 
    var arr=[];    //定义一个临时数组 
    for(var i = 0; i < arrTmp.length; i++)
	{   //循环遍历当前数组 
        //判断当前数组下标为i的元素是否已经保存到临时数组 
        //如果已保存，则跳过，否则将此元素保存到临时数组中 
        if(arr.indexOf(arrTmp[i]) == -1)
	    { 
           arr.push(arrTmp[i]); 
        } 
    }
    alert(arr); 
    return arr; 
}

function delRedundEle_01()
{  
    var h={};    //定义一个hash表  
    var arr=[];  //定义一个临时数组  
      
    for(var i = 0; i < this.length; i++)
	{    //循环遍历当前数组  
        //对元素进行判断，看是否已经存在表中，如果存在则跳过，否则存入临时数组  
        if(!h[this[i]])
		{  
            //存入hash表  
            h[this[i]] = true;  
            //把当前数组元素存入到临时数组中  
            arr.push(this[i]);  
        }  
    }  
    return arr;  
} 

function delRedundEle_02()
{  
    //直接定义结果数组  
    var arr=[] ;
    for(var i = 1; i < this.length; i++)
	{    //从数组第二项开始循环遍历此数组  
        //对元素进行判断：  
        //如果数组当前元素在此数组中第一次出现的位置不是i  
        //那么我们可以判断第i项元素是重复的，否则直接存入结果数组  
        if(this.indexOf(this[i]) == i)
		{  
            arr.push(this[i]);  
        }  
    }  
    return arr;
}

function delRedundEle_03()
{  
    //将数组进行排序  
    this.sort();  
    //定义结果数组  
    var arr=[];  
    for(var i = 1; i < this.length; i++)
	{    //从数组第二项开始循环遍历数组  
        //判断相邻两个元素是否相等，如果相等说明数据重复，否则将元素写入结果数组  
        if(this[i] !== arr[arr.length - 1])
		{  
            arr.push(this[i]);  
        }              
    }  
    return arr;
}
*/
/*
const set=new Set([1,2,3,4,4]);
console.log([...set]);//[1,2,3,4]; 
//[...set]是一个扩展运算符，将一个数组转为用逗号分隔的参数列表。
*/

/*
function delRedundEle_05(array)
{
    return Array.from(new Set(array));
    //这里的 Array.from（）方法是将两类对象转为真正的数组：类似数组的对象和可遍历的对象（包括es6新增的数据结构Set和Map)
}
*/
function delRedundEle_f(vArr)
{
    
    var arrTmp = [];
    var Loopi = 0;

    vArr.sort();
    
    for(Loopi = 0; Loopi < vArr.length; Loopi++)
    {
        if(vArr[Loopi-1] == vArr[Loopi])
        {
            continue;
        }
        
        arrTmp.push(vArr[Loopi]);
    }
    return arrTmp;
}



