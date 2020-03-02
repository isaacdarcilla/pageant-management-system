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

$contest_id = $_GET['contest_id'];

$cui = $_GET['cui'];
$string = "00-auto-";

    $query = "SELECT contest_name 
                FROM contest 
                    WHERE contest_id=$contest_id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $contest_name = $string.str_replace(' ', '', strtolower($row['contest_name']));  

 $querSponsorName = "SELECT * 
                            FROM judge_table
                                WHERE judge_id=$judge_id";
    $resSponsorName= mysqli_query($connection, $querSponsorName);
    $rowSponsorName = mysqli_fetch_assoc($resSponsorName); 

    $querEvent = "SELECT event_id, event_name, event_location
                    FROM event_table JOIN (SELECT event_id FROM judge_event WHERE judge_id=$judge_id) AS judges USING(event_id) ";
    $resEvent = mysqli_query($connection, $querEvent);
////CONTEST

    $querContest = "SELECT *
                        FROM contest 
                            WHERE event_id=$event_id";
    $resContest = mysqli_query($connection, $querContest);


////ENTER 



  
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
                    <span class="nav-text">Log Out</span>
                  </a>
                </li>-->
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
                <strong class="text text-info" style="font-size: 20px;">#<?php echo $rowContestant['contestant_number']?></strong>
              </span>
                    </span>
                    <span class="nav-text text-info" style="font-size: 18px;"><b><?php echo $rowContestant['first_name']?></b></span>
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
              <li class="nav-item dropdown pos-stc-xs">
                <a class="nav-link" href data-toggle="dropdown">

 </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href data-toggle="dropdown">
                  <span class="avatar w-32">
                    <img src="assets/avatar.png" alt="...">
                    <i class="on b-white bottom"></i>
                  </span>
                </a>
        <div class="dropdown-menu dropdown-menu-scale pull-right">
          <a class="dropdown-item" data-toggle="modal" data-target="#top">View My Profile</a>
       <!--   <a class="dropdown-item" href="stats.php?9bc318fcbdac1b119dc53b8a7de21be1430208c7=<?php echo $event_id?>" target="_blank">View Statistics</a> -->
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
              <div ui-include="'../views/blocks/navbar.form.right.html'"></div>
              <!-- link and dropdown -->
              <ul class="nav navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link" href="judge_main_page.php?event_id=<?php echo $event_id?>&judge_id=<?php echo $judge_id?>&contest_id=<?php echo $contest_id ?>&username=<?php echo $username?>">
                    <i class="fa fa-fw fa-chevron-left text-muted"></i>
                    <span>Main Page</span>
                  </a>
                  <div ui-include="'../views/blocks/dropdown.new.html'"></div>
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

<div class="p-a-md info p-y-lg">
    <h3 class="display-3 _500 l-s-n-5x" style="font-size: 30px;"><strong>#<?php echo $rowContestantName['contestant_number'] ?></strong>&nbsp<small><?php echo $rowContestantName['first_name'] ?>&nbsp<?php echo $rowContestantName['sur_name'] ?></small></h3>

</div>

<!-- only need a height for layout 4 -->
<div class="padding">
      <div class="container ">

        <div class="row m-y-lg">

<!---LOOOPPPPP--->
 <h5 class="text-muted text-center">Please <b>do not start judging</b> if the contestant is not performing yet</h5>
<br>   <br>
        <?php 
               while($rowContest = mysqli_fetch_assoc($resContest)){
                $contest_id = $rowContest['contest_id'];

                if($rowContest['start']=='1'){
        ?>

     <div class="col-sm-4">
      <div class="box">
        <div class="box-header">
          <h2 style="font-size: 25px;"><center><?php echo $rowContest['contest_name']?></center></h2>
    
          <p class="m-y-lg text-center">
            
                             
        <button type="submit"  name="" class="btn rounded white"  ><a href="judge_start_vote.php?event_id=<?php echo $event_id?>&judge_id=<?php echo $judge_id?>&contest_id=<?php echo $rowContest['contest_id'] ?>&username=<?php echo $username?>&cui=<?php echo $contestant?>">Start Judging</a></button>  
             
            </p>
                
          <!---<small>Click the <i class="material-icons md-18">&#xe5d4;</i> icon in the left corner for more options </small>--->

        </div>
      <div class="m-b" id="accordion">
        <div class="panel box no-border m-b-xs">
          <div class="box-header p-y-sm">
            <a data-toggle="collapse" data-parent="#accordion" data-target="#show_<?php echo $rowContest['contest_id']?>" >
              Show or hide criteria of judging 
            </a>
          </div>
          <div id="show_<?php echo $rowContest['contest_id']?>" class="collapse out">
            <div class="box-body">
        <div class="">
                                                  <?php
                                            $querCriteria = "SELECT * 
                                                                FROM criteria_of_judging JOIN (SELECT * FROM criteria_and_contest WHERE contest_id = '$contest_id') AS criteria_percentage USING (criteria_id)"; //get criteria each contest
                                            $resCriteria = mysqli_query($connection, $querCriteria);
                                        ?>
        <table class="table table-hover b-t">
          <thead>
            <tr>

              <th class="text-warning">Criteria Name</th>
              <th class="text-warning">Percentage</th>
            </tr>
          </thead>


          <tbody>
                                                 <?php
                                                   while($rowCriteria = mysqli_fetch_assoc($resCriteria)){ 
                                                ?>
            <tr>

              <td><?php echo $rowCriteria['criterias'] ?></td>
              <td><?php echo $rowCriteria['percentage'] ?>%</td>
            </tr>
                                                <?php
                                                   }
                                                ?>
          </tbody>
        </table>
        </div>
            </div>
          </div>
        </div>
      </div>        
      </div>
    </div>
        <?php }else{ ?>
      <?php } ?>          
      <?php } ?>
      </div>

        
    </div>


</div>
<!-- <i class="material-icons md-24">(.*)</i>   <em>$1</em>-->

  





<!-- ############ PAGE END-->

  <!-- / -->

 
  
  <!-- / -->

<!-- ############ LAYOUT END-->

  
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
