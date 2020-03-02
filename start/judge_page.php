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
    <link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
  <!-- build:css ../assets/styles/app.min.css -->
  <link rel="stylesheet" href="../assets/styles/app.css" type="text/css" />
  <!-- endbuild -->
  <link rel="stylesheet" href="../assets/styles/font.css" type="text/css" />
</head>
<body>
  <header>
      <nav class="navbar navbar-md navbar-fixed-top white">
        <div class="container ">
          <a data-toggle="collapse" data-target="#navbar-1" class=" navbar-item pull-right hidden-md-up m-a-0 m-l">
            <i class="fa fa-bars"></i>
          </a>
          
          <!-- brand -->
          <a class="navbar-brand md white" href="" ui-scroll-to="home">

            <span class="hidden-folded inline text-warning"><span class="text-warning"><?php echo ($rowSponsorName['first_name']) ?>&nbsp<?php echo ($rowSponsorName['sur_name']) ?></span></span>
          </a>
          <!-- / brand -->

          <!-- nabar right -->
         
          <!-- / navbar right -->
          <!-- navbar collapse -->
         <div class="collapse navbar-toggleable-sm text-left white" id="navbar-1">
            <!-- link and dropdown -->
            <ul class="nav navbar-nav nav-active-border top b-primary pull-right m-r-lg">
              <li class="nav-item">
                <a class="nav-link" href="#demos" ui-scroll-to="demos" >
                  <span class="nav-text">Home</span> 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#features" ui-scroll-to="features" >
                  <span class="nav-text">About</span> 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">
                  <span class="nav-text">Rate Us</span> 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="j.php">
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
      <div class="container p-y-lg text-primary-hover">
          
        <h5 class="text-muted m-b-lg">&nbsp&nbsp<span class="fa fa-circle text-primary"></span>&nbsp<?php echo $rowEventName['event_name']?></h5>
        

<!---HERE--->
            <?php 
                    $querContestant = "SELECT *
                                        FROM contestant_info_table WHERE event_id_sponsor=$event_id";
                    $resContestant = mysqli_query($connection, $querContestant);
                 

                    while($rowContestant = mysqli_fetch_assoc($resContestant)){
            ?>
  <div class="box">
    <div class="box-header b-b">
      <h2><b><span class="text-primary">#<?php echo $rowContestant['contestant_number']?></b></span>&nbsp<?php echo $rowContestant['first_name']?>&nbsp<?php echo $rowContestant['sur_name']?></h2>
    </div>
    <div class="box-body">
        <form ui-jp="parsley" id="form">
          <div id="rootwizard" ui-jp="bootstrapWizard" ui-options="{
            onTabClick: function(tab, navigation, index) {
              return false;
            },
            onNext: function(tab, navigation, index) {
              var instance = $('#form').parsley();
              instance.validate();
              if(!instance.isValid()) {
                return false;
              }
            }
            }">
            <ul class="nav nav-pills clearfix warning">
              <li class="nav-item"><a class="nav-link" href="#tab1" data-toggle="tab">First</a></li>
              <li class="nav-item"><a class="nav-link" href="#tab2" data-toggle="tab">Second</a></li>
              <li class="nav-item"><a class="nav-link" href="#tab3" data-toggle="tab">Third</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="tab1">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" required>                        
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" required>                        
                  </div>
                  <div class="row m-b">
                    <div class="col-sm-6">
                      <label>Enter password</label>
                      <input type="password" class="form-control" required id="pwd">   
                    </div>
                    <div class="col-sm-6">
                      <label>Confirm password</label>
                      <input type="password" class="form-control" data-parsley-equalto="#pwd" required>      
                    </div>   
                  </div>
                  <div class="form-group">
                    <label>Phone</label>
                    <input type="number" class="form-control" placeholder="XXX XXXX XXX" required>
                  </div>
                  <div class="checkbox">
                    <label class="ui-check">
                      <input type="checkbox" name="check" checked required="true"><i></i> I agree to the <a href="#" class="text-info">Terms of Service</a>
                    </label>
                  </div>
                </div>
                <div class="tab-pane" id="tab2">
                  <div class="form-group">
                    <label>URL</label>
                    <input type="url" class="form-control">
                  </div>
                </div>
                <div class="tab-pane" id="tab3">
                3
                </div>
                <ul class="pager wizard">
                  <li class="previous first" style="display:none;"><a href="#">First</a></li>
                  <li class="previous"><a href="#">Previous</a></li>
                  <li class="next last" style="display:none;"><a href="#">Last</a></li>
                  <li class="next"><a href="#">Next</a></li>
                </ul>
            </div>  
          </div>
        </form>
    </div>
  </div>
<?php } ?>

        <h5 class="m-y-lg text-muted text-center">It's time for an amazing event!</h5>



      </div>
    </div>
</div>


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

  </footer> 

  <script src="libs/jquery/jquery/dist/jquery.js"></script>
  <script src="libs/jquery/tether/dist/js/tether.min.js"></script>
  <script src="libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
  <script src="html/scripts/ui-scroll-to.js"></script>
</body>
</html>
