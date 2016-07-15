<?php

namespace ElasticSearcher\Contracts;

interface ResultParser
{
    /**
     * @param array $results
     *
     * @return $this
     */
    public function setRawResults(array $results);

    /**
     * @return array
     */
    public function getRawResults();

    /**
     * @return int
     */
    public function getTotal();

    /**
     * @return int
     */
    public function getTook();

    /**
     * @return mixed
     */
    public function getResults();
}
