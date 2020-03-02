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

$sponsor_id = $_GET['sponsor_id'];

$username = $_GET['username'];

$event_id = $_GET['event_id'];

$contest_id =$_GET['contest_id'];

$md5_event_id = md5($event_id);



    function generateEventCode()
    {
        $code = '';
        $count = 0;
        for($count = 0; $count<3; $count++)
        {
            $code = $code.chr(rand(65,90));
            $code = $code.chr(rand(48,57));
            
        }
        return $code;
    
    } 
    function generateEventCode2()
    {
        $code = '';
        $count = 0;
        for($count = 0; $count<3; $count++)
        {
            $code = $code.chr(rand(65,90));
            $code = $code.chr(rand(48,57));
            $code = $code.chr(rand(97,122));
        }
        return $code;
    
    } 
    function generateEventCode3()
    {
        $code = '';
        $count = 0;
        for($count = 0; $count<3; $count++)
        {
            $code = $code.chr(rand(65,90));
            $code = $code.chr(rand(48,57));
            $code = $code.chr(rand(97,122));
        }
        return $code;
    
    } 

 $code_link = generateEventCode();   
 $code_link2 = generateEventCode2();  
 $code_link3 = generateEventCode3();  

$contest_name='';
$string = '00-auto-';
  $queryUser = "SELECT username 
                        FROM sponsor_organizer 
                            WHERE username = '$sponsor_id';";
        $resultUser = mysqli_query($connection, $queryUser);
        $rowUser = mysqli_fetch_assoc($resultUser); 

 $querSponsorName = "SELECT sponsor_name 
                            FROM sponsor_organizer
                                WHERE sponsor_id=$sponsor_id";
    $resSponsorName= mysqli_query($connection, $querSponsorName);
    $rowSponsorName = mysqli_fetch_assoc($resSponsorName); 

    $querEvents = "SELECT *
                        FROM event_table 
                            JOIN (SELECT event_id FROM event_sponsor_two WHERE sponsor_id=$sponsor_id) AS sponsorship USING (event_id) ";
    $resEvents = mysqli_query($connection, $querEvents);

    $querEventName = "SELECT *
                        FROM event_table
                            WHERE event_id = $event_id";
    $resEventName = mysqli_query($connection, $querEventName);
    $rowEventName = mysqli_fetch_assoc($resEventName);

//##################################################################
    $querContestantName = "SELECT *
                        FROM contestant_info_table 
                            WHERE event_id_sponsor = '$event_id';";
    $resContestantName = mysqli_query($connection, $querContestantName);
    

    $query = "SELECT *
                FROM contest 
                    WHERE event_id='$event_id';";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $contest_name = $string . str_replace(' ', '', strtolower($row['contest_name']));  


//##################################################################

    $querOverall = "SELECT *
                        FROM overall 
                            WHERE event_id = '$event_id';";
    $resOverall = mysqli_query($connection, $querOverall);

//#############COUNT
    $count = "SELECT COUNT(*) AS _number FROM judge_table WHERE registered_by_sponsor = $sponsor_id AND event_id=$event_id";
    $resCount = mysqli_query($connection, $count);
    $rowCount = mysqli_fetch_assoc($resCount); 
    $count2 = "SELECT COUNT(*) AS _contestant FROM contestant_info_table WHERE added_by_sponsor = $sponsor_id AND event_id_sponsor=$event_id";
    $resCount2 = mysqli_query($connection, $count2);
    $rowCount2 = mysqli_fetch_assoc($resCount2);    
    $count3 = "SELECT COUNT(*) AS _audience FROM audience_votes WHERE event_id = $event_id";
    $resCount3 = mysqli_query($connection, $count3);
    $rowCount3 = mysqli_fetch_assoc($resCount3);       
//#################    


              $querContest = "SELECT *
                        FROM contest 
                            WHERE contest_id = $contest_id";
              $resContest = mysqli_query($connection, $querContest);
              $rowContest = mysqli_fetch_assoc($resContest);

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

      <link  href="/carousel/carousel.css" rel="stylesheet" type="text/css"  />
