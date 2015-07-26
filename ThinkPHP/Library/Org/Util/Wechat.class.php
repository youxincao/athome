<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/25
 * Time: 20:44
 */
namespace Org\Util;

/**
 * ΢����Ȩ��ؽӿ�
 *
 * @link http://www.phpddt.com
 */

class Wechat
{

    //�߼�����-��������ģʽ-����ȡ
    private $app_id = 'wx68c8c38c45de276d';
    private $app_secret = '0aab8199e85964d14b8cadf844f5b04b';


    /**
     * ��ȡ΢����Ȩ����
     *
     * @param string $redirect_uri ��ת��ַ
     * @param mixed $state ����
     */
    public function get_authorize_url($redirect_uri = '', $state = '')
    {
        $redirect_uri = urlencode($redirect_uri);
        return "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->app_id}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state={$state}#wechat_redirect";
    }

    /**
     * ��ȡ��Ȩtoken
     *
     * @param string $code ͨ��get_authorize_url��ȡ����code
     */
    public function get_open_id($code = '')
    {
        $token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->app_id}&secret={$this->app_secret}&code={$code}&grant_type=authorization_code";
        $token_data = $this->http($token_url);

        if ($token_data[0] == 200) {
            return json_decode($token_data[1], TRUE);
        }

        return FALSE;
    }

    public function get_access_token()
    {
        $token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->app_id}&secret={$this->app_secret}";
        $token_data = $this->http($token_url);

        if ($token_data[0] == 200) {
            return json_decode($token_data[1], TRUE);
        }

        return FALSE;
    }

    /**
     * ��ȡ��Ȩ���΢���û���Ϣ
     *
     * @param string $access_token
     * @param string $open_id
     */
    public function get_user_info($access_token = '', $open_id = '')
    {
        if ($access_token && $open_id) {
            $info_url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$open_id}&lang=zh_CN";
            $info_data = $this->http($info_url);

            if ($info_data[0] == 200) {
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
