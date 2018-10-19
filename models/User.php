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

    public function findAllUser()
    {
         // 查询用户是否存在
         $stmt = self::$pdo->query(
             'select u.id, u.username, m.module_name, GROUP_CONCAT(p.privilege_name) privilege_list from user u
              left join user_module b on u.id = b.user_id
              left join module m on b.module_id = m.id
              left join module_privilege n on m.id = n.module_id
              left join privilege p on n.privilege_id = p.id 
              group by u.id');
         return $stmt->fetchAll(\PDO::FETCH_ASSOC); 
        // $sql = "select u.id, u.username, m.module_name, GROUP_CONCAT(p.privilege_name) privilege_list from user u
        //             left join user_module b on u.id = b.user_id
        //             left join module m on b.module_id = m.id
        //             left join module_privilege n on m.id = n.module_id
        //             left join privilege p on n.privilege_id = p.id 
        //             group by u.id
        //             "
    }

    public function insert()
    {
        
    }

   
}