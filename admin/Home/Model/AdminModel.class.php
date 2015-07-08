<?php
namespace Home\Model;
use Think\Model;

class AdminModel extends Model {

	protected $__validate = array (
		array('name', 'require', '必须输入用户名'),
		array('password', 'require', '必须输入密码'),
		)；
}