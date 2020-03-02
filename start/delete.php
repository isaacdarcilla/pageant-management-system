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
$i = $_GET['i'];

    $query = "SELECT contest_name 
                FROM contest 
                    WHERE contest_id=$contest_id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $contest_name = $string.str_replace(' ', '', strtolower($row['contest_name'])); 


        $query = "DELETE FROM `$contest_name` 
                    WHERE increment='$i';";
        $result = mysqli_query($connection, $query);

              $event_args = 'Individual score was deleted from contestant in '.$row['contest_name'];
              $status = 'Removed';
              $created_at = date("M, d Y \a\\t g:i a");

              $query_logs = "INSERT INTO `event_logs` (`log_id`, `event_id`, `status`, `message`, `sponsor_id`, `created_at`) VALUES (NULL, '$event_id', '$status', '$event_args', '$sponsor_id', '$created_at')";
              $result_logs = mysqli_query($connection, $query_logs) 
              or die("Could not insert data because $query_logs".mysqli_connect_errno());

                header("Location:view_judges_scores.php?sponsor_id=$sponsor_id&username=$username&event_id=$event_id&contest_id=$contest_id");


?>