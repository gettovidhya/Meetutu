<?php

session_start();
if(isset($_SESSION['user']))
{
	$user = $_SESSION['user'];
	$email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
	if(isset($email))
	{
		$hostname="localhost";
		$user="root";
		$password="root";
		$database="meetutu";
		$con=mysqli_connect($hostname,$user,$password,$database) or die("Couldnt connect database!");
		$getl=mysqli_query($con,"select learn from interest where email='$email'");
		if($getl){
				$numr=mysqli_num_rows($getl);
				if($numr){
					$l_values=mysqli_fetch_array($getl,MYSQLI_NUM);
					foreach($l_values as $l_value){
						$gett=mysqli_query($con,"select email from pro where teach='$l_value'");

						$some_teach_array = [];
						$tvalues = [];
						if($gett){
							$nr=mysqli_num_rows($gett);
								if($nr){
									$index=0;
									while($index!=$nr){
									$emails_list =  mysqli_fetch_array($gett,MYSQLI_NUM);
									$some_teach_array[$index]=$emails_list[0];
									$index=$index+1;
									}
									$gett2=mysqli_query($con,"select * from users where email IN ('" . join($some_teach_array, "', '") . "');");
									if($gett2){
											$nr=mysqli_num_rows($gett2);
											$index=0;
											if($nr){
												while($index!=$nr){
												$teach_list=mysqli_fetch_array($gett2,MYSQLI_ASSOC);
												$index=$index+1;
												array_push($tvalues,$teach_list);
												}
											}
									}
								}
						}
					}
				}
		}
		$gettc=mysqli_query($con,"select teach from pro where email='$email'");
		if($gettc){
				$numrw=mysqli_num_rows($gettc);
				if($numrw){
					$tc_values=mysqli_fetch_array($gettc,MYSQLI_NUM);
					foreach($tc_values as $tc_value){
						$getln=mysqli_query($con,"select email from pro where teach='$tc_value'");

						$some_teach_array = [];
						$lvalues = [];
						if($getln){
							$nmr=mysqli_num_rows($getln);
								if($nmr){
									$index=0;
									while($index!=$nmr){
									$emails_list =  mysqli_fetch_array($getln,MYSQLI_NUM);
									$some_learn_array[$index]=$emails_list[0];
									$index=$index+1;
									}
									$getl2=mysqli_query($con,"select * from users where email IN ('" . join($some_learn_array, "', '") . "');");
									if($getl2){
											$nmr=mysqli_num_rows($getl2);
											$index=0;
											if($nmr){
												while($index < $nmr){
													$learn_list=mysqli_fetch_array($getl2,MYSQLI_ASSOC);
													$index=$index+1;
												 	array_push($lvalues,$learn_list);
												}
											}
									}
								}
						}
					}
				}
		}

		$final_array=new stdClass();
		$final_array->teach = $tvalues;
		$final_array->learn = $lvalues;
		echo '{"learn": ' . json_encode($lvalues) . ', "teach": ' . json_encode($tvalues) . '}';
		mysqli_close($con);
	}
}
?>
