<?PHP
/*********************************************
 * FileName---: usrsMod.php
 * Function---: 
 * Version----: V 0.0.1
 * Time-------: 20/11/2021
 * Author-----: Duohua(Edward) Wang
 * Email------: dhwangchina@gmail.com
 * Copyright--: All rights reserverd By Duohua(Edward) Wang
 **********************************************
 */
    include_once("common/global.php");
    include_once("include/dbLink.php");
    
    $usrID = $_GET['usrID'];
    $usrID = trim($usrID);
    //Get Usr Info
    $Sql       = "SELECT * FROM usersInfoTbl WHERE usrid = $usrID";
    $SqlResult = mysql_query($Sql) or print("Error in usersInfoTbl:") .mysql_error();
    $rowList   = array();
    $rowCnt    = 0;
    
    while($row = mysql_fetch_array($SqlResult))
    {
        $rowList[] = $row;
        $rowCnt++;
    }
    
    $jsonUsrList = json_encode($rowList);

    mysql_free_result($SqlResult);
    
    //Post data into database
    if(isset($_REQUEST['modSubmit']))
    {
        $uname  = $_POST['uname'];
        $umail  = $_POST['umail'];
        $upwd   = $_POST['usrpwd_new'];

        $newSql       = "UPDATE usersInfoTbl SET
                                                name      = '".$uname."',
                                                umail     = '".$umail."',
                                                passwd    = '".$upwd."',
                                                timestamp = now()
                                             WHERE usrid  = '".$usrID."'";
        $newSqlResult = mysql_query($newSql);
        if($newSqlResult)
        {
            mysql_free_result($newSqlResult);
            echo("<script>
                          alert('OK. Mod User Info successfully!');
                          window.location.href='usrsConf.php';
                  </script>");
        }
        else
        {
            mysql_free_result($newSqlResult);
            echo("<script>
                          alert('Oop. Mod User Info Failure!');
                          window.location.href='usrsMod.php';
                 </script>");
        }
    }
    mysql_close($connect);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>6G testBed</title>
        <link rel="stylesheet" type="text/css" href="css/main_01.css"/>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
       	<script src="js/mmenu/jquery-1.9.1.min.js"></script>
        <script src="js/common_js/comm.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>
    <body>
        <div id="usrBGD">
        <div style="font-family: fantasy; font-size: 16px; font-weight: bold; margin-left: 10px; color: white;">Modify User Info
        </div>
            <form method="post" name="usrInfo" id="usrInfo" style="color: white;">
            <table>
                <tr>
                    <td style="width: 180px; font-family: fantasy; font-size: 14px; font-weight: bold; color: white; padding-left: 5px;">UserID</td>
                    <td style="width: 300px; font-family: fantasy; font-size: 12px; font-weight: normal;">
                        <output name="usrID" id="usrID" for="usrID" style="width: 299px; color: white; padding-left: 5px;"><?PHP echo("$usrID");?></output>
                    </td>
                    <td style="width: 525px; font-family: fantasy; font-size: 12px; font-weight: normal; color: white; padding-left: 5px;">UserID is the identifier of user.</td>
                </tr>
                <tr>
                    <td style="width: 180px; font-family: fantasy; font-size: 14px; font-weight: bold; color: white; padding-left: 5px;">Name</td>
                    <td style="width: 300px; font-family: fantasy; font-size: 12px; font-weight: normal;">
                        <input type="text" name="uname" id="uname" style="width: 299px; color: black; padding-left: 5px;" placeholder="name" value=""/>
                    </td>
                    <td style="width: 525px; font-family: fantasy; font-size: 12px; font-weight: normal; color: white; padding-left: 5px;">Name is used by user to login to system.</td>
                </tr>
                <tr>
                    <td style="width: 180px; font-family: fantasy; font-size: 14px; font-weight: bold; color: white; padding-left: 5px;">Email</td>
                    <td style="width: 300px; font-family: fantasy; font-size: 12px; font-weight: normal;">
                        <input type="text" name="umail" id="umail" style="width: 299px; color: black; padding-left: 5px;" placeholder="email" value="Email@email.com"/>
                    </td>
                    <td style="width: 525px; font-family: fantasy; font-size: 12px; font-weight: normal; color: white; padding-left: 5px;">Your Email address</td>
                </tr>
                <tr>
                    <td style="width: 180px; font-family: fantasy; font-size: 14px; font-weight: bold; color: white; padding-left: 5px;">Password(New)</td>
                    <td style="width: 300px; font-family: fantasy; font-size: 12px; font-weight: normal;">
                        <input type="password" name="usrpwd_new" id="usrpwd_new" style="width: 299px; color: black; padding-left: 5px;" placeholder="Password" value=""/>
                    </td>
                    <td style="width: 525px; font-family: fantasy; font-size: 12px; font-weight: normal; color: white; padding-left: 5px;">Enter your password</td>
                </tr>
                <tr>
                    <td style="width: 180px; font-family: fantasy; font-size: 14px; font-weight: bold; color: white; padding-left: 5px;">Password(Confirm)</td>
                    <td style="width: 300px; font-family: fantasy; font-size: 12px; font-weight: normal;">
                        <input type="password" name="usrpwd_cnf" id="usrpwd_cnf" style="width: 299px; color: black; padding-left: 5px;" placeholder="Password" value=""/>
                    </td>
                    <td style="width: 525px; font-family: fantasy; font-size: 12px; font-weight: normal; color: white; padding-left: 5px;">Confirm your password</td>
                </tr>
            </table>
            <button type="submit" class="submitBtn" name="modSubmit" id="modSubmit" onclick="return dataCheck()" value="modSubmit">Submit</button>
            <a href="usrsConf.php"><input type="button" class="linkLeftBtn" name="linkBtn" id="linkBtn" value="Back"/></a>
            </form>
            <!--form oninput="result.value=parseInt(a.value) + parseInt(b.value)">
            <input type="range" id="b" name="b" value="50"/> + <input type="number" name="a" id="a" value="10"/>=<output name="result" for="a b" style="color: white;">60</output>
            </form-->
        </div>
    </body>
</html>

<script type="text/javascript">
var usrInfo = eval(<?PHP echo("$jsonUsrList");?>);

$(document).ready(function(){
    showLastData();
});

function showLastData()
{
    var usrID = <?PHP echo("$usrID");?>;
    
    if(usrInfo.length != 1)
    {
        alert("PHP get Data Error. Please Check it.");
        return failure;
    }
    document.getElementById("uname").value      = usrInfo[0].name;
    document.getElementById("umail").value      = usrInfo[0].umail;
    document.getElementById("usrpwd_new").value = usrInfo[0].passwd;
    document.getElementById("usrpwd_cnf").value = usrInfo[0].passwd;
}

function dataCheck()
{
    var usrName = document.getElementById("uname").value;
    var usrMail = document.getElementById("umail").value;
    var newPwd  = document.getElementById("usrpwd_new").value;
    var cnfPwd  = document.getElementById("usrpwd_cnf").value;

    if(usrName == '' || usrName == null)
    {
        alert("uname is not correct. Please check it again!");
        document.getElementById("uname").focus();
        return false;
    }

    if(!(/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/.test(usrMail)))
    {
        alert("check umail failure")
        return false;
    }

    if(newPwd == '' || newPwd == null || newPwd.length < 6)
    {
        alert("Password is not correct. Please check it again!");
        document.getElementById("usrpwd_new").focus();
        return false;
    }
    
    if(newPwd != cnfPwd)
    {
        alert("Twice Passwords are not consistent. Please check it again!");
        document.getElementById("usrpwd_cnf").focus();
        return false;
    }
    
    return true;
}

</script>

