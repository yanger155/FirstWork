<?php
session_start();

define('ROOT',Dirname(Dirname(__FILE__)));
// echo ROOT;
// exit;



// 加载文件
require_once(ROOT.'\vendor\autoload.php');
require(ROOT.'\libs\function.php');

function upload($class)
{
    
    $path = str_replace('\\','/',$class);
    require(ROOT.'/'.$path.'.php');
}

spl_autoload_register('upload');



//解析路由
if(php_sapi_name() == 'cli')
{
    $controller = ucfirst($argv[1]);
    $action = $argv[2];

    // $fullController = 'controllers\\'.$controller.'Controller';
    // $_C = new $fullController;
    // $_C->$action();
}
else
{
    if(isset($_SERVER['PATH_INFO']))
    {
        // /index/index
        $url = explode('/',$_SERVER['PATH_INFO']);
        $controller = ucfirst($url[1]);
        $action = $url[2];
        
    }
    else
    {
        $controller = 'Index';
        $action = 'index';
    }

    // $fullController = 'controllers\\'.$controller.'Controller';
    // $_C = new $fullController;
    // $_C->$action();
}

// 拼接地址
$fullController = 'controllers\\'.$controller.'Controller';
$_C = new $fullController;
$_C->$action();


function getUrlParamas($data = [])
{
    // 先得到地址栏里的数据
    // 分解
    // 去掉传过来的参数项
    // 剩下的合并起来并返回字符串
    
}