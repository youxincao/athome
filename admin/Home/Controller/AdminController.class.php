<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends BaseController {

	public function admin(){
		$this->display();
	}

	public function add_device(){
		$device_sn = I('device_sn');

		$data = array(
				'sn' => $device_sn , 
			);

		$res = M('device')->add($data);

		if( $res ) {
			$this->success("设备添加成功");
		}else {
			$this->success("设备添加失败");
		}
	}


	public function gps_info(){

	}

	public function alarm_info(){

	}
}