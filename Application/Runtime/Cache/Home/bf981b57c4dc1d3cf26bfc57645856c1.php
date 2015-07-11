<?php if (!defined('THINK_PATH')) exit();?><html lang="en" class="no-js">    
 <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>AtHome</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
        <meta name="description" content="device" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="WeiLun" />
	<link rel="stylesheet" href="/athome/Public/css/jquery.mobile-1.4.5.min.css" />  
	<script src="/athome/Public/js/jquery-1.11.3.min.js"></script>  
	<script src="/athome/Public/js/jquery.mobile-1.4.5.min.js"></script>  
 </head>
	<body>
			<div data-role="header"><h1>Bound Device</h1></div>
			<div data-role="content">
				<p>Device SN: <?php echo ($device_sn); ?></p>	
			</div>
 	</body>
</html>