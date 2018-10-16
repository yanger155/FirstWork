<?php
namespace models;

class User extends Model
{
    // 连接数据库

    public function findUser($username)
    {
         // 查询用户是否存在
        $stmt = self::$pdo->prepare('select * from user where username = ?');
        $stmt->execute([
            $username,
        ]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
        // echo $count;
        

    }
   
}