<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cook = new Role();
        $cook->name = "kuchar";
        $cook->save();

        $office = new Role();
        $office->name = "kancelar";
        $office->save();

        $server = new Role();
        $server->name = "obsluha";
        $server->save();

        $management = new Role();
        $management->name = "manager";
        $management->save();

    }
}
