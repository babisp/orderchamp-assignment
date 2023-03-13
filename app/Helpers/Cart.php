<?php

namespace App\Helpers;

class Cart {

    public array $lines;

    public ?string $discount_code;
    public int $discount_amount = 0;

    public function __construct(?array $data = [])
    {
        $this->lines = $data['lines'] ?? [];
        $this->discount_code = $data['discount_code'] ?? null;
        $this->discount_amount = $data['discount_amount'] ?? 0;
    }

    public function toArray(): array
    {
        return [
            'lines' => $this->lines,
            'discount_code' => $this->discount_code,
            'discount_amount' => $this->discount_amount,
        ];
    }
}
