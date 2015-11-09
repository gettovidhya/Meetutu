<?php
require_once 'src/Google_Client.php';
require_once 'src/contrib/Google_Oauth2Service.php';
$server = "localhost";
$user = "root";
$password = "root";
$database = "meetutu";
$con = mysqli_connect($server, $user, $password, $database) or die("<h3>Problem with connection</h3>");

session_start();
$client = new Google_Client();
$client->setApplicationName("Meetutu");
$oauth2 = new Google_Oauth2Service($client);
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
  return;
}
if (isset($_SESSION['token'])) {
 $client->setAccessToken($_SESSION['token']);
}
if (isset($_REQUEST['logout'])) {
  unset($_SESSION['token']);
  $client->revokeToken();
}
if ($client->getAccessToken()) {
      $user = $oauth2->userinfo->get();
    //  print_r($user);
    //  $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
    //  $img = filter_var($user['picture'], FILTER_VALIDATE_URL);
      $content = $user;
      $_SESSION['token'] = $client->getAccessToken();



    $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
    if(isset($email)){
        $getres=mysqli_query($con,"SELECT * FROM users where email='$email'");
        if($getres){

            $res=mysqli_num_rows($getres);
            $isNewUser = ($res != 1);
        }
    }
}
else {
  $authUrl = $client->createAuthUrl();
}

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html lang="en" class="no-js">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meetutu : Find your right tutor</title>
    <meta name="description" content="Find your perfect tutor nearby for specific subjects, and get in touch with them" />
    <meta name="keywords" content="MEETUTU TutorFinder, tutorials, teacher, student, learn, study, Find tutor" />
    <meta name="author" content="Shri Vidhya" />
    <!-- Bootstrap -->
    <script src="../js/modernizr.custom.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/jquery.fancybox.css" rel="stylesheet">
    <link href="../css/flickity.css" rel="stylesheet" >
    <link href="../css/animate.css" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Nunito:400,300,700' rel='stylesheet' type='text/css'>
    <link href="../css/styles.css" rel="stylesheet">
    <link href="../css/queries.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="../css/jquery-ui-1.10.3.custom.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
    <script src="../js/ajax.js" type="text/javascript"></script>
<script>
  $(function() {
    var subject = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#learn" ).autocomplete({
      source: subject
    });
  });
  </script>

    <style>
  #google_canvas{
    height: 700px;
    margin: 0px;
    padding: 0px
  }
  input[type="text"]{
      color: #888;
    width: 70%;
    padding: 0px 0px 0px 5px;
    border: 1px solid #C5E2FF;
    background: #FBFBFB;
    outline: 0;
    -webkit-box-shadow:inset 0px 1px 6px #ECF3F5;
    box-shadow: inset 0px 1px 6px #ECF3F5;
    font: 200 12px/25px Arial, Helvetica, sans-serif;
    height: 30px;
    line-height:15px;
    margin: 2px 6px 16px 0px;
  }
  input[type="submit"]{
     background: #E27575;
    border: none;
    padding: 10px 25px 10px 25px;
    color: #FFF;
    box-shadow: 1px 1px 5px #B6B6B6;
    border-radius: 3px;
    text-shadow: 1px 1px 1px #9E3F3F;
    cursor: pointer;
  }
