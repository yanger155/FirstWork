<?php
namespace controllers;

class BaseController
{
    //写在构造函数里，一开始就执行
    public function __construct()
    {
        if(!isset($_SESSION['id']))
        {
            redirect('login/login');
        }
    }

   

    // if($_SESSION['name'] = 'root')
    // {
    //     return ;
    // }
}