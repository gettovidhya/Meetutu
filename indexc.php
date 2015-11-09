 <?php
require_once 'google_login_oauth/src/Google_Client.php';
require_once 'google_login_oauth/src/contrib/Google_Oauth2Service.php';
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
} else {
  $authUrl = $client->createAuthUrl();
}

if(isset($authUrl)) {
    print "<a class='login' href='$authUrl'><img src='img/googleconnect3.png' /></a>";
  } else {
   print "<a class='logout' href='?logout'>Logout</a>";
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
		<script src="js/modernizr.custom.js"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/jquery.fancybox.css" rel="stylesheet">
		<link href="css/flickity.css" rel="stylesheet" >
		<link href="css/animate.css" rel="stylesheet">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Nunito:400,300,700' rel='stylesheet' type='text/css'>
		<link href="css/styles.css" rel="stylesheet">
		<link href="css/queries.css" rel="stylesheet">
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<style>
  html, body, #map-canvas {
    height: 700px;
    margin: 0px;
    padding: 0px
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
							<a href="#"><img src="img/logo-white.png" alt="Boxify Logo"></a>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6 text-right navicon">
							<p>MENU</p><a id="trigger-overlay" class="nav_slide_button nav-toggle" href="#"><span></span></a>
						</div>
					</div>
					<div class="row hero-content">
						<div class="col-md-12" class="style-1 clearfix">
							<h1 class="animated fadeInDown">Join MEETUTU and re-discover yourself </h1><h3>An exclusive place to find your right tutor</h3>
							<input type="text" class="focus" placeholder="Email ID" style="color:black"/><br>
							<input type="text" class="focus" placeholder="Username" style="color:black"/><br>
							<input type="text" class="focus" placeholder="Enter your email id" style="color:black"/><br>
							<input type="text" class="focus" placeholder="Enter your email id" style="color:black"/>
							 <a href="#about" class="learn-btn animated fadeInUp">Learn more <i class="fa fa-arrow-down"></i></a>

						</div>
					</div>
				</div>
			</section>
		</header>
		
		
		<section class="screenshots-intro">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div id="map-canvas"></div>
						<h1>Packed Full of Powerful Features</h1>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a lorem quis neque interdum consequat ut sed sem. Duis quis tempor nunc. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
						<p><a href="#screenshots" class="arrow-btn">See the screenshots! <i class="fa fa-long-arrow-right"></i></a></p>
					</div>
				</div>
			</div>
		</section>
		
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-5">
						<h1 class="footer-logo">
						<img src="img/logo-blue.png" alt="Footer Logo Blue">
						</h1>
						<p>© Boxify 2015 - <a href="http://tympanus.net/codrops/licensing/">Licence</a> - Designed &amp; Developed by <a href="http://www.peterfinlan.com/">Peter Finlan</a></p>
					</div>
					<div class="col-md-7">
						<ul class="footer-nav">
							<li><a href="#about">About</a></li>
							<li><a href="#features">Features</a></li>
							<li><a href="#screenshots">Screenshots</a></li>
							<li><a href="#download">Download</a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
		<div class="overlay overlay-boxify">
			<nav>
				<ul>
					<li><a href="#about"><i class="fa fa-heart"></i>About</a></li>
					<li><a href="#features"><i class="fa fa-flash"></i>Features</a></li>
				</ul>
				<ul>
					<li><a href="#screenshots"><i class="fa fa-desktop"></i>Screenshots</a></li>
					<li><a href="#download"><i class="fa fa-download"></i>Download</a></li>
				</ul>
			</nav>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://pubnub.github.io/angular-js/scripts/pubnub-angular.js"></script>
    <script src="//js.maxmind.com/js/apis/geoip2/v2.1/geoip2.js" type="text/javascript"></script>
 	    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.5/angular.min.js"></script>


		<script src="js/min/toucheffects-min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/flickity.pkgd.min.js"></script>
		<script src="js/jquery.fancybox.pack.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/retina.js"></script>
		<script src="js/waypoints.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/min/scripts-min.js"></script>
		<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
		<script>
		(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
		function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
		e=o.createElement(i);r=o.getElementsByTagName(i)[0];
		e.src='//www.google-analytics.com/analytics.js';
		r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
		ga('create','UA-XXXXX-X');ga('send','pageview');
		</script>
		<!-- Google maps -->
<script src="http://cdn.pubnub.com/pubnub-3.7.1.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script type="text/javascript">
	var lat = null;
var lng = null;


// sets your location as default
if (navigator.geolocation) {

  navigator.geolocation.getCurrentPosition(function(position) {
    var locationMarker = null;
    if (locationMarker){
      // return if there is a locationMarker bug
      return;
    }

    lat = position.coords["latitude"];
    lng = position.coords["longitude"];

   console.log(lat, lng);

  },
  function(error) {
    console.log("Error: ", error);
  },
  {
    enableHighAccuracy: true
  }
  );
}

function pubs() {
	pubnub = PUBNUB.init({
  publish_key: 'pub-c-572e2242-d141-476f-9976-d77155661fd4',
  subscribe_key: 'sub-c-d75446e2-843a-11e5-83e3-02ee2ddab7fe'
});
pubnub.subscribe({
  channel: "mymaps",
  message: function(message, channel) {
    console.log(message)
    lat = message['lat'];
    lng = message['lng'];
    //custom method
    redraw();
  },
  connect: function() {console.log("PubNub Connected")}
});
}
</script>

<!-- Broadcasting -->
 <script>
    angular.module('broadcastApp', ["pubnub.angular.service"])
      .controller('BcCtrl', function ($rootScope, $scope, PubNub, $window) {
        if (!$rootScope.initialized) {
          PubNub.init({
  publish_key: 'pub-c-572e2242-d141-476f-9976-d77155661fd4',
  subscribe_key: 'sub-c-d75446e2-843a-11e5-83e3-02ee2ddab7fe'
          });
          $rootScope.initialized = true;
        }

        if ($window.navigator.geolocation) {
          $window.navigator.geolocation.getCurrentPosition(function(position) { 
            var locationMarker = null;
            if (locationMarker){
              // return if there is a locationMarker bug
                return;
            }
            $scope.mylat = position.coords["latitude"];
            $scope.mylng = position.coords["longitude"];
            $scope.$apply(mainFcn());
          },
          function(error) {
            console.log("Error: ", error);
          },
          {
            enableHighAccuracy: true
          }
          );
        }

        var mainFcn = function() {
          $scope.start_lat = $scope.mylat; //starting location
          $scope.start_long = $scope.mylng; // starting location
          $scope.lat_inc = 0.001; // latitude incremental add
          $scope.long_inc = 0.001; // longitude incremental add
          $scope.delay = 1; // time delay between messages
          $scope.count = 4; // number of messages
          $scope.isDisabled = false;

          $scope.start = function() {
            $scope.coords = {"lat":$scope.start_lat, "lng":$scope.start_long, "alt":0 };
            $scope.pnCall($scope.coords);
          }

          $scope.pnCall = function(coords) {
            console.log(coords);
            $scope.isDisabled = true; // disable the start button
            PubNub.ngPublish({
              channel: "mymaps",
              message: coords,
              callback: function(){setTimeout(function(){$scope.tracker(coords)},$scope.delay*1000)}
            });
          }

          $scope.tracker = function(coords) {
            var new_lng;
            var new_lat;

            if ($scope.count - 1 === 0) {
              console.log("done");
              $scope.$apply($scope.isDisabled = false);
            } else {
              new_lng = Number(coords["lng"]) + Number($scope.long_inc);
              new_lat = Number(coords["lat"]) + Number($scope.lat_inc);
              coords = {"lat":new_lat, "lng":new_lng, "alt":0 };
              $scope.pnCall(coords); // call pnCall and send new coords
              $scope.$apply($scope.count -= 1);
            }
          }
        };

      });



    </script>
    <!--Broadcasting end -->
   <!-- Google maps end -->
	</body>
</html>
