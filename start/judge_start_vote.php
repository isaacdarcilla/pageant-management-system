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



$judge_id = $_GET['judge_id'];

$username = $_GET['username'];

$event_id = $_GET['event_id'];

$contestant = $_GET['cui'];

$cui = $_GET['cui'];

$contest_id = $_GET['contest_id'];

////STATTUS
    $status = 'allowed';
    $string = "00-auto-";



  
  $judge_id = $_GET['judge_id'];
    $event_id = $_GET['event_id'];
    $message = '';
    $event_code = '';

    $querEventName = "SELECT event_name, event_location
                        FROM event_table 
                            WHERE event_id = '$event_id';";
    $resEventName = mysqli_query($connection, $querEventName);
    $rowEventName = mysqli_fetch_assoc($resEventName);

    $querContestantName = "SELECT *
                        FROM contestant_info_table 
                            WHERE username = '$contestant';";
    $resContestantName = mysqli_query($connection, $querContestantName);
    $rowContestantName = mysqli_fetch_assoc($resContestantName);



 $querSponsorName = "SELECT * 
                            FROM judge_table
                                WHERE judge_id=$judge_id";
    $resSponsorName= mysqli_query($connection, $querSponsorName);
    $rowSponsorName = mysqli_fetch_assoc($resSponsorName); 

    $querEvent = "SELECT event_id, event_name, event_location
                    FROM event_table JOIN (SELECT event_id FROM judge_event WHERE judge_id=$judge_id) AS judges USING(event_id) ";
    $resEvent = mysqli_query($connection, $querEvent);
///judge
    $query = "SELECT *
                FROM contest 
                    WHERE contest_id=$contest_id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $contest_name = $string . str_replace(' ', '', strtolower($row['contest_name']));  


////CONTEST

    $querContest = "SELECT *
                        FROM contest 
                            WHERE contest_id=$contest_id";
    $resContest = mysqli_query($connection, $querContest);
$rowContest = mysqli_fetch_assoc($resContest);

///SCORESS
    $querScores = "SELECT *
                    FROM contestant_info_table JOIN (SELECT * FROM join_event WHERE event_id = $event_id) AS contestants USING(contestant_id)";
    $resScores = mysqli_query($connection, $querScores);

        $querOrg = "SELECT * 
                    FROM contestant_info_table 
                        WHERE username = '$contestant'";
        $resOrg = mysqli_query($connection, $querOrg);
        $rowOrg = mysqli_fetch_assoc($resOrg);
        $contestant_id = $rowOrg['contestant_id'];

///JUDGE
    $query1 = "SELECT judge_id 
                FROM $contest_name 
                    WHERE judge_id=$judge_id";
    $result1 = mysqli_query($connection, $query1);


    if(mysqli_affected_rows($connection)!=0) 
    {
        $status = 'not_allowed';
    }

////ENTER 


    if(isset($_POST['submit_scores']))
    {    

            $contestant_id = $rowOrg['contestant_id'];
            $query1 = "INSERT INTO `$contest_name` (`judge_id`, `contestant_id`, `event_id`) 
                        VALUES ('$judge_id', '$contestant_id', '$event_id')";
            $result1 = mysqli_query($connection, $query1) 
            or die("Could not insert data because: $contest_name ".mysqli_connect_error());       

            $querCri = "SELECT *
                            FROM criteria_of_judging JOIN (SELECT * FROM criteria_and_contest WHERE contest_id=$contest_id) AS criteria USING(criteria_id)";
            $resCri = mysqli_query($connection, $querCri);
            $cri=0;
            $total=0;
            $name='';
            while($rowCri = mysqli_fetch_assoc($resCri))
            {
                $name = $rowCri['criteria_id'];
                $individualScores = $_POST["$name"];
                $criterion = "criterion".$rowCri['criteria_id'];  
                $query2 = "
                    UPDATE `$contest_name` 
                            SET `$criterion`='$individualScores'
                                WHERE `judge_id`='$judge_id' AND `contestant_id`='$contestant_id'";
                $result2 = mysqli_query($connection, $query2);                
                $total += $individualScores;
                $cri++;
            }           
            $query1 = "UPDATE `$contest_name`  
                        SET `total`='$total' 
                            WHERE `judge_id`='$judge_id' AND `contestant_id`='$contestant_id'";
            $result1 = mysqli_query($connection, $query1);
        

                      $query="SELECT * FROM `$contest_name` WHERE `judge_id`='$judge_id' ORDER BY `total` DESC";
                      $result = mysqli_query($connection, $query);
                      $rank = 0;
                      $total = 0;
                      while($row = mysqli_fetch_assoc($result))
                      { 
                          if($total !=  $row['total'])
                          {
                              $rank++;
                          }
                          $total = $row['total'];
                          $contestant_id = $row['contestant_id'];
                          $query5 = "UPDATE `$contest_name` 
                                      SET `rank`='$rank' 
                                          WHERE `judge_id`='$judge_id' AND `contestant_id`='$contestant_id'";
                          $result5 = mysqli_query($connection, $query5);
                      }
                
                
        header("Location:judge_start_vote.php?event_id=$event_id&judge_id=$judge_id&contest_id=$contest_id&username=$username&cui=$contestant");
    }


