<?php
namespace libs;

class Mail
{

    // 发邮件
    public function send()
    {
        // Create the Transport
        $transport = (new Swift_SmtpTransport('smtp.qq.com', 25))
        ->setUsername('3491944683@qq.com')
        ->setPassword('saspttrujadkdbjc')   //授权码
        ;

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message('邮箱标题'))
        ->setFrom(['3491944683@qq.com' => 'yanger'])   //发件人
        ->setTo(['yanger199810@foxmail.com', 'yanger199810@foxmail.com' => 'angel'])   //收件人
        ->setBody('点击激活<a href="http://localhost:8888">点击登录</a>','text/html');   

        // Send the message
        $result = $mailer->send($message);
    }
}
