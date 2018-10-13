<?php
namespace models;

class User extends Model
{
    // 连接数据库

    public function findUser()
    {
         // 查询用户是否存在
        $stmt = self::$pdo->prepare('select * from user where username = ?');
        $stmt->execute([
            $_POST['username'],
        ]);
        $count = $stmt->fetch(\PDO::FETCH_COLUMN);
        return $count;

    }
   
}