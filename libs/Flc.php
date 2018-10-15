<?php
namespace libs;

use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;

class Flc
{
    public function flc($phone,$code)
    {
        $config = [
            'accessKeyId'    => 'LTAIbVA2LRQ1tULr',
            'accessKeySecret' => 'ocS48RUuyBPpQHsfoWokCuz8ZQbGxl',
        ];
        
        $client  = new Client($config);
        $sendSms = new SendSms;
        $sendSms->setPhoneNumbers($phone);
        $sendSms->setSignName('验证码');
        $sendSms->setTemplateCode('SMS_77670013');
        $sendSms->setTemplateParam(['code' => $code]);
        $sendSms->setOutId('demo');    //可选
        
        print_r($client->execute($sendSms));
    }
  
}


