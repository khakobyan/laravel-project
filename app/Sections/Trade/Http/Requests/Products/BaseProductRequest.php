<?php

namespace App\Sections\Trade\Http\Requests\Products;

use App\Http\Requests\Contracts\{
    IHasCountInput,
    IHasRelationsInput
};
use App\Http\Requests\Request;
use Illuminate\Support\Arr;
use App\Models\Product;
use App\Traits\Requests\InputsFiltering;
use Carbon\Carbon;

abstract class BaseProductRequest extends Request implements IHasCountInput, IHasRelationsInput
{
    use InputsFiltering;
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * Retreive request final inputs.
     *
     * @return array
     */
    public function inputs()
    {
        return $this->all();
    }

    /**
     * Request should have in query param relations field, for retreive resource relations, if it no present we should retreive default value.
     *
     * @return array
     */
    public function getRelationsInput()
    {
        $relations = (array) $this->input('relations', []);
        $product_relations = Product::$relationships;
        $result = [];
        foreach ($relations as $value) {
            if (in_array($value, $product_relations)) {
                $result[] = $value;
            }
        }
        return $result;
    }

    /**
     * Request should have in query param query field, for search filtration, if it no present we should retreive default value.
     *
     * @return array
     */
    public function getQueryInput()
    {
        $date_validator = function ($value) {
            try {
                Carbon::createFromFormat('Y-m-d H:i:s', $value);
                return true;
            } catch (Exception $e) {
                return false;
            }
        };
        $permitted_query_fields = [
            'status' => [
                'type' => 'string',
                'permitted_values' => [
                    'active',
                    'inactive',
                ],
            ],
            'type' => [
                'type' => 'string',
                'multiple_data' => true,
                'permitted_values' => [
                    'car',
                    'home',
                ],
            ],
            'search' => [
                'type' => 'string',
            ],
            'price_from' => [
                'type' => 'string',
            ],
            'price_to' => [
                'type' => 'string',
            ],
            'user_id' => [
                'type' => 'string',
                'multiple_data' => true,
            ],
            'time_from' => [
                'type' => 'string',
                'validator' => $date_validator,
            ],
            'time_to' => [
                'type' => 'string',
                'validator' => $date_validator,
            ],
        ];
        return $this->queryInput($permitted_query_fields);
    }

    /**
     * Request sort by ascending or descending lists, if it no present we should retreive default value.
     *
     * @return array
     */
    public function getSortByInput()
    {
        $default_order_type = 'desc';
        $default_order_field = 'created_at';
        $permitted_order_fields = [
            'title',
            'price',
        ];
        return $this->sortByInput($default_order_type, $default_order_field, $permitted_order_fields);
    }
}
