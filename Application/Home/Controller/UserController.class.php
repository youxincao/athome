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

class UserController extends Controller {

    public function login() {
        $code = I('code');
        $state = I('state');

        if($state == 'weixin' && $code != '' ){
            // 拉取微信用户的openid
            $wechat = new Wechat();
            $access_token = $wechat->get_access_token($code);
            if( $access_token ) {
                session('access_token', $access_token['access_token']);
                session('refresh_token', $access_token['refresh_token']);
                session('openid', $access_token['openid']);
            }
        }

    	$this->display();
    }

    public function signup(){
        p(I("post."));

        $name = I('usernamesignup');
        $phonenum = I('phonesignup');
        $password = I('passwordsignup');

        $user_model = M('user');
        $data = array( 
        	'name' => $name,
        	'password' => md5($password),
        	'phonenum' => $phonenum,
        	);
        if($user_model->add($data)) {
        	$this->display('login');
        }else {
        	$this->error('注册失败');
        }
    }

    public function signin(){

        if( !IS_POST ) halt("页面不存在");

    	$name = I('name');
    	$password = I('password');

    	$login_user = M('user')->where(array('name' =>$name))->find();
    	if(!$login_user || $login_user['password'] != md5($password)){
    		$this->error('账号或者密码错误');
            return ;
        }

    	session('uid', $login_user['id']);
    	session('username', $name);
    	session('logintime' , date('Y-m-d H:i:s', time()));
    	session('loginip' , get_client_ip());

    	$this->success('登录成功', U('Main/admin'), 1);
    }
}

?>