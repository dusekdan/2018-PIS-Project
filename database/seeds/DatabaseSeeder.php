<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role table seeder must come before User table seeder
        $this->call(RoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        // BookableTypes & Bookables must come before Orders
        $this->call(BookableTypesSeeder::class);
        $this->call(BookableTableSeeder::class);

        // Orderables management
        $this->call(OrderableTypeTableSeeder::class);
        $this->call(OrderableTableSeeder::class);

        // Order status + Order table seeders
        $this->call(OrderStatusTableSeeder::class);

        // Orders seeding should happen the last as it depends
        // pretty much on almost everything.
        $this->call(OrderTableSeeder::class);

        // Menus (is random using the Orderables)
        $this->call(MenuTableSeeder::class);

        // Populate feedback table
        $this->call(FeedbackTableSeeder::class);

        // Create differend kind of reservations
        $this->call(ReservationTableSeeder::class);
        $this->call(ReservationBookablesSeeder::class);

    }
}
