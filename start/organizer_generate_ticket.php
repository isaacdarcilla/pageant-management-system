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

 

$sponsor_id = $_GET['sponsor_id'];

$username = $_GET['username'];

$event_id = $_GET['event_id'];


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

    $querEvents = "SELECT *
                        FROM event_table 
                            JOIN (SELECT event_id FROM event_sponsor_two WHERE sponsor_id=$sponsor_id) AS sponsorship USING (event_id) ";
    $resEvents = mysqli_query($connection, $querEvents);

    $querEventName = "SELECT *
                        FROM event_table
                            WHERE event_id = $event_id";
    $resEventName = mysqli_query($connection, $querEventName);
    $rowEventName = mysqli_fetch_assoc($resEventName);

   $querJudge = "SELECT * 
                    FROM judge_table JOIN (SELECT * FROM judge_event WHERE added_by_sponsor = $sponsor_id AND event_id=$event_id) AS judges USING(judge_id)";
    $resJudge = mysqli_query($connection, $querJudge);
  

   function gen_tix()
    {
        $code = '';
        $count = 0;
        for($count = 0; $count<3; $count++)
        {
            $code = $code.chr(rand(65,90));
            $code = $code.chr(rand(48,57));
            $code = $code.chr(rand(75,50));

        }
        return $code;
    
    } 

    if(isset($_POST['generate_tix']))
    {
        $amount = $_POST['generate'];
          $amount_inc = 0;
        while($amount!=$amount_inc){
          $amount_inc++;

          $tickets1 = range(1, 99);
          shuffle($tickets1);
          $ticket1 = array_shift($tickets1);

          $tickets2 = range(1, 85);
          shuffle($tickets2);
          $ticket2 = array_shift($tickets2);

          $tickets3 = range(1, 199);
          shuffle($tickets3);
          $ticket3 = array_shift($tickets3);

          $string = "E-";
          $ticket = $ticket1.$ticket2.$ticket3;

        $query = "INSERT INTO `ticketing` VALUES (NULL, '$ticket', '$event_id', '$sponsor_id');";

        $result= mysqli_query($connection, $query);

      }
    }
$myTicket = "SELECT * FROM audience_votes WHERE event_id='event_id'";
$myResult = mysqli_query($connection, $myTicket);
$myRow = mysqli_fetch_assoc($myResult);


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
        <span class="m-r-sm">Settings</span>
        <div class="btn-group dropdown">
              <button class="btn white btn-sm ">Manage</button>
              <button class="btn white btn-sm dropdown-toggle" data-toggle="dropdown"></button>
              <div class="dropdown-menu dropdown-menu-scale pull-right">
                <a class="dropdown-item" onclick="printPage()">Print Tickets</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-warning" data-toggle="modal" data-target="#m-a-a" ui-toggle-class="zoom" ui-target="#animate">View Voted Audience</a>
              </div>
            </div>
          </div>
    </div>     
	</div>
</div>

<!-- .modal -->
<div id="m-a-a" class="modal fade animate" data-backdrop="true">
  <div class="modal-dialog" id="animate">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Audience Voted List</h5>
      </div>
      <div class="modal-body p-lg">
      <div class="list-group m-b">
        <?php 
          $vote_query = "SELECT ticket_id, contestant_id, date_voted FROM audience_votes WHERE event_id = '$event_id'";
          $vote_result = mysqli_query($connection, $vote_query);
          while($vote_row = mysqli_fetch_assoc($vote_result)){
            $contestant_id = $vote_row['contestant_id'];
            $contestant_query = "SELECT first_name, sur_name FROM contestant_info_table WHERE contestant_id = '$contestant_id'"; 
            $contestant_result = mysqli_query($connection ,$contestant_query);
            $contesant_row = mysqli_fetch_assoc($contestant_result);
        ?>        
        <a class="list-group-item">
          <span class="pull-right"><b><?php echo $vote_row['date_voted'] ?> </b></span>
          Ticket ID <b><?php echo $vote_row['ticket_id'] ?></b> voted <b><?php echo $contesant_row['first_name'] ?> <?php echo $contesant_row['sur_name'] ?></b>
        </a>
        <?php } ?>  
      </div>
      </div>
    </div><!-- /.modal-content -->
  </div>
</div>
<!-- / .modal -->

<div class="padding">

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


<!-- ############ PAGE END-->
<div class="padding">
      <div class="container ">

  <form id="custom2" name="form" class="form-group column" ui-jp="parsley" action="" method="post">
    <h2 class="display-3 _700 l-s-n-3x m-t-lg m-b-md"><span class="text-primary"><center>Generate Tickets</center></span></h2><br>
   <center><div class="form-group row">
      <label class="col-sm-2 form-control-label rounded"></label>
      <div class="col-sm-10">
        <div class="row">
          <div class="col-md-6" style="padding-left: 140px;">
            <input type="text" name="generate" data-parsley-type="number" maxlength="3" max="100" class="form-control rounded" placeholder="How many tickets?" required>
          </div>
          <div class="col-md-2">
         <button type="submit"  name="generate_tix" class="btn rounded warning btn-block">Generate</button>
       </div>
        </div>
      </div>
    </div></center>
  </form><br>

<script type="text/javascript">
function printPage(){
    var divElements = document.getElementById('printDataHolder').innerHTML;
    var oldPage = document.body.innerHTML;
    document.body.innerHTML="<link rel='stylesheet' href='css/common.css' type='text/css' /><body class='bodytext'><div class='padding'><b style='font-size: 16px;'><p class=''>ePageant Management System</p></b></div>"+divElements+"</body>";
    window.print();
    document.body.innerHTML = oldPage;
    }
</script>

  <div class="row" id="printDataHolder">
<h3><span class="text-muted">Invite Code</span> <i><b><?php echo $rowEventName['invite_code'] ?></b> </i></h3><br>    
      <div class="row">
        <?php 
            $query_ticket = "SELECT * FROM ticketing WHERE event_id = '$event_id';";
            $result_ticket = mysqli_query($connection, $query_ticket);
            while ($row_ticket=mysqli_fetch_assoc($result_ticket)) {
              $tickets = $row_ticket['ticket_number'];
   


        ?>
        <div class="col-xs-2">
              <div class="box b-t b-l b-r b-b b-t-primary p-a">
                <div class="clear">
                  <div class="text-muted">Ticket ID<span><p style="font-size: 25px;" class="fa fa-qrcode pull-right"></p></span></div>
                  <h4 class="m-a-0 text-md _600"><a><?php echo $row_ticket['ticket_number'] ?></a></h4>

                  

                </div>

              </div>
          </div>
        <?php } ?>
        </div>
      </div>    
         </div> 

</div>
</div>
<!-- ############ PAGE END-->

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
