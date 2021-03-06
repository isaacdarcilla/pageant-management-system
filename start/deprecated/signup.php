<?php 


 $message = "Username or password already taken";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Signup | ePageant Management System</title>
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
 <header>
      <nav class="navbar navbar-md navbar-fixed-top white">
        <div class="container">
          <a data-toggle="collapse" data-target="#navbar-1" class="navbar-item pull-right hidden-md-up m-a-0 m-l">
            <i class="fa fa-bars"></i>
          </a>
          
          <!-- brand -->
          <a class="navbar-brand md" href="" ui-scroll-to="home">

            <span class="hidden-folded inline">ePageant Management System</span>
          </a>
          <!-- / brand -->

          <!-- nabar right -->
          <ul class="nav navbar-nav pull-right">
            <li class="nav-item">
              <a class="nav-link" href="">
                <span class="btn btn-sm rounded accent text-u-c _700">
                  Thesis
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
                <a class="nav-link" href="#features" ui-scroll-to="features" >
                  <span class="nav-text">Features</span> 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">
                  <span class="nav-text">Support</span> 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">
                  <span class="nav-text">Documentation</span> 
                </a>
              </li>
            </ul>
            <!-- / link and dropdown -->
          </div>
          <!-- / navbar collapse -->
        </div>
      </nav>
  </header> <br><br> <br>
<!-- ############ LAYOUT START-->
  <div class="center-block w-xxl w-auto-xs p-y-md">
    <div class="navbar">
      <div class="pull-center">
       
      </div>
    </div>
<center><label"> <?php echo $message ?> </label><br/></center>
    <div class="p-a-md box-color r box-shadow-z1 text-color m-a">
      <div class="m-b text-sm">
        Sign up new ePageant Account
      </div>
      <form name="form" action="user_register.php" method="post">
        <div class="md-form-group">
          <input name="username" type="text" class="md-input" required>
          <label>Username</label>
        </div>
        <div class="md-form-group">
          <input name="email" type="email" class="md-input" required>
          <label>Email</label>
        </div>
        <div class="md-form-group">
          <input name="password" type="password" class="md-input" required>
          <label>Password</label>
        </div>
        <div class="m-b-md">
          <label class="md-check">
            <input type="checkbox" required><i class="primary"></i> I agree to the <a href="privacy.php">Privacy Terms</a>
          </label>
        </div>
        <button type="submit" class="btn primary btn-block p-x-md">Sign up</button>
      </form>
    </div>

    <div class="p-v-lg text-center">
      <div>Already have an account? <a ui-sref="access.signin" href="s.php" class="text-primary _600">Sign in</a></div>
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
