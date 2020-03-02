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
$judge_id=$_GET['judge_id'];
$event_id=$_GET['event_id'];
$rate = $_GET['rate'];
$cui = $_GET['cui'];
$new_rate = '';

if($rate==3){
    $new_rate='I love it';
}
if($rate==2){
    $new_rate='I like it';
}
if($rate==1){
    $new_rate='I hate it';
}


        $query = "INSERT INTO `judge_rate_software` (`increment`, `judge_id`, `event_id`, `rate`, `args`, `remarks`) VALUES (NULL, '$judge_id', '$event_id', '$rate', '$username', '$new_rate')";
        $result = mysqli_query($connection, $query);

                header("Location:judge_vote_page.php?event_id=$event_id&judge_id=$judge_id&contest_id=$contest_id&username=$username&cui=$cui");


?>