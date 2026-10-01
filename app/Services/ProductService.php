<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductService
{
    /**
     * Create a new product.
     */
    public function createProduct(array $data, $imageFile = null)
    {
        return DB::transaction(function () use ($data, $imageFile) {
            $data['is_featured'] = isset($data['is_featured']);
            $data['is_new_arrival'] = isset($data['is_new_arrival']);
            
            if ($imageFile) {
                $data['image'] = $imageFile->store('products', 'public');
            }

            return Product::create($data);
        });
    }

    /**
     * Update an existing product.
     */
    public function updateProduct(Product $product, array $data, $imageFile = null)
    {
        return DB::transaction(function () use ($product, $data, $imageFile) {
            $data['is_featured'] = isset($data['is_featured']);
            $data['is_new_arrival'] = isset($data['is_new_arrival']);

            if ($imageFile) {
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $data['image'] = $imageFile->store('products', 'public');
            }

            $product->update($data);
            return $product;
        });
    }

    /**
     * Delete a product.
     */
    public function deleteProduct(Product $product)
    {
        return DB::transaction(function () use ($product) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            return $product->delete();
        });
    }
}
