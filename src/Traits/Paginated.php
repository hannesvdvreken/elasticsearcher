<?php

namespace ElasticSearcher\Traits;

/**
 * Shortcut to adding pagination to a Query.
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-request-from-size.html
 */
trait Paginated
{
    /**
     * @param int $page
     * @param int $limit
     *
     * @return $this
     */
    public function paginate($page, $limit = 10)
    {
        $this->body['from'] = ($limit * ($page - 1));
        $this->body['size'] = $limit;

        return $this;
    }
}
