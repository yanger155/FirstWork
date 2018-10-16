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
        $data = $model->findUser($phone);
        // echo "<pre>";
        // var_dump($data);
        // exit;
        if(!$data)
        {
            echo "用户名不存在";
        }
        else
        {
            $_SESSION['id'] = $data['id'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['pwd'] = $data['password'];
            redirect('/article/list');
        }
        

    }
}