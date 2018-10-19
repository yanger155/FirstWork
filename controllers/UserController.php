<?php
namespace controllers;

use models\User;

class UserController extends BaseController
{
    public function list()
    {
        $model = new User;
        $data = $model->findAllUser();
        // echo "<pre>";
        // var_dump($data);
        // exit;
        view('user/list',[
            'data' => $data,
        ]);
    }


    public function create()
    {

        view('user/create');
    }


    public function insert()
    {
        
    }
    
}