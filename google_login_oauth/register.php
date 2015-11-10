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
$learn_exp = explode(',',$learn);
foreach($learn_exp as $learn_exp){
	$ins=mysqli_query($con,"INSERT INTO interest(email,learn) VALUES('$email','$learn_exp')");
	if(!$ins){
		print 'Error inserting values in interest';
	}
}
$teach=isset($_GET['teach'])?$_GET['teach']:'';
$teach_exp = explode(',',$teach);
print $learn_exp;
foreach($teach_exp as $teach_exp){
$ins=mysqli_query($con,"INSERT INTO pro(email,teach) VALUES('$email','$teach_exp')");
	if(!$ins){
		print 'Error inserting values in pro';
	}
}
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
