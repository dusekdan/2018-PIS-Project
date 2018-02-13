<?php

use App\Models\Menu;
use App\Models\Orderable;
use App\Models\OrderableType;
use App\Services\MenuService;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    private $menuService;
    private $orderableSoups;
    private $orderableMeals;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $soupType = OrderableType::where('name', 'Polévka')->first();
        $mealType = OrderableType::where('name', 'Hlavní jídlo')->first();

        $this->menuService = new MenuService();
        $this->orderableSoups = Orderable::where('orderable_type_id', $soupType->id)->get();
        $this->orderableMeals = Orderable::where('orderable_type_id', $mealType->id)->get();

        $this->seedPastMenus();
        $this->seedCurrentMenus();
        $this->seedFutureMenus();

    }

    public function seedPastMenus()
    {
        // Menu for 31st Dec, 2017
        $this->menuService->createMenu(
            "31. 12. 2017", "31. 12. 2017", "Silvestrovské menu 2017",
            $this->orderableSoups->random()->id, $this->orderableMeals->random()->id,
            $this->orderableMeals->random()->id, $this->orderableMeals->random()->id);

        // Menu for 1st Jan, 2018
        $this->menuService->createMenu(
          "01. 01. 2018", "01. 01. 2018", "Novoroční MENU 2018",
            $this->orderableSoups->random()->id, $this->orderableMeals->random()->id,
            $this->orderableMeals->random()->id, $this->orderableMeals->random()->id);
    }

    public function seedCurrentMenus()
    {
        // Menu for today
        $dt = new DateTime();
        $today = strftime("%d. %m. %Y" , $dt->getTimestamp());
        $this->menuService->createMenu(
            $today, $today, "Dnešní menu",
            $this->orderableSoups->random()->id, $this->orderableMeals->random()->id,
            $this->orderableMeals->random()->id, null
        );
    }

    public function seedFutureMenus()
    {
        // Menu for the far future
        $this->menuService->createMenu(
            "1. 1. 2038", "1. 1. 2038", "Menu na konec UNIX éry.",
            $this->orderableSoups->random()->id, $this->orderableMeals->random()->id,
            $this->orderableMeals->random()->id, null
        );
    }
}