</head>
<body>
  <div class="app" id="app">

<!-- ############ LAYOUT START-->


  <!-- content -->
  <div id="content" class="app-content box-shadow-z0" role="main">


	<!-- large modal -->
<!-- .modal -->
<div id="m-md" class="modal" data-backdrop="true">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
      	<h5 class="modal-title">Event Wizard</h5>
      </div>
      <div class="modal-body text-center p-lg">
    <form name="form"class="form-group row" action="#" method="post">
      <label class="col-sm-2 form-control-label"></label>
      <div class="col-sm-12">
        <input name="event_name" type="text" class="form-control" placeholder="Pageant Event Name">
      </div>
	      <label class="col-sm-2 form-control-label"></label>
      <div class="col-sm-12">
        <input type="text" class="form-control" placeholder="Organization Name"><br>
      </div>
	  	  	      <label class="col-sm-2 form-control-label"></label>
      <div class="col-sm-12">
        <input type="text" class="form-control" placeholder="Event Code">
      </div>
	  	  	      <label class="col-sm-2 form-control-label"></label>
      <div class="col-sm-12">
        <input type="text" class="form-control" placeholder="Event Location">
      </div>
          
    <div class="form-group row">

    </div>
		       <div class="form-group">
          <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: 'LT',
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
              <input type='text' class="form-control" placeholder="Time of Event"/>
              <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
          </div>
      </div>
      <div class="form-group">
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
              <input type='text' class="form-control" placeholder="Date of Event"/>
              <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
          </div>
      </div>
        <p></p>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Cancel</button>
        <button type="submit" name="add" class="btn danger p-x-md" data-dismiss="modal">Create</button>
      </div>
    </div><!-- /.modal-content -->
	</form>	   
  </div>
</div>
<!-- / .modal -->

	<!-- large modal -->
<!-- .modal -->
<div id="m-judge" class="modal" data-backdrop="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      	<h5 class="modal-title">Judge Wizard</h5>
      </div>
      <div class="modal-body text-center p-lg">
    <div class="form-group row">
      <label class="col-sm-2 form-control-label"></label>
      <div class="col-sm-12">
        <input type="text" class="form-control" placeholder="Name of the Judge">
      </div>
      <label class="col-sm-2 form-control-label"></label>
      <div class="col-sm-12">
        <input type="text" class="form-control" placeholder="Industry Profession">
      </div>
	        <label class="col-sm-2 form-control-label"></label>
      <div class="col-sm-12">
        <input type="text" class="form-control" placeholder="Judge Code">
      </div>
    </div>	         
    <div class="form-group row">

    </div>
  
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn danger p-x-md" data-dismiss="modal">Register</button>
      </div>
    </div><!-- /.modal-content -->
  </div>
</div>
<!-- / .modal -->
	

 
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
<!-- ############ PAGE START-->
<div class="p-a lt box-shadow">
	<div class="row">
		<div class="col-sm-6">
			<h4 class="m-b-0 _300" style="padding-left: 8px;"><?php echo $rowContest['contest_name']?></h4>
			<small class="text-muted" style="padding-left: 8px;"><strong>Real-time</strong> projection of scores and statistics</small>
		</div>
    <div class="col-sm-6 text-sm-right">
      <div class="m-y-sm">

        <div class="btn-group dropdown">
       
            <div class="btn-group">

            </div>
        <span class="m-r-sm pull-left">Top Contestant</span> 
        <div class="btn-group dropdown">
              <button class="btn  btn-sm ">View</button>
              <button class="btn  btn-sm dropdown-toggle" data-toggle="dropdown"></button>
              <div class="dropdown-menu dropdown-menu-scale pull-right">
              <a class="dropdown-item pull-right" href="top.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>&contest_id=<?php echo $rowContest['contest_id']?>&val=1">View Top One</a>

              <a class="dropdown-item" href="top.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>&contest_id=<?php echo $rowContest['contest_id']?>&val=3">View Top Three</a>                       

              <a class="dropdown-item" href="top.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>&contest_id=<?php echo $rowContest['contest_id']?>&val=5">View Top Five</a>
 
              <a class="dropdown-item" href="top.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>&contest_id=<?php echo $rowContest['contest_id']?>&val=10">View Top Ten</a>
               <div class="dropdown-divider"> </div>
                            <a class="dropdown-item" href="organizer.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>">Go to Dashboard</a>

              </div>

            </div>
    
            </div>
          </div>
    </div>     
	</div>
