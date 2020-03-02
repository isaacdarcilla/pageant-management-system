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

  

$user_id = $_GET['user_id'];

$username = $_GET['username'];

$event_id = $_GET['event_id'];

    $message = '';
    $event_name = '';
  $event_org = '';
  $event_location = '';
  $time = '';
    $date = '';
  
  //  if(isset($_SESSION['user_id']))
    //{
      //header("Location:a.php");
    //} 


  $queryUser = "SELECT username 
                        FROM user_table 
                            WHERE username = '$user_id';";
        $resultUser = mysqli_query($connection, $queryUser);
        $rowUser = mysqli_fetch_assoc($resultUser); 


  $querEvent = "SELECT event_id, event_name 
                    FROM $db_event_table WHERE event_id = '$event_id'" ;
        $resEvent = mysqli_query($connection, $querEvent);
        $rowEvent = mysqli_fetch_assoc($resEvent);



?>  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>ePageant Management System | (<?php echo $username?>)</title>
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
        	<span class="hidden-folded inline">Administration</span>
        </a>
        <!-- / brand -->
      </div>
      <div flex class="hide-scroll">
          <nav class="scroll nav-light">
            
              <ul class="nav" ui-nav>
                <li class="nav-header hidden-folded">
                  <small class="text-muted">Index</small>
                </li>
                
                <li>
                  <a href="admin_home.php?user_id=<?php echo $user_id ?>&username=<?php echo $username ?>" >
                    <span class="nav-icon">
                      <i>
                        <span class="fa fa-home"></span>
                      </i>
                    </span>
                    <span class="nav-text">Home Page</span>
                  </a>
                </li>

                <li class="nav-header hidden-folded">
                  <small class="text-muted">Event</small>
                </li>
                
                <li>
                  <a href="admin_my_event.php?user_id=<?php echo $user_id ?>&username=<?php echo $username ?>" >
                    <span class="nav-icon">
                      <i>
                        <span class="fa fa-star"></span>
                      </i>
                    </span>
                    <span class="nav-text">Events</span>
                  </a>
                </li>
     
                <li>

    
                  <a href="admin_create_event.php?user_id=<?php echo $user_id ?>&username=<?php echo $username ?>" >
                    <span class="nav-icon">
                      <i>
                        <span class="fa fa-tag"></span>
                      </i>
                    </span>
                    <span class="nav-text">Create Event</span>
                  </a>
                </li>       

       <li class="nav-header hidden-folded">
                  <small class="text-muted">Organizer</small>
                </li>
                
                <li>
                  <a href="admin_organizer.php?user_id=<?php echo $user_id ?>&username=<?php echo $username ?>" >
                    <span class="nav-icon">
                      <i>
                        <span class="fa fa-star"></span>
                      </i>
                    </span>
                    <span class="nav-text">Organizers</span>
                  </a>
                </li>
     
                <li>
                  <a href="admin_register_organizer.php?user_id=<?php echo $user_id ?>&username=<?php echo $username ?>" >
                    <span class="nav-icon">
                      <i>
                        <span class="fa fa-user"></span>
                      </i>
                    </span>
                    <span class="nav-text">Register Organizer</span>
                  </a>
                </li>         
            <li class="nav-header hidden-folded">
                  <small class="text-muted">Monitor</small>
                </li>
                
                <li>
                  <a href="logs.php?user_id=<?php echo $user_id ?>&username=<?php echo $username ?>" >
                    <span class="nav-icon">
                      <i>
                        <span class="fa fa-rss"></span>
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
        	      <img src="assets/avatar.png" alt="Profile" class="w-40 img-circle">
        	    </span>
        	    <span class="clear hidden-folded p-x">

				
        	      <span class="block _500">
				  <?php
					echo $username;
				  ?>
				  
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





	<!-- large modal -->
<!-- .modal -->
<div id="m-md" class="modal" data-backdrop="true">
  <div class="modal-dialog black">
    <div class="modal-content black">
      <div class="modal-header">
      	<h5 class="modal-title">Admin</h5>
      </div>
      <div class="modal-body text-center p-lg">

    <div class="form-group row">
        <h6>Do you want to log out?</h6>
    </div>	         
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn dark p-x-md" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn dark p-x-md">Log Out</button>
      </div>
    </div><!-- /.modal-content -->
  </div>
</div>
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
    <div ui-view class="app-body" id="view">

<!-- ############ PAGE START-->
<div class="p-a white lt box-shadow">
	<div class="row">
		<div class="col-sm-6">
			<h4 class="m-b-0 _300">Welcome, <?php echo $username ?>!</h4>
			<small class="text-muted">Organize <strong></strong> your pageant event with ease</small>
		</div>
	</div>
</div>
<div class="padding">
	<div class="row">
		
<script type="text/javascript">
function PrintPage(){
    var divElements = document.getElementById('printDataHolder').innerHTML;
    var oldPage = document.body.innerHTML;
    document.body.innerHTML="<link rel='stylesheet' href='css/common.css' type='text/css' /><body class='bodytext'>"+divElements+"</body>";
    window.print();
    document.body.innerHTML = oldPage;
    }
</script>
<script type="text/javascript">
function PrintPage2(){
    var divElements = document.getElementById('printDataHolder2').innerHTML;
    var oldPage = document.body.innerHTML;
    document.body.innerHTML="<link rel='stylesheet' href='css/common.css' type='text/css' /><body class='bodytext'>"+divElements+"</body>";
    window.print();
    document.body.innerHTML = oldPage;
    }
