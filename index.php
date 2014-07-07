<?php
include_once "controller/vinstagram.php";
?>
<!DOCTYPE html> 
<html lang="en"> 
<head> 
	<title>INSTAGRAM FEEDER</title>
	<!-- metatags -->
	<meta charset="utf-8" /> 
	<!-- styles -->
	<link rel="stylesheet" href="css/vinstagram.css" type="text/css" media="screen" charset="utf-8" />
	<!-- js -->
	<script src="js/jquery-1.10.2.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/vinstagram.js" type="text/javascript" charset="utf-8"></script>
 
	

</head> 
<body> 
<div id="container"> 

	<div id="instagram-lightbox-wrapper">
		
		<div id="instagram-lightbox-container"></div>

	</div>

	<article id="vinstagram-container"> 

	<?php 
		$instagram->GetPhotosByHashtag( "rockalparque" );
		$instagram->PrintInstagramInformation();
	?>

	</article> 



</div><!-- container --> 
<!-- scripts --> 
</body> 
