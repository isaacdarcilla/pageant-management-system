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






$event_id = $_GET['9bc318fcbdac1b119dc53b8a7de21be1430208c7'];



    $querContest = "SELECT contest_name, contest_id 
                        FROM contest 
                            WHERE event_id=$event_id";
    $resContest = mysqli_query($connection, $querContest);




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

  
  <!-- content -->



    <div ui-view class="app-body" id="view">

<!-- ############ PAGE START-->

<div class="p-a-md primary p-y-lg">
    <h1 class="display-3 _500 l-s-n-2x" style="font-size: 40px;"></h1>
    <div class="row">
      <h4 class="col-md-9 l-h">Statistics <span class="black-translucent"></b> </span> </h4>
    </div>
</div>

<!-- only need a height for layout 4 -->
<div class="padding">

<div class="p-a-md">
  <div class="row p-t-md">
    <div class="col-sm-3 col-sm-push-9">
      <div bs-affix data-offset-top="-80" class="pos-stc-sm text">
        <h5>Contents</h5>
        <nav>
          <ul class="nav">
            <li class="nav-item">
              <a href="#intro" ui-scroll-to="intro">Introduction</a>
            </li>
            <li class="nav-item">
              <a href="#build" ui-scroll-to="build">Developer</a>
            </li>
            <li class="nav-item">
              <a href="#docs" ui-scroll-to="includes">Documentation</a>
            </li>
            <li class="nav-item">
              <a href="#beta" ui-scroll-to="includes">Beta Tester</a>
            </li>            
            <li class="nav-item">
              <a href="#eula" ui-scroll-to="includes">End User License</a>
            </li>  
          </ul>
        </nav>
      </div>
    </div>
    <div class="col-sm-9 col-sm-pull-3">
      <div id="intro">
        <h2 class="m-b">Intro</h2>
        <h5 class="_300 l-h">This thesis was proposed last  <strong>October 2018</strong> at Catanduanes State Unversity's <strong>College of Engineering</strong>, this was based on the concept of <a href="https://www.facebook.com/isaacdarcilla" class="text-warning">Isaac D. Arcilla</a>.</h5>
      </div>
      <div id="build">
        <h2 class="m-t-lg m-b">Developer</h2>
<pre class="box p-a">
Lead Developer & Designer
  |-- Isaac D. Arcilla
</pre>
      </div>
       <div id="docs">
        <h2 class="m-t-lg m-b">Documentation</h2>
<pre class="box p-a">
Documentation
  |-- John Paul C. Bagadiong
  |-- Lyndon T. Buenconsejo
  |-- Donita Mae T. Teano
  |-- Jonah C. Sarmiento
</pre>
      </div>
      <div id="beta">
                <h2 class="m-t-lg m-b">QA & Testing</h2>
<pre class="box p-a">
Quality Assurance
  |-- Isaac D. Arcilla
  |-- John Paul C. Bagadiong
  |-- Lyndon T. Buenconsejo
  |-- Donita Mae T. Teano
  |-- Jonah C. Sarmiento

 Beta Testers
  |--
  |--
</pre>
      </div>
     <!-- <div id="beta">
                <h2 class="m-t-lg m-b">EULA</h2>
<pre class="box p-a">
COPYING OR USE OF THIS SOFTWARE OR ANY ACCOMPANYING DOCUMENTATION EXCEPT AS PERMITTED BY <br>AGREEMENT IS UNAUTHORIZED AND CONSTITUTES A MATERIAL BREACH OF THIS AGREEMENT AND AN INFRINGEMENT <br>OF THE COPYRIGHT AND OTHER INTELLECTUAL PROPERTY RIGHTS IN SUCH SOFTWARE AND DOCUMENTATION. <br>IF YOU COPY OR USE ALL OR ANY PORTION OF THIS SOFTWARE OR ITS USER DOCUMENTATION WITHOUT <br>ENTERING INTO THIS AGREEMENT OR OTHERWISE OBTAINING WRITTEN PERMISSION OF AUTODESK, YOU ARE <br>VIOLATING COPYRIGHT AND OTHER INTELLECTUAL PROPERTY LAW.  YOU MAY BE LIABLE TO AUTODESK AND ITS <br>LICENSORS FOR DAMAGES, AND YOU MAY BE SUBJECT TO CRIMINAL PENALTIES.
</div>

      </div>  -->  
      </div>
    </div>
  </div>
</div>
</div>



<div class="padding">


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
