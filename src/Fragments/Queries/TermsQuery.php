<?php

namespace ElasticSearcher\Fragments\Queries;

use ElasticSearcher\Contracts\Fragment;
use ElasticSearcher\Traits\Body;

/**
 * Simple terms query.
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-terms-query.html
 */
class TermsQuery implements Fragment
{
    use Body;

    /**
     * @param string $field
     * @param array $values
     */
    public function __construct($field, array $values)
    {
        $this->body['terms'] = [
            $field => $values,
        ];
    }
}
