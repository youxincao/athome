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
			$this->success("绑定设备成功");
			// 绑定设备
			
		}else {
			$this->error("设备不存在");
		}
	}
}
