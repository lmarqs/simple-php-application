<?php
namespace lmarqs\Spa\Elasticsearch;

use Elasticsearch\ClientBuilder;

class Indexer
{

    const INDEX = "spa";

    private static $client;

    private static function createIndex()
    {
        $params = [
            "index" => self::INDEX,
        ];

        self::getClient()->indices()->create($params);
    }

    private static function getClient()
    {
        if (!self::$client) {
            self::$client = ClientBuilder::create()
                ->setHosts([getenv("ELASTICSEARCH_HOST")])
                ->build();
            try {
                self::createIndex();
            } catch (\Exception $ignored) {

            }

        }
        return self::$client;
    }

    public static function delete($id)
    {

        $params = [
            "index" => self::INDEX,
            "id" => $id,
        ];

        self::getClient()->delete($params);
    }

    public static function index($document)
    {

        $params = [
            "index" => self::INDEX,
            "id" => $document["id"],
            "body" => $document,
        ];

        self::getClient()->index($params);
    }

    public static function search($term)
    {

        $params = [
            "index" => self::INDEX,
            "body" => [
                "query" => [
                    "match" => [
                        "_all" => $term,
                    ],
                ],
            ],
        ];

        return self::getClient()->search($params)["hits"];
    }
}
