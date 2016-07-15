<?php

namespace ElasticSearcher;

use Elasticsearch\ClientBuilder;
use ElasticSearcher\Managers\DocumentsManager;
use ElasticSearcher\Managers\IndicesManager;

class ElasticSearcher
{
    /**
     * @var Environment
     */
    private $environment;

    /**
     * @var \Elasticsearch\Client
     */
    private $client;

    /**
     * @var \ElasticSearcher\Managers\IndicesManager
     */
    private $indicesManager;

    /**
     * @var \ElasticSearcher\Managers\DocumentsManager
     */
    private $documentsManager;

    /**
     * @param Environment $environment
     */
    public function __construct(Environment $environment = null)
    {
        // Allow super easy start.
        if (!$environment) {
            $environment = new Environment(['hosts' => ['localhost:9200']]);
        }

        $this->environment = $environment;
    }

    /**
     * @return \Elasticsearch\Client
     */
    public function getClient()
    {
        if (!$this->client) {
            $this->client = $this->createClient();
        }

        return $this->client;
    }

    /**
     * @return \ElasticSearcher\Managers\IndicesManager
     */
    public function getIndicesManager()
    {
        if (!$this->indicesManager) {
            $this->indicesManager = new IndicesManager($this->getClient(), $env);
        }

        return $this->indicesManager;
    }

    /**
     * @return \ElasticSearcher\Managers\DocumentsManager
     */
    public function getDocumentsManager()
    {
        if (!$this->documentsManager) {
            $this->documentsManager = new DocumentsManager($this);
        }

        return $this->documentsManager;
    }

    /**
     * @return bool
     */
    public function isHealthy()
    {
        $info = $this->getClient()->cluster()->health();

        return $info['status'] === 'green';
    }

    /**
     * Create an ElasticSearch SDK client.
     *
     * @return \Elasticsearch\Client
     */
    private function createClient()
    {
        return ClientBuilder::fromConfig($this->environment->all());
    }
}
