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


 $querSponsorName = "SELECT * 
                            FROM judge_table
                                WHERE judge_id=$judge_id";
    $resSponsorName= mysqli_query($connection, $querSponsorName);
    $rowSponsorName = mysqli_fetch_assoc($resSponsorName); 

    $querEvent = "SELECT event_id, event_name 
                    FROM event_table JOIN (SELECT event_id FROM judge_event WHERE judge_id=$judge_id) AS judges USING(event_id) ";
    $resEvent = mysqli_query($connection, $querEvent);

////ENTER 

  
  $judge_id = $_GET['judge_id'];
    $event_id = $_GET['event_id'];
    $message = '';
    $event_code = '';

    $querEventName = "SELECT event_name 
                        FROM event_table 
                            WHERE event_id = '$event_id';";
    $resEventName = mysqli_query($connection, $querEventName);
    $rowEventName = mysqli_fetch_assoc($resEventName);


    if(isset($_POST['start']))
    {
        $event_code = $_POST['event_code'];
        $query = "SELECT event_code
                    FROM event_table  
                        WHERE  event_code='$event_code'";

        $result= mysqli_query($connection, $query);
        if(mysqli_affected_rows($connection)==1)
        {
            $query = "SELECT contest_id 
                        FROM contest  
                            WHERE event_id=$event_id LIMIT 1";

            $result= mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($result); 
            $contest_id = $row['contest_id'];
            header("Location:judge_main_page.php?event_id=$event_id&judge_id=$judge_id&contest_id=$contest_id&username=$username");
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
  <meta name="description" content="Admin, Dashboard" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="">
  <meta name="apple-mobile-web-app-title" content="none">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="">
  
  <!-- style -->
  <link rel="stylesheet" href="assets/animate.css/animate.min.css" type="text/css" />
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="assets/styles/app.min.css" type="text/css" />
  <link rel="stylesheet" href="assets/styles/font.css" type="text/css" />
</head>
<body>
  <header>
      <nav class="navbar navbar-md navbar-fixed-top white">
        <div class="container ">
          <a data-toggle="collapse" data-target="#navbar-1" class=" navbar-item pull-right hidden-md-up m-a-0 m-l">
            <i class="fa fa-bars"></i>
          </a>
          
          <!-- brand -->
          <a class="navbar-brand md white" href="#home" ui-scroll-to="home">

            <span class="hidden-folded inline text-warning">ePageant</span>
          </a>
          <!-- / brand -->

          <!-- nabar right -->
         
          <!-- / navbar right -->
          <!-- navbar collapse -->
         <div class="collapse navbar-toggleable-sm text-left white" id="navbar-1">
            <!-- link and dropdown -->
            <ul class="nav navbar-nav nav-active-border top b-primary pull-right m-r-lg">
  

              <li class="nav-item">
                <a class="nav-link" href="judge.php">
                  <span class="nav-text text-danger">Log Out<?php  session_destroy();  ?></span> 
                </a>
              </li>
            </ul>
            <!-- / link and dropdown -->
          </div>
          <!-- / navbar collapse -->
        </div>
      </nav>
  </header>
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
    <div class="p-y-lg" id="">
<div class="p-a-md warning p-y-lg"><br>
  <div class="padding">
    <h1 class="display-3 _500 l-s-n-2x" style="font-size: 40px;">Hello, <b><?php echo $rowSponsorName['first_name'] ?></b>!</h1>
  </div>
</div>      
      <div class="container p-y-lg text-primary-hover">

        <h5 class="text-muted m-b-lg">Select the organized event.</h5>
        <div class="row m-y-lg">
                        <?php
                            while($rowEvent = mysqli_fetch_row($resEvent)){ 
                        ?>
          <div class="col-md-6 col-lg-4">
            <div class="box white box-shadow-z3 text-center">
                <a >
                <!--  <img class="img-responsive b-b m-b" src="../assets/image.jpg" alt="default"> --><br>
                 <span class="_800 p-a block h4 m-a-0"><span class=""></span> <?php echo $rowEvent[1]?>&nbsp<?php print date("Y", time());?></span>
                </a>
                <p class="text-warning"><?php  echo $message ?></p>
  <!--    <div class="m-b" id="accordion">
        <div class="panel box no-border m-b-xs">
          <div class="box-header p-y-sm">
            <a data-toggle="collapse" data-parent="#accordion" data-target="#c_1" >
              Show or hide event information 
            </a>
          </div>
          <div id="c_1" class="collapse out">
            <div class="box-body">
              <p class="text-sm text-muted"> Miss Mach-O is an annual event organized by Fifth Year Engineering Students Association</p>
            </div>
          </div>
        </div>
      </div> -->
                <div class="box-body">
                       <form name="form" class="form-group column" id="custom2" action="" method="post" ui-jp="parsley">
                         <div class="form-group row">
                            <label class="col form-control-label rounded"></label>
                            <div class="col-sm-12">
                              <div class="row">
                          
                                <div class="col-md-8">
                                  <input type="text" data-parsley-type="text" name="event_code" class="form-control rounded" placeholder="Enter the Event Code" required><br>
                                </div>

                                <div class="col-md-4">
                                   <button type="submit" name="start" class="btn rounded warning btn-block">Start</button>
                                 </div>
                              </div>
                            </div>
                          </div>
                      </form>
                </div>
 
            </div>
          </div>
        <?php } ?>
        </div>
        <h5 class="m-y-lg text-muted text-center">It's time for an amazing event!</h5>
      </div>
    </div>
  </div>
  </footer> 
  <script src="libs/jquery/jquery/dist/jquery.js"></script>
  <script src="libs/jquery/tether/dist/js/tether.min.js"></script>
  <script src="libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
  <script src="html/scripts/ui-scroll-to.js"></script>
</body>
</html>
