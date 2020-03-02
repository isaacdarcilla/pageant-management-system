<!--
COPYRIGHT (c) 2018 ISAAC D. ARCILLA (isaacdarcilla@gmail.com)

ALL RIGHTS RESERVED.

IF YOU COPY OR USE ALL OR ANY PORTION OF THIS SOFTWARE OR ITS USER DOCUMENTATION WITHOUT ENTERING INTO THIS AGREEMENT OR OTHERWISE OBTAINING WRITTEN PERMISSION OF ISAAC D ARCILLA, YOU ARE VIOLATING COPYRIGHT AND OTHER INTELLECTUAL PROPERTY LAW.  YOU MAY BE LIABLE TO AUTODESK AND ITS LICENSORS FOR DAMAGES, AND YOU MAY BE SUBJECT TO CRIMINAL PENALTIES.
-->

 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>ePageant Management System</title>
  <meta name="description" content="A sleek web application for managing and organizing your pageant events. Sign up now!" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="../assets/images/logo.png">
  <meta name="apple-mobile-web-app-title" content="none">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">
  
  <!-- style -->
  <link rel="stylesheet" href="assets/animate.css/animate.min.css" type="text/css" />
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="assets/styles/app.min.css" type="text/css" />
  <link rel="stylesheet" href="assets/styles/font.css" type="text/css" />
</head>
<body>
  <header>
      <nav class="navbar navbar-md navbar-fixed-top black">
        <div class="container ">
          <a data-toggle="collapse" data-target="#navbar-1" class=" navbar-item pull-right hidden-md-up m-a-0 m-l">
            <i class="fa fa-bars"></i>
          </a>
          
          <!-- brand -->
          <a class="navbar-brand md black" href="#home" ui-scroll-to="home">

            <span class="hidden-folded inline ">ePageant</span>
          </a>
          <!-- / brand -->

          <!-- nabar right -->

          <!-- / navbar right -->
          <!-- navbar collapse -->
          <div class="collapse navbar-toggleable-sm text-center black" id="navbar-1">
            <!-- link and dropdown -->
            <ul class="nav navbar-nav black nav-active-border top b-primary pull-right m-r-lg">
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
                  <span class="nav-text">Events</span> 
                </a>
              </li>
              <li class="nav-item ">
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
  <div class="page-content" id="home">
    <div class="h-v black row-col">
      <div class="row-cell v-b">
        <div class="container p-y-lg pos-rlt">
          <h1 class="display-3 _700 l-s-n-3x m-t-lg m-b-md">It's time for an <span class="text-primary">amazing</span> event</h1>
          <h5 class="text-muted m-b-lg">Organize your <span class="label accent">PAGEANT</span> choose your role.</h5>
          
         <!-- <a href="start/admin.php" class="btn btn-lg btn-outline b-primary text-primary b-2x">Admin</a>-->
          <a href="start/sponsor.php" class="btn btn-lg btn-outline b-accent text-accent b-2x">Organizer</a>
          <a href="start/judge.php" class="btn btn-lg btn-outline b-warning text-warning b-2x">Judge</a>
          <a href="start/audience.php" class="btn btn-lg btn-outline b-info text-info b-2x">Audience</a>          
        </div>
      </div>
    </div>
 <!--
    <div class="pos-rlt" id="features">
      <div class="h-v-5 row-col text-center">
        <div class="col-sm-6 deep-purple v-m">
          <div class="p-a-lg">
            <h2 class=" _700 l-s-n-1x m-y m-b-md">Minimal UI</h2>
            <p class="h5 text-muted l-h">A user-friendly system, view standing of contestant using charts and visual data.</p>
          </div>
        </div>
        <div class="col-sm-6 red-700 v-m">
          <div class="p-a-lg">
            <h2 class=" _700 l-s-n-1x m-y m-b-md">Registration</h2>
            <p class="h5 text-muted l-h">Wizard-type registration form for judges, contestants and the events.</p>
          </div>
        </div>
      </div>
      <div class="h-v-5 row-col text-center">
        <div class="col-sm-6 primary v-m">
          <div class="p-a-lg">
            <h2 class=" _700 l-s-n-1x m-y m-b-md">Easy Judging</h2>
            <p class="h5 text-muted l-h">Comprehensive criteria of choices for a dynamically customizable system.</p>
          </div>
        </div>
        <div class="col-sm-6 warn v-m">
          <div class="p-a-lg">
            <h2 class=" _700 l-s-n-1x m-y m-b-md">Automated</h2>
            <p class="h5 l-h">Eliminating the need to hand prepare a master scorecard, auto-generation of reports.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="black pos-rlt">
    <div class="footer dk">
      <div class="text-center container p-y-lg">
        <div class="clearfix text-lg m-t">
          <strong>Pageant Judging System</strong> for your next big event
        </div>
        <div class="nav m-y text-primary-hover">
          <a class="nav-link m-x" href="#demos" ui-scroll-to="demos" >
            <span class="nav-text"></span>
          </a>
          <a class="nav-link m-x" href="#features" ui-scroll-to="features" >
            <span class="nav-text">Features</span> 
          </a>
          <a class="nav-link m-x" href="">
            <span class="nav-text">Support</span> 
          </a>
          <a class="nav-link m-x" href="">
            <span class="nav-text">Documentation</span> 
          </a>
        </div>
        <div class="block clearfix">
          <a href="https://www.facebook.com/isaacdarcilla" class="btn btn-icon btn-social rounded btn-sm m-r">
            <i class="fa fa-facebook"></i>
            <i class="fa fa-facebook blue"></i>
          </a>
          <a href="https://twitter.com/newtonianx" class="btn btn-icon btn-social rounded btn-sm m-r">
            <i class="fa fa-twitter"></i>
            <i class="fa fa-twitter light-blue"></i>
          </a>
          <a href="" class="btn btn-icon btn-social rounded btn-sm">
            <i class="fa fa-dribbble"></i>
            <i class="fa fa-dribbble pink"></i>
          </a>
        </div>
      </div>
      <div class="b b-b"></div>
      <div class="p-a-md">
        <div class="row footer-bottom">
          <div class="col-sm-8">
            <small class="text-muted">&copy; Copyright 2018 Isaac D. Arcilla</small>
          </div>
          <div class="col-sm-4">
            <div class="text-sm-right text-xs-left">
              Catanduanes State University
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer> -->
  <script src="libs/jquery/jquery/dist/jquery.js"></script>
  <script src="libs/jquery/tether/dist/js/tether.min.js"></script>
  <script src="libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
  <script src="html/scripts/ui-scroll-to.js"></script>
</body>
</html>
