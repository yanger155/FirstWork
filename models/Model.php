<?php
namespace models;

class Model
{
    // 连接数据库
    static $pdo = null;

    // 放到构造函数内，一开始就执行
    public function __construct()
    {
        if(self::$pdo === null)
        {
            self::$pdo = new \PDO('mysql:host=127.0.0.1;dbname=yxy','root','');
            self::$pdo->exec("SET NAMES UTF8");
        }

    }

    // 暂时不用封装方法
}