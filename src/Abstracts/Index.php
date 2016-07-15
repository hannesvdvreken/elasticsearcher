<?php

namespace ElasticSearcher\Abstracts;

use ElasticSearcher\Contracts\Fragment;
use ElasticSearcher\Traits\Body;

/**
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/indices-create-index.html
 */
abstract class Index implements Fragment
{
    use Body;

    /**
     * @var string
     */
    private $name = '';

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
