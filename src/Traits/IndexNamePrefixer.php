<?php

namespace ElasticSearcher\Traits;

trait IndexNamePrefixer
{
    /**
     * @var string
     */
    private $indexNamePrefix;

    /**
     * @param string $indexName
     *
     * @return string
     */
    private function prefixIndexName($indexName)
    {
        if ($this->indexNamePrefix) {
            $indexName = $this->indexNamePrefix.'_'.$indexName;
        }

        return $indexName;
    }
}
