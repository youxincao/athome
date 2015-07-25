<?php
namespace Home\Controller;

use Think\Controller;


class MainController extends BaseController
{

    public function admin()
    {
        $this->display();
    }

    public function bind_device()
    {

        $device_sn = I('device_sn');

        if (M('device')->where(array('sn' => $device_sn))->select()) {
            // 绑定设备
            $bind_time = time();

            if (null != $_SESSION['openid']) {
                $openiddata = array(
                    'openid' => $_SESSION['openid'],
                    'device_sn' => $device_sn,
                    'bind_time' => $bind_time,
                );

                if (!M('bind_openid_sn')->add($openiddata)) {
                    $this->error("绑定设备到微信失败");
                    return;
                }
            }

            if (null != $_SESSION['username']) {
                $username_data = array(
                    'username' => $_SESSION['username'],
                    'device_sn' => $device_sn,
                    'bind_time' => $bind_time,
                );

                if (!M('bind_user_sn')->add($username_data)) {
                    $this->error("绑定设备到用户失败");
                    return;
                }
            }
            $this->success("绑定设备成功");

        } else {
            $this->error("设备不存在");
        }
    }

    public function bound_device()
    {
        $this->assign('device_sn', $_SESSION['device_sn']);
        $this->display();
    }

    public function gps_info()
    {
        $code = I('code');
        $state = I('state');
        $bound = false;

        if ($state == 'weixin' && $code != '') {
            // 拉取微信用户的openid
            import("Org.Util.Wechat");
            $wechat = new \Wechat();

            $access_token = $wechat->get_open_id($code);
            if ($access_token) {
                session('access_token', $access_token['access_token']);
                session('refresh_token', $access_token['refresh_token']);
                session('openid', $access_token['openid']);

                // save the accesstoken to db
                $token = $wechat->get_access_token();
                if ($token) {
                    $data['access_token'] = $token['access_token'];
                    $data['time'] = time();
                    M('accesstoken')->add($data);
                }

                // 查看是否已经绑定设备，如果已经绑定显示已经绑定的设备
                $res = M('bind_openid_sn')->where(array('openid' => $access_token['openid']))->select();
                if ($res) {
                    $bound = true;
                    session('device_sn', $res[0]['device_sn']);
                    $this->success("Already Bound Device", U('Main/list_gps_info'), 1);
                    return;
                }
            }
        }

        if (!$bound)
            $this->display("ask_bind_device");

    }

    public function alarm_info()
    {
        $code = I('code');
        $state = I('state');
        $bound = false;

        if ($state == 'weixin' && $code != '') {
            // 拉取微信用户的openid
            import(Org . Uiti . Wechat);
            $wechat = new \Wechat();
            $access_token = $wechat->get_open_id($code);
            if ($access_token) {
                session('access_token', $access_token['access_token']);
                session('refresh_token', $access_token['refresh_token']);
                session('openid', $access_token['openid']);
                // save the accesstoken to db
                $token = $wechat->get_access_token();
                if ($token) {
                    $data['access_token'] = $token['access_token'];
                    $data['time'] = time();
                    M('accesstoken')->add($data);
                }


                // 查看是否已经绑定设备，如果已经绑定显示已经绑定的设备
                $res = M('bind_openid_sn')->where(array('openid' => $access_token['openid']))->select();
                if ($res) {
                    $bound = true;
                    session('device_sn', $res[0]['device_sn']);
                    $this->success("Already Bound Device", U('Main/list_alarm_info'), 1);
                    return;
                }
            }
        }

        if (!$bound)
            $this->display("ask_bind_device");

    }

    public function list_alarm_info()
    {
        $device_sn = $_SESSION['device_sn'];
        $records = M('alarmrecord')->where(array("sn" => $device_sn))->select();
        if ($records) {
            $this->assign('info', "共有" . count($records) . "条报警信息");
            $this->assign("alarm_infos", $records);
        } else {
            $this->assign('info', "绑定的设备没有报警信息");
        }
        $this->display();
    }

    public function list_gps_info()
    {
        $device_sn = $_SESSION['device_sn'];
        $records = M('location')->where(array("sn" => $device_sn))->select();
        if ($records) {
            $this->assign('info', "共有" . count($records) . "条报警信息");
            $this->assign("gps_infos", $records);
        } else {
            $this->assign('info', "绑定的设备没有报警信息");
        }

        $this->display();
    }

    public function add_device(){
        $this->display();
    }
}

	
