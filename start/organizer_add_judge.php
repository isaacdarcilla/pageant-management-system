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
///////////



    $message = '';
    $first_name = '';
  $middle_name = '';
  $sur_name = '';
  $birthday = '';
    $sex = '';
    $email = '';
    $phone_number = '';
    $username2 = '';
    $password = '';
    $judge_code = '';
    $pincode = '';
$profession='';
    function genJudgePass()
    {
        $code = '';
        $count = 0;
        for($count = 0; $count<3; $count++)
        {
            $code = $code.chr(rand(65,90));
            $code = $code.chr(rand(48,57));
        }
        return $code;
    
    } 
  
    if(isset($_POST["add_judge"]))
    {

    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $sur_name = $_POST["sur_name"];
   // $birthday = $_POST["birthday"];
    $sex = $_POST["sex"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $username2 = $_POST["username2"];
    $password = genJudgePass();
   // $pincode = $_POST["pincode"];
$profession = $_POST['profession'];

$md5pass = md5($password);


        if(mysqli_affected_rows($connection)>0)
        {
            $message = 'Judge already exists. Try another username.';
            header("location:organizer_judge.php?sponsor_id=$sponsor_id&username=$username&event_id=$event_id");
        }
        else
        {
            $query_data = "INSERT INTO judge_table  VALUES (NULL,'$first_name', '$middle_name', '$sur_name','$sex', '$email', '$phone_number', '$username2', '$password', '$profession', '$sponsor_id', '$event_id', 0, '$md5pass');"; 
            $insert = mysqli_query($connection, $query_data)
      or die("Could not insert data because $query_data".mysqli_connect_errno());

            if(mysqli_affected_rows($connection)==1)
            {
$event_args = 'Added '.$first_name.' '.$sur_name.' as judge by '.strtoupper($username);
$status = 'Success';
$created_at = date("M, d Y \a\\t g:i a");

$query_logs = "INSERT INTO `event_logs` (`log_id`, `event_id`, `status`, `message`, `sponsor_id`, `created_at`) VALUES (NULL, '$event_id', '$status', '$event_args', '$sponsor_id', '$created_at')";
$result_logs = mysqli_query($connection, $query_logs);

      // print a success message
        header("location:organizer_judge.php?sponsor_id=$sponsor_id&username=$username&event_id=$event_id");
                $message = 'Judge successfully registered.';
            }
        }
    }

////////////
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







  ?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>ePageant Management System <?php echo $created_at ?></title>
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



<!-- / .modal -->
  
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
  </div>
</div>

<div class="padding">
<center><h2 class=" _700 l-s-n-1x m-b-md">Register a <span class="text-warning">Judge</span></h2></center>
    <div class="row padding">
   
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

<div class="page-content" id="home" >
  <center><label"> <?php echo $message ?> </label></center>
 
           <center>      <span  id="custom4" class="text-u-c _800">
          Judge Details
                </span> </center><br>
 <form id="custom2" name="form" class="form-group column" action="" method="post" ui-jp="parsley">
   <div class="form-group row">
      <label class="col-sm-2 form-control-label rounded"></label>
      <div class="col-sm-10">
        <div class="row">
          <div class="col-md-3">
            <input type="text" name="first_name" class="form-control rounded" placeholder="First name" required>
          </div>
          <div class="col-md-3">
            <input type="text" name="middle_name" class="form-control rounded" placeholder="Middle name" required>
          </div>
          <div class="col-md-3">
            <input type="text" name="sur_name" class="form-control rounded" placeholder="Sur name" required>
          </div>
        </div>
      </div>
    </div>
   <div class="form-group row">
      <label class="col-sm-2 form-control-label rounded"></label>
      <div class="col-sm-10">
        <div class="row">

          <div class="col-md-3">
          <select id="single" name="sex" required="true" placeholder="Select gender" class="form-control select2 rounded" ui-jp="select2" ui-options="{theme: 'AngularJS'}">
          
          <optgroup label="Gender Orientation">
               <option name="sex" value="Straight">Straight</option>   
            <option name="sex" value="Lesbian">Lesbian</option>            
            <option name="sex" value="Gay">Gay</option>
            <option name="sex" value="Bisexual">Bisexual</option>
            <option name="sex" value="Transgender">Transgender</option>                           
          </optgroup>

        </select>
          </div>
      
       <div class="col-md-6">
            <input type="text" name="profession" class="form-control rounded" placeholder="Professional Background " required>
          </div>

        </div>

   
        </div>        
      </div>
  <br>

   <div class="form-group row">
      <label class="col-sm-2 form-control-label rounded"></label>
      <div class="col-sm-10">
        <div class="row">
          <div class="col-md-5">
            <input type="email" name="email" class="form-control rounded" placeholder="Email Address" required>
          </div>
          <div class="col-md-4">
            <input type="text" name="phone_number" data-parsley-type="digits" class="form-control rounded" placeholder="Phone Number e.g. 09XX XXXX XXX" maxlength="11" minlength="10" required>
          </div>
        </div>
      </div>
    </div><br>
   <div class="form-group row">
      <label class="col-sm-2 form-control-label rounded"></label>
      <div class="col-sm-10">
        <div class="row">
          <div class="col-md-4">
            <input type="text" name="username2" class="form-control rounded" placeholder="Username" required>
          </div>
          <div class="col-md-5">
         <button type="submit"  name="add_judge" class="btn rounded primary btn-block">Register</button>
       </div>
        </div>
      </div>
    </div><br>


    <!-- /.modal-content -->
  </form>  
  
  
</div>
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
