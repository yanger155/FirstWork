<?php
namespace controllers;

use models\User;

class LoginController 
{
    public function login()
    {
        view('login/login');
    }

    public function dologin()
    {
        // 接收数据
        $phone = $_POST['phone'];
        $pwd = md5($_POST['password']);

        $model = new User;
        $result = $model->findUser($username);
        if($result)
        {
            
            view('index/index');
        }
        else
        {
            echo "用户名不存在";
        }
        

    }
}