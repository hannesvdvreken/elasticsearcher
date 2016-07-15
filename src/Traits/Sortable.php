<?php

namespace ElasticSearcher\Traits;

/**
 * Shortcut for adding sorting to a Query.
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-request-sort.html
 */
trait Sortable
{
    /**
     * @param array $fields
     *
     * @return $this
     */
    public function setSort(array $fields)
    {
        $sortFields = [];

        foreach ($fields as $field => $value) {
            if (is_numeric($field) && !is_array($value)) {
                // Simplest form, just a field name.
                $sortFields[] = $value;
            } else {
                // Field with direction and/or other options.
                $sortFields[] = [$field => $value];
            }
        }

        $this->body['sort'] = $sortFields;

        return $this;
    }

    /**
     * @param string $field
     * @param string $order
     * @param string $mode
     * @param string $nestedPath
     * @param mixed $nestedFilter
     *
     * @return $this
     */
    public function sort($field, $order = null, $mode = null, $nestedPath = null, $nestedFilter = null)
    {
        $this->body['sort'] = isset($this->body['sort']) ? $this->body['sort'] : [];

        $sort = [];

        if (!is_null($order)) {
            $sort['order'] = $order;
        }

        if (!is_null($mode)) {
            $sort['mode'] = $mode;
        }

        if (!is_null($nestedPath) && !is_null($nestedFilter)) {
            $sort['nested_path'] = $nestedPath;
            $sort['nested_filter'] = $nestedFilter;
        }

        $this->body['sort'][] = [$field => $sort];

        return $this;
    }

    /**
     * @param string $fieldName
     * @param array $fields
     *
     * @return mixed|void
     */
    private function findField($fieldName, array $fields)
    {
        foreach ($fields as $field) {
            if (!is_array($field) && $field === $fieldName) {
                return $field;
            } elseif (is_array($field) && array_key_exists($fieldName, $field)) {
                return $field;
            }
        }

        return;
    }
}
