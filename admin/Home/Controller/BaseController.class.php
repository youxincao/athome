<?php 

namespace Home\Controller;
use Think\Controller;

Class BaseController extends Controller{

	public function _initialize(){
		if ( null ==  $_SESSION['uid']  || null == $_SESSION['username']){
			$this->redirect("home/login/login");
		}
	}
};
?>