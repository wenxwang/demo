<?php
namespace app\models;

use mvc\base\Model;
use mvc\db\Db;

class UserModel extends Model
{
    protected $table = 'user';

    public function search($keyword)
    {
        $sql = "select * from `$this->table` where `id` = :id";
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [':id' => $keyword]);
        $sth->execute();

        return $sth->fetchAll();
    }
}