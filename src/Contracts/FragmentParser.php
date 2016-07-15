<?php

namespace ElasticSearcher\Contracts;

interface FragmentParser
{
    /**
     * @param \ElasticSearcher\Contracts\Fragment|array $body
     *
     * @return array
     */
    public function parse($body);
}
