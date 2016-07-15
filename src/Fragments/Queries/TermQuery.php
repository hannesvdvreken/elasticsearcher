<?php

namespace ElasticSearcher\Fragments\Queries;

use ElasticSearcher\Contracts\Fragment;
use ElasticSearcher\Traits\Body;

/**
 * Simple term query.
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-term-query.html
 */
class TermQuery implements Fragment
{
    use Body;

    /**
     * @param string $field
     * @param string $value
     */
    public function __construct($field, $value)
    {
        $this->body['term'] = [
            $field => $value,
        ];
    }
}
