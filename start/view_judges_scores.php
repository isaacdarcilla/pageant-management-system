<!--
COPYRIGHT (c) 2018 ISAAC D. ARCILLA (isaacdarcilla@gmail.com)

ALL RIGHTS RESERVED.

IF YOU COPY OR USE ALL OR ANY PORTION OF THIS SOFTWARE OR ITS USER DOCUMENTATION WITHOUT ENTERING INTO THIS AGREEMENT OR OTHERWISE OBTAINING WRITTEN PERMISSION OF ISAAC D ARCILLA, YOU ARE VIOLATING COPYRIGHT AND OTHER INTELLECTUAL PROPERTY LAW.  YOU MAY BE LIABLE TO ISAAC AND ITS LICENSORS FOR DAMAGES, AND YOU MAY BE SUBJECT TO CRIMINAL PENALTIES.
-->


<?php 
    session_start(); 
  
  include("config.php");
  
  $search = '';
$db_table = "user_table";    // the table that this script will set up and use.
  $db_event_table = "event_table";
  
  $string = "00-auto-";
    $connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die("Could not connect to database");
    mysqli_select_db($connection,$db_name);

  $print ='';

$sponsor_id = $_GET['sponsor_id'];

$username = $_GET['username'];

$event_id = $_GET['event_id'];

$contest_id = $_GET['contest_id'];

$string = "00-auto-";

    $query = "SELECT contest_name 
                FROM contest 
                    WHERE contest_id=$contest_id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $contest_name = $string.str_replace(' ', '', strtolower($row['contest_name']));  


  $queryUser = "SELECT username 
                        FROM sponsor_organizer 
                            WHERE username = '$sponsor_id';";
        $resultUser = mysqli_query($connection, $queryUser);
        $rowUser = mysqli_fetch_assoc($resultUser); 

 $querSponsorName = "SELECT sponsor_name 
                            FROM sponsor_organizer
                                WHERE sponsor_id=$sponsor_id";
    $resSponsorName= mysqli_query($connection, $querSponsorName);
    $rowSponsorName = mysqli_fetch_assoc($resSponsorName); 

    $querStatus = "SELECT contest_id AS status FROM overall WHERE event_id=$event_id AND contest_id=$contest_id";
    $resStatus = mysqli_query($connection, $querStatus);
    $rowStatus = mysqli_fetch_assoc($resStatus);
    $status = (($rowStatus['status']!=0)?'submitted':'');

    $querEvents = "SELECT *
                        FROM event_table 
                            JOIN (SELECT event_id FROM event_sponsor_two WHERE sponsor_id=$sponsor_id) AS sponsorship USING (event_id) ";
    $resEvents = mysqli_query($connection, $querEvents);

    $querEventName = "SELECT *
                        FROM event_table
                            WHERE event_id = $event_id";
    $resEventName = mysqli_query($connection, $querEventName);
    $rowEventName = mysqli_fetch_assoc($resEventName);


    $querAddJudge = "SELECT *
                        FROM judge_table WHERE registered_by_sponsor=$sponsor_id";
    $resAddJudge = mysqli_query($connection, $querAddJudge);

    $count = "SELECT COUNT(*) AS _number FROM judge_table WHERE registered_by_sponsor = $sponsor_id";
    $resCount = mysqli_query($connection, $count);
    $rowCount = mysqli_fetch_assoc($resCount); 


              $querContest = "SELECT *
                        FROM contest 
                            WHERE contest_id = $contest_id";
              $resContest = mysqli_query($connection, $querContest);
              $rowContest = mysqli_fetch_assoc($resContest);
              

    $querJudge = "SELECT *
                    FROM judge_table JOIN (SELECT judge_id FROM judge_event WHERE event_id=$event_id) AS judges USING(judge_id)";
    $resJudge = mysqli_query($connection, $querJudge); 

    $querContestant = "SELECT *
                    FROM contestant_info_table WHERE event_id_sponsor = $event_id";
    $resContestant = mysqli_query($connection, $querContestant); 

   // $querjudgeSystem = "SELECT judging_system  
     //                     FROM event_table WHERE event_id=$event_id";
    //$resjudgeSystem = mysqli_query($connection, $querjudgeSystem);
    //$rowjudgeSystem = mysqli_fetch_assoc($resjudgeSystem);
    //$order = ($rowjudgeSystem['judging_system']==0?'DESC':($rowjudgeSystem['judging_system']==1?'ASC':''));

       

