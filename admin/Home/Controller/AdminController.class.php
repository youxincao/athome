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
		if( !IS_AJAX ) halt("页面不存在");
		$device_sn = I("device_sn");

		$condition['sn'] = $device_sn;
		$gps_infos = M('location')->where($condition)->select();
		if($gps_infos){
			$data['status'] = 1;
			$data['gps_info'] = $gps_infos;
			$data['time'] = date('y-m-d H:i', time());
			$this->ajaxReturn($data, 'json');
		}else{
			$this->ajaxReturn(array('status' => 0 ), 'json');
		}
	}

	public function alarm_info(){

	}
}