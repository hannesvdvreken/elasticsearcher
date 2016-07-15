<?php

namespace ElasticSearcher\Traits;

trait ResultParser
{
    /**
     * @var array
     */
    private $results;

    /**
     * @param array $results
     *
     * @return $this
     */
    public function setRawResults(array $results)
    {
        $this->results = $results;

        return $this;
    }

    /**
     * @return array
     */
    public function getRawResults()
    {
        $this->results;
    }

    /**
     * Total hits for this query.
     *
     * @return int
     */
    public function getTotal()
    {
        return isset($this->results['hits'], $this->results['hits']['total']) ? $this->results['hits']['total'] : null;
    }

    /**
     * Time it took to executed the query.
     *
     * @return int
     */
    public function getTook()
    {
        return isset($this->results['took']) ? $this->results['took'] : null;
    }
}
