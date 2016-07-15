<?php

namespace ElasticSearcher\Parsers;

use ElasticSearcher\Contracts\ResultParser;
use ElasticSearcher\Traits\ResultParser as ResultParserTrait;

class ArrayResultParser implements ResultParser
{
    use ResultParserTrait;

    /**
     * @return array
     */
    public function getResults()
    {
        return isset($this->results['hits'], $this->results['hits']['hits']) ? $this->results['hits']['hits'] : [];
    }
}
