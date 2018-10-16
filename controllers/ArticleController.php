<?php
namespace controllers;

use models\Article;

class ArticleController{


    public function list()
    {
        $model = new Article;
        $data = $model->search();
        // echo "<pre>";
        // var_dump($data);
        // exit;

       
        view('article/list',$data);
    }

    public function create()
    {
        $model = new Article;
        $data = $model -> findCategory();
        view('article/create',[
            'data' => $data,
        ]);
    }

    public function insert()
    {
        // 接收表单
        $title = $_POST['title'];
        $content = $_POST['content'];
        $is_show = $_POST['is_show'];

        // echo "<pre>";
        // var_dump($data);
        // exit;
        $model = new Article;
        $model->insert($title,$content,$is_show);
        redirect('/article/list');

    }

    public function category()
    {
        view('article/category');
    }

    public function categoryInsert()
    {
        $cat_name = $_POST['cat_name'];
        $model = new Article;
        $model->categoryInsert($cat_name);
        redirect('/article/list');
    }

    public function edit()
    {
        $id = $_GET['id'];
        // 查询原始数据，并初始化
        // echo $_GET['id'];
        $model = new Article;
        $articleData = $model->findOne($id);
        // echo "<pre>";
        // var_dump($articleData);
        // exit;

        view('article/edit',[
            'articleData' => $articleData,
        ]);
    }

    public function update()
    {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $is_show = $_POST['is_show'];
        $id = $_POST['id'];


        $model = new Article;
        $model->update($title,$content,$is_show,$id);
        redirect('/Article/list');
    }

    public function delete()
    {
        $model = new Article;
        $id = $_GET['id'];
        $model->delete($id);
        redirect('/article/list');
    }
}
