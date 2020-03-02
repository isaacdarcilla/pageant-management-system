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
$contest_id = $_GET['contest_id'];

 $querSponsorName = "SELECT * 
                            FROM judge_table
                                WHERE judge_id=$judge_id";
    $resSponsorName= mysqli_query($connection, $querSponsorName);
    $rowSponsorName = mysqli_fetch_assoc($resSponsorName); 

    $querEvent = "SELECT event_id, event_name, event_location
                    FROM event_table JOIN (SELECT event_id FROM judge_event WHERE judge_id=$judge_id) AS judges USING(event_id) ";
    $resEvent = mysqli_query($connection, $querEvent);
////CONTEST

    $querContest = "SELECT contest_name, contest_id 
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


    if(isset($_POST['start']))
    {
        $event_code = $_POST['event_code'];
        $query = "SELECT event_code
                    FROM event_table  
                        WHERE event_id=$event_id AND event_code='$event_code'";

        $result= mysqli_query($connection, $query);
        if(mysqli_affected_rows($connection)==1)
        {
            $query = "SELECT contest_id 
                        FROM contest  
                            WHERE event_id=$event_id LIMIT 1";

            $result= mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($result); 
            $contest_id = $row['contest_id'];
            header("Location:judgeTable.php?judge_ID=$judge_ID&event_ID=$event_ID&contest_ID=$contest_ID");
        } 
        else
        {
            $message="Enter the correct event code. <a><u>Help</u></a>.";
        }
    }

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
                <li class="nav-header hidden-folded">
                  <small class="text-muted">Main</small>
                </li>
                
                <li>
                  <a href="judge_main_page.php?event_id=<?php echo $event_id?>&judge_id=<?php echo $judge_id?>&contest_id=<?php echo $contest_id ?>&username=<?php echo $username?>" >
                    <span class="nav-icon">
                      <i class="material-icons">&#xe88a;
                        <span ui-include="'../assets/images/i_0.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text">Home</span>
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
                    <span class="nav-icon ">
                      <i class="material-icons">&#xe879;
                        <span ui-include="'../assets/images/i_0.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text ">Log Out <?php  session_destroy();  ?></span>
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
                <div ui-include="'../views/blocks/dropdown.notification.html'"></div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link clear" href data-toggle="dropdown">
                  <span class="avatar w-32">
                    <img src="assets/avatar.png" alt="...">
                    <i class="on b-white bottom"></i>
                  </span>
                </a>
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
            <div class="collapse navbar-toggleable-sm" id="collapse">
              <div ui-include="'../views/blocks/navbar.form.right.html'"></div>
              <!-- link and dropdown -->
              <ul class="nav navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link" href data-toggle="dropdown">
                    <i class="fa fa-fw fa-plus text-muted"></i>
                    <span>New</span>
                  </a>
                  <div ui-include="'../views/blocks/dropdown.new.html'"></div>
                </li>
              </ul>
              <!-- / -->
            </div>
            <!-- / navbar collapse -->
        </div>
    </div>


    <div ui-view class="app-body" id="view">

<!-- ############ PAGE START-->

<div class="p-a-md warning p-y-lg">
    <h1 class="display-3 _500 l-s-n-2x" style="font-size: 40px;"></h1>
    <div class="row">
      <h4 class="col-md-9 l-h">Rate Our Service <span class="black-translucent"></b> </span> </h4>
    </div>
</div>

<!-- only need a height for layout 4 -->
    <div class="col-sm-9 col-sm-pull-3">
<div class="padding">
        <form ui-jp="parsley" name="form" method="post" action="">
      <div id="intro"><br><br>
        <h2 class="m-b">Question #1</h2>
        <h5 class="_300 l-h">From 1 to 10, <strong>how do you love our software?</strong></h5>
              <!--        <div class="col-sm-12">
                <input type="text" data-parsley-type="number" name="question1" class="form-control rounded" max="10" maxlength="2" required placeholder="1 as lowest and 10 as highest">    
              </div>  -->
      </div>
    

      <div id="intro"><br><br>
        <h2 class="m-b">Question #2</h2>
        <h5 class="_300 l-h">From 1 to 10, <strong>how easy it is to use our software?</strong></h5>
      </div>
      <div id="intro"><br><br>
        <h2 class="m-b">Question #3</h2>
        <h5 class="_300 l-h">From 1 to 10, <strong>how do you enjoy our service?</strong></h5>
      </div>   
      </form>   
</div>
</div>




<!-- ############ PAGE END-->

  <!-- / -->

 
 
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
