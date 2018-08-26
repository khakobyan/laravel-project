<?php

namespace App\Sections\Trade\Services;

use App\Sections\Trade\Contracts\IProductService;
use App\Models\{
    Product
};
use Auth;
use Carbon\Carbon;

class ProductService implements IProductService
{
    /**
     * Get all products.
     *
     * @param int $count
     * @param array $relations
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll($count = 30, $relations = [], $search_inputs = [], $sort_inputs = [], $fields = ['*'])
    {
        $query = Product::query();
        if (!empty($relations)) {
            $query->with($relations);
        }
        foreach ($search_inputs as $input) {
            $value = $input['value'];
            $field = $input['field'];
            switch ($field) {
                case 'status':
                    if ('active' === (string) $value) {
                        $query = $query->where('active', 1);
                    } elseif ('inactive' === (string) $value) {
                        $query = $query->where('active', 0);
                    }
                    break;
                case 'type':
                case 'user_id':
                    $query = $query->{$input['type']}($field, $value);
                    break;
                case 'price_from':
                    $query = $query->where('price', '>=', $value);
                    break;
                case 'price_to':
                    $query = $query->where('price', '<=', $value);
                    break;    
                case 'time_from':
                    //remember to think about other timezones
                    $value = Carbon::createFromFormat('Y-m-d H:i:s', $value);
                    $value = $value->tz('UTC')->__toString();
                    $query = $query->where('created_at', '>=', $value);
                    break;
                case 'time_to':
                    //remember to think about other timezones
                    $value = Carbon::createFromFormat('Y-m-d H:i:s', $value);
                    $value = $value->tz('UTC')->__toString();
                    $query = $query->where('created_at', '<=', $value);
                    break;
                case 'search':
                    $query = $query->where(function ($q) use ($value) {
                        return $q->where('title', 'like', "%{$value}%")
                            ->orWhere('description', 'like', "%{$value}%");
                    });
                    break;
            }
        }
        $query = $query->orderBy($sort_inputs['field'], $sort_inputs['type']);
       
        return $query->paginate($count);
    }

    /**
     * Create new product.
     *
     * @param array $inputs
     *
     * @return \App\Models\Product
     */
    public function create($inputs)
    {
        return Product::create($inputs); 
    }

    /**
     * Get product from storage.
     *
     * @param string $id
     * @param array  $relations
     *
     * @return \App\Models\Product
     */
    public function get($id, $relations = [])
    {
        $query = Product::where('id', $id);
        if (!empty($relations)) {
            $query = $query->with($relations);
        }
        return $query->first();
    }

    /**
     * Update product.
     *
     * @param string $id
     * @param array  $inputs
     *
     * @return bool
     */
    public function update($id, $inputs)
    {
        $product = Product::findOrFail($id);
        if ($product && $product->user_id == Auth::id()) {
            return $product->update($inputs);
        }
        return false;
    }

    /**
     * Destroy product from storage.
     *
     * @param string $id
     *
     * @return bool
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product && $product->user_id == Auth::id()) {
            return $product->delete();
        }
        return false;
    }

    /**
     * Abort(404) if product not exist.
     *
     * @param string $id
     */
    public function abortIfNotExist($id)
    {
        if (!Product::where('id', $id)->exists()) {
            abort(404, 'Not found');
        }
    }
}
