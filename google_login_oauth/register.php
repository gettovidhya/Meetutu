<?php
$hostname="localhost";
$user="root";
$password="root";
$database="meetutu";
$con=mysqli_connect($hostname,$user,$password,$database) or die("Couldnt connect database!");
$email=isset($_GET['email'])?$_GET['email']:'';
$lat=isset($_GET['lat'])?$_GET['lat']:'';
$lng=isset($_GET['lng'])?$_GET['lng']:'';
$username=isset($_GET['uname'])?$_GET['uname']:'';
$learn=isset($_GET['learn'])?$_GET['learn']:'';
$teach=isset($_GET['teach'])?$_GET['teach']:'';
$sno=mysqli_query($con,"select * from users");
if($sno){
	$numrows= mysqli_num_rows($sno);
}
else{
	$numrows= 0;
}
$id = $numrows+1;
$res=mysqli_query($con,"INSERT INTO users(id,username,email,learn,teach,lat,lng) VALUES('$id','$username','$email','$learn','$teach','$lat','$lng')");
if($res){
}
else {
	print '<h1>Please try again!</h1>';
}
mysqli_close($con);
?>

<script>
location.replace("index.php");
alert("Form successfully created");

 </script>
