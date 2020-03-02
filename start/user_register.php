<!--
COPYRIGHT (c) 2018 ISAAC D. ARCILLA (isaacdarcilla@gmail.com)

ALL RIGHTS RESERVED.

IF YOU COPY OR USE ALL OR ANY PORTION OF THIS SOFTWARE OR ITS USER DOCUMENTATION WITHOUT ENTERING INTO THIS AGREEMENT OR OTHERWISE OBTAINING WRITTEN PERMISSION OF ISAAC D ARCILLA, YOU ARE VIOLATING COPYRIGHT AND OTHER INTELLECTUAL PROPERTY LAW.  YOU MAY BE LIABLE TO ISAAC AND ITS LICENSORS FOR DAMAGES, AND YOU MAY BE SUBJECT TO CRIMINAL PENALTIES.
-->


<?php 
    session_start(); 
  
  include("config.php");
  

<?php 

include("config.php"); 

// connect to the mysql server
$connection = mysqli_connect($db_host, $db_user, $db_pass)
or die ("Could not connect to mysql because ".mysqli_connect_error());

// select the database
$database = mysqli_select_db($connection, $db_name)
or die ("Could not select database because ".mysqli_connect_error());

$password = mysqli_real_escape_string($connection, $_POST["password"]);
$user = mysqli_real_escape_string($connection, $_POST['username']); 
$encrypt  = md5($password);

// check if the username is taken
$check = "SELECT user_id FROM $db_table WHERE username = '$user';";
$qry = mysqli_query($connection, $check) or die ("Could not match data because ".mysqli_connect_error());
echo mysqli_connect_error();
$num_rows = mysqli_num_rows($qry); 
if ($num_rows != 0) { 
$message = "Username or password already taken";
header("location:signup.php");
} else {

// insert the data
$data = "INSERT INTO $db_table VALUES ('NULL', '$user', '".$_POST['email']."', '$encrypt');";
$insert = md5(mysqli_query($connection, $data)) 
or die("Could not insert data because ".mysqli_connect_error());

// print a success message
header("location:a.php");
}

?>
