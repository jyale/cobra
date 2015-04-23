
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Blur.js</title>
  
	<script type='text/javascript' src='http://code.jquery.com/jquery-1.7.1.js'></script>
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js'></script>
	<script type='text/javascript' src='blur.js'></script>
  
	<style type='text/css'>
		body{
			margin:0;padding:0;
			color:#fff;
			font-family:arial;
			text-shadow:0 2px 2px #000;
			
			background:top left no-repeat;
			background-image:url('logo.png');
			
		}
		.circle{
			margin:0;
			
			-webkit-box-shadow:0 2px 2px #000, 0 1px 0 #fff inset;
			-moz-box-shadow:0 2px 2px #000, 0 1px 0 #fff inset;
			box-shadow:0 2px 2px #000, 0 1px 0 #fff inset;
			
			width:255px;
			height:255px;
			
			-webkit-border-radius:127px;
			-moz-border-radius:127px;
			border-radius:0px;
			
			cursor:move;
		}

		.overlay{
			position:absolute;
			top:100;left:100;
			width:100%;height:100%;
			background:url("logo.png");
		}

	</style>
</head>
<body>
	<div class="circle"></div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.circle').blurjs({
				draggable: false,
				overlay: 'rgba(255,255,255,0.1)',
				radius:20
			});
		});
	</script>


<div class="overlay"></div>


</body>
</html>
