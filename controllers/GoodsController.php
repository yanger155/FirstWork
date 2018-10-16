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
        // echo "<pre>";
        // var_dump($_POST);
        // exit;
        $parent_id = '';
        $path = '';
        $cat_name = $_POST['cat_name'];

        if($_POST['catid1'] == "" && $_POST['catid2'] == "" && $_POST['catid3'] == "")
        {
            $parent_id = 0;
            // $cat_name = $_POST['cat_name'];
            $path = '-';
        }
        else if($_POST['catid2'] == "" && $_POST['catid3'] == "")
        {
            $parent_id = $_POST['catid1'];
            // $cat_name = $_POST['cat_name'];
            $path = '-'.$parent_id.'-';
        }
        else if($_POST['catid3'] == "")
        {
            $parent_id = $_POST['catid2'];
            // $cat_name = $_POST['cat_name'];
            $path = '-'.$_POST['catid1'].'-'.$_POST['catid2'].'-';
        }
        else
        {
            $parent_id = $_POST['catid3'];
            // $cat_name = $_POST['catid3']
            $path = '-'.$_POST['catid1'].'-'.$_POST['catid2'].'-'.$_POST['catid3'].'-';
        }
        $model = new Goods;
        $model -> insert($cat_name,$parent_id,$path);
        redirect('/goods/list');

    }


    // ajax三级联动
    public function ajax_getCat()
    {

        $parent_id = @(int)$_GET['parent_id'];
        $model = new Goods;
        $data = $model->getCat($parent_id);
        echo json_encode($data);

    }
    

}