if(isset($_POST['submit_contest_scores'])){


        $tabulatedQuery = "SELECT SUM(total) AS contest_total, SUM(rank) AS rank_basis, contestant_id, first_name, sur_name, contestant_number 
                    FROM `$contest_name` JOIN `contestant_info_table` USING(contestant_id) 
                        WHERE `event_id`='$event_id' GROUP BY contestant_id ORDER BY rank_basis ASC;";
        $tabulatedResult = mysqli_query($connection, $tabulatedQuery);
        
                  


                      $rank = 0;
                      $total = 0;
                        while($rowTabulated = mysqli_fetch_assoc($tabulatedResult)){
                            if($total !=  $rowTabulated['rank_basis']){
                                    $rank++;
                                }
                                $total = $rowTabulated['rank_basis'];    

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
                                $ranking2 = $rowTabulated['rank_basis'];
                                $total_points = $rowTabulated['contest_total'];
                                                           

                                $queryOverall = "INSERT INTO `overall` (`increment`, `contest_id`, `contestant_id`, `contestant_number`, `contestant_name`, `deductions`, `percentage`, `total_points`, `rank`, `event_id`) VALUES (NULL, '$contest_id', '$contestant_id', '$contestant_number', '$contestant_name', '$deductions', '$ranking2', '$total_points', '$rank', '$event_id')";

                                $resultOverall = mysqli_query($connection, $queryOverall) or die ("Could not match data because ".mysqli_connect_error());


              $event_args = 'Overall scores for '.$rowEventName['event_name'].' was submitted';
              $status = 'Success';
              $created_at = date("M, d Y \a\\t g:i a");

              $query_logs = "INSERT INTO `event_logs` (`log_id`, `event_id`, `status`, `message`, `sponsor_id`, `created_at`) VALUES (NULL, '$event_id', '$status', '$event_args', '$sponsor_id', '$created_at')";
              $result_logs = mysqli_query($connection, $query_logs) 
              or die("Could not insert data because $query_logs".mysqli_connect_errno());

                                if(mysqli_affected_rows($connection)==1)
                                { 

                                   header("Location:view_judges_scores.php?sponsor_id=$sponsor_id&username=$username&event_id=$event_id&contest_id=$contest_id");
                                }                                

                                }

}


    if(isset($_POST['query']))
    {
        $search = $_POST['search'];
    }

    $querAddJudge = "SELECT contestant_id, first_name, event_id, sur_name 
                        FROM (SELECT contestant_id, CONCAT(first_name, ' ', last_name) AS name FROM contestant_info_table WHERE (first_name LIKE '%$search%' OR sur_name LIKE '%$search%') AND contestant_id != 0) as result 
                             USING(contestant_id)
                                ORDER BY name";
    $resAddJudge = mysqli_query($connection, $querAddJudge);



  ?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>ePageant Management System | (isaacdarcilla)</title>
  <meta name="description" content="Admin, Dashboard, Bootstrap, Bootstrap 4, Angular, AngularJS" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="../assets/images/logo.png">
  <meta name="apple-mobile-web-app-title" content="Flatkit">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
 
  
   <!-- style -->
  <link rel="stylesheet" href="../assets/animate.css/animate.min.css" type="text/css" />
  <link rel="stylesheet" href="../assets/glyphicons/glyphicons.css" type="text/css" />
  <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../assets/material-design-icons/material-design-icons.css" type="text/css" />

  <link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
  <!-- build:css ../assets/styles/app.min.css -->
  <link rel="stylesheet" href="../assets/styles/app.css" type="text/css" />
  <!-- endbuild -->
  <link rel="stylesheet" href="../assets/styles/font.css" type="text/css" />
</head>
<body>
  <div class="app" id="app">

