<?php
namespace lmarqs\Spa\Elasticsearch;

use Elasticsearch\ClientBuilder;

class Indexer
{

    const ELASTICSEARCH_INDEX = 'spa';
    const ELASTICSEARCH_TYPE = 'doc';

    private static $client;

    private static function createIndex()
    {
        $params = [
            'index' => self::ELASTICSEARCH_INDEX,
            'body' => [
                'mappings' => [
                    self::ELASTICSEARCH_TYPE => [
                        '_all' => [
                            'enabled' => true,
                        ],
                    ],
                ],
            ],
        ];

        self::getClient()->indices()->create($params);
    }

    private static function getClient()
    {
        usleep(500000);
        if (!self::$client) {
            self::$client = ClientBuilder::create()
                ->setHosts([getenv('ELASTICSEARCH_HOST')])
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
            'index' => self::ELASTICSEARCH_INDEX,
            'type' => self::ELASTICSEARCH_TYPE,
            'id' => $id,
        ];

        self::getClient()->delete($params);
    }

    public static function index($document)
    {

        $params = [
            'index' => self::ELASTICSEARCH_INDEX,
            'type' => self::ELASTICSEARCH_TYPE,
            'id' => $document['id'],
            'body' => $document,
        ];

        self::getClient()->index($params);
    }

    public static function search($term = '')
    {
        $params = [
            'index' => self::ELASTICSEARCH_INDEX,
            'type' => self::ELASTICSEARCH_TYPE,
            'body' => [
                'query' => [
                    'query_string' => [
                        'query' => "*$term*",
                    ],
                ],
            ],
        ];

        return self::getClient()->search($params)['hits'];
    }
}
