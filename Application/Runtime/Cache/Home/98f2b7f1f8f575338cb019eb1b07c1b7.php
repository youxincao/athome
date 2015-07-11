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
			<div data-role="header"><h1><?php echo ($info); ?></h1></div>
			<div data-role="content">
				<?php if($gps_infos != null): ?><table>
				        <thead>
				        <tr>
				            <th>latitude</th>
				            <th>longitude</th>
				            <th>precision</th>
				            <th>time</th>
				        </tr>
				        </thead>

				        <?php if(is_array($gps_infos)): $i = 0; $__LIST__ = $gps_infos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gps): $mod = ($i % 2 );++$i;?><tr>
				            <td><?php echo ($gps['latitude']); ?></td>
				            <td><?php echo ($gps['longitude']); ?></td>
				            <td><?php echo ($gps['precision']); ?></td>
				            <td><?php echo ($gps['recordtime']); ?></td>
				        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
				    </table><?php endif; ?>
			</div>
 	</body>
</html>