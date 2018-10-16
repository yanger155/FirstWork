<?php
namespace models;

use PDO;

class Goods extends Model
{

    // static $data = null;


    // 递归排序  树形结构
    public function category($parent_id=0,$level=0)
    {
        $stmt = self::$pdo->query('select * from goodscategory');
        // $stmt->execute([$id]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // 1.排序的数据
        // 2.顶级父分类的id
        // 3.当前分类的级别
    
    }

    public function sort($data,$parent_id=0,$level=0)
    {
        static $arr = [];

        foreach($data as $v)
        {
            if($v['parent_id'] == $parent_id)
            {
                $v['level'] = $level;
                $arr[] = $v;
                $this->sort($data,$v['id'],$level+1);
            }
        }

        return $arr;
    }


    // 三级联动获取数据
    // 参数：上级分类的id  初始为0
    public function getCat($parent_id)
    {
        // echo $parent_id;
        $stmt = self::$pdo->prepare("select * from goodscategory where parent_id = ?");
        $stmt->execute([
            $parent_id,
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    public function insert($cat_name,$parent_id,$path)
    {
        $stmt = self::$pdo->prepare("INSERT INTO goodscategory(cat_name,parent_id,path) VALUES(?,?,?)");
        $stmt->execute([
            $cat_name,
            $parent_id,
            $path
        ]);
    }


   


}