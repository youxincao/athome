<?php if (!defined('THINK_PATH')) exit();?><html lang="en" class="no-js">    
 <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>AtHome</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
        <meta name="description" content="Login" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="WeiLun" />

	<style type="text/css">
		label.error{   
		   color: red;   
		   font-size: 16px;    
		   font-weight: normal;   
		   line-height: 1.4;    
		   margin-top: 0.5em;    
		   width: 100%;    
		   float: none; 
		}  
		 
		 .landscape label.error {   
		   display: inline-block;    
		   margin-left: 22%; 
		 } 
		 
		.portrait label.error {     
		   margin-left: 0;     
		   display: block; 
		 }   
		 
		em{      
		  color: red;    
		  font-weight: bold;    
		  padding-right: .25em;  
		}
	</style>
	
	<link rel="stylesheet" href="/athome/Public/css/jquery.mobile-1.4.5.min.css" />  
	<script src="/athome/Public/js/jquery-1.11.3.min.js"></script>  
	<script src="/athome/Public/js/jquery.mobile-1.4.5.min.js"></script>  
	<script src="/athome/Public/js/jquery.validate.min.js"></script>  
	<script src="/athome/Public/js/messages_zh.min.js"></script>  

	<script type="text/javascript">
        	$(function(){
        	    $("#bindForm").validate();
        	});
        </script>
 </head>
    <body>
      <div id="login">
       <form  id ="bindForm" action="/athome/index.php/Home/Main/bind_device" autocomplete="on" method="post" data-ajax="false">
		<div data-role="header">
              		<h1>绑定设备</h1> 
	      	</div>
   	      	<div data-role="filedcontain">
                  	<label for="device_sn"><em>* </em>device SN </label>
                  	<input id="device_sn" name="device_sn" class="required" type="text" placeholder="device sn"/>
			</div>
   	      	
   	      	<div data-role="filedcontain">
                 	<input data-theme="a" type="submit" value="确定" /> 
			</div>
          </form>
      </div>
   </body>
</html>