</script>
<!-- ############ PAGE START-->
<div>
  <a href="admin_my_event.php?user_id=<?php echo $user_id ?>&username=<?php echo $username ?>"><i class=" fa fa-chevron-left"></i>&nbspGo back</a>

</div>
<center><h2 class=" _700 l-s-n-1x m-b-md"> <span class="text-primary"><?php echo $rowEvent['event_name'] ?></span> Data</h2></center>
<div class="padding">
  <div class="box" id="printDataHolder">
    <div class="box-header">
      <h2><b>Contestants Data Table</b></h2>
    </div>
	            <div class="box-tool">
            <ul class="nav">
              <li class="nav-item inline dropdown">
                <p class=""></p>
              </li>
              <li class="nav-item inline dropdown">
                    <a   class="btn btn-xs pull-right" ><i class="fa fa-print " onclick="PrintPage();"></i>&nbsp Print</a>
              </li>
            </ul>
          </div>  
    <div class="table-bordered table-hover">
      <table   class="table table-striped b-t b-b">
        <thead>
          <tr>
            <th  style="width:3%" class="text-warning">ID</th>
            <th  style="width:3%" class="text-warning">Name</th>
            <th  style="width:7%" class="text-warning">#</th>
       <!--     <th  style="width:10%">Sponsor Name</th> -->
            <th  style="width:6%" class="text-warning">Birthday</th>
            <th  style="width:5%" class="text-warning">Sex</th>
            <th  style="width:6%" class="text-warning">Email</th>
            <th  style="width:6%" class="text-warning">Phone #</th>
            <th  style="width:3%" class="text-warning">Municipality</th>
            <th  style="width:3%" class="text-warning">Username</th> 
                        
          </tr>
          
            <?php 
              $numberOfEntity = 0;

 $query = "SELECT * 
                    FROM contestant_info_table WHERE event_id_sponsor=$event_id";
        $result = mysqli_query($connection, $query);
      
                while ($row = mysqli_fetch_assoc($result)) 
                  {
                ?>
                <tr>
                  <th style="width:3%"> <?php echo $row['contestant_id'] ?> </th>
                  <th style="width:3%"> <?php echo $row['first_name'] ?>&nbsp<?php echo $row['sur_name'] ?> </th>
                 <th style="width:7%"> <?php echo $row['contestant_number'] ?> </th> 
             <th style="width:7%"> <?php echo $row['birthday'] ?> </th> 
                  <th style="width:6%"> <?php echo $row['sex'] ?> </th>
                  <th style="width:5%"> <?php echo $row['email'] ?> </th>
                  <th style="width:6%"> <?php echo $row['phone_number'] ?> </th>
                  <th style="width:4%"> <?php echo $row['municipality'] ?> </th>
                  <th style="width:4%" class="text-primary"> <?php echo $row['username'] ?> </th>                  
                             

                 </tr>
                 <?php
                      }
                 ?>   
         

        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>

 <div class="box" id="printDataHolder2">
    <div class="box-header">
      <h2><b>Judges Data Table</b></h2>
    </div>
              <div class="box-tool">
            <ul class="nav">
              <li class="nav-item inline dropdown">
                <p class=""></p>
              </li>
              <li class="nav-item inline dropdown">
                    <a   class="btn btn-xs pull-right" ><i class="fa fa-print " onclick="PrintPage2();"></i>&nbsp Print</a>
              </li>
            </ul>
          </div>     
    <div class="table-bordered table-hover">
      <table   class="table table-striped b-t b-b">
        <thead>
          <tr>
            <th  style="width:3%" class="text-warning">ID</th>
            <th  style="width:3%" class="text-warning">Name</th>
            <th  style="width:7%" class="text-warning">Sex</th>
       <th  style="width:7%"class="text-warning">Profession</th>
         
            <th  style="width:5%" class="text-warning">Phone Number</th>
            <th  style="width:6%" class="text-warning">Username</th>
            <th  style="width:6%" class="text-warning">Password</th>
                      
          </tr>
          
            <?php 
              $numberOfEntity = 0;

 $query = "SELECT * 
                    FROM judge_table WHERE event_id=$event_id";
        $result = mysqli_query($connection, $query);
      
                while ($row = mysqli_fetch_assoc($result)) 
                  {
                ?>
                <tr>
                  <th style="width:3%"> <?php echo $row['judge_id'] ?> </th>
                  <th style="width:3%"> <?php echo $row['first_name'] ?>&nbsp<?php echo $row['sur_name'] ?> </th>
                 <th style="width:7%"> <?php echo $row['sex'] ?> </th> 
             <th style="width:7%"> <?php echo $row['profession'] ?> </th> 
                  <th style="width:6%"> <?php echo $row['phone_number'] ?> </th>
  
                  <th style="width:4%" class="text-primary"> <?php echo $row['username'] ?> </th>                  
                  <th style="width:4%" class="text-primary"> <?php echo $row['is_unhash'] ?> </th>                  

                 </tr>
                 <?php
                      }
                 ?>   
         

        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>

</div>

<!-- ############ PAGE END-->



	</div>
</div>


<!-- ############ PAGE END-->

    </div>
  </div>
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