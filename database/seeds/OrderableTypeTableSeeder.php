<?php

use App\Models\OrderableType;
use Illuminate\Database\Seeder;

class OrderableTypeTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $orderableTypes = [ "Hlavní jídlo", "Polévka", "Pití", "Pochutiny" ];

        foreach ($orderableTypes as $typeName)
        {
            $orderableType = new OrderableType();
            $orderableType->timestamps = false; // Prevents laravel from trying to seed updated/added at automatically
            $orderableType->name = $typeName;
            $orderableType->save();
        }
    }
}
