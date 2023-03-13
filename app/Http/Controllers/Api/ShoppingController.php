<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Shopping\AddOrUpdateCartLineRequest;
use App\Services\CartService;
use App\Services\DiscountCodesService;
use App\Services\ProductsService;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    public function productsIndex()
    {
        return ProductsService::findProducts(only_available: true);
    }

    public function getCart()
    {
        // code...
    }

    public function addProductToCart(AddOrUpdateCartLineRequest $request)
    {
        $data = $request->validated();

        $products = ProductsService::findProducts(ids: [
            $data['product_id'],
        ]);

        if (!count($products)) {
            abort(404, "Product not found");
        }

        $product = reset($products);
        if ($product['pieces_in_stock'] < $data['quantity']) {
            abort(400, "There are not enough pieces of the requested product");
        }

        $cart = CartService::retrieve();
        $cart = CartService::addLine($cart, $data['product_id'], $data['quantity']);
        CartService::store($cart);

        return $cart->toArray();
    }

    public function addDiscountCode(string $discount_code)
    {
        $code = DiscountCodesService::findCode($discount_code);
        if (!$code) {
            abort(404, "Invalid discount code");
        }

        if (!$code['is_available']) {
            abort('403', "This discount code is not available")
        }

        $cart = CartService::retrieve();
        $cart->discount_code = $code['code'];
        $cart->discount_amount = $code['amount'];
        CartService::store($cart);

        return $cart->toArray();
    }

    public function deleteDiscountCode()
    {
        $cart = CartService::retrieve();
        $cart->discount_code = null;
        $cart->discount_amount = 0;
        CartService::store($cart);

        return $cart->toArray();
    }

    public function updateProductInCart(int $line_id)
    {
        // code...
    }

    public function deleteProductInCart(int $line_id)
    {
        // code...
    }

    public function checkout()
    {
        // code...
    }

    public function doCheckout()
    {
        /**
         * 1. validate stock and get fresh product prices
         * 2. use discount code, if any
         * 3. generate invoice
         * 4. generate new discount code and dispatch an anonymous job for
         *    sendDiscountCodeNotification with 15 minutes delay
         * 5. clear cart
         */
    }
}
