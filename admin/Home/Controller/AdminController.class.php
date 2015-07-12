<?php
namespace Home\Controller;
use Think\Controller;

/**
 * 微信授权相关接口
 * 
 * @link http://www.phpddt.com
 */
 
class Wechat {
    
    //高级功能-》开发者模式-》获取
    private $app_id = 'wx68c8c38c45de276d';
    private $app_secret = '0aab8199e85964d14b8cadf844f5b04b';
 
 
    /**
     * 获取微信授权链接
     * 
     * @param string $redirect_uri 跳转地址
     * @param mixed $state 参数
     */
    public function get_authorize_url($redirect_uri = '', $state = '')
    {
        $redirect_uri = urlencode($redirect_uri);
        return "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->app_id}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state={$state}#wechat_redirect";
    }
    
    /**
     * 获取授权token
     * 
     * @param string $code 通过get_authorize_url获取到的code
     */
    public function get_open_id($code = '')
    {
        $token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->app_id}&secret={$this->app_secret}&code={$code}&grant_type=authorization_code";
        $token_data = $this->http($token_url);
        
        if($token_data[0] == 200)
        {
            return json_decode($token_data[1], TRUE);
        }
        
        return FALSE;
    }
    
    public function get_access_token(){
		$token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->app_id}&secret={$this->app_secret}";

		$ch = curl_init();
		//设置选项参数
		curl_setopt($ch, CURLOPT_URL, $token_url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$token_data = curl_exec($ch);//执行
		curl_close($ch);//释放curl句柄
  //      $token_data = $this->http($token_url, 'GET');
        p($token_data);
        
        if($token_data['errcode']  == null )
        	return false;
        return json_decode($token_data, TRUE);
        
    }

    /**
     * 获取授权后的微信用户信息
     * 
     * @param string $access_token
     * @param string $open_id
     */
    public function get_user_info($access_token = '', $open_id = '')
    {
        if($access_token && $open_id)
        {
            $info_url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$open_id}&lang=zh_CN";
            $info_data = $this->http($info_url);
            
            if($info_data[0] == 200)
            {
                return json_decode($info_data[1], TRUE);
            }
        }
        
        return FALSE;
    }
    
    public function http($url, $method, $postfields = null, $headers = array(), $debug = false)
    {
        $ci = curl_init();
        /* Curl settings */
        curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ci, CURLOPT_TIMEOUT, 30);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
 
        switch ($method) {
            case 'POST':
                curl_setopt($ci, CURLOPT_POST, true);
                if (!empty($postfields)) {
                    curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
                    $this->postdata = $postfields;
                }
                break;
        }
        curl_setopt($ci, CURLOPT_URL, $url);
        curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ci, CURLINFO_HEADER_OUT, true);
 
        $response = curl_exec($ci);
        $http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
 
        if ($debug) {
            echo "=====post data======\r\n";
            var_dump($postfields);
 
            echo '=====info=====' . "\r\n";
            print_r(curl_getinfo($ci));
 
            echo '=====$response=====' . "\r\n";
            print_r($response);
        }
        curl_close($ci);
        return array($http_code, $response);
    }
 
}

class AdminController extends BaseController {

	private function http_post_data($url, $data_string) {
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, $url); 
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	    curl_setopt($curl, CURLOPT_POST, 1);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);


	    $result = curl_exec($curl);
	    p($result);
	    if (curl_errno($curl)) {
	       return 'Errno'.curl_error($curl);
	    }
	    curl_close($curl);
	    return $result;
}


	public function admin(){
		$this->assign("device_list", M('device')->select());
		$this->assign("gps_infos", M('location')->select());
		$this->assign("alarm_infos",M('alarmrecord')->select());
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
			// 查看该sn是否有绑定的openid 
				$openids = M('bind_openid_sn')->where(array('device_sn' => "111111"))->select();
				$wechat = new Wechat();
				$token = $wechat->get_access_token();
	
				// 发送微信消息
				if( $openids && $token ){
					foreach ($openids as $openid) {
						$data['touser'] = $openid['openid'];
						$data['msgtype'] ='text';
						$data['text'] = array('content' => "Alarm Code:".$alarm_code);

						p( json_encode($data));

						$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$token['access_token'];
						$this->http_post_data($url, json_encode($data));
					}
				}

		
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