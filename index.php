<?PHP
/*********************************************
 * FileName---: index.php
 * Function---: 
 * Version----: V 0.0.1
 * Time-------: 20/11/2021
 * Author-----: Duohua(Edward) Wang
 * Email------: dhwangchina@gmail.com
 * Copyright--: All rights reserverd By Duohua(Edward) Wang
 **********************************************
 */
    session_start();
    
    if(isset($_POST['userid']) && isset($_POST['password']))
    {
        $_SESSION['userid']   = $_POST['userid'];
        $_SESSION['password'] = $_POST['password'];
    }
    else
    {
        unset($_POST['userid']);
        unset($_POST['password']);
        session_destroy();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <title>6G testBed</title>
        <link rel="stylesheet" type="text/css" href="css/index.css"/>
        <style>
        .indexFootBox{
            width: 100%;
            height: 70px;
            color: white;
            background-color: #FFFC90;
            background-image: url(images/home-bg.png);
            background-repeat: repeat;
        
            text-align: center;
            padding: 0px;
            border: 1px solid #D9D9D9;
            border-left: 1px solid #D9D9D9;
            border-right: 1px solid #D9D9D9;
        }
        </style>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="js/common_js/comm.js"></script>
    </head>
    <body>
        <!----topBox------>
        <div class="topBox">
            <div id="logo">
                <img src="images/6G_logo_002.png" width="10%" height="100%" alt="" />
                <img src="images/satelite_001.png" width="20%" height="100%" style="float:right;" id="satImg"  alt=""/>
            </div>
        </div>
        <!----mainBox------>
        <div class="mainBox">
        <h3 style="color: white;">Welcome to 6G Testbed</h3>
        <?PHP
            if(isset($_SESSION['userid']) && isset($_SESSION['password']))
            {
                $url = "login.php";
                echo "<meta http-equiv='refresh' content='0.1;url=$url'>";
            }
            else
            {
                if(isset($_SESSION['$userid']))
                {
                    echo '<p style="color:white">Could not log you in.</p>';
                }
                else
                {
                    echo '<p style="color:white">You are not logged in.</p>';
                }
                
                echo '<form action="index.php" method="post">';
                echo '<fieldset>';
                echo '<legend style="color:white">Login Now!</legend>';
                echo '<p><label for="userid" style="color:white">UserID:</label>';
                echo '<input type="text" name="userid" id="userid" size="40"/></p><br/>';
                echo '<p><label for="password" style="color:white">Password:</label>';
                echo '<input type="password" name="password" id="password" size="40"/></p><br/>';
                echo '</fieldset>';
                echo '<button type="submit" style="color=white; margin-left:758px" name="login">Login</button>';
                echo '</form>';
            }
        ?>
        </div>
        <!----footBox------>
        <div class="indexFootBox">
            <footer><h4>All Rights Reserved &copy;2021-2022</h4></footer>
        </div>
        
    </body>
</html>
