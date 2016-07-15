<?php

namespace ElasticSearcher;

class Environment
{
    /**
     * @var array
     */
    private $variables;

    /**
     * @param array $variables
     */
    public function __construct(array $variables)
    {
        $this->variables = $variables;
    }

    /**
     * Get all defined variables.
     *
     * @return array
     */
    public function all()
    {
        return $this->variables;
    }
}
