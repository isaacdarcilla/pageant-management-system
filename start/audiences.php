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




   function generateEventCode()
    {
        $code = '';
        $count = 0;
        for($count = 0; $count<3; $count++)
        {
            $code = $code.chr(rand(65,90));
            $code = $code.chr(rand(48,57));
           // $code = $code.chr(rand(75,50));

        }
        return $code;
    
    } 
$recode = generateEventCode();    

$event_id = $_GET['event_id'];

$invite_code = $_GET['code'];



$ticket = $_GET['ticket'];
////ENTER 

  

    $message = '';
    $event_code = '';

    $querEventName = "SELECT event_name 
                        FROM event_table 
                            WHERE event_id = md5('$event_id');";
    $resEventName = mysqli_query($connection, $querEventName);
    $rowEventName = mysqli_fetch_assoc($resEventName);

   $querTix = "SELECT ticket_id
                        FROM audience_votes 
                            WHERE event_id = $event_id AND ticket_id = '$ticket'";
    $resTix = mysqli_query($connection, $querTix);
    $rowTix = mysqli_fetch_assoc($resTix);

$tickets = $rowTix['ticket_id'];

$Tickets2 = "SELECT ticket_number FROM ticketing WHERE event_id = '$event_id' AND ticket_number = '$ticket'";
$Result2 = mysqli_query($connection, $Tickets2);
$Row = mysqli_fetch_assoc($Result2);


  $myRow = $Row['ticket_number'];

  if($myRow != $ticket){

  header("Location: audience.php");

}
else{}


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
</head>
<body class="dark">
  <header>
      <nav class="navbar navbar-md navbar-fixed-top white">
        <div class="container ">
          <a data-toggle="collapse" data-target="#navbar-1" class=" navbar-item pull-right hidden-md-up m-a-0 m-l">
            <!-- <i class="fa fa-bars"></i> -->
          </a>
          
          <!-- brand -->
          <a class="navbar-brand md white" href="#home" ui-scroll-to="home">

            <span class="hidden-folded inline text-warning">ePageant System</span>
          </a>
          <!-- / brand -->

          <!-- nabar right -->
         
          <!-- / navbar right -->
          <!-- navbar collapse -->
         <div class="collapse navbar-toggleable-sm text-left white" id="navbar-1">
            <!-- link and dropdown -->
            <ul class="nav navbar-nav nav-active-border top b-primary pull-right m-r-lg">

              <li class="nav-item">
                <a class="nav-link" href="../">
                  <span class="nav-text text-danger"></span> 
                </a>
              </li>
            </ul>     
            <ul class="nav navbar-nav nav-active-border top b-primary pull-right m-r-lg">

              <li class="nav-item">
                <a class="nav-link" href="../">
                  <span class="nav-text text">Log Out<?php  session_destroy();  ?></span> 
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
<div class="p-a-md info p-y-lg"><br>
  <div class="padding">
    <h1 class="display-3 _500 l-s-n-2x" style="font-size: 40px; "><center><b><?php echo $ticket?></b></center></h1>
  </div>
</div>      
      <div class="container p-y-lg text-primary-hover">





<?php 

if($tickets!=$ticket){

?>

        <h5 class="text-muted m-b-lg">Support your contestant by <b>voting</b>, note that you can only vote <b>once </b>so choose your bet wisely. </h5>
    

<div class="padding">
  <div class="row m-b">
<?php

$query = "SELECT * FROM contestant_info_table WHERE event_id_sponsor='$event_id';";
$result = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($result)){
$contestant_id = $row['contestant_id'];
?>


    <div class="col-sm-4">
      <div class="box b-t b-l b-r b-b b-t-info">
        <div class="box-header">

        </div>
        <div class="box-body">
          <p class="text-center"><small >Contestant #<?php echo $row['contestant_number'] ?></small> 
          <h5 class="text-center"><b><?php echo $row['first_name'] ?>&nbsp<?php echo $row['sur_name'] ?></b></h5>
          <center>  </center>       <br>  
      <form method="post" action="" onclick="myButton.value='Voting...'; myButton.disabled = true; return true;">   
        <center><a href="voted.php?code=<?php echo $invite_code ?>&event_id=<?php echo $event_id ?>&contestant=<?php echo $row['contestant_id'] ?>&ticket=<?php echo $ticket?>"><input type="submit"  value="Vote" name="myButton" class="btn rounded text info "  ></input></a>  </center>
        </form>     
            </p>

<br>
      </div>
    </div>
   </div> 
<?php } ?>    
  </div>
</div>    
        
        </div>


      <?php }else{ ?>

<?php 

$query = "SELECT contestant_id FROM audience_votes WHERE ticket_id='$tickets'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$contestant_id = $row['contestant_id'];

$query2 = "SELECT first_name, sur_name FROM contestant_info_table WHERE contestant_id=$contestant_id";
$result2 = mysqli_query($connection, $query2);
$row2 = mysqli_fetch_assoc($result2);

?>


  <br><br><br>
                                         <center> <div style="font-size:  75px;" ><span class="fa  fa-check text-primary "></span></div>
                                          <h2 class="" style="font-size: 20px;"><span class="text">Your vote for <b><i><?php echo $row2['first_name']  ?> <?php echo $row2['sur_name']  ?></i></b> is now being processed.</center></span></h2><br>  
                                       
                                          <?php }?>  

        
      </div>
            <p class="text-muted text-center">Made with <span class="text-danger fa fa-heart"></span> by <i><a><u>ePageant</u></a></p>      </i>       <br><br><br>

    </div>
  </div>
<!-- small modal -->
<div id="m-sm" class="modal" data-backdrop="true">
  <div class="row-col h-v">
    <div class="row-cell v-m">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Small modal</h5>
          </div>
          <div class="modal-body text-center p-lg">
            <p>Are you sure to execute this action?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">No</button>
            <button type="button" class="btn danger p-x-md" data-dismiss="modal">Yes</button>
          </div>
        </div><!-- /.modal-content -->
      </div>
    </div>
  </div>
</div>
<!-- / .modal -->

  </footer> 
  <script src="libs/jquery/jquery/dist/jquery.js"></script>
  <script src="libs/jquery/tether/dist/js/tether.min.js"></script>
  <script src="libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
  <script src="html/scripts/ui-scroll-to.js"></script>
</body>
</html>
