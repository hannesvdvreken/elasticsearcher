<?php

namespace ElasticSearcher\Traits;

/**
 * A body can be an entire query or just a chunk of query (fragment).
 * Any entity (query, fragment, index, ...) that builds request body's should
 * use this trait.
 */
trait Body
{
    /**
     * @var array
     */
    public $body = [];

    /**
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }
}
