<?php 
namespace Home\Controller;
use Think\Controller;

class MainController extends BaseController {

	public function admin(){
		$this->display();
	}

	public function bind_device(){
		
		$device_sn = I('device_sn');

		if(M('device')->where(array('sn' => $device_sn))->select()){
			// 绑定设备
			$bind_time = time();

			if( null !=  $_SESSION['openid']  ){
				$openiddata = array(
					'openid' => $_SESSION['openid'],
					'device_sn' => $device_sn,
					'bind_time' => $bind_time,
				);

				if( !M('bind_openid_sn')->add($openiddata) ){
					$this->error("绑定设备到微信失败");
					return;
				}
			}

			if( null != $_SESSION['username'] ) {
				$username_data = array(
					'username' => $_SESSION['username'],
					'device_sn' => $device_sn,
					'bind_time' => $bind_time, 
				);

				if( !M('bind_user_sn')->add($username_data) ){
					$this->error("绑定设备到用户失败");
					return;
				}
			}
			$this->success("绑定设备成功");

		}else {
			$this->error("设备不存在");
		}
	}
}
