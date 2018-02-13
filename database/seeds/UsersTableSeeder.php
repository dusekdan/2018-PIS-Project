<?php

use App\Models\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cook = Role::where('name', 'kuchar')->first();
        $server = Role::where('name', 'obsluha')->first();
        $office = Role::where('name', "kancelar")->first();
        $manager = Role::where('name', 'manager')->first();


        $userCook = new User();
        $userCook->name = "Kuchař";
        $userCook->email = "FIT-PIS-kuchar@mailinator.com";
        $userCook->password = bcrypt("fit-2018");
        $userCook->role()->associate($cook);
        $userCook->save();

        $userServer = new User();
        $userServer->name = "Obsluha";
        $userServer->email = "FIT-PIS-obsluha@mailinator.com";
        $userServer->password = bcrypt("fit-2018");
        $userServer->role()->associate($server);
        $userServer->save();

        $userOffice = new User();
        $userOffice->name = "Kancelář";
        $userOffice->email = "FIT-PIS-kancelar@mailinator.com";
        $userOffice->password = bcrypt("fit-2018");
        $userOffice->role()->associate($office);
        $userOffice->save();

        $userManager = new User();
        $userManager->name = "Manažer";
        $userManager->email = "FIT-PIS-manager@mailinator.com";
        $userManager->password = bcrypt("fit-2018");
        $userManager->role()->associate($manager);
        $userManager->save();
    }
}
