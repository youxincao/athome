<?php if (!defined('THINK_PATH')) exit();?><html lang="en" class="no-js">    
 <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>AtHome</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
        <meta name="description" content="Login" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="WeiLun" />
	<!--
	<link rel="stylesheet" href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" />  
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>  
	<script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>  
	-->

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
        	    $("#loginForm").validate();

        	//     function complete(data){
        	//     	alert(data);
        	//     }
        	});
        </script>
 </head>
    <body>
      <div id="login">
       <form  id ="loginForm" action="/athome/index.php/Home/User/signin" autocomplete="on" method="post" data-ajax="false">
		<div data-role="header">
              		<h1>Log in</h1> 
	      	</div>
   	      	<div data-role="filedcontain">
                  	<label for="username"><em>* </em>Your username </label>
                  	<input id="username" name="name" class="required" type="text" placeholder="myusername"/>
		</div>
   	      	<div data-role="filedcontain">
                  	<label for="password"><em>* </em>Your password</label>
                  	<input id="password" name="password" class="required" type="password" placeholder="eg. X8df!90EO" /> 
		</div>
			<label>
      	        		<input type="checkbox" name="loginkeeping">Keep Login</input> 
			</label>
   	      	<div data-role="filedcontain">
                 	<input data-theme="a" type="submit" value="Login" /> 
		</div>
              	<p> 
      			Not a member yet ?
      			<a href="#toregister" class="to_register">Join us</a>
      		</p>
          </form>
      </div>
   </body>
</html>