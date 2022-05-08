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

//����r��c�еı��
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
            td.innerHTML = "��" + (i + 1) + "�У���" + (j + 1) + "��";
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
    var arr=[];    //����һ����ʱ���� 
    for(var i = 0; i < arrTmp.length; i++)
	{   //ѭ��������ǰ���� 
        //�жϵ�ǰ�����±�Ϊi��Ԫ���Ƿ��Ѿ����浽��ʱ���� 
        //����ѱ��棬�����������򽫴�Ԫ�ر��浽��ʱ������ 
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
    var h={};    //����һ��hash��  
    var arr=[];  //����һ����ʱ����  
      
    for(var i = 0; i < this.length; i++)
	{    //ѭ��������ǰ����  
        //��Ԫ�ؽ����жϣ����Ƿ��Ѿ����ڱ��У�������������������������ʱ����  
        if(!h[this[i]])
		{  
            //����hash��  
            h[this[i]] = true;  
            //�ѵ�ǰ����Ԫ�ش��뵽��ʱ������  
            arr.push(this[i]);  
        }  
    }  
    return arr;  
} 

function delRedundEle_02()
{  
    //ֱ�Ӷ���������  
    var arr=[] ;
    for(var i = 1; i < this.length; i++)
	{    //������ڶ��ʼѭ������������  
        //��Ԫ�ؽ����жϣ�  
        //������鵱ǰԪ���ڴ������е�һ�γ��ֵ�λ�ò���i  
        //��ô���ǿ����жϵ�i��Ԫ�����ظ��ģ�����ֱ�Ӵ���������  
        if(this.indexOf(this[i]) == i)
		{  
            arr.push(this[i]);  
        }  
    }  
    return arr;
}

function delRedundEle_03()
{  
    //�������������  
    this.sort();  
    //����������  
    var arr=[];  
    for(var i = 1; i < this.length; i++)
	{    //������ڶ��ʼѭ����������  
        //�ж���������Ԫ���Ƿ���ȣ�������˵�������ظ�������Ԫ��д��������  
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
//[...set]��һ����չ���������һ������תΪ�ö��ŷָ��Ĳ����б�
*/

/*
function delRedundEle_05(array)
{
    return Array.from(new Set(array));
    //����� Array.from���������ǽ��������תΪ���������飺��������Ķ���Ϳɱ����Ķ��󣨰���es6���������ݽṹSet��Map)
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



