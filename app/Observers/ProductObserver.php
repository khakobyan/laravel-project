<?php

namespace App\Observers;

use App\Models\Product;
use Auth;

class ProductObserver
{
    /**
     * Handle the product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->user_id = Auth::id();
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function saving(Product $product)
    {
        if (null === $product->user_id || '' === $product->user_id) {
            $product->user_id = Auth::id();
        }
    }
}
