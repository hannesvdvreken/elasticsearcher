<?php

namespace ElasticSearcher\Abstracts;

use ElasticSearcher\Traits\Body;

abstract class Query
{
    use Body;

    /**
     * @var array
     */
    private $indices = [];

    /**
     * @var array
     */
    private $types = [];

    /**
     * @return array
     */
    public function getIndices()
    {
        return $this->indices;
    }

    /**
     * @return array
     */
    public function getTypes()
    {
        return $this->types;
    }
}
