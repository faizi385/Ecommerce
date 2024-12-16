<?php

use Illuminate\Database\Seeder;
use App\Models\DiscountCode;

class DiscountCodesSeeder extends Seeder
{
    public function run()
    {
        DiscountCode::create([
            'code' => 'SUMMER10',
            'discount_amount' => 10.00, // 10 units of currency off
            'is_active' => true,
        ]);

        DiscountCode::create([
            'code' => 'WINTER15',
            'discount_amount' => 15.00, // 15 units of currency off
            'is_active' => true,
        ]);

        DiscountCode::create([
            'code' => 'SPRING20',
            'discount_amount' => 20.00, // 20 units of currency off
            'is_active' => true,
        ]);
    }
}
