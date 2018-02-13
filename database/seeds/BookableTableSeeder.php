<?php

use App\Models\Bookable;
use App\Models\BookableType;
use Illuminate\Database\Seeder;

class BookableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedSeats();
        $this->seedTables();
        $this->seedSaloon();
    }

    private function seedSeats()
    {
        $seatType = BookableType::where('name', 'Židle')->first();

        // All values seeded are hardcoded and need to maintain ID's in database.
        // The information chair being dependent on table will be hardcoded
        // in the room plan.
        for ($i = 1; $i <= 42; $i++)
        {
            $seat = new Bookable([
                'name' => 'Židle ' . $i,
                'capacity' => 1,
            ]);
            $seat->bookableType()->associate($seatType);
            $seat->save();
        }
    }

    private function seedTables()
    {
        $tableType = BookableType::where('name', 'Stůl')->first();

        $table = new Bookable([
            'name' => 'Stůl 1',
            'capacity' => 12
        ]);
        $table->bookableType()->associate($tableType);
        $table->save();

        $table = new Bookable([
            'name' => 'Stůl 2',
            'capacity' => 12
        ]);
        $table->bookableType()->associate($tableType);
        $table->save();

        $table = new Bookable([
            'name' => 'Stůl 3',
            'capacity' => 6
        ]);
        $table->bookableType()->associate($tableType);
        $table->save();

        $table = new Bookable([
            'name' => 'Stůl 4',
            'capacity' => 4
        ]);
        $table->bookableType()->associate($tableType);
        $table->save();

        $table = new Bookable([
            'name' => 'Stůl 5',
            'capacity' => 4
        ]);
        $table->bookableType()->associate($tableType);
        $table->save();

        $table = new Bookable([
            'name' => 'Stůl 6',
            'capacity' => 2
        ]);
        $table->bookableType()->associate($tableType);
        $table->save();

        $table = new Bookable([
            'name' => 'Stůl 7',
            'capacity' => 2
        ]);
        $table->bookableType()->associate($tableType);
        $table->save();
    }

    private function seedSaloon()
    {
        // We'll only have one bookable saloon and therefore singular
        // method name.
        $saloonType = BookableType::where('name', 'Salónek')->first();

        $saloon = new Bookable([
            'name' => 'Salónek',
            'capacity' => 30,
        ]);
        $saloon->bookableType()->associate($saloonType);
        $saloon->save();
    }
}
