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
  
    $connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die("Could not connect to database");
    mysqli_select_db($connection,$db_name);
  
$date_voted = date("M, d Y \a\\t g:i A");  

$event_id = $_GET['event_id'];

$contestant_id = $_GET['contestant'];

$ticket = $_GET['ticket'];

$code=$_GET['code'];


$query = "INSERT INTO `audience_votes` (`increment`, `contestant_id`, `event_id`, `votes`, `ticket_id`, `date_voted`) VALUES (NULL, '$contestant_id', '$event_id', 1, '$ticket', '$date_voted');";
$result = mysqli_query($connection, $query)

or die ("Could not update data because $query ".mysqli_connect_error());


                                   header("Location:audiences.php?code=$code&event_id=$event_id&ticket=$ticket");
                      

                                      





?>