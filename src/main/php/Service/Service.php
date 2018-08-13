<?php
namespace lmarqs\Spa\Service;

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

    public function find($term)
    {
        $params = [
            "body" => [
                "query" => [
                    "match" => [
                        "testField" => $term,
                    ],
                ],
            ],
        ];

        $client = ClientBuilder::create();
        $client->setHosts(["elasticsearch"])
            ->build();

        return $client->search($params);
    }

}
