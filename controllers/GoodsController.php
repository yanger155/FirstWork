<?php
namespace controllers;

use models\Goods;

class GoodsController
{


    // 获取无限级别分类数据，加载数据
    public function list()
    {
        $goods = new Goods;
        // 获取分类数据
        $data = $goods->category();
        $sortData = $goods->sort($data,$parent_id=0,$level=0);

        // echo "<pre>";
        // var_dump($sortData);
        // exit;

        view('goods/list',[
            'sortData' => $sortData,
        ]);
        
    }


    public function create()
    {
        $model = new Goods;
        $data = $model->getCat($parent_id = 0);
        // var_dump($data);
        // exit;
        view('goods/create',[
            'data' => $data
        ]);
    }

    public function insert()
    {
        
    }


    // 通过ajax获取的数据
    public function ajax_getCat()
    {
        $parent_id = @(int)$_GET['parent_id'];
        $model = new Goods;
        $data = $model->getCat($parent_id);
        echo json_encode($data);

    }
    

}
