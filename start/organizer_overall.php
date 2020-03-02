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

    $querStatus = "SELECT event_id AS status FROM official_scores WHERE event_id=$event_id";
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


if(isset($_POST['submit_over_all'])){

  $contestant_name='';
  $contestant_number='';
  $deductions='';
  $percentage='';
  $total_points='';
  $rank='';
        /*
        *
        * YAWQNA
        *
        */
        $tabulatedQuery = "SELECT SUM(total_points) AS contest_total, SUM(percentage) AS total_ranking , SUM(rank) AS rank_basis, contestant_id, contestant_name, contestant_number, deductions 
                    FROM `overall`
                        WHERE `event_id`='$event_id' GROUP BY contestant_id ORDER BY rank_basis ASC;";
        $tabulatedResult = mysqli_query($connection, $tabulatedQuery);
                      $rank = 0;
                      $total = 0;
                        while($rowTabulated = mysqli_fetch_assoc($tabulatedResult)){
                            if($total !=  $rowTabulated['rank_basis']){
                                    $rank++;
                                }
                                $total = $rowTabulated['rank_basis'];     
                                
                                
                                /**LOOP TAS PUTA ILAGAY SA DATABASE**/     
                                    

  
                                $deductions = $rowTabulated['deductions'];
                                $contestant_number = $rowTabulated['contestant_number'];
                                $contestant_name = $rowTabulated['contestant_name'];
                                $percentage = $rowTabulated['total_ranking'];
                                $total_points = $rowTabulated['contest_total'];
                                

                                $queryOverall = "INSERT INTO `official_scores` (`increment`, `contestant_number`, `contestant_name`, `final_ranking`, `overall_percentage`, `overall_points`, `deductions`, `event_id`) VALUES (NULL, '$contestant_number', '$contestant_name', '$rank', '$percentage', '$total_points', '$deductions', '$event_id')";
                                $resultOverall = mysqli_query($connection, $queryOverall) or die ("Could not insert data because $queryOverall".mysqli_connect_error());

                                if(mysqli_affected_rows($connection)==1)
                                { 
                                   header("Location:organizer_overall.php?sponsor_id=$sponsor_id&username=$username&event_id=$event_id&contest_id=$contest_id");
                                }                                

                                }
}
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
  <!-- large modal -->
<div id="m-md" class="modal" data-backdrop="true">

  <div class="modal-dialog" style="padding-top: 100px">
    <div class="modal-content">
      <div class="modal-header black">
        <h5 class="modal-title">Judge Credentials</h5>
      </div>
      <div class="modal-body text-center p-lg">
        <p>Are you sure to execute this action?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div>
</div>
<!-- / .modal -->
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
              <button class="btn white btn-sm ">Print</button>
              <button class="btn white btn-sm dropdown-toggle" data-toggle="dropdown"></button>
              <div class="dropdown-menu dropdown-menu-scale pull-right">
                <a class="dropdown-item"  onclick="PrintThis()">Print Overall</a>
           
              </div>
            </div>
          </div>
    </div>     
  </div>
</div>


   
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

             <a style="font-size: 15px;" href="view_judges_scores.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>&contest_id=<?php echo $contest_id?>"><span class="fa fa-chevron-left"></span></a>&nbsp&nbspGo back      
  <!--  <h2 class="display-3 _700 l-s-n-3x m-t-lg m-b-md"><span class="text-primary"><center>Official <?php echo $rowEventName['event_name'] ?> Ranking</center></span></h2><br>-->



        <div class="row m-y-lg">

<script type="text/javascript">
function PrintThis(){
    var divElements = document.getElementById('printDataHolder').innerHTML;
    var oldPage = document.body.innerHTML;
    document.body.innerHTML="<link rel='stylesheet' href='css/common.css' type='text/css' /><body class='bodytext'><div class='padding'><b style='font-size: 16px;'><p class=''>ePageant Management System</p></b></div>"+divElements+"</body>";
    window.print();
    document.body.innerHTML = oldPage;
    }