<!-- ############ LAYOUT START-->

  <!-- aside -->
  <div id="aside" class="app-aside modal fade nav-dropdown">
    <!-- fluid app aside -->
    <div class="left navside dark dk" layout="column">
      <div class="navbar no-radius">
        <!-- brand -->
        <a class="navbar-brand">
          
          <img src="../assets/images/logo.png" alt="." class="hide">
          <span class="hidden-folded inline">My Dashboard</span>
        </a>
        <!-- / brand -->
      </div>
      <div flex class="hide-scroll">
          <nav class="scroll nav-light">
            
              <ul class="nav" ui-nav>
                <li class="nav-header hidden-folded">
                  <small class="text-muted">Main</small>
                </li>
                
                <li>
                  <a href="organizer.php?username=<?php echo $username ?>&sponsor_id=<?php echo $sponsor_id ?>&event_id=<?php echo($event_id) ?>" >
                    <span class="nav-icon">
                      <i class="material-icons">
                        <span class="fa fa-bookmark"></span>
                      </i>
                    </span>
                    <span class="nav-text">Dashboard</span>
                  </a>
                </li>
     
            

            
                <li class="nav-header hidden-folded">
                  <small class="text-muted">Event</small>
                </li>
            
                <li>
                  <a>
                    <span class="nav-caret">
                      <i class="fa fa-caret-down"></i>
                    </span>

                    <span class="nav-icon">
                      <i class="material-icons">
                        <span class="fa fa-flag"></span>
                      </i>
                    </span>
                    <span class="nav-text active">Manage Event</span>
                  </a>
                  <ul class="nav-sub nav-mega nav-mega-3">
                    <li>
                      <a href="organizer_judge.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>" >
                        <span class="nav-text">Judges</span>
                      </a>
                    </li>
                    <li>
                      <a href="organizer_contest.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>" >
                        <span class="nav-text">Contest & Criteria</span>
                      </a>
                    </li>

                    <li>
                      <a href="organizer_contestant.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>" >
                        <span class="nav-text">Contestant</span>
                      </a>
                    </li>
   
                    <li>
                      <a href="organizer_event_details.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>" >
                        <span class="nav-text">Event Details</span>
                      </a>
                    </li>

                  </ul>
                </li>
          
            
                <li>

                  <ul class="nav-sub">
                  
                  </ul>
                </li>
            
 
                <li>
                  <a>
                    <span class="nav-caret">
                      <i class="fa fa-caret-down"></i>
                    </span>
                    <span class="nav-label hidden-folded">
                      
                    </span>
                    <span class="nav-icon">
                      <i class="material-icons">
                        <span class="fa fa-rss"></span>
                      </i>
                    </span>
                    <span class="nav-text">Projector</span>
                  </a>
                  <ul class="nav-sub">
     
                    <li>
                      <a>
                        <span class="nav-text">Statistics</span>
                      </a>
                    </li>
                  </ul>
                </li>
            
                <li class="nav-header hidden-folded">
                  <small class="text-muted">Help</small>
                </li>
                
                    <li>
                      <a href="faq.php" >
                                         <span class="nav-icon">
                      <i class="material-icons">
                        <span class="fa fa-info"></span>
                      </i>
                    </span>
                        <span class="nav-text">FAQ</span>
                      </a>
                    </li>
                <li class="hidden-folded" >
                  <a href="docs.html" >
                                     <span class="nav-icon">
                      <i class="material-icons">
                        <span class="fa fa-cogs"></span>
                      </i>
                    </span>
                    <span class="nav-text">Documents</span>
                  </a>
                </li>
                <li class="nav-header hidden-folded">
                  <small class="text-muted">Monitor</small>
                </li>
                
                    <li>
                      <a href="faq.php" >
                                         <span class="nav-icon">
                      <i class="material-icons">
                        <span class="fa fa-rss-square"></span>
                      </i>
                    </span>
                        <span class="nav-text">Activity Logs</span>
                      </a>
                    </li>
            
              </ul>
          </nav>
      </div>
      <div flex-no-shrink class="b-t">
        <div class="nav-fold">
          <a href="">
              <span class="pull-left">
                <img src="assets/avatar.png" alt="..." class="w-40 img-circle">
              </span>
              <span class="clear hidden-folded p-x">
        <?php
        include "config.php";
        $user = "Isaac D Arcilla";
        
        ?>
        
                <span class="block _700">
         <h4> <?php


          echo $username;
          ?>
          </h4>
          </span>
                <small class="block text-muted"><i class="fa fa-circle text-success m-r-sm"></i>online</small>
              </span>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- / -->

  <!-- content -->
  <div id="content" class="app-content box-shadow-z0" role="main">


 

    <div class="app-footer">
      <div class="p-a text-xs">
        <div class="pull-right text-muted">
          &copy; Copyright <strong>2018 Isaac D. Arcilla</strong> <span class="hidden-xs-down"></span>
          <a ui-scroll-to="content"><i class="fa fa-long-arrow-up p-x-sm"></i></a>
        </div>
        <div class="nav">
          <a class="nav-link" href="../">About</a>
          <span class="text-muted">-</span>
            <a class="nav-link" href="../">Help</a>                 <span class="text-muted">-</span>
            <a class="nav-link" href="../">Logout<?php  session_destroy();  ?></a>   
    

      </div>
      </div>

    </div>
 

<!-- ############ PAGE START-->
<div class="p-a white lt box-shadow">
  <div class="row">
    <div class="col-sm-6">
      <h4 class="m-b-0 _300">Welcome, <?php echo $rowSponsorName['sponsor_name'] ?>!</h4>
      <small class="text-muted">Organize <strong></strong> your pageant event with ease</small>
    </div>
    <div class="col-sm-6 text-sm-right">
      <div class="m-y-sm">
        <span class="m-r-sm">Manage Scoring</span>
        <div class="btn-group dropdown">
              <button class="btn white btn-sm ">View</button>
              <button class="btn white btn-sm dropdown-toggle" data-toggle="dropdown"></button>
              <div class="dropdown-menu dropdown-menu-scale pull-right">
                <a class="dropdown-item"  data-toggle="modal" data-target="#m-md">View Score of Contestants</a>
 
                <a class="dropdown-item text-warning" href="organizer_overall.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>&contest_id=<?php echo $rowContest['contest_id']?>">View Overall Results</a>
                <div class="dropdown-divider"></div>
                 <a class="dropdown-item" href="contest.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>&contest_id=<?php echo $rowContest['contest_id']?>" >View Contest Statistics</a>                           
              </div>
            </div>
          </div>
    </div>     
  </div>
</div>

