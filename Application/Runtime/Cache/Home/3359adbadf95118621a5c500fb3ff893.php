<?php if (!defined('THINK_PATH')) exit();?>

<FORM method="post" action="/athome/index.php/Home/User/signup">
	  昵称 <INPUT type="text" name="name"><br/>
	  密码 <INPUT type="password" name="password"><br/>
    确认密码<INPUT type="password" name="confirm_password"><br/>
   	手机号<INPUT type="text" name="phone_number"><br/>
   	<INPUT type="text" name="verify_code">
	<INPUT type="button" name="verify_code_btn" value="获取验证码" onclick="get_verify_code()"> <br />
	<INPUT type="submit" value="提交">
</FORM>