////STATUS NOT ALLOWED



?>  


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>ePageant Management System</title>
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
  <link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">
  
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
        	<div ui-include="'../assets/avatar.png'"></div>
        	<img src="../assets/images/logo.png" alt="." class="hide">
        	<span class="hidden-folded inline">My Dashboard</span>
        </a>
        <!-- / brand -->
      </div>
      <div flex class="hide-scroll">
          <nav class="scroll nav-light">
            
              <ul class="nav" ui-nav>
               <!-- <li class="nav-header hidden-folded">
                  <small class="text-muted">Main</small>
                </li>
                
                <li>
                  <a href="judge_main_page.php?event_id=<?php echo $event_id?>&judge_id=<?php echo $judge_id?>&contest_id=<?php echo $contest_id ?>&username=<?php echo $username?>" >
                    <span class="nav-icon">
                      <i class="material-icons">&#xe88a;
                        <span ui-include="'../assets/images/i_0.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Main Page</span>
                  </a>
                </li>
                <li>
                  <a href="judge_about.php?event_id=<?php echo $event_id?>&judge_id=<?php echo $judge_id?>&contest_id=<?php echo $contest_id ?>&username=<?php echo $username?>" >
                    <span class="nav-icon">
                      <i class="material-icons">&#xe88f;
                        <span ui-include="'../assets/images/i_0.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">About</span>
                  </a>
                </li>
                <li>
                  <a href="judge_rate.php?event_id=<?php echo $event_id?>&judge_id=<?php echo $judge_id?>&contest_id=<?php echo $contest_id ?>&username=<?php echo $username?>" >
                    <span class="nav-icon">
                      <i class="material-icons">&#xe87d;
                        <span ui-include="'../assets/images/i_0.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Rate Us</span>
                  </a>
                </li>                            
                <li>
                  <a href="j.php" >
                    <span class="nav-icon">
                      <i class="material-icons">&#xe879;
                        <span ui-include="'../assets/images/i_0.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text ">Log Out</span>
                  </a>
                </li> -->
                <li class="nav-header hidden-folded">
                  <small class="text-muted">Contestant Switcher</small>
                </li>
            <?php 
                    $querContestant = "SELECT *
                                        FROM contestant_info_table WHERE event_id_sponsor=$event_id";
                    $resContestant = mysqli_query($connection, $querContestant);
                 

                    while($rowContestant = mysqli_fetch_assoc($resContestant)){
if($rowContestant['username']==$cui){
            ?> 
                <li class="dker">
                  <a href="judge_vote_page.php?event_id=<?php echo $event_id?>&judge_id=<?php echo $judge_id?>&contest_id=<?php echo $contest_id ?>&username=<?php echo $username?>&cui=<?php echo $rowContestant['username']?>" onclick="window.location.reload();">
                    <span class="nav-icon">
              <span class="">
                <strong class="text text-warning" style="font-size: 20px;">#<?php echo $rowContestant['contestant_number']?></strong>
              </span>
                    </span>
                    <span class="nav-text text-warning" style="font-size: 18px;"><b><?php echo $rowContestant['first_name']?></b></span>
                  </a>
                </li> 
                <?php }else{ ?>
                <li>
                  <a href="judge_vote_page.php?event_id=<?php echo $event_id?>&judge_id=<?php echo $judge_id?>&contest_id=<?php echo $contest_id ?>&username=<?php echo $username?>&cui=<?php echo $rowContestant['username']?>" onclick="window.location.reload();">
                    <span class="nav-icon">
              <span class="">
                <strong class="" style="font-size: 20px;">#<?php echo $rowContestant['contestant_number']?></strong>
              </span>
                    </span>
                    <span class="nav-text"><?php echo $rowContestant['first_name']?></span>
                  </a>
                </li> 
                <?php } ?>                 
                <?php } ?>                          
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
    <div class="app-header white box-shadow">
        <div class="navbar">
            <!-- Open side - Naviation on mobile -->
            <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up">
              <i class="material-icons">&#xe5d2;</i>
            </a>
            <!-- / -->
        
            <!-- Page title - Bind to $state's title -->
            <div class="navbar-item pull-left h5" ng-bind="$state.current.data.title" id="pageTitle"></div>
        
            <!-- navbar right -->
            <ul class="nav navbar-nav pull-right">
     <!--         <li class="nav-item dropdown pos-stc-xs">
                <a class="nav-link" href data-toggle="dropdown">
                
                </a>
                <div ui-include="'../views/blocks/dropdown.notification.html'"></div>
              </li>
              <li class="nav-item dropdown pos-stc-xs">
                <a class="nav-link text-warning" href data-toggle="modal" data-target="#m-a-a-log" ui-toggle-class="zoom" ui-target="#animate">
                  Log Out 
                </a>
                <div ui-include="'../views/blocks/dropdown.notification.html'"></div>
              </li>
            
              <li class="nav-item dropdown pos-stc-xs">
                <a class="nav-link" href data-toggle="about">
                  About
                </a>
                <div ui-include="'../views/blocks/dropdown.notification.html'"></div>
              </li>    
              <li class="nav-item dropdown pos-stc-xs">
                <a class="nav-link" href data-toggle="rate-us">
                  Rate Us
                </a>
                <div ui-include="'../views/blocks/dropdown.notification.html'"></div>
              </li>      -->         
              <li class="nav-item dropdown">
                <a class="nav-link clear" href data-toggle="dropdown">
                  <span class="avatar w-32">
                    <img src="assets/avatar.png" alt="...">
                    <i class="on b-white bottom"></i>
                  </span>
                </a>
        <div class="dropdown-menu dropdown-menu-scale pull-right">
          <a class="dropdown-item" data-toggle="modal" data-target="#top">View My Profile</a>
         <!-- <a class="dropdown-item" href="stats.php?9bc318fcbdac1b119dc53b8a7de21be1430208c7=<?php echo $event_id?>" target="_blank">View Statistics</a> -->
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" data-toggle="modal" data-target="#m-md-about" ui-toggle-class="zoom" ui-target="#animate">About Us</a>
          <a class="dropdown-item" data-toggle="modal" data-target="#m-md-rate" ui-toggle-class="zoom" ui-target="#animate">Rate Us</a> 
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-warning" data-toggle="modal" data-target="#m-a-a-log" ui-toggle-class="zoom" ui-target="#animate">Log Out</a>                      
        </div>                   
                <div ui-include="'../views/blocks/dropdown.user.html'"></div>
              </li>
              <li class="nav-item hidden-md-up">
                <a class="nav-link" data-toggle="collapse" data-target="#collapse">
                  <i class="material-icons">&#xe5d4;</i>
                </a>
              </li>
            </ul>
            <!-- / navbar right -->
        
            <!-- navbar collapse -->
           <a href="judge_main_page.php?event_id=<?php echo $event_id?>&judge_id=<?php echo $judge_id?>&contest_id=<?php echo $contest_id ?>&username=<?php echo $username?>"> <div class="collapse navbar-toggleable-sm" id="collapse">
              
              <!-- link and dropdown -->
              <ul class="nav navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link" href="judge_main_page.php?event_id=<?php echo $event_id?>&judge_id=<?php echo $judge_id?>&contest_id=<?php echo $contest_id ?>&username=<?php echo $username?>">
                    <i class="fa fa-fw fa-chevron-left text-muted"></i>
                    <span>Main Page</span>
                  </a>
                 
                </li>
              </ul>
              <!-- / -->
            </div></a>
            <!-- / navbar collapse -->
        </div>
    </div>

