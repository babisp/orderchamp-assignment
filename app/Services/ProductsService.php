<?php

namespace App\Services;

use App\Models\Product;

class ProductsService
{
    public static function findProducts(?array $ids = null, ?bool $only_available = false): array
    {
        $query = Product::query();

        if ($ids) {
            $query->whereIn('id', $ids);
        }

        if ($only_available) {
            $query->available();
        }

        $query->orderBy('name');

        // pagination was not handled here for simplicity
        $products = $query->get();
        return $products->map(fn($p) => [
            'id' => $p->id,
            'name' => $p->name,
            'price' => $p->price,
            'pieces_in_stock' => $p->pieces_in_stock,
        ])->toArray();
    }

    public static function createProduct($data): void
    {
        // out of scope
    }

    public static function updateStock($data): void
    {
        // out of scope
    }
}
