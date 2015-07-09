<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends BaseController {

	public function admin(){
		$this->display();
	}

	public function add_device(){

		if(!IS_AJAX ) E("页面不存在");

		$device_sn = I('device_sn');
		$data = array(
				'sn' => $device_sn , 
			);

		// 如果设备已经存在
		$device = M('device');
		if($device->where($data)->select() ){
			$this->ajaxReturn(array('status' => 0 ), 'json');
		}else {
			$res =$device->add($data);
				if( $res ) {
					$this->ajaxReturn(array('status' => 1 ), 'json');
				}else {
					$this->ajaxReturn(array('status' => 0 ), 'json');
				}
			}	
	}


	public function gps_info(){
		if(!IS_AJAX ) E("页面不存在");
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