</style>
  </head>
  <body>

  <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <!-- open/close -->
    <header>
      <section class="hero">
        <div class="texture-overlay"></div>
        <div class="container">
          <div class="row nav-wrapper">
            <div class="col-md-6 col-sm-6 col-xs-6 text-left">
              <a href="#"><img src="../img/logo-white.png" alt="Boxify Logo"></a>
            </div>

          </div>
          <div class="row hero-content">
            <div class="col-md-12" class="style-1 clearfix">
              <h1 class="animated fadeInDown" style="left:15%;position:relative;">Join MEETUTU and re-discover yourself </h1><h3 style="left:36%;position:relative;">An exclusive place to find your right tutor</h3>
            </div>
          </div>
        </div>
        <?php
          if(isset($authUrl)) {
        ?>
            <a class='login animated fadeInUp' id='login' href='<?php echo $authUrl; ?>' style='top:50%;left:40%;position:relative;z-index:99;'>
              <img src='images/googleconnect3.png' style='height:6%;width:20%;'/>
            </a>
        <?php
          } else {
        ?>
            <a class='logout' href='?logout' style='color:white'>
              <div class='learn-btn text-right navicon' style='top:7%;right:4%;position:absolute;z-index:99;line-height: 0.42857143;'>LOGOUT</div>
            </a>
        <?php
          }
          if(isset($isNewUser)) {
            if($isNewUser) {
        ?>
          <div class='animated fadeInUp' id='loginpg' style='z-index:99;position:relative;left:4%;'>
            <h2 class='style-1' style='color:white;position:relative;left:27%;'>Now share about yourself and find your tutor in no time! </h2>
            <form method='post' action='register.php'>
              <input type='hidden' name='email' value='<?php echo $email; ?>' />
              <input type='hidden' name='cords' id='cords' value='51.508742,-0.120850'/>
              <div class='col-md-4'>
                <h3 style='color:white;'>Username:</h3>
                <input type='text' class='focus' name='username' placeholder='Username' id='username' onblur='checkreq()' style='color:black'/><br>
              </div>
              <div class='col-md-4'>
                <h3 style='color:white;'>Subjects you wish to learn:</h3>
                <input type='text' class='focus' name='learn' id='learn' placeholder='eg: Maths, Physics' style='color:black'/><br>
              </div>
              <div class='col-md-4'>
                <h3 style='color:white;'>Subjects you can teach:</h3>
                <input type='text' class='focus' name='teach' id='teach' placeholder='eg: Botany, Zoology' style='color:black'/><br>
              </div>
              <div class='col-md-12'>
                <input type='submit' value='Add my profile' style='width:500px; left:27%; position: relative; top : 30px;'/>
              </div>
            </form></div>

          <?php } else { ?>
              <a href='#google_canvas' style='position:relative;left:42%;top:5%;z-index:99;' class='learn-btn animated fadeInUp'>Find Your Tutor<i class='fa fa-arrow-down'></i></a>
          <?php
          }
        }
          ?>
        <div id="reg_status" style="position:relative;top:24%;left:45%"></div>
      </section>
    </header>


    <section class="screenshots-intro">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div id="google_canvas"></div>
            <h1>Get in touch with your tutor</h1>
            <p>The map shows all the tutors who are near to you. You can click on it, and get in touch with them instantly! <br> To filter your search, you can specify the name of the subject below.</p>
            <p>Filter the search :</p><input type="text" name="subject" style="width:300px;" placeholder="eg : Physics"/>

          </div>
        </div>
      </div>
    </section>

    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-5">
            <h1 class="footer-logo">
            <img src="../img/logo-blue.png" alt="Footer Logo Blue">
            </h1>
            <p>© Shri Vidhya</p>
          </div>
        </div>
      </div>
    </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/min/toucheffects-min.js"></script>
    <script src="../js/flickity.pkgd.min.js"></script>
    <script src="../js/jquery.fancybox.pack.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/retina.js"></script>
    <script src="../js/waypoints.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/min/scripts-min.js"></script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='//www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>

<!--Maps-->


   <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

    <script>

function initialize() {

  var mycenter = new google.maps.LatLng(51.508742,-0.120850);
  var mapProp = {
    center:mycenter,
    zoom:12,
    mapTypeId:google.maps.MapTypeId.ROADMAP,
    mapTypeControl:false,
    scaleControl:false,
    rotateControl:true,
    scrollwheel:false
  };
  var map=new google.maps.Map(document.getElementById("google_canvas"),mapProp);
var marker=new google.maps.Marker({
  position:mycenter,
  });

marker.setMap(map);

}
google.maps.event.addDomListener(window, 'load', initialize);

if(document.getElementById("cords")){
   if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        console.log( "Geolocation is not supported by this browser.");
    }

function showPosition(position) {
  console.log('showPosition');
    var latlon = position.coords.latitude + "," + position.coords.longitude;
    document.getElementById("cords").value=latlon;
}

function showError(error) {
  console.log('showError');
    switch(error.code) {
        case error.PERMISSION_DENIED:
            console.log("User denied the request for Geolocation.");
            break;
        case error.POSITION_UNAVAILABLE:
            console.log("Location information is unavailable.");
            break;
        case error.TIMEOUT:
            console.log("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            console.log("An unknown error occurred.");
            break;
    }
}
}
</script>
    <!-- Google maps -->



</body>
</html>
