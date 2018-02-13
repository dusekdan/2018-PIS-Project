<?php
namespace App\Services;

use App\Models\Menu;
use App\Models\Orderable;
use DateTime;

class MenuService
{
    public function createMenu($validityStart, $validityEnd, $name, $soup, $meal1, $meal2, $meal3)
    {
        $soupOrderable = Orderable::find($soup);
        $meal1Orderable = Orderable::find($meal1);
        $meal2Orderable = Orderable::find($meal2);
        $meal3Orderable = Orderable::find($meal3);

        $menu = new Menu();
        $menu->validityStart = $this->convertUITimestampToDatetime($validityStart);
        $menu->validityEnd = $this->convertUITimestampToDatetime($validityEnd);
        $menu->name = $name;
        $menu->soup()->associate($soupOrderable);
        $menu->meal_1()->associate($meal1Orderable);
        $menu->meal_2()->associate($meal2Orderable);
        $menu->meal_3()->associate($meal3Orderable);

        return $menu->save();
    }

    public function getMenuForEdit($id)
    {
        return Menu::find($id);
    }

    public function deleteMenu($id)
    {
        return Menu::find($id)->delete();
    }

    public function updateMenu($id, $validityStart, $validityEnd, $name, $soup, $meal1, $meal2, $meal3)
    {
        $soupOrderable = Orderable::find($soup);
        $meal1Orderable = Orderable::find($meal1);
        $meal2Orderable = Orderable::find($meal2);
        $meal3Orderable = Orderable::find($meal3);

        $menu = Menu::find($id);
        $menu->validityStart = $this->convertUITimestampToDatetime($validityStart);
        $menu->validityEnd = $this->convertUITimestampToDatetime($validityEnd);
        $menu->name = $name;
        $menu->soup()->associate($soupOrderable);
        $menu->meal_1()->associate($meal1Orderable);
        $menu->meal_2()->associate($meal2Orderable);
        $menu->meal_3()->associate($meal3Orderable);

        return $menu->save();
    }

    private function convertUITimestampToDatetime($time)
    {
        return Datetime::createFromFormat("d. m. Y", $time);
    }

    public function getHistoricMenus()
    {
        return Menu::whereDate('validityEnd', '<', now())->orderBy('validityEnd', 'DESC')->get();
    }

    public function getUpcomingMenus()
    {
        return Menu::whereDate('validityEnd', '>=', now()->subDays(1))->orderBy('validityEnd', 'DESC')->get();
    }


    public static function getPriceString($menu, $mealSelection)
    {
        if ($menu->{"meal_" . $mealSelection} != null)
            return "(" . ($menu->soup->price + $menu->{"meal_" . $mealSelection}->price) . " CZK)";

        return "";
    }

    public static function getCzechDayName($date)
    {
        $czechDays = [ 1 => "Pondělí", "Úterý", "Středa", "Čtvrtek", "Pátek", "Sobota", "Neděle" ];

        return $czechDays[date('N', strtotime($date))];
    }
}