<!-- top -->
<div class="modal fade" id="top">
  <div class="top white b-b" style="height:180px;">
            <div class="padding">
              <div class="padding">
              <h5 class="m-a-0 m-b-sm"><a href><?php echo $rowSponsorName['first_name'] ?>&nbsp<?php echo $rowSponsorName['sur_name'] ?></a></h5>
              <p class="text-muted">Username <code>@<?php echo $rowSponsorName['username'] ?></code><br>
             Password <code><?php echo $rowSponsorName['is_unhash'] ?></code></p>              
              
            </div>
            </div>
  </div>
</div>   
<!-- large modal LOG OUT -->
<div id="m-a-a-log" class="modal" data-backdrop="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="font-size: 16px;">Log Out</h5>
      </div>
      <div class="modal-body text-center p-lg">
        <p style="font-size: 20px;">Are you sure you want to execute this action?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">No</button>
        <button type="button" class="btn danger p-x-md" <?php  session_destroy();  ?> ><a  href="judge.php">Yes</a></button>
      </div>
    </div><!-- /.modal-content -->
  </div>
</div>
<!-- / .modal --> 
<!-- large modal RATE -->
<div id="m-md-rate" class="modal" data-backdrop="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Rate Us</h5>
      </div>
      <div class="modal-body text-center p-lg">
