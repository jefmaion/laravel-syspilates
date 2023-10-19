<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::create(['name' => 'Pix']);
        PaymentMethod::create(['name' => 'Crédito']);
        PaymentMethod::create(['name' => 'Débito']);
        PaymentMethod::create(['name' => 'Transferência']);
        PaymentMethod::create(['name' => 'Dinheiro']);
    }
}
