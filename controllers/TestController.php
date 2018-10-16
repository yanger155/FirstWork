<?php
namespace controllers;

class TestController
{
    public function sendmail()
    {
        // require_once '/vendor/autoload.php';
        // Create the Transport
        $transport = (new \Swift_SmtpTransport('smtp.qq.com', 25))
        ->setUsername('3491944683@qq.com')
        ->setPassword('saspttrujadkdbjc')
        ;

        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);

        // Create a message
        $message = (new \Swift_Message('邮箱标题'))
        ->setFrom(['3491944683@qq.com' => 'yanger'])   //发件人
        ->setTo(['yanger199810@foxmail.com', 'yanger199810@foxmail.com' => 'angel'])   //收件人
        ->setBody('点击激活<a href="http://localhost:8888">点击登录</a>','text/html');   

        // Send the message
        $result = $mailer->send($message);
        var_dump($result);
    }

    public function makethumb()
    {
        // getimagesize 要求传入的是物理路径
        // imagejpeg("图片资源");用来输出图片，而后来添加了第二个参数imagejpeg("图片资源"，"文件保存位置");这是保存图片
        $model = new \libs\Thumb;
        $model->thumbMake('D:\www\FirstWork\public\uploads\20181016\64c68258d517023557e90897fa4acbe0.jpg',150,150,'D:\www\FirstWork\public\uploads\20181016\thumb.jpg');
    }

}