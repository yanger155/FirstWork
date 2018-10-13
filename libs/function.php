<?php
// 这是一个加载视图函数的文件

function view($file,$data=[])
{
    // index/index
    // 解压参数**
    extract($data);
    include(ROOT.'/views/'.$file.'.html');
}

function redirect($url)
{
    header('Location:'.$url);
    exit;
}
