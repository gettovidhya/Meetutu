<?php
$hostname="localhost";
$user="root";
$password="root";
$database="meetutu";
$con=mysqli_connect($hostname,$user,$password,$database) or die("Couldnt connect database!");
$email=isset($_POST['email'])?$_POST['email']:'';
$username=isset($_POST['username'])?$_POST['username']:'';
$learn=isset($_POST['learn'])?$_POST['learn']:'';
$teach=isset($_POST['teach'])?$_POST['teach']:'';
$sno=mysqli_query($con,"select * from users");
if($sno){
	$numrows= mysqli_num_rows($sno);
}
else{
	$numrows= 0;
}
$id = $numrows+1;
$res=mysqli_query($con,"INSERT INTO users(id,username,email,learn,teach) VALUES('$id','$username','$email','$learn','$teach')");
if($res){
print '<h1>jhi</h1>';
}
else {
	print '<h1>noo</h1>';
}
mysqli_close($con);
?>

<script>
location.replace("index.php");
alert("Form successfully created"); 

 </script>  