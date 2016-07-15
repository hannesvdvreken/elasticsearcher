<?php

namespace ElasticSearcher\Parsers;

use ElasticSearcher\Contracts\Fragment;
use ElasticSearcher\Contracts\FragmentParser as FragmentParserContract;

/**
 * Traverses an array and checks if there are any fragments to be replaced with their body.
 */
class FragmentParser implements FragmentParserContract
{
    /**
     * @param \ElasticSearcher\Contracts\Fragment|array $body
     *
     * @return array
     */
    public function parse($body)
    {
        if ($body instanceof Fragment) {
            return $this->parse($body->getBody());
        }

        foreach ($body as $key => &$item) {
            $item = $this->parse($item);
        }

        return $body;
    }
}
