<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {

	public function register(){
		$this->redirect("User/login#toregister");
	}

    public function login() {
    	$this->display();
    }

    public function signup(){
        p(I("post."));

        $name = I('usernamesignup');
        $phonenum = I('phonesignup');
        $password = I('passwordsignup');

        $user_model = M('user');
        $data = array( 
        	'name' => $name,
        	'password' => md5($password),
        	'phonenum' => $phonenum,
        	);
        if($user_model->add($data)) {
        	$this->display('login');
        }else {
        	$this->error('注册失败');
        }
    }

    public function signin(){
    	if (!IS_POST) halt('页面不存在');

        p(I("post."));
    	$name = I('name');
    	$password = I('password');

    	$login_user = M('user')->where(array('name' =>$name))->find();
        p($login_user);
    	if(!$login_user || $login_user['password'] != md5($password))
    		$this->error('账号或者密码错误');

    	session('uid', $login_user['id']);
    	session('username', $name);
    	session('logintime' , date('Y-m-d H:i:s', time()));
    	session('loginip' , get_client_ip());

    	$this->redirect('Home/Main/admin');
    }
}

?>