<div id="m-md" class="modal" data-backdrop="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header dark">
        <h5 class="modal-title">Individual Contestant Scores</h5>
      </div>
            <div class="box-tool">
            <ul class="nav">
              <li class="nav-item inline dropdown">
                <p class=""></p>
              </li>
              <li class="nav-item inline dropdown">
                    <a   class="btn btn-xs pull-right" ><i style="font-size: 15px; color: white;" class="fa fa-close" data-dismiss="modal"></i></a>
              </li>
            </ul>
          </div>      
      <div class="body">
 <?php
    while($rowContestant = mysqli_fetch_assoc($resContestant)){
      $contestant_id = $rowContestant['contestant_id'];
      $contestant_code = $rowContestant['contestant_code'];      
      $cui = $rowContestant['username'];
 ?>       
<script type="text/javascript">
  $('#printFab').click(function(){
  $('#hideFab').hide();}
</script>

 <script type="text/javascript">
function <?php echo $cui ?>(){
    var divElements = document.getElementById('printDataHolder<?php echo $contestant_code?>').innerHTML;
    var oldPage = document.body.innerHTML;
    document.body.innerHTML="<link rel='stylesheet' href='css/common.css' type='text/css' /><body class='bodytext'><div class='padding'><b style='font-size: 16px;'><p class=''>ePageant Management System</p></b></div>"+divElements+"</body>";
    window.print();
    document.body.innerHTML = oldPage;
    }

</script>


<div class="col-md-13">
      <div class="box" id="printDataHolder<?php echo $contestant_code?>">
        <div class="box-header">
          <h2>Contestant #<?php echo $rowContestant['contestant_number'] ?> <b><?php echo $rowContestant['first_name'] ?> <?php echo $rowContestant['sur_name'] ?></b></h2>
          <small>
            Individual contestant scores generated on <b><?php print date("m/d/y", time());?></b> by <b><?php echo strtoupper($username) ?></b><small>Digital signature<span>&nbsp<code><?php echo sha1($rowContestant['contestant_code']) ?></code></span></small>

          </small>
            <div class="box-tool" id="hideFab">
            <ul class="nav">
              <li class="nav-item inline dropdown">
                <p class=""></p>
              </li>
              <li class="nav-item inline dropdown">
                    <a   class="btn btn-xs pull-right" id="printFab"><i class="fa fa-print hidden-print" onclick="<?php echo $rowContestant['username']?>();"></i></a>
              </li>
            </ul>
          </div>           
        </div>
        <table class="table table-bordered table-hover b-t">
          <thead>
            <tr>
              <th class="text-warning dker">Judge</th>
              <th class="text-warning dker">Contest</th>
                            <?php
                                $numOfCri=0;
                                $querCri = "SELECT * FROM criteria_of_judging
                                                JOIN (SELECT criteria_id, percentage FROM criteria_and_contest WHERE contest_id='$contest_id') AS criteria_judging USING(criteria_id)"; //get criteria each contest
                                $resCri = mysqli_query($connection, $querCri);
                                while($rowCri = mysqli_fetch_assoc($resCri))
                                {
                            ?>
                            <th class="text-warning dker"> <?php echo $rowCri['criterias'] ?> <?php echo $rowCri['percentage']  ?>%</th>
                            <?php
                                     $criIDs[$numOfCri] = $rowCri['criteria_id'];
                                    $numOfCri++;   
                                } 
                            ?> 
              <th class="text-warning dker">Total</th>
              <th class="text-warning dker">Rank</th>              
            </tr>
          </thead>
          <tbody>
                        <?php  
                            $querScores2 = "SELECT * FROM `judge_table`
                                                    JOIN (SELECT * FROM `$contest_name` WHERE `contestant_id`='$contestant_id') AS score USING(judge_id)";
                            $resScores2 = mysqli_query($connection, $querScores2);
                            $contest = "SELECT contest_name FROM contest WHERE contest_id = $contest_id";
                            $resContest = mysqli_query($connection, $contest);
                            $rowContest = mysqli_fetch_assoc($resContest);
                            while($rowScores = mysqli_fetch_assoc($resScores2)){ 

                        ?>

            <tr>
              <td><?php echo $rowScores['first_name'] ?> <?php echo $rowScores['sur_name'] ?></td>
              <td><?php echo $rowContest['contest_name'] ?></td>                        
                            <?php                                                 
                            for($counter=0; $counter<$numOfCri; $counter++){ 
                                $criterion = 'criterion'.$criIDs[$counter];
                            ?>
              <td><?php echo $rowScores[$criterion] ?></td>
                            <?php
                                }   
                            ?>       
              <td class="text-warning dker"><?php echo $rowScores['total'] ?></td>
            <!--  <td><?php echo $rowScores['deduction'] ?></td>   -->
              <td class="text-warning dker"><?php echo $rowScores['rank'] ?></td>    

            </tr>

                        <?php
                            }
                        ?>    
           <tr>
              <th class="text-warning dker"><b>Total</b></th>
              <th class="text-warning dker"></th>
                            <?php
                                $numOfCri=0;
                                $querCri = "SELECT * FROM criteria_of_judging
                                                JOIN (SELECT criteria_id, percentage FROM criteria_and_contest WHERE contest_id='$contest_id') AS criteria_judging USING(criteria_id)"; //get criteria each contest
                                $resCri = mysqli_query($connection, $querCri);
                                while($rowCri = mysqli_fetch_assoc($resCri))
                                {
                            ?>
                            <th class="text-warning dker"></th>
                            <?php
                                     $criIDs[$numOfCri] = $rowCri['criteria_id'];
                                    $numOfCri++;   
                                } 
                            ?> 
               <?php
                  $tabulated = "SELECT SUM(total) AS contest_total, SUM(rank) AS ranking 
                    FROM `$contest_name` JOIN `contestant_info_table` USING(contestant_id) 
                        WHERE `contestant_id`='$contestant_id'";
                  $resTab = mysqli_query($connection, $tabulated);
                  while($myTab = mysqli_fetch_assoc($resTab)){
                ?>
               

              <th class="warning"><?php echo $myTab['contest_total'] ?></th>
              <th class="warning"><?php echo $myTab['ranking'] ?></th>     
              <?php } ?>         
            </tr>
          </tbody>
        </table>
<?php 
                            $querScores = "SELECT in_charge FROM sponsor_organizer WHERE sponsor_id = $sponsor_id";
                            $resScores = mysqli_query($connection, $querScores);
                           $rowScores = mysqli_fetch_assoc($resScores);
?>   
        <span class="text-center pull-right" style="padding-top: 30px;">Checked by <b>ISAAC ARCILLA</b><br><br>Noted by <b><?php echo strtoupper($rowScores['in_charge'])?></b></span>

      </div>
    </div>
   <?php } ?>     
      </div>

    </div><!-- /.modal-content -->
  </div>
</div>
<!-- / .modal -->

   
  <div>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="30" height="30" style="position:fixed; z-index:0; left:50%; top: 20%" class="animated fadeInDownBig">
        <path d="M 48 0 L 24 48 L 0 0 Z" fill="rgba(0,0,0,0.05)" />
      </svg>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="10" height="10" style="position:fixed; z-index:0; left:49%; top: 15%" class="animated fadeInDown">
        <path d="M 48 0 L 24 48 L 0 0 Z" fill="#a88add" />
      </svg>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="5" height="5" style="position:fixed; z-index:0; left:30%; top: 0%" class="animated fadeInDown">
        <path d="M 48 0 L 24 48 L 0 0 Z" fill="#a88add" />
      </svg>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="20" height="20" style="position:fixed; z-index:0; right:5%; top: 30%" class="animated fadeInDown">
        <path d="M 48 0 L 24 48 L 0 0 Z" fill="#0cc2aa" />
      </svg>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="15" height="15" style="position:fixed; z-index:0; left:34.5%; top: 55%" class="animated fadeIn">
        <path d="M 0 48 L 24 0 L 48 48 Z" fill="#fcc100" />
      </svg>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="200" height="200" style="position:fixed; z-index:0; right:20%; top: 70%" class="animated fadeInUp">
        <path d="M 0 48 L 24 0 L 48 48 Z" fill="rgba(252,193,0,0.1)" />
      </svg>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="120" height="120" style="position:fixed; z-index:0; left:0%; top: 30%" class="animated fadeInLeftBig">
        <path d="M 0 48 L 48 24 L 0 0 Z" fill="rgba(0,0,0,0.03)" />
      </svg>
  </div>
<div class="padding">
      <div class="container ">

             <a style="font-size: 15px;" href="organizer_contest.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>"><span class="fa fa-chevron-left"></span></a>&nbsp&nbspGo back      
    <h2 class="display-3 _700 l-s-n-3x m-t-lg m-b-md"><span class="text-primary"><center>Judges Scores</center></span>
     
    <!--      <div class="col-md-8" style="padding-left: 380px; padding-top: 28px;">
         <button type="submit"  name="submit_over_all" class="btn rounded white btn-block"><a href="organizer_overall.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>&contest_id=<?php echo $rowContest['contest_id']?>">View Overall Result</a></button>-->
       </div>
    </h2>

        <div class="row m-y-lg">
<!--  <form action="#8bdca1674961121a55ac330e734a24ea" method="post" class="col-sm-12" style="padding-bottom: 20px;">
    <div class="input-group input-group-lg">
      <input type="search" class="form-control" name="search" placeholder="Type first name">
      <span class="input-group-btn">
        <button class="btn b-a no-shadow white" type="submit" name="query">Search</button>
      </span>
    </div>
  </form> 
  <p class="m-b-md" style="padding-left: 15px;">Results found for: <strong><?php  echo $search ?></strong></p>-->
    <div class="col-sm-12">
                          <?php
            while($rowJudge = mysqli_fetch_assoc($resJudge)){
                $judge_id = $rowJudge['judge_id'];
                $named = $rowJudge['first_name'];
                $inc = $rowJudge['username'];                
                $strings = $named;
        ?> 

<script type="text/javascript">
function <?php echo $inc ?>(){
    var divElements = document.getElementById('printDataHolder<?php echo $judge_id?>').innerHTML;
    var oldPage = document.body.innerHTML;
    document.body.innerHTML="<link rel='stylesheet' href='css/common.css' type='text/css' /><body class='bodytext'><div class='padding'><b style='font-size: 16px;'><p class=''>ePageant Management System</p></b></div>"+divElements+"</body>";
    window.print();
    document.body.innerHTML = oldPage;
    }
</script>

      <div class="box" id="printDataHolder<?php echo $judge_id?>">


        <div class="box-header">
          <h2 style="font-size: 25px;">Judged by&nbsp<strong><?php echo $rowJudge['first_name']?>&nbsp<?php echo $rowJudge['sur_name']?></strong>&nbsp  </h2>
         <small style="">Individual scores for <strong><?php echo $rowContest['contest_name']?></strong> generated on <b><?php print date("m/d/y", time());?></b> by <b><?php echo strtoupper($username) ?></b></small><small>Digital signature<span>&nbsp<code><?php echo sha1($rowJudge['is_unhash']) ?></code></span></small>         

      
            <div class="box-tool">
            <ul class="nav">
              <li class="nav-item inline dropdown">
                <p class=""></p>
              </li>
              <li class="nav-item inline dropdown">
                    <a   class="btn btn-xs pull-right" ><i class="fa fa-print hidden-print" onclick="<?php echo $rowJudge['username']?>();"></i></a>
              </li>
            </ul>
          </div>          
        </div>
        <table class="table table-bordered table-hover">
          <thead>
            <tr class="text-warning">
              <th class="dker">Number</th>
              <th class="dker">Contestant Name</th>
                            <?php
                                $numOfCri=0;
                                $querCri = "SELECT * FROM criteria_of_judging
                                                JOIN (SELECT criteria_id, percentage FROM criteria_and_contest WHERE contest_id='$contest_id') AS criteria_judging USING(criteria_id)"; //get criteria each contest
                                $resCri = mysqli_query($connection, $querCri);
                                while($rowCri = mysqli_fetch_assoc($resCri))
                                {
                            ?>
                            <th class="dker"> <?php echo $rowCri['criterias'] ?> <?php echo $rowCri['percentage']  ?>%</th>
                            <?php
                                     $criIDs[$numOfCri] = $rowCri['criteria_id'];
                                    $numOfCri++;   
                                } 
                            ?>              
              <th class="dker">Total</th>
              <!--<th>Deductions</th>-->
              <th class="dker">Rank</th>
            </tr>
          </thead>
          <tbody>
                        <?php  
                            $querScores = "SELECT * FROM `contestant_info_table`
                                                    JOIN (SELECT * FROM `$contest_name` WHERE `judge_id`='$judge_id') AS score USING(contestant_id)";
                            $resScores = mysqli_query($connection, $querScores);
                            while($rowScores = mysqli_fetch_assoc($resScores)){ 
                             // $deleteScore = $rowScores['increment'];
                        ?>

            <tr>
              <td><a class="fa fa-circle text-primary" data-toggle="modal" data-target="#m-a-a-<?php echo $rowScores['increment'] ?>" ui-toggle-class="zoom" style="font-size: 10px;"></a>&nbsp&nbsp<?php echo $rowScores['contestant_number'] ?></td>
              <td><?php echo $rowScores['first_name'] ?>&nbsp<?php echo $rowScores['sur_name'] ?></td>
                            <?php                                                 
                            for($counter=0; $counter<$numOfCri; $counter++){ 
                                $criterion = 'criterion'.$criIDs[$counter];
                            ?>
              <td><?php echo $rowScores[$criterion] ?></td>
                            <?php
                                }   
                            ?>  



 <div style="padding-top: 0px;" id="m-a-a-<?php echo $rowScores['increment'] ?>" class="modal fade animate" data-backdrop="true">
  <div class="modal-dialog" id="animate">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="font-size: 16px;">Remove</h5>
      </div>
      <div class="modal-body text-center p-lg ">
        <p style="font-size: 20px;">Are you sure you want to remove this score for <b><?php echo $rowScores['first_name'] ?>&nbsp<?php echo $rowScores['sur_name'] ?></b>?</p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn dark-white rounded" data-dismiss="modal">No</button>
        <button type="button" class="btn warning rounded" ><a href="delete.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>&contest_id=<?php echo $contest_id?>&i=<?php echo $rowScores['increment']?>">Yes</a></button>
      </div> 
     
    </div><!-- /.modal-content -->
  </div>
</div>


              <td class="text-warning dker" ><?php echo $rowScores['total'] ?></td>
            <!--  <td><?php echo $rowScores['deduction'] ?></td>   -->
              <td class="text-warning dker"><?php echo $rowScores['rank'] ?></td> 

            </tr>
                        <?php
                            }
                        ?>          
          </tbody>
        </table>
 
<?php 
                            $querScores = "SELECT in_charge FROM sponsor_organizer WHERE sponsor_id = $sponsor_id";
                            $resScores = mysqli_query($connection, $querScores);
                           $rowScores = mysqli_fetch_assoc($resScores);
?> 
<div>
  <p>

        <span class="pull-right" style="padding-top: 30px">Checked by <b>ISAAC ARCILLA</b><br><br>Noted by <b><?php echo strtoupper($rowScores['in_charge'])?></b></span>
</p>  
</div>    
      </div>
    <?php } ?>



<!--#############################################################################-->
<script type="text/javascript">
function printPage(){
    var divElements = document.getElementById('printDataHolder').innerHTML;
    var oldPage = document.body.innerHTML;
    document.body.innerHTML="<link rel='stylesheet' href='css/common.css' type='text/css' /><body class='bodytext'><div class='padding'><b style='font-size: 16px;'><p class=''>ePageant Management System</p></b></div>"+divElements+"</body>";
    window.print();
    document.body.innerHTML = oldPage;
    }
</script>

        <div class="box" id="printDataHolder" >
        <div class="box-header">
          <h2 style="font-size: 25px;">Overall Score & Rank for&nbsp<strong><?php echo $rowContest['contest_name']?></strong>&nbsp  </h2>
         <small style="">Overall scores for <strong><?php echo $rowContest['contest_name']?></strong> generated on <b><?php print date("m/d/y", time());?></b> by <b><?php echo strtoupper($username) ?></b></strong></small><small>Digital signature<span>&nbsp<code><?php echo sha1($username) ?></code></span></small>          
      
            <div class="box-tool">
            <ul class="nav">
              <li class="nav-item inline dropdown">
                <p class=""></p>
              </li>
              <li class="nav-item inline dropdown">
 
                <a class="nav-link" data-toggle="dropdown">
                  <i class="material-icons md-18">&#xe5cf;</i>
                </a>
                <div class="dropdown-menu dropdown-menu-scale pull-right">

                        <?php  



                        
                            $querScores = "SELECT * FROM `contestant_info_table`
                                                    WHERE event_id_sponsor=$event_id";
                            $resScores = mysqli_query($connection, $querScores);
                            while($rowScores = mysqli_fetch_assoc($resScores)){ 

                        ?>
                      <a class="dropdown-item text-danger" href="organizer_deduct_scores.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>&contest_id=<?php echo $rowContest['contest_id']?>&contestant_id=<?php echo $rowScores['contestant_id']?>"><span class="fa fa-minus-circle"></span>&nbsp Deduct Scores For <?php echo $rowScores['first_name']?> </a>
                    <?php } ?>

                </div>
              </li>
            </ul>
          </div>          
        </div>
        <table class="table table-bordered table-hover">
          <thead>
            <tr class="text-warning">
              <th>Number</th>
              <th>Contestant Name</th>          
              <th>Deductions</th>

              <th>Total Points</th>       
              <th>Total Rank</th>                     
              <th><b>Final Ranking</b></th>
            </tr>
          </thead>
          <tbody>
<?php

        $tabulatedQuery = "SELECT SUM(total) AS contest_total, SUM(rank) AS rank_basis, contestant_id, first_name, sur_name, contestant_number 
                    FROM `$contest_name` JOIN `contestant_info_table` USING(contestant_id) 
                        WHERE `event_id`='$event_id' GROUP BY contestant_id ORDER BY rank_basis ASC;";
        $tabulatedResult = mysqli_query($connection, $tabulatedQuery);
        
                  


                      $rank = 0;
                      $total = 0;
                        while($rowTabulated = mysqli_fetch_assoc($tabulatedResult)){
                            if($total !=  $rowTabulated['rank_basis']){
                                    $rank++;
                                }
                                $total = $rowTabulated['rank_basis'];       

?>
            <tr>
              <td><?php echo $rowTabulated['contestant_number']?></td>
              <td><?php echo $rowTabulated['first_name']?>&nbsp<?php echo $rowTabulated['sur_name']?></td>
                         <?php 
                            $contestant_id = $rowTabulated['contestant_id'];
                            $query2 = "SELECT total*-1 AS totals FROM `$contest_name` WHERE `contestant_id`='$contestant_id' AND `judge_id`=0;";
                            $result2 = mysqli_query($connection, $query2);
                            $row2 = mysqli_fetch_assoc($result2);
                            if(mysqli_affected_rows($connection)==1)
                            {        
                        ?>
              <td><?php echo $row2['totals']?></td> 
                        <?php        
                            }
                            else
                            {
                        ?>
                        <td> 0 </td>
                        <?php 
                            } 
                        ?>           
              <td class=""><?php echo $rowTabulated['contest_total']?></td>  
              <td class="text-warning"><?php echo $rowTabulated['rank_basis']?></td>

 <?php 
    if($rank==1){
 ?>
              <td class="text-warning"><b><?php echo $rank?><span class="text-primary pull-right fa fa-caret-up"></span></b></td>   
 <?php }else{ ?>
 
              <td class="text-warning"><b><?php echo $rank?><span class="text-danger pull-right fa fa-caret-down"></span></b></td> 
 <?php } ?>                                   
            </tr>        
<?php 
} 
?>
          </tbody>
        

        </table>
          

      </div>

                    <a   class="btn btn-xs pull-right" onclick="printPage();"><i class="fa fa-print " ></i>&nbsp Print Overall</a>
    </div>



            <?php 
                if($status != 'submitted')
                {
            ?>
        <form name="form" class="form-group column" action="" ui-jp="parsley" method="post">
          <br><br><br>
              <div class="col-sm-8" style="padding-left: 360px; ">
                <input type="text"  name="user" class="form-control rounded" data-parsley-equalto="<?php echo $username?>" maxlength="25" required="true" placeholder="Type your username for confirmation">    
              </div>           
          <div class="col-md-8" style="padding-left: 360px; padding-top: 10px;">
         <button type="submit"  name="submit_contest_scores" class="btn rounded white btn-block">Submit Overall Scores</button>
       </div>

        </form>
      <?php }else{?><br><br><br>
       <center style="padding-top: 28px;"><h3><span style="font-size: 18px;" class="text-warning">Scores for <b><?php echo $rowContest['contest_name']?></b> was already submitted</span></h3></center>
      <?php } ?>

</div>
  
        <h5 class="m-y-lg text-muted text-center" style="font-size: 15px;"><span class=""></span><span class="text-danger">&nbsp&nbspNote that changes after the submission of the final results will <strong>no longer</strong> affect the overall ranking.<br><br><b>DO NOT SUBMIT IF THE JUDGING IS NOT DONE YET. </b></span></h5>


<!-- ############ PAGE END-->


  <!-- theme switcher -->
  <div id="switcher">
    <div class="switcher box-color dark-white text-color" id="sw-theme">
      <a href ui-toggle-class="active" target="#sw-theme" class="box-color dark-white text-color sw-btn">
        <i class="fa fa-gear"></i>
      </a>
      <div class="box-header">
        
        <h2>Dashboard Themes</h2>
      </div>
      <div class="box-divider"></div>
      <div class="box-body">
        <p class="hidden-md-down">
          <label class="md-check m-y-xs"  data-target="folded">
            <input type="checkbox">
            <i class="green"></i>
            <span class="hidden-folded">Folded Aside</span>
          </label>
          <label class="md-check m-y-xs" data-target="boxed">
            <input type="checkbox">
            <i class="green"></i>
            <span class="hidden-folded">Boxed Layout</span>
          </label>
          <label class="m-y-xs pointer" ui-fullscreen>
            <span class="fa fa-expand fa-fw m-r-xs"></span>
            <span>Fullscreen Mode</span>
          </label>
        </p>
        <p>Colors:</p>
        <p data-target="themeID">
          <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md" data-value="{primary:'primary', accent:'accent', warn:'warn'}">
            <input type="radio" name="color" value="1">
            <i class="primary"></i>
          </label>
          <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md" data-value="{primary:'accent', accent:'cyan', warn:'warn'}">
            <input type="radio" name="color" value="2">
            <i class="accent"></i>
          </label>
          <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md" data-value="{primary:'warn', accent:'light-blue', warn:'warning'}">
            <input type="radio" name="color" value="3">
            <i class="warn"></i>
          </label>
          <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md" data-value="{primary:'success', accent:'teal', warn:'lime'}">
            <input type="radio" name="color" value="4">
            <i class="success"></i>
          </label>
          <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md" data-value="{primary:'info', accent:'light-blue', warn:'success'}">
            <input type="radio" name="color" value="5">
            <i class="info"></i>
          </label>
          <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md" data-value="{primary:'blue', accent:'indigo', warn:'primary'}">
            <input type="radio" name="color" value="6">
            <i class="blue"></i>
          </label>
          <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md" data-value="{primary:'warning', accent:'grey-100', warn:'success'}">
            <input type="radio" name="color" value="7">
            <i class="warning"></i>
          </label>
          <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md" data-value="{primary:'danger', accent:'grey-100', warn:'grey-300'}">
            <input type="radio" name="color" value="8">
            <i class="danger"></i>
          </label>
        </p>
        <p>Themes:</p>
        <div data-target="bg" class="text-u-c text-center _600 clearfix">
          <label class="p-a col-xs-6 light pointer m-a-0">
            <input type="radio" name="theme" value="" hidden>
            Light
          </label>
          <label class="p-a col-xs-6 grey pointer m-a-0">
            <input type="radio" name="theme" value="grey" hidden>
            Grey
          </label>
          <label class="p-a col-xs-6 dark pointer m-a-0">
            <input type="radio" name="theme" value="dark" hidden>
            Dark
          </label>
          <label class="p-a col-xs-6 black pointer m-a-0">
            <input type="radio" name="theme" value="black" hidden>
            Black
          </label>
        </div>
      </div>
    </div>



 
  <!-- / -->

<!-- ############ LAYOUT END-->

  </div>

 <script type="text/javascript">
function Reload(){
    var divElements = document.getElementById('printDataHolder<?php echo $contestant_code?>').innerHTML;
    var oldPage = document.body.innerHTML;
    document.body.innerHTML="<link rel='stylesheet' href='css/common.css' type='text/css' /><body class='bodytext'>"+divElements+"</body>";
    window.print();
    document.body.innerHTML = oldPage;
    }
</script>
   <div class="switcher box-color black lt" id="sw-demo">
      <a onclick="window.location.reload();"  class="box-color black lt text-color sw-btn">
        <i class="fa fa-refresh text-white"></i>
      </a>
    </div>

<!-- build:js scripts/app.html.js -->
<!-- jQuery -->
  <script src="../libs/jquery/jquery/dist/jquery.js"></script>
<!-- Bootstrap -->
  <script src="../libs/jquery/tether/dist/js/tether.min.js"></script>
  <script src="../libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<!-- core -->
  <script src="../libs/jquery/underscore/underscore-min.js"></script>
  <script src="../libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js"></script>
  <script src="../libs/jquery/PACE/pace.min.js"></script>

  <script src="scripts/config.lazyload.js"></script>

  <script src="scripts/palette.js"></script>
  <script src="scripts/ui-load.js"></script>
  <script src="scripts/ui-jp.js"></script>
  <script src="scripts/ui-include.js"></script>
  <script src="scripts/ui-device.js"></script>
  <script src="scripts/ui-form.js"></script>
  <script src="scripts/ui-nav.js"></script>
  <script src="scripts/ui-screenfull.js"></script>
  <script src="scripts/ui-scroll-to.js"></script>
  <script src="scripts/ui-toggle-class.js"></script>

  <script src="scripts/app.js"></script>

  <!-- ajax -->
  <script src="../libs/jquery/jquery-pjax/jquery.pjax.js"></script>
  <script src="scripts/ajax.js"></script>
<!-- endbuild -->
</body>
</html>
