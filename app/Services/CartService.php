<?php

namespace App\Services;

use App\Helpers\Cart;
use Illuminate\Support\Facades\Cookie;

class CartService
{
    public static function retrieve(): Cart
    {
        // simple implementation with cookies, can be replaced
        $data = [];

        if (Cookie::has('shopping-cart')) {
            $data = json_decode(Cookie::get('shopping-cart'), true);
        }

        return new Cart($data);
    }

    public static function store(Cart $cart): void
    {
        // simple implementation with cookies, can be replaced
        $data = $cart->toArray();

        Cookie::set('shopping-cart', json_encode($data));
    }

    public static function addLine(Cart $cart, int $product_id, int $quantity): Cart
    {
        // each line will contain the product id, product name, product price
        // and the quantity. This service will use the ProductsService.
    }

    public static function updateLine(Cart $cart, int $line_id, int $quantity): Cart
    {
    }

    public static function removeLine(Cart $cart, int $line_id): Cart
    {
    }

    public static function setDiscountCode(Cart $cart, ?string $discount_code = null): Cart
    {
    }

    public static function getSubtotal(Cart $cart): float // total price without discount
    {
    }

    public static function getTotal(Cart $cart): float // total price with discount
    {
    }

    public static function doPurchase(Cart $cart): bool
    {
    }

    public static function clear(Cart $cart): void
    {
    }
}