</div>

<div class="padding">

      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        
        <ol style="display: none;" class="carousel-indicators" >
<?php 
        $tabulatedQuery = "SELECT SUM(total) AS contest_total, SUM(rank) AS rank_basis, contestant_id, first_name, sur_name, contestant_number 
                    FROM `$contest_name` JOIN `contestant_info_table` USING(contestant_id) 
                        WHERE `event_id`='$event_id' GROUP BY contestant_id ORDER BY rank_basis ASC;";
        $tabulatedResult = mysqli_query($connection, $tabulatedQuery);
  
                      $rank = 0;
                      $total = 0;
                        while($rowTabulated = mysqli_fetch_assoc($tabulatedResult)){
                            if($total !=  $rowTabulated['rank_basis']){
                                    $rank++;
                                }
                                $total = $rowTabulated['rank_basis'];  

?>          
          <li data-target="#myCarousel" data-slide-to="<?php echo $rowTabulated['contestant_id']?>" class="active"></li>
<?php }?>          
        </ol>
        <div class="carousel-inner">
<?php 
        $tabulatedQuery2 = "SELECT SUM(total) AS contest_total, SUM(rank) AS rank_basis, contestant_id, first_name, sur_name, contestant_number 
                    FROM `$contest_name` JOIN `contestant_info_table` USING(contestant_id) 
                        WHERE `event_id`='$event_id' GROUP BY contestant_id ORDER BY rank_basis ASC;";
        $tabulatedResult2 = mysqli_query($connection, $tabulatedQuery2);
  
                      $rank = 1;
                      $total = 0;
                        while($rowTabulated2 = mysqli_fetch_assoc($tabulatedResult2)){
                            if($total !=  $rowTabulated['rank_basis']){
                                    $rank++;
                                }
                                $total = $rowTabulated2['rank_basis'];  
    if($rank==1){
      $stat = 'active';
    }else{
      $stat = '';
    }
?>           
          <div class="carousel-item <?php echo $stat?>"  style="background-color: transparent; ">
           
            <div class="container">
              <div class=" text-left" ><br><br>
                <span><h2 class=" "><span >Rank </span><?php echo $rank?></h2></span>                
                <h1 class="text-primary" >#<?php echo $rowTabulated2['contestant_number']?>&nbsp<b class="text-muted"><?php echo $rowTabulated2['first_name']?> <?php echo $rowTabulated2['sur_name']?></b></h1>
 <!--               <span>With a total points of <b><?php echo $rowTabulated2['contest_total']?></b> and total rank of <b><?php echo $rowTabulated2['rank_basis']?></b>.</span> -->

              </div>
            </div>
          </div>
<?php }?> 
        </div>

      </div>
    <div class="row padding">
 



<div class="row-col">
  <div class="col-md-5 col-lg-4">
    <div class="padding">
      <div class="">
        <div class="box-header b-b">
          <h3 class="text-u-c text-muted"><b>Top <?php echo $rowContest['top'] ?></b> <?php echo $rowContest['contest_name'] ?> Contestant</h3>
        </div>
        <ul class="list inset">
