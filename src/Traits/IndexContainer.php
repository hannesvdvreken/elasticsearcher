<?php

namespace ElasticSearcher\Traits;

use ElasticSearcher\Abstracts\Index;

trait IndexContainer
{
    /**
     * @var \Elasticsearcher\Abstracts\Index[]
     */
    private $indices = [];

    /**
     * @param \ElasticSearcher\Abstracts\Index $index
     *
     * @return $this
     */
    public function registerIndex(Index $index)
    {
        $this->indices[$index->getName()] = $index;

        return $this;
    }

    /**
     * @param \ElasticSearcher\Abstracts\Index[] $indices
     *
     * @return $this
     */
    public function registerIndices(array $indices)
    {
        foreach ($indices as $index) {
            $this->register($index);
        }

        return $this;
    }

    /**
     * @param string $indexName
     *
     * @return bool
     */
    public function isIndexRegistered($indexName)
    {
        return array_key_exists($indexName, $this->indices);
    }

    /**
     * Get a registered index. When not found it will throw an exception.
     * If you do not want the exception being thrown, use isRegistered first to check existence.
     *
     * @param string $indexName
     *
     * @throws \Exception
     *
     * @return \ElasticSearcher\Abstracts\Index
     */
    public function getRegisteredIndex($indexName)
    {
        if (!$this->isRegistered($indexName)) {
            throw new Exception('Index ['.$indexName.'] could not be found in the register of the indices manager.');
        }

        return $this->indices[$indexName];
    }

    /**
     * @param string $indexName
     *
     * @return bool
     */
    public function unregisterIndex($indexName)
    {
        $isRegistered = $this->isRegistered($indexName);

        unset($this->indices[$indexName]);

        return $isRegistered;
    }
}
