<!--
COPYRIGHT (c) 2018 ISAAC D. ARCILLA (isaacdarcilla@gmail.com)

ALL RIGHTS RESERVED.

IF YOU COPY OR USE ALL OR ANY PORTION OF THIS SOFTWARE OR ITS USER DOCUMENTATION WITHOUT ENTERING INTO THIS AGREEMENT OR OTHERWISE OBTAINING WRITTEN PERMISSION OF ISAAC D ARCILLA, YOU ARE VIOLATING COPYRIGHT AND OTHER INTELLECTUAL PROPERTY LAW.  YOU MAY BE LIABLE TO ISAAC AND ITS LICENSORS FOR DAMAGES, AND YOU MAY BE SUBJECT TO CRIMINAL PENALTIES.
-->


<?php 
    session_start(); 
  
  include("config.php");
  
	$db_contestant_table = "contestant_info_table";
	
    $connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die("Could not connect to database");
    mysqli_select_db($connection,$db_name);


    $message = '';
    $first_name = '';
	$middle_name = '';
	$sur_name = '';
	$contestant_number ='';
	$birthday = '';
    $sex = '';
	$height = '';
	$weight = '';
	$complexion ='';
    $email = '';
    $phone_number = '';
	$municipality = '';
	$province='';
	$zipcode='';
    $username = '';
  //  $password = '';
    $contestant_code = '';

	

	
    if(isset($_POST["add_contestant"]))
    {

		$first_name = $_POST["first_name"];
		$middle_name = $_POST["middle_name"];
		$sur_name = $_POST["sur_name"];
		$contestant_number = $_POST["contestant_number"];
		$birthday = $_POST["birthday"];
		$sex = $_POST["sex"];
		$height = $_POST["height"];
		$weight = $_POST["weight"];
		$complexion = $_POST["complexion"];

		$email = $_POST["email"];
		$phone_number = $_POST["phone_number"];
		$municipality = $_POST["municipality"];
		$province = $_POST["province"];
		$zipcode = $_POST["zipcode"];
		$username = $_POST["username"];
		//$password = $_POST["password"];
		$contestant_code = $_POST["contestant_code"];

        $query = "SELECT contestant_info_identification 
                    FROM $db_contestant_table 
                        WHERE username = '$username'";
        $result = mysqli_query($connection, $query);
        if(mysqli_affected_rows($connection)>0)
        {
            $message = 'Contestant already exists. Try another username.';
        }
        else
        {
            $query_data = "INSERT INTO $db_contestant_table  VALUES ('NULL','$first_name', '$middle_name', '$sur_name', '$contestant_number',
						'$birthday','$sex', '$height', '$weight', '$complexion', '$email', '$phone_number', '$municipality', 'province', 
						'$zipcode', '$username', 'NULL', '$contestant_code');"; 
            $insert = mysqli_query($connection, $query_data)
			or die("Could not insert data because ".mysqli_connect_errno());

            if(mysqli_affected_rows($connection)==1)
            {
				
			// print a success message
				header("location:contestant.php#m-sm");
                $message = 'Contestant successfully registered.';
            }
        }
    }

    $querEvent = "SELECT contestant_info_identification, username 
                    FROM $db_contestant_table";
    $resEvent = mysqli_query($connection, $querEvent);
?> 	


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Contestant Wizard | ePagaent Management System</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="../assets/imges/lgo.png">
  <meta name="apple-mobile-web-app-title" content="Flatkit">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="../asset/images/logo.png">
  
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

            <span class="hidden-folded inline">Register a Pageant Contestant</span>
          </a>
          <!-- / brand -->
		<form action="" method="post">
          <!-- nabar right -->
          <ul class="nav navbar-nav pull-right">
         
		   <li class="nav-item">
              <a class="nav-link" href="criteria.php">
                <span  class="btn btn-sm rounded primary text-u-c _700">
					Skip 
                </span>
              </a>
            </li>
          </ul>
		  </form>
          <!-- / navbar right -->
          <!-- navbar collapse -->
          <div class="collapse navbar-toggleable-sm text-center white" id="navbar-1">
            <!-- link and dropdown -->

            <!-- / link and dropdown -->
          </div>
          <!-- / navbar collapse -->
        </div>
      </nav>
  </header>< br><br> <br><br><br><br>
  </div></div>