<?php

        $tabulatedQuery = "SELECT SUM(total) AS contest_total, SUM(rank) AS rank_basis, contestant_id, first_name, sur_name, contestant_number 
                    FROM `$contest_name` JOIN `contestant_info_table` USING(contestant_id) 
                        WHERE `event_id`='$event_id' GROUP BY contestant_id ORDER BY rank_basis ASC;";
        $tabulatedResult = mysqli_query($connection, $tabulatedQuery);
  
                      $rank = 0;
                      $total = 0;
                        while($rowTabulated = mysqli_fetch_assoc($tabulatedResult)){
                            if($total !=  $rowTabulated['rank_basis']){
                                    $rank++;
                                }
                                $total = $rowTabulated['rank_basis'];      

                              

?>
<?php 
  if($rank <= $rowContest['top']){
?>
    <?php 
        if($rank <= $rowContest['top']){
     ?>
          <li class="list-item">
            <a herf class="list-left">
              <span class="w-40 circle warning">
                <strong class="text-lg"><?php echo $rank ?></strong>
              </span>
            </a>
            <div class="list-body">
              <div style="font-size: 16px;"><a  class="_600"><span class="text-dark" style="font-size: 16px;">#<?php echo $rowTabulated['contestant_number'] ?></span>&nbsp</a><?php echo $rowTabulated['first_name'] ?> <?php echo $rowTabulated['sur_name'] ?></div>
              <small class="text-muted">With a total ranking points of <b><?php echo $rowTabulated['contest_total'] ?></b></small>
            </div>
          </li>
        <?php }else{ ?>
          <li class="list-item">
            <a herf class="list-left">
              <span class="w-40 circle light lt">
                <strong class="text-lg"><?php echo $rank ?></strong>
              </span>
            </a>
            <div class="list-body">
              <div><a href class="_600"><b></b></a><?php echo $rowTabulated['sur_name'] ?> <?php echo $rowTabulated['sur_name'] ?></div>
              <small class="text-muted">With a total ranking points of <b><?php echo $rowTabulated['contest_total'] ?></b></small>
            </div>
          </li>        
        <?php } ?>  
     <?php }else{ ?>
            
     <?php } ?>   
<?php } ?>           
        </ul>
      </div>

    </div>
  </div>

  <div class="col-md-7 col-lg-8 v-b">
    <div class="padding">
      <div class="text-center m-b">
        <h6 class="">Overall Points Based on Judges Scores as of <?php print date("G:i a", time());?></h6>
        <p class="text-muted">Contestant graphical statistics</p>
      </div>
            <div ui-jp="plot" ui-refresh="app.setting.color" ui-options="
              [
                { data: [<?php
        $tabulatedQuery = "SELECT SUM(total) AS contest_total, SUM(rank) AS rank_basis, contestant_id, first_name, sur_name, contestant_number 
                    FROM `$contest_name` JOIN `contestant_info_table` USING(contestant_id) 
                        WHERE `event_id`='$event_id' GROUP BY contestant_id ORDER BY rank_basis ASC;";
        $tabulatedResult = mysqli_query($connection, $tabulatedQuery);
  
                      $rank = 0;
                      $top = 0;
                      $total = 0;
                        while($rowTabulated = mysqli_fetch_assoc($tabulatedResult)){

                            if($total !=  $rowTabulated['rank_basis']){
                                    $rank++;
                                }
                                $total = $rowTabulated['rank_basis'];  
                               
            ?>[<?php echo $rowTabulated['contestant_number'] ?>, <?php echo $rowTabulated['contest_total'] ?>], <?php }?>] }
              ], 
              {
                bars: { show: true, fill: true,  barWidth: 0.4, lineWidth: 0, fillColor: { colors: [{ opacity: 0.8 }, { opacity: 1}] }, align: 'center' },
                colors: ['#fbc015'],
                series: { shadowSize: 3 },
                xaxis: { show: true, font: { color: '#000' }, position: 'bottom' },
                yaxis:{ show: false, font: { color: '#000' }},
                grid: { hoverable: true, clickable: true, borderWidth: 0, color: 'rgba(120,120,120,0.5)' },
                tooltip: true,
                tooltipOpts: { content: 'Contestant %x.0 has %y.00',  defaultTheme: false, shifts: { x: 0, y: -40 } }
              }
            " style="height:360px;" >

      </div>

 <div class="text-muted text-xs m-t"><span class="pull-right"></div>
    </div>
  </div>
</div>


</div>
	


<!-- ############ PAGE END-->


 

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
