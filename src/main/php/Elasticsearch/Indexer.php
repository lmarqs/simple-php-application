<?php
namespace lmarqs\Spa\Elasticsearch;

use Elasticsearch\ClientBuilder;

class Indexer
{

    private static $client;

    private static function getClient()
    {
        if (!self::$client) {
            $client = ClientBuilder::create()
                ->setHosts([getenv("ELASTICSEARCH_HOST")])
                ->build();
        }
        return self::$client;
    }

    public static function search($term)
    {

        $client = self::getClient();

        $params = [
            "index" => self::getIndex(),
            "body" => [
                "query" => [
                    "match" => [
                        "_all" => $term,
                    ],
                ],
            ],
        ];

        return $client->search($params)["hits"];
    }
}
