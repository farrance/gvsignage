<?php
require_once('class/class.signage.php');
$Signage = new Signage();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!--meta http-equiv="refresh" content="30; url=./" /-->
<link href="css/style.css" rel="stylesheet" />
<title>GV Signage</title>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>
<body>
<div class="wrapper">
	<div class="header">
		<img src="img/logo.png"  />
	</div>
	<div class="hero">
		<h1>Live Tube Statuses</h1>
	</div>
	<div class="tube">
		<?php echo $Signage->TubeStatus(); ?>
	</div>
	<div class="clock"></div>
</div>
<script>

//Clock
function clock() {
	
	var date	= new Date();
	var hour	= date.getHours();
	var minute	= date.getMinutes();
	var second	= date.getSeconds();
	var time	= hour + ':' + minute + ':' + second;
	
	$('.clock').html(time);
	setTimeout('clock()',1000);
	
}
clock();

//Animate all the tube info one at a time
function animateIn(){
	$('.tube-animate').each(function (i) {
		$(this)
		.delay( 200*i )
		.css( { opacity : 0, "z-index": 1 } )
		.animate( { opacity: 1 }, 500 );
	});
}

animateIn();
</script>
</body>
</html>