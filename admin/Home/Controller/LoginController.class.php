<?php 
	
	namespace Home\Controller;
	use Think\Controller;

	class LoginController extends Controller {
    	public function login(){
        	$this->show();
    	}

    	public function signin(){
    	if (!IS_POST) halt('页面不存在');

    	$name = I('name');
    	$password = I('password');

    	$admin_user = M('admin')->where(array('name' =>$name))->find();

    	if(!$admin_user || $admin_user['password'] != md5($password))
    		$this->error('账号或者密码错误');

    	session('uid', $admin_user['id']);
    	session('username', $name);
    	session('logintime' , date('Y-m-d H:i:s', time()));
    	session('loginip' , get_client_ip());

    	$this->redirect('Home/admin/admin');
    }

    public function admin() {
    	$this->show();
    }
}