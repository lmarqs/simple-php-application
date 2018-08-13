<?php
namespace lmarqs\Spa\Service;

use lmarqs\Spa\Elasticsearch\Indexer;

abstract class Service
{
    private $pdo;
    private $fields = array();

    public function __construct()
    {
        $this->pdo = new \PDO(getenv('PDO_DNS'), getenv('PDO_USERNAME'), getenv('PDO_PASSWORD'));
    }

    abstract public function validate($model);

    public function insert($model)
    {
        $this->validate($model);
        $this->getDao()->insert($model);
    }

    public function fetch($id)
    {
        $this->getDao()->fetch($id);
    }

    public function update($model)
    {
        $this->validate($model);
        $this->getDao()->update($model);
    }

    public function delete($id)
    {
        $this->getDao()->delete($id);
    }

    public function find($term = '')
    {
        return Indexer::search($term);
    }

}
