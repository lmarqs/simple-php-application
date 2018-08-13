<?php
namespace lmarqs\Spa\Persistence;

abstract class Dao
{
    private $pdo;
    private $fields = array();

    abstract protected function table();
    abstract protected function model();

    public function insert($model)
    {
        $array = $model->toArray();

        $sql = sprintf('INSERT INTO %s (%s) VALUES (%s);', $this->table(), join(array_keys($array), ', '), join($this->placeholders($array), ', '));

        $pdo = ConnectionFactory::connection();

        $sth = $pdo->prepare($sql);
        $sth->execute($array);

        return $this->fetch($pdo->lastInsertId());
    }

    public function fetch($id)
    {
        $sql = "SELECT * FROM {$this->table()} WHERE id = :id";
        $sth = ConnectionFactory::connection()->prepare($sql);
        $sth->execute(['id' => $id]);

        return $this->model()->fromArray($sth->fetchAll(\PDO::FETCH_ASSOC)[0]);
    }

    public function update($model)
    {
        $sql = "INSERT INTO {$this->table()} VALUES ({join($this->names()})";
        $sth = ConnectionFactory::connection()->prepare($sql);
        $sth->execute($this->values());
        return $sth->fetchAll();
    }

    public function delete($model)
    {
        $sql = "DELETE FROM {$this->table()} WHERE id = :id";
        $sth = ConnectionFactory::connection()->prepare($sql);
        $data = $sth->execute(['id' => $model->getId()]);
    }
    public function find()
    {
        $sth = ConnectionFactory::connection()->prepare("SELECT * FROM {$this->table()}");
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    protected function placeholders($array, $ignore = [])
    {
        $keys = array_keys($array);
        $placeholders = [];

        foreach ($array as $key => $value) {
            if (!in_array($key, $ignore)) {
                $placeholders[] = ":$key";
            }
        }

        return $placeholders;
    }
}
