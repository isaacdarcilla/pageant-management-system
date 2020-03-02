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
    $count4 = "SELECT COUNT(*) AS _tickets FROM ticketing WHERE event_id = $event_id";
    $resCount4 = mysqli_query($connection, $count4);
    $rowCount4 = mysqli_fetch_assoc($resCount4);      


              $querContest = "SELECT *
                        FROM contest 
                            WHERE event_id = $event_id";
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
        	<span class="hidden-folded inline">My Dashboard</span>
        </a>
        <!-- / brand -->
      </div>
      <div flex class="hide-scroll">
          <nav class="scroll nav-light">
            
              <ul class="nav" ui-nav>
                <li class="nav-header hidden-folded">
                  <small class="text-muted">Main</small>
                </li>
                
                <li>
                  <a href="organizer.php?username=<?php echo $username ?>&sponsor_id=<?php echo $sponsor_id ?>&event_id=<?php echo($event_id) ?>" >
                    <span class="nav-icon">
                      <i class="material-icons">
                        <span class="fa fa-bookmark"></span>
                      </i>
                    </span>
                    <span class="nav-text">Dashboard</span>
                  </a>
                </li>
     
            

            
                <li class="nav-header hidden-folded">
                  <small class="text-muted">Event</small>
                </li>
            
                <li>
                  <a>
                    <span class="nav-caret">
                      <i class="fa fa-caret-down"></i>
                    </span>

                    <span class="nav-icon">
                      <i class="material-icons">
                        <span class="fa fa-flag"></span>
                      </i>
                    </span>
                    <span class="nav-text active">Manage Event</span>
                  </a>
                  <ul class="nav-sub nav-mega nav-mega-3">
                    <li>
                      <a href="organizer_judge.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>" >
                        <span class="nav-text">Judges</span>
                      </a>
                    </li>
                    <li>
                      <a href="organizer_contest.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>" >
                        <span class="nav-text">Contest & Criteria</span>
                      </a>
                    </li>

                    <li>
                      <a href="organizer_contestant.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>" >
                        <span class="nav-text">Contestant</span>
                      </a>
                    </li>
   
                    <li>
                      <a href="organizer_event_details.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>" >
                        <span class="nav-text">Event Details</span>
                      </a>
                    </li>

                  </ul>
                </li>
          
            
                <li>

                  <ul class="nav-sub">
                  
                  </ul>
                </li>
            

                <li>
                  <a>
                    <span class="nav-caret">
                      <i class="fa fa-caret-down"></i>
                    </span>
                    <span class="nav-label hidden-folded">
                      
                    </span>
                    <span class="nav-icon">
                      <i class="material-icons">
                        <span class="fa fa-rss"></span>
                      </i>
                    </span>
                    <span class="nav-text">Projector</span>
                  </a>
                  <ul class="nav-sub">
     
                    <li>
                      <a href="statistics.php?eid=<?php echo $event_id?>" target="_blank">
                        <span class="nav-text">Statistics</span>
                      </a>
                    </li>
                  </ul>
                </li>
            
                <li class="nav-header hidden-folded">
                  <small class="text-muted">Help</small>
                </li>
                
                    <li>
                      <a href="faq.php" >
                                         <span class="nav-icon">
                      <i class="material-icons">
                        <span class="fa fa-info"></span>
                      </i>
                    </span>
                        <span class="nav-text">FAQ</span>
                      </a>
                    </li>
                <li class="hidden-folded" >
                  <a href="docs.html" >
                                     <span class="nav-icon">
                      <i class="material-icons">
                        <span class="fa fa-cogs"></span>
                      </i>
                    </span>
                    <span class="nav-text">Documents</span>
                  </a>
                </li>
                <li class="nav-header hidden-folded">
                  <small class="text-muted">Monitor</small>
                </li>
                
                    <li>
                      <a href="logs.php?sponsor_id=<?php echo $sponsor_id ?>&username=<?php echo $username ?>&event_id=<?php echo $event_id?>" >
                                         <span class="nav-icon">
                      <i class="material-icons">
                        <span class="fa fa-rss-square"></span>
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
 

