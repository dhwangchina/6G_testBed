<?PHP
/*********************************************
 * FileName---: login.php
 * Function---: 
 * Version----: V 0.0.1
 * Time-------: 20/11/2021
 * Author-----: Duohua(Edward) Wang
 * Email------: dhwangchina@gmail.com
 * Copyright--: All rights reserverd By Duohua(Edward) Wang
 **********************************************
 */
    session_id(SID);
    session_start();

    if(isset($_SESSION['userid']) && isset($_SESSION['password']))
    {
        $userid   = $_SESSION['userid'];
        $password = $_SESSION['password'];

        $db_conn = new mysqli('localhost','root','root','6GtestBed');
        if(mysqli_connect_errno())
        {
            echo 'Connect to database failed:'.mysqli_connect_error();
            exit();
        }
        
        //$query  = "SELECT * FROM usersInfoTbl WHERE name='".$userid."' AND passwd=sha1('".$password."')";
        $query  = "SELECT * FROM usersInfoTbl WHERE name='".$userid."' AND passwd='".$password."'";
        $result = $db_conn->query($query);
        if($result->num_rows > 0)
        {
            $_SESSION['valid_user'] = $userid;
            $url = "home.php";
        }
        else
        {
            $url = "logout.php";
        }
        
        $db_conn->close();
        echo "<meta http-equiv='refresh' content='0.1;url=$url'>";//Jump to $url in 0.1 second 
    }
    else
    {
        $url = "logout.php";
        echo "<meta http-equiv='refresh' content='0.1;url=$url'>";//Jump to $url in 0.1 second 
    }
?>