var ajaxRequest;
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
	ajaxRequest=new XMLHttpRequest();
  }
  else
  {// code for IE6, IE5
	  ajaxRequest=new ActiveXObject("Microsoft.XMLHTTP");
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
		var mail=document.getElementById('emailid').value;
		var cords=document.getElementById('cords').value;
		var query="?un="+uname+"&l="+learn+"&t="+teach+"&m="+mail+"&c="+cords;

		ajaxRequest.onreadystatechange = function(){
		 if(ajaxRequest.readyState == 4){
					var ajaxDisplay = document.getElementById('loginpg');
					ajaxDisplay.innerHTML = ajaxRequest.responseText;
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