<!-- ############ PAGE START-->
<div class="p-a white lt box-shadow">
	<div class="row">
		<div class="col-sm-6">
			<h4 class="m-b-0 _300">Welcome, <?php echo $rowSponsorName['sponsor_name'] ?>!</h4>
			<small class="text-muted">Organize <strong></strong> your pageant event with ease</small>
		</div>

	</div>
</div>

<div class="padding">

<br>
<center><h2 class=" _700 l-s-n-1x m-b-md"><span class="text-warning"><?php echo $rowEventName['event_name'] ?>&nbsp<?php print date("Y", time());?> </span>Candidates Stats</h2></center>

      <div class="col-xs-12 col-sm-3">
        <div class="box-color p-a info">
          <div class="pull-right m-l">
            <span class="w-40 dker text-center rounded">
              <i class="material-icons">star</i>
            </span>
          </div>
          <div class="clear">
            <h4 class="m-a-0 text-md"><a ><?php echo $rowCount2["_contestant"] ?> <span class="text-sm">Contestants counts</span></a></h4>
            <small class="text-muted">Based on registration</small>
          </div>
        </div>
      </div>  
      <div class="col-xs-12 col-sm-3">
        <div class="box-color p-a primary">
          <div class="pull-right m-l">
            <span class="w-40 dker text-center rounded">
              <i class="material-icons">account_circle</i>
            </span>
          </div>
          <div class="clear">
            <h4 class="m-a-0 text-md"><a ><?php echo $rowCount["_number"] ?> <span class="text-sm">Judges counts</span></a></h4>
            <small class="text-muted">Based on registered judges</small>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-3">
        <div class="box-color p-a warn">
          <div class="pull-right m-l">
            <span class="w-40 dker text-center rounded">
              <i class="material-icons">mic</i>
            </span>
          </div>

            <h4 class="m-a-0 text-md"><a><?php echo $rowCount4['_tickets'] ?> <span class="text-sm">Tickets counts</span></a></h4>
            <small class="text-muted"><a >
          <div class="clear">Based on generation</a></small>
          </div>

        </div>
      </div>      
      <div class="col-xs-12 col-sm-3">
        <div class="box-color p-a warning">
          <div class="pull-right m-l">
            <span class="w-40 dker text-center rounded">
              <i class="material-icons">verified_user </i>
            </span>
          </div>
          <div class="clear">
            <h4 class="m-a-0 text-md"><a><?php echo $rowCount3["_audience"] ?> <span class="text-sm">Audience counts</span></a></h4>
            <small class="text-muted">Based on logged in </small>
          </div>
        </div>
      </div> 
    

     


<div class="row-col">
  <div class="col-md-5 col-lg-4">
    <div class="padding">
      <div class="">
        <div class="box-header b-b">
          <h3 class="text-u-c text-muted">Top 6 <?php echo $rowEventName['event_name'] ?> Contestant</h3>
        </div>
        <ul class="list inset">
<?php
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

                              

?>
<?php 
  if($rank <= 6){
?>
    <?php 
        if($rank <= 3){
     ?>
          <li class="list-item">
            <a herf class="list-left">
              <span class="w-40 circle warning">
                <strong class="text-lg"><?php echo $rank ?></strong>
              </span>
            </a>
            <div class="list-body">
              <div><a  class="_600"><span class="text-warn fa fa-star"></span>&nbsp</a> #<?php echo $rowTabulated['contestant_number'] ?>, <?php echo $rowTabulated['contestant_name'] ?></div>
              <small class="text-muted">With a total ranking points of <b><?php echo $rowTabulated['total_ranking'] ?></b></small>
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
              <div><a href class="_600"><b></b></a><?php echo $rowTabulated['contestant_name'] ?></div>
              <small class="text-muted">With a total ranking points of <b><?php echo $rowTabulated['total_ranking'] ?></b></small>
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
        <p class="text-muted">Rank according to total scores</p>
      </div>
            <div ui-jp="plot" ui-refresh="app.setting.color" ui-options="
              [
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
                     

            ?>[<?php echo $rowTabulated['contestant_number'] ?>, <?php echo $rowTabulated['contest_total'] ?>], <?php }?> ] }
              ], 
              {
                bars: { show: true, fill: true,  barWidth: 0.3, lineWidth: 0, fillColor: { colors: [{ opacity: 0.8 }, { opacity: 1}] }, align: 'center' },
                colors: ['#0cc2aa'],
                series: { shadowSize: 3 },
                xaxis: { show: true, font: { color: '#000' }, position: 'bottom' },
                yaxis:{ show: false, font: { color: '#000' }},
                grid: { hoverable: true, clickable: true, borderWidth: 0, color: 'rgba(120,120,120,0.5)' },
                tooltip: true,
                tooltipOpts: { content: '%x.0 has %y.0',  defaultTheme: false, shifts: { x: 0, y: -40 } }
              }
            " style="height:360px;" >

      </div>

 <div class="text-muted text-xs m-t"><span class="pull-right"></div>
    </div>
  </div>



