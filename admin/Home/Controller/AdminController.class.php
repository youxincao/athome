<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends BaseController {

	public function admin(){
		$this->assign("device_list", M('device')->select());
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
			$data['recodetime'] = time();
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
			$this->assign("gps_infos", $gps_info);
			$data['time'] = date('y-m-d H:i', time());
			$this->ajaxReturn($data, 'json');
		}else{
			$this->ajaxReturn(array('status' => 0 ), 'json');
		}
	}

	public function alarm_info(){
		if(!IS_AJAX ) E("页面不存在");
		$device_sn = I("device_sn");

		$condition['sn'] = $device_sn;
		$alarm_infos = M('alarmrecord')->where($condition)->select();
		if($gps_infos){
			$data['status'] = 1;
			$data['alarm_infos'] = $alarm_infos;
			$data['time'] = date('y-m-d H:i', time());
			$this->ajaxReturn($data, 'json');
		}else{
			$this->ajaxReturn(array('status' => 0 ), 'json');
		}
	}

	public function add_gps(){

		if(!IS_AJAX ) E("页面不存在");

		$sn = I('sn');
		$latitude = I('latitude');
		$longgtude = I('longgtude');
		$precision = I('precision');
		$time = time();

		// 设备号不存在
		if(!M('device')->where(array( sn => $sn))->select()){
			$res['status'] = 0;
			$res['info'] = "该设备不存在";
			$this->ajaxReturn($res, 'json');
			return ; 
		}

		$data['sn'] = $sn;
		$data['latitude'] = $latitude;
		$data['longgtude'] = $longgtude;
		$data['precision'] = $precision;
		$data['recordtime'] = $time;

		if( M('location')->add($data) ) {
			$res['status'] = 1;
			$res['info'] = "GPS信息添加成功";
			$this->ajaxReturn($res, 'json');
		}else{
			$res['status'] = 0;
			$res['info'] = "GPS信息添加失败";
			$this->ajaxReturn($res, 'json');
		}

	}

	public function add_alarm(){
		if(!IS_AJAX ) E("页面不存在");

		$sn = I('sn');
		$alarm_code = I('alarm_code');
		$time = time();

		// 设备号不存在
		if(!M('device')->where(array( sn => $sn))->select()){
			$res['status'] = 0;
			$res['info'] = "该设备不存在";
			$this->ajaxReturn($res, 'json');
			return ; 
		}

		// 状态码不存在
		if( !M(alarmtype)->where(array(code => $alarm_code))->select()){
			$res['status'] = 0;
			$res['info'] = "该报警信息不存在";
			$this->ajaxReturn($res, 'json');
			return;
		}

		$data['sn'] = $sn;
		$data['type'] = $alarm_code;
		$data[time] = time();
		if( M('alarmrecord')->add($data) ) {
			$res['status'] = 1;
			$res['info'] = "报警信息添加成功";
			$this->ajaxReturn($res, 'json');
		}else{
			$res['status'] = 0;
			$res['info'] = "报警信息添加失败";
			$this->ajaxReturn($res, 'json');
		}
	}
}