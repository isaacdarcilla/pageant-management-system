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
                  <small class="text-muted">Contestant Switcher</small>
                </li>
            <?php 
                    $querContestant = "SELECT *
                                        FROM contestant_info_table WHERE event_id_sponsor=$event_id";
                    $resContestant = mysqli_query($connection, $querContestant);
                 

                    while($rowContestant = mysqli_fetch_assoc($resContestant)){

            ?> 
                <li>
                  <a href="judge_vote_page.php?event_id=<?php echo $event_id?>&judge_id=<?php echo $judge_id?>&contest_id=<?php echo $contest_id ?>&username=<?php echo $username?>&cui=<?php echo $rowContestant['username']?>" onclick="window.location.reload();">
                    <span class="nav-icon">
              <span class="">
                <strong class="text" style="font-size: 20px;">#<?php echo $rowContestant['contestant_number']?></strong>
              </span>
                    </span>
                    <span class="nav-text"><b><?php echo $rowContestant['first_name']?></b></span>
                  </a>
                </li> 
                <?php } ?> 
              <!--  <li class="nav-header hidden-folded">
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
                </li>-->
                                         
               <!-- <li>
                  <a href="j.php" >
                    <span class="nav-icon ">
                      <i class="material-icons">&#xe879;
                        <span ui-include="'../assets/images/i_0.svg'"></span>
                      </i>
                    </span>
                    <span class="nav-text "></span>
                  </a>
                </li>-->
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
             <!-- <li class="nav-item dropdown pos-stc-xs">
                <a class="nav-link text-warning" href data-toggle="modal" data-target="#m-a-a" ui-toggle-class="zoom" ui-target="#animate">
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
              </li>   -->                     
              <li class="nav-item dropdown">
                <a class="nav-link clear" href data-toggle="dropdown">
                  <span class="avatar w-32">
                    <img src="assets/avatar.png" alt="...">
                    <i class="on b-white bottom"></i>
                  </span>
                </a>
        <div class="dropdown-menu dropdown-menu-scale pull-right">
          <a class="dropdown-item" data-toggle="modal" data-target="#top">View My Profile</a>
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
            <div class="collapse navbar-toggleable-sm" id="collapse">
              <div ui-include="'../views/blocks/navbar.form.right.html'"></div>
              <!-- link and dropdown -->
              <ul class="nav navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link" href data-toggle="dropdown">
                    <i class="fa fa-fw fa-plus text-muted"></i>
                    <span data-toggle="modal" data-target="#bottom">Vote</span>
                  </a>
                  <div ui-include="'../views/blocks/dropdown.new.html'"></div>
                </li>
              </ul>
              <!-- / -->
            </div>
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

<?php
  $myQuery = "SELECT sponsor_id FROM event_sponsor_two WHERE event_id = $event_id";
  $myResult = mysqli_query($connection, $myQuery);
  $myRow = mysqli_fetch_assoc($myResult);

  $sponsor_id = $myRow['sponsor_id'];

  $myQuery2 = "SELECT sponsor_name FROM sponsor_organizer WHERE sponsor_id = $sponsor_id";
  $myResult2 = mysqli_query($connection, $myQuery2);
  $myRow2 = mysqli_fetch_assoc($myResult2);

  $sponsor_name = $myRow2['sponsor_name'];  
?>

<div class="p-a-md primary p-y-lg">
    <h1 class="display-3 _500 l-s-n-2x" style="font-size: 40px;"><?php echo $rowEventName['event_name']?> <?php print date("Y", time()); ?></h1>
    <div class="row">
      <h4 class="col-md-9 l-h">Organized by <span class="black-translucent"><b><?php echo $sponsor_name?></b> </span> </h4>
    </div>
</div>

<!-- only need a height for layout 4 -->

<br>
<div class="">
 <!-- <h5 class="text-muted text-center">Please <b>do not start judging</b> if the contestant is not performing yet</h5><br>-->
            <?php 
                    $querContestant = "SELECT *
                                        FROM contestant_info_table WHERE event_id_sponsor=$event_id";
                    $resContestant = mysqli_query($connection, $querContestant);
                 
                    $contestants=0;
                    while($rowContestant = mysqli_fetch_assoc($resContestant)){
                       
                      
            ?>
    <!-- <i class="material-icons md-24">(.*)</i>   <em>$1</em>-->
<div class="modal fade" id="bottom">
  <div class="bottom white b-t" style="height:400px">
 
  </div>
</div>
<div class="col-sm-4">
          <div class="box">
            <div class="item dark">
              <div class="item-overlay active p-a">
                <h3><a href class="pull-right  rounded label label-md warning">#<?php echo $rowContestant['contestant_number']?></a></h3>
                <span></span>
              </div>

                <a href><img src="assets/p0.jpg" class="w-full"></a> 

             <!--
                
                'yourfolder' - contains all the image of contestants
                Edit this with the same folder name followed by the photo

                Eg. assets/epageant/

                Image extension is .jpg

                Should be name 1.jpg, 2.jpg, 3.jpg, etc.

                <a href><img src="assets/yourfolder/<?php echo $rowContestant['contestant_number'].'.jpg' ?>" class="w-full"></a> 

              -->
                <div class="item-overlay black-overlay w-full">
                  <a href="judge_vote_page.php?event_id=<?php echo $event_id?>&judge_id=<?php echo $judge_id?>&contest_id=<?php echo $contest_id ?>&username=<?php echo $username?>&cui=<?php echo $rowContestant['username']?>" class="center text-md"><i class="fa fa-eye" style="font-style: Helvetica"> </i></a>
                </div>
                <div class="bottom gd-overlay p-a-xs">
                  <a href class="text-md block p-x-sm" style="font-size: 25px;"><?php echo $rowContestant['first_name']?>&nbsp<?php echo $rowContestant['sur_name']?>, <?php echo $rowContestant['age']?></a>
                  <a href class="text-muted">&nbsp&nbsp&nbsp<?php echo $rowContestant['municipality']?>, <?php echo $rowContestant['province']?> <?php echo $rowContestant['zipcode']?> </a>
                </div>

                <div class="top item-overlay text-right p-x-xs">
                  <a href ui-toggle-class class="text-md p-a-sm inline">
                    <i class="fa fa-heart-o inline"></i>
                    <i class="fa fa-heart text-danger none"></i>
                  </a>
                </div>
            </div>
            <a href="judge_vote_page.php?event_id=<?php echo $event_id?>&judge_id=<?php echo $judge_id?>&contest_id=<?php echo $contest_id ?>&username=<?php echo $username?>&cui=<?php echo $rowContestant['username']?>"class="md-btn md-raised md-fab md-mini m-r pos-rlt md-fab-offset pull-right white"><i class="material-icons md-24">&#xe145;</i></a>
            <div class="p-a">
              <div class="text-muted m-b-xs">
                <span class="m-r"><i class="fa fa-calendar"></i> <?php echo  date('F j', strtotime(str_replace('-','/',$rowContestant['birthday']))) ?></span>
                <a href class="m-r"><i class="fa fa-cutlery"></i> <?php echo $rowContestant['weight']?>KG</a>
                <a href><i class="fa fa-arrows-v"></i> <?php echo $rowContestant['height']?>CM</a>
              </div>              


            </div>
          </div>
        </div>        
<!--jasaskaska-->
<?php } ?>
  </div>
  





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
