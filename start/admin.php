<!--
COPYRIGHT (c) 2018 ISAAC D. ARCILLA (isaacdarcilla@gmail.com)

ALL RIGHTS RESERVED.

IF YOU COPY OR USE ALL OR ANY PORTION OF THIS SOFTWARE OR ITS USER DOCUMENTATION WITHOUT ENTERING INTO THIS AGREEMENT OR OTHERWISE OBTAINING WRITTEN PERMISSION OF ISAAC D ARCILLA, YOU ARE VIOLATING COPYRIGHT AND OTHER INTELLECTUAL PROPERTY LAW.  YOU MAY BE LIABLE TO ISAAC AND ITS LICENSORS FOR DAMAGES, AND YOU MAY BE SUBJECT TO CRIMINAL PENALTIES.
-->


<?php 
    session_start(); 
	
	include("config.php");
	
	$connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die("Could not connect to database");
    mysqli_select_db($connection,$db_name);

    if(isset($_SESSION['user_id']))
    {
        $user_id = $_SESSION["user_id"];
         header("Location:admin_create_event.php?user_id=$user_id&username=$username");
    }

    $message = '';
    $username = '';
    $password = '';

    if(isset($_POST['login']))
    {
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);

        $query = "SELECT user_id 
                    FROM user_table 
                        WHERE username='$username' AND password=md5('$password')";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
		
		$user_id = $row['user_id'];
	
        if(mysqli_affected_rows($connection)==1)
        {
            $_SESSION["user_id"] = $user_id;
	
            header("Location:admin_create_event.php?user_id=$user_id&username=$username");
            echo "Success.";
        } 
        else
        {

            $message = "
            Username or password incorrect
            ";

        }
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Admin | ePageant Management System</title>
  <meta name="description" content="Admin, Dashboard, Bootstrap, Bootstrap 4, Angular, AngularJS" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="../assets/imges/logo.png">
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

   <header>
      <nav class="navbar navbar-md navbar-fixed-top white">
        <div class="container">
          <a data-toggle="collapse" data-target="#navbar-1" class="navbar-item pull-right hidden-md-up m-a-0 m-l">
            <i class="fa fa-bars"></i>
          </a>
          
          <!-- brand -->
          <a class="navbar-brand md" href="#home" ui-scroll-to="home">

            <span class="hidden-folded inline">Admin Signin</span>
          </a>
          <!-- / brand -->

          <!-- nabar right -->
          <ul class="nav navbar-nav pull-right">
            <li class="nav-item">
              <a class="nav-link" href="">
                <span class="btn btn-sm rounded warning text-u-c _700">
                  Admin Access Only
                </span>
              </a>
            </li>
          </ul>
          <!-- / navbar right -->
          <!-- navbar collapse -->
          <div class="collapse navbar-toggleable-sm text-center white" id="navbar-1">
            <!-- link and dropdown -->
            <ul class="nav navbar-nav nav-active-border top b-primary pull-right m-r-lg">
              <li class="nav-item">
                <a class="nav-link" href="#demos" ui-scroll-to="demos" >
                  <span class="nav-text"></span> 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">
                  <span class="nav-text"></span> 
                </a>
              </li>
            </ul>
            <!-- / link and dropdown -->
          </div>
          <!-- / navbar collapse -->
        </div>
      </nav>
  </header>< br><br> <br><br><br>
<!-- ############ LAYOUT START-->
  <div class="center-block w-xxl w-auto-xs p-y-md">
    <div class="navbar">
      <div class="pull-center">
        
      </div>
    </div>
	<center><label><span class="warning p-x-md btn-block"> <?php echo $message ?> </span></label><br/></center>
    <div class="p-a-md box-color r box-shadow-z1 text-color m-a">
      <div class="m-b text-sm">
        Sign in as <span class="text-primary _600">ePageant Admin</span>
      </div>
      <form name="form" action="" method="post">
        <div class="md-form-group float-label">
          <input name="username" type="text" class="md-input" ng-model="user.email" required>
          <label>Username</label>
        </div>
        <div class="md-form-group float-label">
          <input name="password" type="password" class="md-input" ng-model="user.password" required>
          <label>Password</label>
        </div>      

        <button type="submit" name="login" class="btn primary btn-block p-x-md" href="dashboard.php">Sign in</button>
      </form>
    </div>

    <div class="p-v-lg text-center">

    </div>
  </div>

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
