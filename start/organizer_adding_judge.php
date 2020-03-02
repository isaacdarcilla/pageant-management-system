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

$first_name = '';
$sur_name = '';
$judge_id = '';
$event_id = '';

    $event_id = $_GET['event_id'];
    $judge_id = $_GET['judge_id'];
    $sponsor_id = $_GET['sponsor_id'];
    $username = $_GET['username'];

    $querAddJudge = "SELECT *
                        FROM judge_table WHERE judge_id=$judge_id";
    $resAddJudge = mysqli_query($connection, $querAddJudge);
    $rowAddJudge = mysqli_fetch_assoc($resAddJudge);

    $querEventName = "SELECT *
                        FROM event_table
                            WHERE event_id = $event_id";
    $resEventName = mysqli_query($connection, $querEventName);
    $rowEventName = mysqli_fetch_assoc($resEventName);

    $query = "INSERT INTO `judge_event` (`increment`, `judge_id`, `event_id`, `added_by_sponsor`) VALUES (NULL, '$judge_id', '$event_id', '$sponsor_id')";
    $result = mysqli_query($connection, $query);


        $first_name = $rowAddJudge['first_name'];
        $sur_name = $rowAddJudge['sur_name'];
        $event_name = $rowEventName['event_name'];

        $event_args = $first_name.' '.$sur_name.' was selected as judge for '.$event_name;
        $status = 'Success';
        $created_at = date("M, d Y \a\\t g:i a");

        $query_logs = "INSERT INTO `event_logs` (`log_id`, `event_id`, `status`, `message`, `sponsor_id`, `created_at`) VALUES (NULL, '$event_id', '$status', '$event_args', '$sponsor_id', '$created_at')";
        $result_logs = mysqli_query($connection, $query_logs) 
        or die("Could not insert data because $query_logs".mysqli_connect_errno());



       header("Location:organizer_judge.php?sponsor_id=$sponsor_id&username=$username&event_id=$event_id");

?> 