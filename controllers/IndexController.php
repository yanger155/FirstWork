<?php
namespace controllers;

class IndexController extends BaseController
{

    public function index()
    {
        view('index/index');
    }
}