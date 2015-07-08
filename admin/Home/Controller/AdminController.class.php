<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends Controller {
    public function login(){
        $this->show();
    }

    public function signin(){

    	$admin_form = D("Admin");
    	$vo = $admin_form->crate();
    	if($vo){
    		$this->error($admin_form->getError());
    		return;
    	}

    	$name = $_POST['name'];
    	$password = $_POST['password'];
    	$admin = M('admin');
    	$res = $admin->where("name=".$name." and password=".md5($password))->find();
    	if($res) {
    		session('admin' , $arrayName = array('id' => $res['id'], 'name' => $res['name']));
    		$this->success('登录成功');
    	}else {
    		$this->error('用户名或者密码错误', '__URL__/login');
    	}
    }
}