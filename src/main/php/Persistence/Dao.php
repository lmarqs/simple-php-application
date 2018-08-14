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

        $columns = [];
        $values = [];
        $parameters = [];

        foreach($array as $key => $value) {
            if ($key != 'id') {
                $columns[] = "$key";
                $values[] = ":$key";
                $parameters[":$key"] = $value;
            }
        }

        $sql = sprintf('INSERT INTO %s (%s) VALUES (%s);', $this->table(), join($columns, ', '), join($values, ', '));

        $pdo = ConnectionFactory::connection();

        $sth = $pdo->prepare($sql);
        $sth->execute($parameters);

        return $pdo->lastInsertId();
    }

    public function fetch($id)
    {
        $sql = sprintf('SELECT * FROM %s WHERE id = :id', $this->table());

        $sth = ConnectionFactory::connection()->prepare($sql);
        $sth->execute(['id' => $id]);

        return $this->model()->fromArray($sth->fetchAll(\PDO::FETCH_ASSOC)[0]);
    }

    public function update($model)
    {
        $array = $model->toArray();

        $columns = [];
        foreach($array as $key => $value) {
            if ($key != 'id') {
                $columns[] .= "$key = :$key";
            }
        }

        $sql = sprintf('UPDATE %s SET %s WHERE id = :id;', $this->table(), join($columns, ', '));

        $sth = ConnectionFactory::connection()->prepare($sql);

        $sth->execute($array);

    }

    public function delete($id)
    {
        $sql = sprintf('DELETE FROM %s WHERE id = :id', $this->table());

        $sth = ConnectionFactory::connection()->prepare($sql);
        $sth->execute(['id' => $id]);
    }

    public function find()
    {
        $sql = "SELECT * FROM {$this->table()}";

        $sth = ConnectionFactory::connection()->prepare($sql);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
}
