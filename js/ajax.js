$(document).ready(function(){
  $.get("../google_login_oauth/retrieve.php", function(data) {
    var obj = JSON.parse(data)
    initialize(obj);
  })
});
  function dummy(){
  	return false;
  }

function checkreq()
{
var uname = document.getElementById('username').value;
if(uname==''){
	document.getElementById('username').style.borderColor="#ff0000";
		document.getElementById('username').style.borderWidth="2px";
		return false;
}
else{
	document.getElementById('username').style.borderColor="#ffffff";
	return true;
}
}

function register()
{
	if(checkreq())
	{
		var uname=document.getElementById('username').value;
		var learn=document.getElementById('learn').value;
		var teach=document.getElementById('teach').value;
		var mail=document.getElementById('email').value;
		var lat=document.getElementById('lat').value;
		var lng=document.getElementById('lng').value;
		var query="?uname="+uname+"&learn="+learn+"&teach="+teach+"&email="+mail+"&lat="+lat+"&lng="+lng;

		ajaxRequest.onreadystatechange = function(){
		 if(ajaxRequest.readyState == 4){
					var ajaxDisplay = document.getElementById('loginpg');
					ajaxDisplay.innerHTML = ajaxRequest.responseText;
          alert('Thanks for registering!');
          window.location.replace('index.php#showMap');
			}
		}
		ajaxRequest.open("GET", "../google_login_oauth/register.php" + query, true);
		ajaxRequest.send();
		return false;
	}
	else{
		document.getElementById('reg_status').innerHTML="Username is required";
	}
}