</script>

    <div class="col-sm-12">     
      <div class="box" id="printDataHolder">


        <div class="box-header">
        
          <h2 style="font-size: 25px;"><span style="font-size:;" class="fa fa-check-circle text-primary" title="Verified result">
            </span> Official Result of <b><?php echo $rowEventName['event_name'] ?>&nbsp<?php print date("Y", time());?></b>             </h2>
         <small style="">Generated <strong></strong>on <strong><?php print date("F j Y \a\\t g:i a", time());?></strong> by <?php echo $rowSponsorName['sponsor_name'] ?></small> <small>Digital signature<span>&nbsp<code><?php echo sha1($username) ?></code></span></small>         
      
          
        </div>
        <table class="table table-bordered table-hover">
          <thead>
            <tr class="text-warning text-center">
              <th class="dker">Rank</th>
              <th class="dker">Number</th>
              <th class="dker">Contestant Name</th>

            <!--  <th class="dker">Total Ranking</th>   -->                       
              <th class="dker">Overall Points</th>   
             <th class="dker">Deduction</th>                        
            

            </tr>
          </thead>
          <tbody>
<?php

        $tabulatedQuery = "SELECT SUM(total_points) AS contest_total, SUM(percentage) AS total_ranking , SUM(rank) AS rank_basis, contestant_id, contestant_name, contestant_number 
                    FROM `overall`
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
              
              <?php 
              if($rank <= 3){
                
              ?>
              <td class="text-primary dker"> <span class="fa fa-caret-up text-success">&nbsp&nbsp</span><b><?php echo $rank?></b></td> 
              <td class="text-primary"><b><?php echo $rowTabulated['contestant_number']?></b></td>              
              <td class="text-primary"><b><?php echo $rowTabulated['contestant_name']?></b></td>


              <!--<td class="text-primary"><b><?php echo $rowTabulated['total_ranking']?> </b></td>-->
              <td class="text-primary"><b><?php echo $rowTabulated['contest_total']?></b></td>  
                                      
                         <?php 
                            $contestant_id = $rowTabulated['contestant_id'];
                            $query2 = "SELECT SUM(deductions) AS totals FROM `overall` WHERE `contestant_id`='$contestant_id';";
                            $result2 = mysqli_query($connection, $query2);
                            $row2 = mysqli_fetch_assoc($result2);
                            if(mysqli_affected_rows($connection)==1)
                            {        
                        ?>
              <td class="text-primary"><b><?php echo $row2['totals']?></b></td> 
                        <?php        
                            }
                            else
                            {
                        ?>
                        <td class="text-primary"><b> 0 </b></td>
                        <?php 
                            } 
                        ?>               
            <?php }else{?>
              <td class="dker"><span class="text-danger fa fa-caret-down"></span>&nbsp&nbsp<?php echo $rank?></td>
              <td ><?php echo $rowTabulated['contestant_number']?></td>              
              <td><?php echo $rowTabulated['contestant_name']?></td>


             <!-- <td><?php echo $rowTabulated['total_ranking']?></td>-->
              <td><?php echo $rowTabulated['contest_total']?></td>      
                                   
                         <?php 
                            $contestant_id = $rowTabulated['contestant_id'];
                            $query2 = "SELECT SUM(deductions) AS totals FROM `overall` WHERE `contestant_id`='$contestant_id';";
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

            <?php }?>
                       
            </tr>   
            <?php } ?>      
          </tbody>
        </table>
   

      </div>

                  <?php 
                if($status != 'submitted')
                {
            ?>
        <form ui-jp="parsley" name="form" method="post" action="">
          <br>
              <div class="col-sm-8" style="padding-left: 360px; ">
                <input type="text"  name="user" class="form-control rounded" data-parsley-equalto="<?php echo $username?>" maxlength="25" required="true" placeholder="Type your username for confirmation">    
              </div>        
              <div class="col-md-8" style="padding-left: 360px; padding-top: 10px;">
                <button type="submit"  name="submit_over_all" class="btn rounded white btn-block">Submit Official Result</button>
              </div>

        </form>
      <?php }else{?><br>
       <center style=""><h3><span style="font-size: 18px;" class="text-wwarning">Official result for <b><?php echo $rowEventName['event_name']?></b> was already submitted</span></h3></center>
      <?php } ?>
  </div>

</div>
<h5 class="m-y-lg text-muted text-center" style="font-size: 15px;"><span class=""></span><span class="text-danger">&nbsp&nbspNote that <b>changes</b> after the submission of the official results will <strong>no longer</strong> affect the overall ranking.<br><br><b>DO NOT SUBMIT IF THE EVENT IS NOT DONE YET. </b></span></h5>
</div>
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
