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




////ENTER 

  
  $sponsor_id = $_GET['sponsor_id'];
    $event_id = $_GET['event_id'];
        $username = $_GET['username'];
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
           // header("Location:judge_main_page.php?event_id=$event_id&judge_id=$judge_id&contest_id=$contest_id&username=$username");
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

            <span class="hidden-folded inline text-warning">Masters of Ceremonies</span>
          </a>
          <!-- / brand -->

          <!-- nabar right -->
         
          <!-- / navbar right -->
          <!-- navbar collapse -->
         <div class="collapse navbar-toggleable-sm text-left white" id="navbar-1">
            <!-- link and dropdown -->
            <ul class="nav navbar-nav nav-active-border top b-primary pull-right m-r-lg">

              <li class="nav-item">
                <a class="nav-link" href="../">
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
<div class="p-a-md primary p-y-lg"><br>
  <div class="padding">
    <h1 class="display-3 _500 l-s-n-2x" style="font-size: 40px; "><center><?php echo $rowEventName['event_name'] ?>&nbsp<?php print date("Y", time());?></b></center></h1>
  </div>
</div>      
     
<div class="padding">
  <div class="row">
                             <?php 
                      $queryQW="SELECT contest_id FROM overall WHERE `event_id`='$event_id'; ";
                      $resultQW = mysqli_query($connection, $queryQW);
                      $rowQW = mysqli_fetch_assoc($resultQW);
                            ?>
                                    <?php
                                    if($rowQW['contest_id']!=0)
                                        {
                                          
                                    ?>  

        <?php 
              $querContest = "SELECT *
                        FROM contest 
                            WHERE event_id = $event_id";
              $resContest = mysqli_query($connection, $querContest);
              $increment = 0;
               while($rowContest = mysqli_fetch_assoc($resContest)){
                $contest_id = $rowContest['contest_id'];
                $increment++;
        ?> 
    <div class="col-xs-12 col-sm-12">
          <div class="box p-a">

            <div class="pull-right m-r">
              <span class="w-48 rounded  ">
                <a href="organizer_mc_main.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>&contest_id=<?php echo $rowContest['contest_id']?>"><i  class="fa fa-chevron-right"></i></a>
              </span>
            </div>            
            <div class="clear">
              <h4 class="m-a-0 text-lg _300"><a ><span class=""><b><?php echo $increment?>.</b>&nbsp</span><?php echo $rowContest['contest_name'] ?> <span class="text-sm"></span></a></h4>
              <small class="text-muted">View <b>official contest</b> results</small>
            </div>
          </div>
      </div>

    <?php } ?>

                                                  <?php 
                                        }else{
                                   
                                          ?>  
  <br><br><br><br><br>
                                         <center> <div style="font-size:  75px;" ><span class="fa  fa-gears text-primary"></span></div>
                                          <h2 class="" style="font-size: 20px;"><span class="text">There's no official result yet.</center></span></h2><br>  
                                       
                                          <?php }?>                                           
 

                             <?php 
                      $queryQW="SELECT * FROM official_scores WHERE `event_id`='$event_id'; ";
                      $resultQW = mysqli_query($connection, $queryQW);
                      $rowQW = mysqli_fetch_assoc($resultQW);
                            ?>
                                    <?php
                                    if($rowQW['event_id']!=NULL)
                                        {
                                          
                                    ?>  
  <div class="col-xs-12 col-sm-12">
          <div class="box p-a">

            <div class="pull-right m-r">
              <span class="w-48 rounded  ">
                <a href="organizer_mc_winner.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>"><i  class="fa fa-chevron-right"></i></a>
              </span>
            </div>            
            <div class="clear">
              <h4 class="m-a-0 text-lg _300"><a ><span  class="text-warning"><b>Overall Result </b></span><span class="text-sm"></span></a></h4>
              <small class="text-muted">View <b>official winner</b> of <?php echo $rowEventName['event_name'] ?></small>
            </div>
          </div>
      </div>

                                                  <?php 
                                        }else{
                                   
                                          ?>  

<div></div>
                                        <?php } ?>

    </div>
      
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
