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

    $query = "SELECT contest_name 
                FROM contest 
                    WHERE contest_id=$contest_id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $contest_name = $string.str_replace(' ', '', strtolower($row['contest_name'])); 





  $contestant_name='';
  $contestant_number='';
  $deductions='';
  $percentage='';
  $total_points='';
  $rank='';

        $tabulatedQuery = "SELECT SUM(total) AS contest_total, contestant_id, SUM(total)/(SELECT COUNT(judge_id) FROM `judge_event` 
                           WHERE `event_id`='$event_id') AS basis, first_name, sur_name, contestant_number 
                                  FROM `$contest_name` 
                                  JOIN `contestant_info_table` USING(contestant_id) 
                                  GROUP BY contestant_id 
                                  ORDER BY basis DESC;";
        $tabulatedResult = mysqli_query($connection, $tabulatedQuery) or die ("Could not match data because ".mysqli_connect_error());

                      $ranking = 0;
                      $total = 0;
                        while($rowTabulated = mysqli_fetch_assoc($tabulatedResult)){
                            if($total !=  $rowTabulated['basis']){
                                    $ranking++;
                                }
                                $total = $rowTabulated['basis'];
                                ///////////////          
                                    $contestant_id = $rowTabulated['contestant_id'];
                                    $query2 = "SELECT total*-1 AS totals FROM `$contest_name` WHERE `contestant_id`='$contestant_id' AND `judge_id`=0;";
                                    $result2 = mysqli_query($connection, $query2);
                                    $row2 = mysqli_fetch_assoc($result2);
                                    if(mysqli_affected_rows($connection)==1)
                                    {       
                                    $deductions = $row2['totals'];
                                    }else{$deductions='0';}

                                $contestant_number = $rowTabulated['contestant_number'];
                                $contestant_name = $rowTabulated['first_name']." ".$rowTabulated['sur_name'];
                                $percentage = $rowTabulated['basis'];
                                $total_points = $rowTabulated['contest_total'];
                                $rank = $ranking;

                                $queryOverall = "INSERT INTO `overall` (`increment`, `contest_id`, `contestant_id`, `contestant_number`, `contestant_name`, `deductions`, `percentage`, `total_points`, `rank`, `event_id`) VALUES (NULL, '$contest_id', '$contestant_id', '$contestant_number', '$contestant_name', '$deductions', '$percentage', '$total_points', '$rank', '$event_id')";
                                $resultOverall = mysqli_query($connection, $queryOverall) or die ("Could not match data because ".mysqli_connect_error());

                                if(mysqli_affected_rows($connection)==1)
                                { 
                                   header("Location:view_judges_scores.php?sponsor_id=$sponsor_id&username=$username&event_id=$event_id&contest_id=$contest_id");
                                }                                

                                }
?>