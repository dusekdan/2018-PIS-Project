<?php

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orderStatuses = [ "Otevřená", "Zaplacená" ];

        foreach ($orderStatuses as $order)
        {
            $orderStatus = new OrderStatus();
            $orderStatus->timestamps = false; // Prevents laravel from trying to seed updated/added at automatically
            $orderStatus->name = $order;
            $orderStatus->save();
        }
    }
}
