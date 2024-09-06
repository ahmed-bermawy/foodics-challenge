<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getList()
    {
        return Product::paginate(20);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function getDetail(int $id)
    {
        return Product::find($id);
    }

    public function update(array $data, Product $product): Product
    {
        $product->update($data);
        return $product;
    }

    public function delete(Product $product): Product
    {
        $product->delete();

        return $product;
    }
}