</div>
<div class="padding">
  <div class="row">
<script type="text/javascript">
function printPage(){
    var divElements = document.getElementById('printDataHolder').innerHTML;
    var oldPage = document.body.innerHTML;
    document.body.innerHTML="<link rel='stylesheet' href='css/common.css' type='text/css' /><body class='bodytext'><div class='padding'><b style='font-size: 16px;'><p class=''>ePageant Management System</p></b></div>"+divElements+"</body>";
    window.print();
    document.body.innerHTML = oldPage;
    }
</script>

      <div class="col-sm-12 col-md-12" id="printDataHolder">
        <div class="">
          <div class="box-header">
            <h3>Audience Votes as of <?php print date("G:i a", time());?></h3>
            <small>There are <span class="label warning"><?php echo $rowCount3["_audience"] ?></span> audiences voted</small>
          </div>
            <div class="box-tool">
            <ul class="nav">
              <li class="nav-item inline dropdown">
                <p class=""></p>
              </li>
              <li class="nav-item inline dropdown">
                    <a   class="btn btn-xs pull-right text-muted hidden-print" ><i class="fa fa-print " onclick="printPage();"></i> Print Votes</a>
              </li>
            </ul>
          </div>          
          <ul class="list inset">
              <?php 

                while($rowContestant = mysqli_fetch_assoc($resContestantName)){
                  $contestant_id = $rowContestant['contestant_id'];
               
                $votes = "SELECT SUM(votes) AS vote FROM audience_votes WHERE event_id = $event_id AND contestant_id = $contestant_id;";
                $result = mysqli_query($connection, $votes);
                $rowVotes = mysqli_fetch_assoc($result);
                $voted = $rowVotes['vote'];
              ?>

              <li class="list-item">
                <a herf class="list-left">
              <span class="pull-left">
                <img src="assets/pa.png" alt="..." class="w-40 img-circle">
              </span>
                </a>
                <div class="list-body">
                <?php 
                  if($rowVotes['vote'] != 0){
                ?>

                <div class="m-y-sm pull-right">
                  <h4 ><b class="text-muted"><?php echo $rowVotes['vote']  ?></b> <span style="font-size: 20px;" class="text-warning fa fa-heart"></span></h4>
                </div> 
                <?php }else{ ?>
                 <div class="m-y-sm pull-right">
                  <h4 ><b class="text-muted">0</b> <span style="font-size: 20px;" class="text-warning fa fa-heart"></span></h4>
                </div>                    
                <?php } ?>                 
                  <div class="m-y-sm ">

                  </div>
                  <div><a>Contestant #<?php echo $rowContestant['contestant_number'] ?><b> <?php echo $rowContestant['first_name'] ?> <?php echo $rowContestant['sur_name'] ?></b></a></div>
                <div class="text-sm">
                  <span class="text-muted"><strong><?php echo $rowContestant['municipality'] ?></strong>, <strong><?php echo $rowContestant['province'] ?></strong></span> 
                  <span class="label"></span>
                </div>

                </div>
              </li>
            <?php } ?>
              
          </ul>
        </div>
      </div>
</span>
  </div>


</div>
	


<!-- ############ PAGE END-->


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
