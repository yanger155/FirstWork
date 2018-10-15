<?php
namespace libs;

class Redis
{
    private static $obj = null;
    private function __construct(){}
    private function __clone(){}

    public static function getInstance()
    {
        if(self::$obj === null)
        {
            self::$obj = new \Predis\Client([
                'scheme' => 'tcp',
                'host' => '127.0.0.1',
                'port' => 6379,
            ]);
        }
        return self::$obj;
    }
}