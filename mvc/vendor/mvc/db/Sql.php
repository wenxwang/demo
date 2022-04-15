<?php
namespace mvc\db;

use \PDOStatement;

class Sql
{
    // 数据库表名
    protected $table;

    // 主键
    protected $primary = 'id';

    // where和order拼装后的参数集合
    private $filter = '';

    // pdo bindParam() 绑定的参数
    private $param = array();

    /**
     * 查询条件拼接
     * 
     */
    public function where($where = array(), $param = array())
    {
        if ($where) {
            $this->filter .= ' WHERE ';
            $this->filter .= implode(' ', $where);
            $this->param = $param;
        }

        return $this;
    }

    /**
     * 拼接排序条件
     */
    public function order($order = array())
    {
        if ($order) {
            $this->filter .= ' ORDER BY ';
            $this->filter .= implode(' ', $order);
        }

        return $this;
    }

    // 查询所有
    public function fetchAll()
    {
        $sql = sprintf('select * from `%s` %s', $this->table, $this->filter);
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, $this->param);
        $sth->execute();

        return $sth->fetchAll();
    }

    // 查询一条
    public function fetch()
    {
        $sql = sprintf('select * from `%s` %s', $this->table, $this->filter);
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, $this->param);
        $sth->execute();

        return $sth->fetch();
    }

    // 根据条件 (id) 删除
    public function delete($id)
    {
        $sql = sprintf('delete from `%s` where `%s` = :%s', $this->table, $this->primary, $this->primary);
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [$this->primary => $id]);
        $sth->execute();

        return $sth->rowCount();
    }

    // 新增数据
    public function add($data)
    {
        $sql = sprintf('insert into `%s` %s', $this->table, $this->formatInsert($data));
        var_dump($sql);
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, $data);
        $sth = $this->formatParam($sth, $this->param);
        $sth->debugDumpParams();
        $sth->execute();

        return $sth->rowCount();
    }

    // 修改数据
    public function update($data)
    {
        $sql = sprintf('update `%s` set %s %s', $this->table, $this->formatUpdate($data), $this->filter);
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, $data);
        $sth = $this->formatParam($sth, $this->param);
        $sth->execute();

        return $sth->rowCount();
    }
    
    // 占位符绑定变量
    public function formatParam(PDOStatement $sth, $params = array())
    {
        foreach($params as $param => $value) {
            $param = is_int($param) ? $param + 1 : ':' . ltrim($param, ':');
            $sth->bindParam($param, $value);
        }

        return $sth;
    }

    // 将数组转换成插入格式的sql语句
    private function formatInsert($data)
    {
        $fields = array();
        $names = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf('%s', $key);
            $names[] = sprintf(':%s', $key);
        }

        $field = implode(',', $fields);
        $name = implode(',', $names);

        return sprintf('(%s) values (%s)', $field, $name);
    }

    // 将数组转换成更新格式的sql语句
    private function formatUpdate($data)
    {
        $fields = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf('%s = :%s', $key, $key);
        }

        return implode(',', $fields);
    }
}