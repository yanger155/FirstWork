<?php
namespace controllers;

class RegistController
{
    public function regist()
    {
        view('login/register');
    }


    public function doRegist()
    {
        $redis = \libs\Redis::getInstance();
        $phone = $_POST['phone'];
        $pwd = md5($_POST['password']);
        if(is_numeric($username))
        {
            $key = 'sms_'.$_POST['code'];
            $ret = $redis->get($key);

        }
    }

    // 验证码生产者
    public function sendCode($phone)
    {
    //    $phone = $argv;
    //    $phone = $_GET['phone'];
       $code = rand(10000,99999);
       $redis = \libs\Redis::getInstance();
       $key = 'sms_'.$code;
        // 设置过期时间
       $redis->setex($key,300,$phone);
       $sms = [
           'phone' => $_GET['phone'],
           'code' => $code,
       ];
        // 使用队列
       $sms = json_encode($sms);
       $redis->lpush('sms-list',$sms);
       $redis->brpop('sms-list');

    }

    // 验证码消费者
    public function sendCodeList()
    {
        
        // 设置永不过时
        ini_set('default_socket_timeout',-1);
        echo "消费者程序已启动。。。。";

        $redis = \libs\Redis::getInstance();

        while(true)
        {
            // 取数据，设置为永不超时
            $data = $redis->brpop('sms-list',0);
            $flcode = json_decode($data);
            // 发验证码
            $flc = new libs\flc;
            $flc->flc($flcode['phone'],$sms['code']);
        }

        
    }
}