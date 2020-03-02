<!--
COPYRIGHT (c) 2018 ISAAC D. ARCILLA (isaacdarcilla@gmail.com)

ALL RIGHTS RESERVED.

IF YOU COPY OR USE ALL OR ANY PORTION OF THIS SOFTWARE OR ITS USER DOCUMENTATION WITHOUT ENTERING INTO THIS AGREEMENT OR OTHERWISE OBTAINING WRITTEN PERMISSION OF ISAAC D ARCILLA, YOU ARE VIOLATING COPYRIGHT AND OTHER INTELLECTUAL PROPERTY LAW.  YOU MAY BE LIABLE TO ISAAC AND ITS LICENSORS FOR DAMAGES, AND YOU MAY BE SUBJECT TO CRIMINAL PENALTIES.
-->


<?php 
    session_start(); 
  
  include("config.php");
  
$db_table = "user_table";    // the table that this script will set up and use.
  $db_event_table = "event_table";
   $string = "00-auto-";
    $connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die("Could not connect to database");
    mysqli_select_db($connection,$db_name);



$contest_id=$_GET['contest_id'];
$username=$_GET['username'];
$sponsor_id=$_GET['sponsor_id'];
$event_id=$_GET['event_id'];


            $query = "UPDATE `contest` SET `start` = 0 WHERE `contest`.`contest_id` = '$contest_id';";
            $result = mysqli_query($connection, $query);

              header("Location:organizer_contest.php?sponsor_id=$sponsor_id&username=$username&event_id=$event_id"); 


?>