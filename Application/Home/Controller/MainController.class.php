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
    public function get_access_token($code = '')
    {
        $token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->app_id}&secret={$this->app_secret}&code={$code}&grant_type=authorization_code";
        $token_data = $this->http($token_url);
        
        if($token_data[0] == 200)
        {
            return json_decode($token_data[1], TRUE);
        }
        
        return FALSE;
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

    	public function bound_device(){
        	$this->assign('device_sn',$_SESSION['device_sn']);
		$this->display();
    	}
	
	public function gps_info(){
	$code = I('code');
        $state = I('state');
	$bound  = false ;

        if($state == 'weixin' && $code != '' ){
            // 拉取微信用户的openid
            $wechat = new Wechat();
            $access_token = $wechat->get_access_token($code);
            if( $access_token ) {
                session('access_token', $access_token['access_token']);
                session('refresh_token', $access_token['refresh_token']);
                session('openid', $access_token['openid']);

                // 查看是否已经绑定设备，如果已经绑定显示已经绑定的设备
                $res = M('bind_openid_sn')->where(array('openid' => $access_token['openid']))->select();
                if( $res ){
		    $bound = true ;
                    session('device_sn', $res[0]['device_sn']);
                    $this->success("Already Bound Device", U('Main/bound_device'), 1);
		    return ;
                }
            }
        }

    	if(!$bound) 
		$this->display("ask_bind_device");
 	
	}	

	public function alarm_info(){
	$code = I('code');
        $state = I('state');
	$bound  = false ;

        if($state == 'weixin' && $code != '' ){
            // 拉取微信用户的openid
            $wechat = new Wechat();
            $access_token = $wechat->get_access_token($code);
            if( $access_token ) {
                session('access_token', $access_token['access_token']);
                session('refresh_token', $access_token['refresh_token']);
                session('openid', $access_token['openid']);

                // 查看是否已经绑定设备，如果已经绑定显示已经绑定的设备
                $res = M('bind_openid_sn')->where(array('openid' => $access_token['openid']))->select();
                if( $res ){
		    $bound = true ;
                    session('device_sn', $res[0]['device_sn']);
                    $this->success("Already Bound Device", U('Main/bound_device'), 1);
		    return ;
                }
            }
        }

    	if(!$bound) 
		$this->display("ask_bind_device");
 	
	}	

}
