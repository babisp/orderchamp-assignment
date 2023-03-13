<?php

namespace App\Services;

use App\Models\DiscountCode;
use Illuminate\Support\Str;

class DiscountCodesService
{
    public static function generateCode(float $discount_amount): string
    {
        if ($discount_amount <= 0) {
            throw new \Exception("The discount amount must be a positive number.");
        }

        $randomString = Str::upper(substr(uniqid(), -5));

        while (DiscountCode::where('code', $randomString)->first()) {
            $randomString = Str::upper(substr(uniqid(), -5));
        }

        DiscountCode::create([
            'code' => $randomString,
            'amount' => $discount_amount,
        ]);

        return $randomString;
    }

    public static function findCode(string $code): array|null
    {
        $code = DiscountCode::where('code', $code)->first();

        if ($code) {
            return [
                'code' => $code->code,
                'amount' => $code->amount,
                'used_at' => $code->used_at,
                'is_available' => $code->isAvailable,
            ];
        }

        return null;
    }

    public static function useCode(string $code): void
    {
        $code = DiscountCode::where('code', $code)->first();

        if (!$code) {
            throw new \Exception("Invalid discount code: $code");
        }

        if (!$code->isAvailable) {
            throw new \Exception("$code: this discount code is not available.");
        }

        $code->used_at = now();
        $code->save();
    }

    public static function sendDiscountCodeNotification(string $code, string $email): void
    {
        $code = static::findCode($code);

        if (!$code) {
            throw new \Exception("$code: discount code not found while trying to notify $email");
        }

        // @todo send an email with the discount code details
        // a notification channel other than email might also be used
    }
}
