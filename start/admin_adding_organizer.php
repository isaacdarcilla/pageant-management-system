<!--
COPYRIGHT (c) 2018 ISAAC D. ARCILLA (isaacdarcilla@gmail.com)

ALL RIGHTS RESERVED.

IF YOU COPY OR USE ALL OR ANY PORTION OF THIS SOFTWARE OR ITS USER DOCUMENTATION WITHOUT ENTERING INTO THIS AGREEMENT OR OTHERWISE OBTAINING WRITTEN PERMISSION OF ISAAC D ARCILLA, YOU ARE VIOLATING COPYRIGHT AND OTHER INTELLECTUAL PROPERTY LAW.  YOU MAY BE LIABLE TO ISAAC AND ITS LICENSORS FOR DAMAGES, AND YOU MAY BE SUBJECT TO CRIMINAL PENALTIES.
-->


<?php 
    session_start(); 
    
    include("config.php");
    
    $db_table = "user_table";    // the table that this script will set up and use.
    $db_event_table = "event_sponsor_two";
    $connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die("Could not connect to database");
    mysqli_select_db($connection,$db_name);

    $username = $_GET['username'];
    $event_id = $_GET['event_id'];
    $user_id = $_GET['user_id'];
    $sponsor_id = $_GET['sponsor_id'];

    $query = "INSERT INTO `event_sponsor_two` (`increment`, `event_id`, `sponsor_id`, `added_by`) VALUES (NULL, '$event_id', 
        '$sponsor_id', $user_id);";
    $result = mysqli_query($connection, $query)
        or die("Could not insert data because ".mysqli_connect_error());
    if(mysqli_affected_rows($connection)==1)
    { 

        //DAI GALAOG SA DATABASE (ISSUE: 1) NOT SOLVED
       header("Location:admin_add_sponsor.php?username=$username&event_id=$event_id&user_id=$user_id");
    }
?> 
