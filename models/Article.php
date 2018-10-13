<?php
namespace models;

use PDO;

class Article extends Model
{
    public function search()
    {
        $where = 'user_id='.$_SESSION['id'];
        
        $value = [];

        if(isset($_GET['start_time']) && $_GET['start_time'])
        {
            $where .= " AND created_at >= ?";
            $value[] = $_GET['start_time'];

        }

        if(isset($_GET['end_time']) && $_GET['end_time'])
        {
            $where .= " AND created_at <= ?";
            $value[] = $_GET['end_time'];
        }

        if(isset($_GET['keyword']) && $_GET['keyword'])
        {
            $where .= " AND (title LIKE ? OR content LIKE ?)";
            $value[] = '%'.$_GET['keyword'].'%';
            $value[] = '%'.$_GET['keyword'].'%';
        }

        if(isset($_GET['is_show']) && $_GET['is_show']=='1' || $_GET['is_show']==='0')
        {
            $where .= " AND is_show = ?";
            $value[] = $_GET['is_show'];
        }

        $odby = 'created_at';
        $odway = 'desc';

        if(isset($_GET['odby']) && $_GET['odby'] == 'display')
        {
            $odby = 'display';
        }

        if(isset($_GET['odway']) && $_GET['odway'] == 'odway')
        {
            $odway = 'asc';
        }

        $perpage = 2;

        // 当前页码  整数
        $page = isset($_GET['page']) ? max(1,(int)$_GET['page']) : 1;

        // 计算每页开始的文章编号
        $startCount = ($page-1)*$perpage;

        $stmt = self::$pdo->prepare("SELECT COUNT(*) FROM article WHERE $where");
        $stmt->execute($value);
        // 取出符合条件的条数
        $count = $stmt->fetch(FETCH_COLUMN);

        $pageCount = ceil($count/$perpage);

        // 制作按钮
        $btns = '';
        for($i=1; $i<=$pageCount; $i++)
        {
            $params = getUrlParamas(['page']); 
            $btns .= "<a href='?{$params}page=$i'> $i </a>";
        }



        // $sql = "select * from article";
        $stmt = self::$pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function insert($title,$content,$is_show)
    {
        $stmt = self::$pdo->prepare('INSERT INTO article(title,content,is_show,user_id) VALUES(?,?,?,?)');
        $stmt->execute([
            $title,
            $content,
            $is_show,
            $_SESSION['id']
        ]);
    }

    public function findOne($id)
    {
        $stmt = self::$pdo->prepare('select * from article where id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function update($title,$content,$is_show,$id)
    {
        $stmt = self::$pdo->prepare('UPDATE article SET title=?,content=?,is_show=? WHERE id=?');
        return $stmt->execute([
            $title,
            $content,
            $is_show,
            $id
        ]);
        
    }

    
    public function delete($id)
    {
        $stmt = self::$pdo->prepare('DELETE FROM article WHERE id=?');
        $stmt->execute([
            $id,
        ]);

    }
}