<?php 
 $queryArg = "SELECT judge_id FROM judge_rate_software WHERE judge_id=$judge_id;";
 $resArgs = mysqli_query($connection, $queryArg);
 $rowArgs = mysqli_fetch_assoc($resArgs);

 if($rowArgs['judge_id']==NULL){
?>
        <p>
          <p>Select your desired rating below</p><br>
  <div><a href="rate.php?event_id=<?php echo $event_id?>&judge_id=<?php echo $judge_id?>&contest_id=<?php echo $contest_id ?>&username=<?php echo $username?>&cui=<?php echo $contestant?>&rate=<?php echo '3' ?>"><span style="font-size: 80px;" class="fa fa-heart text-danger" title="Equivalent to 3 points"></span></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<a href="rate.php?event_id=<?php echo $event_id?>&judge_id=<?php echo $judge_id?>&contest_id=<?php echo $contest_id ?>&username=<?php echo $username?>&cui=<?php echo $contestant?>&rate=<?php echo '2' ?>"><span style="font-size: 80px;" class="fa fa-heart text-warning" title="Equivalent to 2 points"></span></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<a href="rate.php?event_id=<?php echo $event_id?>&judge_id=<?php echo $judge_id?>&contest_id=<?php echo $contest_id ?>&username=<?php echo $username?>&cui=<?php echo $contestant?>&rate=<?php echo '1' ?>"><span style="font-size: 80px;" class="fa fa-heart text-muted" title="Equivalent to 1 point"></span></a>
  </div>
  <div><span><a>I love it<a></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <span><a>I like it</a></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<span><a>I hate it</a></span>
  </div>
        </p>
<?php }else{ ?>
  <div><span style="font-size: 70px;" class="fa fa-heart text-danger" title="Equivalent to 3 points"></span></div>
<div><p style="font-size: 20px; padding-top: 10px;">We appreciate your rating.</p></div>
<?php } ?>  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div>
</div>
<!-- / .modal --> 
<!-- large modal ABOUT -->
<div id="m-md-about" class="modal" data-backdrop="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">About</h5>
      </div>
      <div class="modal-body text-center p-lg">
        <p>
      <div id="">
        <h2 class="" style="padding-bottom: 10px;">About Us</h2>
        <p style="font-size: 15px; padding-left: 10px; padding-right: 10px;">This thesis was proposed last October 2018 at Catanduanes State University's College of Engineering, this was based on the concept of <a href="https://www.facebook.com/isaacdarcilla" target="_blank" class="text-warning">Isaac D. Arcilla</a>. The ePageant System was developed for pageant events. The Lead Developer and UI Designer</b> is Isaac D. Arcilla. Quality Assurance are John Paul C. Bagadiong and Lyndon T. Buenconsejo. Documenatation are Jonah Sarmiento and Donita Mae T. Teano. <b>ALL RIGHTS RESERVE 2018.</b></p>
      </div>    
           
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div>
</div>
<!-- / .modal -->
    <div ui-view class="app-body" id="view">

