<?php
namespace lmarqs\Spa\Service;

use lmarqs\Spa\Elasticsearch\Indexer;

abstract class Service
{

    abstract public function validate($model);

    public function insert($model)
    {
        $this->validate($model);
        $dao = $this->getDao();
        $id = $dao->insert($model);
        $model = $dao->fetch($id);
        Indexer::index($model->toArray());
        return $model;
    }

    public function fetch($id)
    {
        return $this->getDao()->fetch($id);
    }

    public function update($model)
    {
        $this->validate($model);
        $dao = $this->getDao();

        $dao->update($model);
        $model = $dao->fetch($model->getId());

        Indexer::index($model->toArray());
        return $model;
    }

    public function delete($id)
    {
        $this->getDao()->delete($id);
        Indexer::delete($id);
    }

    public function find($term = '')
    {
        return Indexer::search($term);
    }

}
