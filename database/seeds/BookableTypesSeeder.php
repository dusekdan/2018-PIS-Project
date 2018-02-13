<?php

use App\Models\BookableType;
use Illuminate\Database\Seeder;

class BookableTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seat = new BookableType();
        $seat->name = "Židle";
        $seat->timestamps = false;
        $seat->save();

        $table = new BookableType();
        $table->name = "Stůl";
        $table->timestamps = false;
        $table->save();

        $saloon = new BookableType();
        $saloon->name = "Salónek";
        $saloon->timestamps = false;
        $saloon->save();
    }
}