<!-- ############ LAYOUT START-->


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


 	<center><label"> <?php echo $message ?> </label><br/></center>
 <span class="hidden-folded inline"></span>
    <center>      <span  id="custom4" class="text-u-c _800">
					Personal Information
                </span> </center><br>
 
 <form name="form" class="form-group column" id="custom2" action="" method="post">
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
            <input type="text" name="contestant_number" class="form-control rounded" placeholder="Contestant Number" required>
          </div>
	<div class="col-md-3">
          <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: 'DD/MM/YYYY',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
              <input type='text' name="birthday" required class="form-control rounded" placeholder="Date of Birth"/>
              <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
          </div>
      </div>
          <div class="col-md-3">
            <input type="text" name="sex" class="form-control rounded" placeholder="Sex" required>
          </div>
        </div>
      </div>
    </div>

	 <div class="form-group row">
      <label class="col-sm-2 form-control-label rounded"></label>
      <div class="col-sm-10">
        <div class="row">
          <div class="col-md-3">
            <input type="text" name="height" class="form-control rounded" placeholder="Height" required>
          </div>
          <div class="col-md-3">
            <input type="text" name="weight" class="form-control rounded" placeholder="Weight" required>
          </div>
          <div class="col-md-3">
            <input type="text" name="complexion" class="form-control rounded" placeholder="Complexion" required>
          </div>
        </div>
      </div>
    </div><br>
	          <center>      <span id="custom3" class="text-u-c _800">
					Contact Information
                </span> </center><br>
		 <div class="form-group row">
      <label class="col-sm-2 form-control-label rounded"></label>
      <div class="col-sm-10">
        <div class="row">
          <div class="col-md-5">
            <input type="email" name="email" class="form-control rounded" placeholder="Email Address" required>
          </div>
          <div class="col-md-4">
            <input type="text" name="phone_number" class="form-control rounded" placeholder="Phone Number"required>
          </div>
        </div>
      </div>
    </div>
	 <div class="form-group row">
      <label class="col-sm-2 form-control-label rounded"></label>
      <div class="col-sm-10">
        <div class="row">
          <div class="col-md-3">
            <input type="text" name="municipality" class="form-control rounded" placeholder="Municipality" required>
          </div>
          <div class="col-md-3">
            <input type="text" name="province" class="form-control rounded" placeholder="Province" required>
          </div>
          <div class="col-md-3">
            <input type="text" name="zipcode" class="form-control rounded" placeholder="Zipcode" required>
          </div>
        </div>
      </div>
    </div><br>
		 <center>      <span id="custom5" class="text-u-c _800">
					Login Information
                </span> </center><br>
   <div class="form-group row">
      <label class="col-sm-2 form-control-label rounded"></label>
      <div class="col-sm-10">
        <div class="row">
          <div class="col-md-3">
            <input type="text" name="username" class="form-control rounded" placeholder="Username" required>
          </div>
		  <div class="col-md-3">
            <input type="text" name="contestant_code" value="<?php echo $contestant_code ?>" class="form-control rounded" placeholder="Contestant Code" required>
          </div>
		  		  <div class="col-md-3">
	       <button type="submit" name="add_contestant" class="btn rounded primary btn-block">Register</button>
		   </div>

        </div>
      </div>
    </div><br>

    <!-- /.modal-content -->
	</form>	 
	
	
	<style>	
		#custom{
			margin-left: 300px;
			
			
		}
		#custom2{
			margin-left: 60px;
		}
		#custom3{
			margin-right: 675px;
		}
		#custom4{
			margin-right: 600px;
		}
		#custom5{
			margin-right: 700px;
		}
	</style>
	
	
<!-- ############ LAYOUT END-->

<footer class="black pos-rlt">
    <div class="footer dk">
      <div class="text-center container p-y-lg">
	  
        <div class="clearfix text-lg m-t">
          <strong>Organize</strong>  your next big event
        </div>
        <div class="nav m-y text-primary-hover">
          <a class="nav-link m-x" href="#features" ui-scroll-to="features" >
            <span class="nav-text">Features</span> 
          </a>
          <a class="nav-link m-x" href="">
            <span class="nav-text">Support</span> 
          </a>
          <a class="nav-link m-x" href="angular/#/app/docs">
            <span class="nav-text">Documentation</span> 
          </a>
        </div>
        <div class="block clearfix">
          <a href class="btn btn-icon btn-social rounded btn-sm m-r">
            <i class="fa fa-twitter"></i>
            <i class="fa fa-twitter light-blue"></i>
          </a>
          <a href="https://dribbble.com/flatfull" class="btn btn-icon btn-social rounded btn-sm">
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
              <strong>Catanduanes State University</strong>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- small modal -->
<!-- / .modal -->
  
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
