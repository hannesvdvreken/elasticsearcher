<?php

namespace ElasticSearcher\Managers;

use Elasticsearch\Client;
use ElasticSearcher\Traits\IndexContainer;
use ElasticSearcher\Traits\IndexNamePrefixer;

/**
 * Manager for everything index related. Holds a container for
 * used indexes. Also allows basic CRUD operations on those indexes.
 */
class IndicesManager
{
    use IndexContainer;
    use IndexNamePrefixer;

    /**
     * @var \Elasticsearch\Client
     */
    private $client;

    /**
     * @param \Elasticsearch\Client $client
     * @param string $indexNamePrefix
     */
    public function __construct(Client $client, $indexNamePrefix = null)
    {
        $this->client = $client;
        $this->indexNamePrefix = $indexNamePrefix;
    }

    /**
     * @param string $indexName
     *
     * @return array
     */
    public function create($indexName)
    {
        $index = $this->getRegisteredIndex($indexName);

        $params = [
            'index' => $this->prefixIndexName($index->getName()),
            'body' => $index->getBody(),
        ];

        return $this->client->indices()->create($params);
    }

    /**
     * Update the index and all its types. This should be used to reflect changes
     * in the Index object with the Elasticsearch server.
     *
     * @param string $indexName
     */
    public function update($indexName)
    {
        $index = $this->getRegisteredIndex($indexName);

        $body = $index->getBody();
        $mappings = isset($body['mappings']) ? $body['mappings'] : [];

        foreach ($mappings as $type => $body) {
            $params = [
                'index' => $this->prefixIndexName($index->getName()),
                'type' => $type,
                'body' => [
                    $type => $body,
                ],
            ];

            $this->client->indices()->putMapping($params);
        }
    }

    /**
     * @param string $indexName
     */
    public function delete($indexName)
    {
        $index = $this->getRegisteredIndex($indexName);

        $params = [
            'index' => $this->prefixIndexName($index->getName()),
        ];

        $this->client->indices()->delete($params);
    }

    /**
     * @param string $indexName
     *
     * @return array
     */
    public function getIndex($indexName)
    {
        $index = $this->getRegisteredIndex($indexName);

        $params = [
            'index' => $this->prefixIndexName($index->getName()),
        ];

        return $this->client->indices()->getMapping($params);
    }

    /**
     * @return array
     */
    public function getIndices()
    {
        return $this->client->indices()->getMapping(['_all']);
    }

    /**
     * @param string $indexName
     * @param string $type
     *
     * @return array
     */
    public function getType($indexName, $type)
    {
        $index = $this->getRegisteredIndex($indexName);

        $params = [
            'index' => $this->prefixIndexName($index->getName()),
            'type' => $type,
        ];

        return $this->client->indices()->getMapping($params);
    }

    /**
     * @param string $indexName
     *
     * @return bool
     */
    public function exists($indexName)
    {
        $index = $this->getRegisteredIndex($indexName);

        $params = [
            'index' => $this->prefixIndexName($index->getName()),
        ];

        return $this->client->indices()->exists($params);
    }

    /**
     * @param string $indexName
     * @param string $type
     *
     * @return array
     */
    public function existsType($indexName, $type)
    {
        $index = $this->getRegisteredIndex($indexName);

        $params = [
            'index' => $this->prefixIndexName($index->getName()),
            'type' => $type,
        ];

        return $this->client->indices()->existsType($params);
    }
}
