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



//if(!isset($_SESSION['sponsor_id']))  
//{
  //  header("Location: s.php");
//}



$event_id = $_GET['eid'];



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
 <!--
  <div class="col-md-7 col-lg-8 v-b">
    <div class="padding">
      <div class="text-center m-b">
        <h6 class="">Overall Points Based on Judges Scores as of <?php print date("G:i a", time());?></h6>
        <p class="text-muted">From highest rank to lowest rank</p>
      </div>
      <div ui-jp="plot" ui-refresh="app.setting.color" ui-options="
        [
          { 
            data: [<?php
        $tabulatedQuery = "SELECT SUM(total_points) AS contest_total, SUM(percentage) AS total_ranking , SUM(rank) AS rank_basis, contestant_id, contestant_name, contestant_number 
                    FROM `overall`
                        WHERE `event_id`='$event_id' GROUP BY contestant_id ORDER BY rank_basis ASC;";
        $tabulatedResult = mysqli_query($connection, $tabulatedQuery);
                      $rank = 0;
                      $total = 0;
                        while($rowTabulated = mysqli_fetch_assoc($tabulatedResult)){
                            if($total !=  $rowTabulated['rank_basis']){
                                    $rank++;
                                }
                                $total = $rowTabulated['rank_basis'];       
                     

            ?>[<?php echo $rank ?>, <?php echo $rowTabulated['contest_total'] ?>], <?php } ?> ], 
            points: { show: true, radius: 5}, 
            splines: { show: true, tension: 0.45, lineWidth: 4, fill: 0.1} 
          },
          { data: [<?php
        $tabulatedQuery = "SELECT SUM(total_points) AS contest_total, SUM(percentage) AS total_ranking , SUM(rank) AS rank_basis, contestant_id, contestant_name, contestant_number 
                    FROM `overall`
                        WHERE `event_id`='$event_id' GROUP BY contestant_id ORDER BY rank_basis ASC;";
        $tabulatedResult = mysqli_query($connection, $tabulatedQuery);
                      $rank = 0;
                      $total = 0;
                        while($rowTabulated = mysqli_fetch_assoc($tabulatedResult)){
                            if($total !=  $rowTabulated['rank_basis']){
                                    $rank++;
                                }
                                $total = $rowTabulated['rank_basis'];       
                     

            ?>[<?php echo $rank ?>, <?php echo $rowTabulated['contest_total'] ?>], <?php } ?> ], 
            bars: { show: true, barWidth: 0.05, align: 'center', lineWidth: 0, fillColor: { colors: [{ opacity: 0.1 }, { opacity: 0.1}] } } 
          }
        ], 
        {
          colors: ['#0cc2aa','#0cc2aa'],
          series: { shadowSize: 3 },
          xaxis: { show: true, font: { color: '#0cc2aa' }, position: 'bottom' },
          yaxis:{ show: false, font: { color: '#ccc' }},
          grid: { hoverable: true, clickable: true, borderWidth: 0, color: 'transparent' },
          tooltip: true,
          tooltipOpts: { content: 'Rank %x.0 with %y.0 points',  defaultTheme: false, shifts: { x: 0, y: -40 } }
        }
      " style="height:360px" >
      </div>

 <div class="text-muted text-xs m-t"><span class="pull-right"></div>
    </div>
  </div>
</div>

-->
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
    <!-- Custom styles for this template -->
    <link href="carousel/carousel.css" rel="stylesheet">



      <div style="padding-top: 80px;" id="myCarousel" class="carousel slide" data-ride="carousel">
        
        <ol class="carousel-indicators" >
<?php 
  $query = "SELECT * FROM overall WHERE event_id = '$event_id'";
  $result = mysqli_query($connection, $query);
  while($rowTab = mysqli_fetch_assoc($result)){

?>          
          <li data-target="#myCarousel" data-slide-to="<?php echo $rowTab['contestant_id']?>" class="active"></li>
<?php }?>          
        </ol>
        <div class="carousel-inner">
<?php 
  $query2 = "SELECT * FROM overall WHERE event_id = '$event_id'";
  $result2 = mysqli_query($connection, $query2);
  while($rowTab2 = mysqli_fetch_assoc($result2)){
    if($rowTab2['rank']==1){
      $stat = 'active';
    }else{
      $stat = '';
    }
?>           
          <div class="carousel-item <?php echo $stat?>"  style="background-color: transparent; ">
           
            <div class="container">
              <div class=" text-left" style="padding-left: 180px; padding-right: 180px; "><br><br>
                <h2 class=" _700 l-s-n-1x m-b-md"><span style="font-size: 50px;">rank</span> <span class="text-warning" style="font-size: 180px;"><?php echo $rowTab2['rank']?></span></h2>                
                <h1 class="text-primary" style="font-style: 'Segoe UI'; font-size: 50px;">#<?php echo $rowTab2['contestant_number']?>&nbsp<b><?php echo $rowTab2['contestant_name']?></b></h1>
                <p>With a total points of <b><?php echo $rowTab2['total_points']?></b> and total rank of <b><?php echo $rowTab2['percentage']?></b>.</p>

              </div>
            </div>
          </div>
<?php }?> 
        </div>

      </div>
</div>
	


<!-- ############ PAGE END-->


  <!-- theme switcher -->
  
 
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
