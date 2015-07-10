<?php if (!defined('THINK_PATH')) exit();?><html lang="en" class="no-js">    
 <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
        <meta name="description" content="Login" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="WeiLun" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" />  
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>  
	<script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>  
 </head>
    <body>
      <div id="login">
          <form  action="/athome/index.php/Home/User/signin" autocomplete="on" method="post">
		<div data-role="header">
              		<h1>Log in</h1> 
	      	</div>
   	      	<div data-role="filedcontain">
                  	<label>Your username </label>
                  	<input id="username" name="name" required="required" type="text" placeholder="myusername"/>
		</div>
   	      	<div data-role="filedcontain">
                  	<label>Your password</label>
                  	<input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
		</div>
			<label>
      	        		<input type="checkbox" name="loginkeeping">Keep Login</input> 
			</label>
   	      	<div data-role="filedcontain">
                 	<input type="submit" value="Login" /> 
		</div>
              	<p> 
      			Not a member yet ?
      			<a href="#toregister" class="to_register">Join us</a>
      		</p>
          </form>
      </div>
   </body>
</html>