<?php

namespace App\Traits\Requests;

trait InputsFiltering
{
    /**
     * Request should have in query param count field, for pagination count limit, if it no present we should retreive default value.
     *
     * @param mixed $is_all_value_permitted
     *
     * @return int
     */
    public function getCountInput($is_all_value_permitted = false)
    {
        $input = strtolower($this->query('count'));
        $default = 30;
        if ($is_all_value_permitted && 'all' !== $input) {
            $input = (int) $input;
            $input = $input > 0 ? $input : $default;
        } 
        return $input;
    }

    /**
     * Request should have in query param query field, for search filtration, if it no present we should retreive default value.
     *
     * @param mixed $permitted_query_fields
     *
     * @return array
     */
    public function queryInput($permitted_query_fields)
    {
        $query = (array) $this->input('query', []);
        $result = [];
        foreach ($query as $value) {
            if (false === strpos($value, '=')) {
                continue;
            }

            list($field, $value) = explode('=', $value, 2);
            $is_muiltiple = data_get($permitted_query_fields, "{$field}.multiple_data", false);
            $has_permitted_values = data_get($permitted_query_fields, "{$field}.permitted_values", false);
            $has_validator = data_get($permitted_query_fields, "{$field}.validator", false);
            $has_key_in_db = data_get($permitted_query_fields, "{$field}.key_in_db", false);
            $has_field = data_get($permitted_query_fields, $field, false);

            if (false !== strpos($value, ',') && $is_muiltiple) {
                $value = explode(',', $value);
                if ('' !== (string) $value[0]) {
                    $checkType = $this->checkType($value[0]);
                    $value[0] = $checkType['value'];
                    $type = $checkType['type'];
                }
                $array_diff = $has_permitted_values ? array_diff($value, $permitted_query_fields[$field]['permitted_values']) : [];
            }

            if (!is_array($value)) {
                if ('' !== (string) $value) {
                    $checkType = $this->checkType($value);
                    $value = $checkType['value'];
                    $type = $checkType['type'];
                } else {
                    continue;
                }
                if (!$has_field || '' === (string) $value) {
                    continue;
                }
                if ($has_permitted_values && !in_array($value, $permitted_query_fields[$field]['permitted_values'])) {
                    continue;
                }
                if ($has_validator && !$permitted_query_fields[$field]['validator']($value)) {
                    continue;
                }
                settype($value, $permitted_query_fields[$field]['type']);
                if ('' === $value) {
                    continue;
                }
                $value = $is_muiltiple ? [$value] : $value;
            } else {
                foreach ($array_diff as $k => $v) {
                    if (!$has_field || '' === (string) $v) {
                        unset($value[$k]);
                    }
                    if ($has_permitted_values && !in_array($value, $permitted_query_fields[$field]['permitted_values'])) {
                        unset($value[$k]);
                    }
                    if ($has_validator && !$permitted_query_fields[$field]['validator']($v)) {
                        unset($value[$k]);
                    }
                    settype($v, $permitted_query_fields[$field]['type']);
                    if ('' === $v) {
                        unset($value[$k]);
                    }
                }
            }
            if ($has_key_in_db) {
                $field = data_get($permitted_query_fields, $field.'.key_in_db', $field);
            }
            $result[] = $is_muiltiple ? compact('field', 'type', 'value') : compact('field', 'value');
        }
        $final = [];
        foreach ($result as $key => $value) {
            $final[$key] = $value;
        }
        return $final;
    }

    /**
     * Request sort by ascending or descending lists, if it no present we should retreive default value.
     *
     * @param mixed      $default_order_type
     * @param mixed      $default_order_field
     * @param mixed      $permitted_order_fields
     * @param null|mixed $map_to_db
     *
     * @return array
     */
    public function sortByInput(
            $default_order_type,
            $default_order_field,
            $permitted_order_fields,
            $map_to_db = null
        ) {
        $sort_by = $this->input('sortBy', '');
        $exploded = explode(':', $sort_by);
        $permitted_order_types = [
            'asc',
            'desc',
        ];
        $order_field = in_array($exploded[0], $permitted_order_fields) ? $exploded[0] : $default_order_field;
        if (null !== $map_to_db) {
            $order_field = data_get($map_to_db, $order_field, $order_field);
        }
        $order_type = strtolower($exploded[1] ?? $default_order_type);
        $order_type = in_array($order_type, $permitted_order_types) ? $order_type : $default_order_type;
        return [
            'field' => $order_field,
            'type' => $order_type,
        ];
    }

    /**
     * Request should have in query param fields, for select fields, if it no present we should retreive default value.
     *
     * @param mixed $permitted_fields
     *
     * @return array
     */
    public function queryFields($permitted_fields)
    {
        $query = (array) $this->input('fields', []);
        $result = [];
        foreach ($query as $value) {
            if (!in_array($value, $permitted_fields)) {
                continue;
            }
            $result[] = $value;
        }
        return $result;
    }

    /**
     * Check Type.
     *
     * @param mixed $value
     *
     * @return array
     */
    private function checkType($value)
    {
        $firstCharacter = preg_split('//', $value, -1, PREG_SPLIT_NO_EMPTY)[0];
        if ('!' === $firstCharacter) {
            $type = 'whereNotIn';
            $value = substr($value, 1);
        } else {
            $type = 'whereIn';
        }
        return compact('type', 'value');
    }
}