<!-- ############ PAGE START-->

<div class="p-a-md warning p-y-lg">

    <h3 class="display-3 _500 l-s-n-5x" style="font-size: 30px;"><strong>#<?php echo $rowContestantName['contestant_number'] ?></strong>&nbsp<small><?php echo $rowContestantName['first_name'] ?>&nbsp<?php echo $rowContestantName['sur_name'] ?></small></h3>


</div>


<!-- only need a height for layout 4 -->
<div class="padding">
    <div class="col-sm-12">
      <form ui-jp="parsley" name="form" method="post" action="">
        <div class="">
          <div class="box-header">
            <h2><a href="judge_vote_page.php?event_id=<?php echo $event_id?>&judge_id=<?php echo $judge_id?>&contest_id=<?php echo $contest_id ?>&username=<?php echo $username?>&cui=<?php echo $contestant?>"><span class="fa fa-chevron-left"></span></a>&nbsp&nbsp<?php echo $rowContest['contest_name'] ?></h2>
          </div>
          <div class="box-body"> 

                            <?php 
                      $queryQW="SELECT * FROM `$contest_name` WHERE `judge_id`='$judge_id' AND `contestant_id`='$contestant_id'";
                      $resultQW = mysqli_query($connection, $queryQW);
                      $rowQW = mysqli_fetch_assoc($resultQW);
                            ?>
                                    <?php
                                    if($rowQW['judge_id']==NULL)
                                        {
                                          
                                    ?>
                            <?php
                                $query = "SELECT criterias, percentage, criteria_id 
                                            FROM criteria_of_judging JOIN (SELECT criteria_id, percentage FROM criteria_and_contest WHERE contest_id=$contest_id) AS criteria USING(criteria_id)"; //get criteria each contest
                                $result = mysqli_query($connection, $query);
                                $percentage = array();
                                $numOfCri=0;
                                while($row = mysqli_fetch_assoc($result)){
                            ?>                         
            <div class="form-group row">


              <div class="col-sm-12">
                <input type="tel" data-parsley-type="number" name="<?php echo ($row['criteria_id']) ?>" class="form-control rounded" max="<?php echo $row['percentage']?>" maxlength="3" required placeholder="<?php echo $row['criterias']?> with <?php echo $row['percentage']?>%">    
              </div>
    
            </div>
          <?php } ?>
       <!--        <div class="m-b-md"> 
              <label class="md-switch ui-check">
                <input type="checkbox" name="check" required="true">
                <i class="pink">&nbsp</i>
                I will now submit my final votes
              </label>
            </div>-->
<!--
            <div class="form-group row" style="padding-top: 15px;">
              <label style="padding-left: 16px;">Confirmation</label>
              <div class="col-sm-12">
                <input type="text" class="form-control rounded" data-parsley-equalto="<?php echo $username?>" maxlength="20" required placeholder="Type your username">    
              </div>  
            </div>   -->
          </div>

<br>
          <div class="col-md-12">
         <button type="button" class="btn rounded warning btn-block" data-toggle="modal" data-target="#m-a-a" ui-toggle-class="zoom"  >Submit Scores</button>
<!-- .modal -->
<script type="text/javascript">

$('#btnId').click(function(){
  $('#contents').show(); //<----here
  $('#animate').hide();
  $.ajax({
    ....
   success:function(result){
       $('#contents').hide();  //<--- hide again
       $('#animate').show();       
   }


}
}
</script>
<div style="padding-top: 0px;" id="m-a-a" class="modal fade animate" data-backdrop="true">
  <div class="modal-dialog" id="animate">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="font-size: 16px;">Submission</h5>
      </div>
      <div class="modal-body text-center p-lg" id="load">
        <span class="text-center"  style="font-size: 20px;">Are you sure you want to submit your scores now?</span><br>
        <span class="text-center" ><img style="display:none;" id="contents" src="assets/load.gif" /></i></span>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn dark-white rounded" data-dismiss="modal">No</button>
        <button type="submit" id="btnId" name="submit_scores" class="btn warning rounded" >Yes</button>
      </div> 
     
    </div><!-- /.modal-content -->
  </div>
</div>
<!-- / .modal -->       

       </div>
             </div>
        <!--<h5 class="m-y-lg text-muted text-center" style="font-size: 15px;"><span class=""></span><span class="text-danger">&nbsp&nbspNote that you are <strong>no longer allowed</strong> to edit the scores after submission.</span></h5>-->




      </div>

                                                  <?php 
                                        }else{
                                   
                                          ?>    <br><br><br>
                                         <center> <div style="font-size:  75px;" ><span class="fa  fa-check text-primary"></span></div>
                                          <h2 class="" style="font-size: 20px;"><span class="text">Thank you for voting. Please go to next contestant.<br> <br>
                                           
                                         <!--  <a data-toggle="modal" data-target="#m-md-edit-score" ui-toggle-class="zoom" ui-target="#animate"> <button  class="btn rounded success" > Edit scores for <?php echo $rowContestantName['first_name'] ?>&nbsp<?php echo $rowContestantName['sur_name'] ?>     </button> </a>     -->


<div id="m-md-edit-score" class="modal" data-backdrop="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">About</h5>
      </div>
      <div class="modal-body text-center p-lg">
                            <?php
                                $query = "SELECT criterias, percentage, criteria_id 
                                            FROM criteria_of_judging JOIN (SELECT criteria_id, percentage FROM criteria_and_contest WHERE contest_id=$contest_id) AS criteria USING(criteria_id)"; //get criteria each contest
                                $result = mysqli_query($connection, $query);
                                $percentage = array();
                                $numOfCri=0;
                                while($row = mysqli_fetch_assoc($result)){
                            ?>                         
            <div class="form-group row">


              <div class="col-sm-12">
                <input type="tel" data-parsley-type="number" name="<?php echo ($row['criteria_id']) ?>" class="form-control rounded" max="<?php echo $row['percentage']?>" maxlength="3" required placeholder="<?php echo $row['criterias']?> with <?php echo $row['percentage']?>%">    
              </div>
    
            </div>
          <?php } ?>
       <!--        <div class="m-b-md"> 
              <label class="md-switch ui-check">
                <input type="checkbox" name="check" required="true">
                <i class="pink">&nbsp</i>
                I will now submit my final votes
              </label>
            </div>-->
<!--
            <div class="form-group row" style="padding-top: 15px;">
              <label style="padding-left: 16px;">Confirmation</label>
              <div class="col-sm-12">
                <input type="text" class="form-control rounded" data-parsley-equalto="<?php echo $username?>" maxlength="20" required placeholder="Type your username">    
              </div>  
            </div>   -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div>
</div>

                                          <?php }?>  
        </div>
      </form>
    </div>


</div>
<!-- <i class="material-icons md-24">(.*)</i>   <em>$1</em>-->

  





<!-- ############ PAGE END-->

  <!-- / -->

 
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
 
  <!--<div class="switcher box-color black lt" id="sw-demo">
      <a href ui-toggle-class="active" target="#sw-demo" class="box-color black lt text-color sw-btn">
        <i class="fa fa-reorder text-white"></i>
      </a>
      <div class="box-header">
        <h2>Contestant Switcher</h2>
      </div>
      <div class="box-divider"></div>
      <div class="box-body">
        <div class="text text-center _600 clearfix">
            <?php 
                    $querContestant = "SELECT *
                                        FROM contestant_info_table WHERE event_id_sponsor=$event_id";
                    $resContestant = mysqli_query($connection, $querContestant);
                 

                    while($rowContestant = mysqli_fetch_assoc($resContestant)){

            ?> 

          <a href="judge_vote_page.php?event_id=<?php echo $event_id?>&judge_id=<?php echo $judge_id?>&contest_id=<?php echo $contest_id ?>&username=<?php echo $username?>&cui=<?php echo $rowContestant['username']?>"
            class="p-a col-md-6 warning">
            <span class="text-white"><?php echo $rowContestant['first_name']?></span>
          </a>
        <?php }?>
          

        </div>
      </div>
    </div> -->
  <!-- / -->

<!-- ############ LAYOUT END-->
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
