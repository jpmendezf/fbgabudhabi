<?php
/**
* Template Name: Contact Us - Mobile App Version
*/
?><!DOCTYPE html>
<html>
<head>
	<title>Contact Us </title>
	<meta charset="utf-8" />
	<meta name = "viewport" content = "width=device-width, maximum-scale = 1, minimum-scale=1" />
	<link rel="stylesheet" type="text/css" href="http://belpro.co/fbg/css/default.css" media="all" />
	<link rel="stylesheet" type="text/css" href="http://belpro.co/fbg/css/font-awesome.min.css" media="all" />
	<script type="text/javascript"
	    src="https://maps.google.com/maps/api/js?sensor=false">
	</script>
	<script type="text/javascript">
	  function initialize() {
	    var latlng = new google.maps.LatLng(24.500600, 54.370635);
	    var myOptions = {
	      zoom: 13,
	      center: latlng,
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    };
	    var map = new google.maps.Map(document.getElementById("map_canvas"),
	        myOptions);
		var marker = new google.maps.Marker({
          position: latlng,
          map: map,
          title: 'The French Business Group Abu Dhabi'
        });
	  }

	</script>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body onload="initialize()">
	<div id="pagewidth">
		
		<div id="content">
			
			
			
			
			<section id="contactUs" class="row grey">
				<div class="center">
					<div class="columns">
						<div class="half">
							<div class="item"><img src="http://belpro.co/fbg/wp-content/uploads/2016/12/new-FBG-logo.png" width="233" height="224" alt=""  ></div>
							<h3>We'd love to discuss over the phone or via e-mail!</h3>
							
							<p>
							<i class="fa fontawesome-icon fa-phone circle-yes" style="font-size:15.84px;line-height:31.68px;height:31.68px;margin-right:9px;"></i>
							<a href="tel:+971 2 674 1137">+971 (0)2 674 1137</a> <br /><br />
							<i class="fa fontawesome-icon fa-envelope-o circle-yes" style="font-size:15.84px;line-height:31.68px;height:31.68px;margin-right:9px;"></i>
							<a href="mailto:info@fbgabudhabi.com">info@fbgabudhabi.com</a><br /><br />
							</p>
							
							<h2><i style="border-color:#333333;border-width:1px;background-color:#333333;height:30px;width:30px;line-height:30px;border-radius:50%;color:#ffffff;" class="fa fontawesome-icon fa-globe circle-yes"></i>&nbsp;&nbsp;GPS Coordinates</h2>
							<p>N 24°30.058′ – E 54°22.246′<br /><br />
							</p>
							<h2><i style="border-color:#333333;border-width:1px;background-color:#333333;height:30px;width:30px;line-height:30px;border-radius:50%;color:#ffffff;font-size:21px;" class="fa fontawesome-icon fa-street-view circle-yes"></i>&nbsp;&nbsp;Address</h2>
							<p>
							Behind the Sheraton Corniche Hotel, <br /><br />
							Next to the Hawthorn Suites Hotel,<br /><br />
							Mina Road, Salam Street - Office Floor - Suite 05<br /><br />
							Abu Dhabi, UAE<br /><br />
							<br />
							
							</p>
							<h2><i style="border-color:#333333;border-width:1px;background-color:#333333;height:30px;width:30px;line-height:30px;border-radius:50%;color:#ffffff;font-size:21px;" class="fa fontawesome-icon fa-clock-o circle-yes"></i>&nbsp;&nbsp;Opening Hours</h2>
							<p>Sunday to Thursday 8:30am to 5.00pm Abu Dhabi Time</p>

						</div>

						<div class="half">
							<div id="map">
								<div class="imgHolder"><div id="map_canvas" style="width:445px; height:392px"></div></div>
							</div>
						</div>
												
					</div>
				</div>
			</section>
		</div>
		
	</div>
</body>
</html>