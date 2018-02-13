<?php

use App\Models\OrderableType;
use App\Models\Orderable;
use Illuminate\Database\Seeder;

class OrderableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedBeverages();

        $this->seedSoups();

        $this->seedMeals();

        $this->seedRefreshments();
    }

    public function seedBeverages()
    {
        $orderableTypeDrink = OrderableType::where('name', 'Pití')->first();

        $orderableDrink01 = new Orderable();
        $orderableDrink01->name = "Coca cola, točená";
        $orderableDrink01->quantity = "0.3l";
        $orderableDrink01->price = 27.00;
        $orderableDrink01->orderable_type()->associate($orderableTypeDrink);
        $orderableDrink01->save();

        $orderableDrink02 = new Orderable();
        $orderableDrink02->name = "Coca cola, točená";
        $orderableDrink02->quantity = "0.5l";
        $orderableDrink02->price = 32.00;
        $orderableDrink02->orderable_type()->associate($orderableTypeDrink);
        $orderableDrink02->save();

        $orderableDrink03 = new Orderable();
        $orderableDrink03->name = "Rum";
        $orderableDrink03->quantity = "0.04l";
        $orderableDrink03->price = 25.00;
        $orderableDrink03->orderable_type()->associate($orderableTypeDrink);
        $orderableDrink03->save();

        $orderableDrink04 = new Orderable();
        $orderableDrink04->name = "Black Marry";
        $orderableDrink04->quantity = "0.05l";
        $orderableDrink04->price = 85.00;
        $orderableDrink04->orderable_type()->associate($orderableTypeDrink);
        $orderableDrink04->save();

        $orderableDrink05 = new Orderable();
        $orderableDrink05->name = "Voda - neperlivá";
        $orderableDrink05->quantity = "0.5l";
        $orderableDrink05->price = 25.00;
        $orderableDrink05->orderable_type()->associate($orderableTypeDrink);
        $orderableDrink05->save();

        $orderableDrink06 = new Orderable();
        $orderableDrink06->name = "Voda - jemně perlivá";
        $orderableDrink06->quantity = "0.5l";
        $orderableDrink06->price = 25.00;
        $orderableDrink06->orderable_type()->associate($orderableTypeDrink);
        $orderableDrink06->save();

        $orderableDrink07 = new Orderable();
        $orderableDrink07->name = "Čaj čerstvý";
        $orderableDrink07->quantity = "0.3l";
        $orderableDrink07->price = 40.00;
        $orderableDrink07->orderable_type()->associate($orderableTypeDrink);
        $orderableDrink07->save();

        $orderableDrink08 = new Orderable();
        $orderableDrink08->name = "Čaj";
        $orderableDrink08->quantity = "0.3l";
        $orderableDrink08->price = 30.00;
        $orderableDrink08->orderable_type()->associate($orderableTypeDrink);
        $orderableDrink08->save();

        $orderableDrink09 = new Orderable();
        $orderableDrink09->name = "Espresso";
        $orderableDrink09->quantity = "40ml";
        $orderableDrink09->price = 30.00;
        $orderableDrink09->orderable_type()->associate($orderableTypeDrink);
        $orderableDrink09->save();

        $orderableDrink010 = new Orderable();
        $orderableDrink010->name = "Espresso macchiato";
        $orderableDrink010->quantity = "90ml";
        $orderableDrink010->price = 30.00;
        $orderableDrink010->orderable_type()->associate($orderableTypeDrink);
        $orderableDrink010->save();

        $orderableDrink011 = new Orderable();
        $orderableDrink011->name = "Cappuccino";
        $orderableDrink011->quantity = "180ml";
        $orderableDrink011->price = 30.00;
        $orderableDrink011->orderable_type()->associate($orderableTypeDrink);
        $orderableDrink011->save();

        $orderableDrink012 = new Orderable();
        $orderableDrink012->name = "Café latte";
        $orderableDrink012->quantity = "250ml";
        $orderableDrink012->price = 30.00;
        $orderableDrink012->orderable_type()->associate($orderableTypeDrink);
        $orderableDrink012->save();



    }

    public function seedMeals()
    {
        $orderableTypeMeal = OrderableType::where('name', 'Hlavní jídlo')->first();

        $orderableMeal01 = new Orderable();
        $orderableMeal01->name = "Rizoto s kuřecím masem, příloha rýže";
        $orderableMeal01->quantity = "500g";
        $orderableMeal01->price = 85.00;
        $orderableMeal01->orderable_type()->associate($orderableTypeMeal);
        $orderableMeal01->save();

        $orderableMeal02 = new Orderable();
        $orderableMeal02->name = "Rizoto s kuřecím masem, příloha rýže, dětská porce";
        $orderableMeal02->quantity = "250g";
        $orderableMeal02->price = 65.00;
        $orderableMeal02->orderable_type()->associate($orderableTypeMeal);
        $orderableMeal02->save();

        $orderableMeal03 = new Orderable();
        $orderableMeal03->name = "Tatarák z hovězího masa + 2 topinky";
        $orderableMeal03->quantity = "150g";
        $orderableMeal03->price = 155.00;
        $orderableMeal03->orderable_type()->associate($orderableTypeMeal);
        $orderableMeal03->save();

        $orderableMeal04 = new Orderable();
        $orderableMeal04->name = "Svíčková hovězí pečeně, houskový knedlík";
        $orderableMeal04->quantity = "250g";
        $orderableMeal04->price = 180.00;
        $orderableMeal04->orderable_type()->associate($orderableTypeMeal);
        $orderableMeal04->save();

        $orderableMeal05 = new Orderable();
        $orderableMeal05->name = "Těstoviny s boloňskou omáčkou a parmazánem";
        $orderableMeal05->quantity = "300g";
        $orderableMeal05->price = 135.00;
        $orderableMeal05->orderable_type()->associate($orderableTypeMeal);
        $orderableMeal05->save();

        $orderableMeal06 = new Orderable();
        $orderableMeal06->name = "Hovězí hamburger s čedarem a smaženou cibulkou, hranolky";
        $orderableMeal06->quantity = "250g";
        $orderableMeal06->price = 175.00;
        $orderableMeal06->orderable_type()->associate($orderableTypeMeal);
        $orderableMeal06->save();

        $orderableMeal07 = new Orderable();
        $orderableMeal07->name = "Přírodní kuřecí plátek, dušená rýže";
        $orderableMeal07->quantity = "150g";
        $orderableMeal07->price = 135.00;
        $orderableMeal07->orderable_type()->associate($orderableTypeMeal);
        $orderableMeal07->save();

        $orderableMeal08 = new Orderable();
        $orderableMeal08->name = "Čočka na kyselo, okurek, chléb";
        $orderableMeal08->quantity = "150g";
        $orderableMeal08->price = 105.00;
        $orderableMeal08->orderable_type()->associate($orderableTypeMeal);
        $orderableMeal08->save();

        $orderableMeal09 = new Orderable();
        $orderableMeal09->name = "Palačinky s tvarohem a marmeládou";
        $orderableMeal09->quantity = "2 ks";
        $orderableMeal09->price = 85.00;
        $orderableMeal09->orderable_type()->associate($orderableTypeMeal);
        $orderableMeal09->save();
    }

    public function seedRefreshments()
    {
        $orderableTypeRefreshment = OrderableType::where('name', 'Pochutiny')->first();

        $orderableRefreshment01 = new Orderable();
        $orderableRefreshment01->name = "Solené domácí brambůrky";
        $orderableRefreshment01->quantity = "150g";
        $orderableRefreshment01->price = 25.00;
        $orderableRefreshment01->orderable_type()->associate($orderableTypeRefreshment);
        $orderableRefreshment01->save();

        $orderableRefreshment02 = new Orderable();
        $orderableRefreshment02->name = "Zelené olivy s mandlemi";
        $orderableRefreshment02->quantity = "60g";
        $orderableRefreshment02->price = 35.00;
        $orderableRefreshment02->orderable_type()->associate($orderableTypeRefreshment);
        $orderableRefreshment02->save();

        $orderableRefreshment03 = new Orderable();
        $orderableRefreshment03->name = "Nakládaný hermelín, chléb";
        $orderableRefreshment03->quantity = "150g";
        $orderableRefreshment03->price = 75.00;
        $orderableRefreshment03->orderable_type()->associate($orderableTypeRefreshment);
        $orderableRefreshment03->save();

        $orderableRefreshment04 = new Orderable();
        $orderableRefreshment04->name = "Medovník";
        $orderableRefreshment04->quantity = "100g";
        $orderableRefreshment04->price = 55.00;
        $orderableRefreshment04->orderable_type()->associate($orderableTypeRefreshment);
        $orderableRefreshment04->save();
    }

    public function seedSoups()
    {
        $orderableTypeSoup = OrderableType::where('name', 'Polévka')->first();

        $orderableSoup01 = new Orderable();
        $orderableSoup01->name = "Kuřecí vývar se zeleninou";
        $orderableSoup01->quantity = "250ml";
        $orderableSoup01->price = 15.0;
        $orderableSoup01->orderable_type()->associate($orderableTypeSoup);
        $orderableSoup01->save();

        $orderableSoup02 = new Orderable();
        $orderableSoup02->name = "Rajská polévka";
        $orderableSoup02->quantity = "250ml";
        $orderableSoup02->price = 15.0;
        $orderableSoup02->orderable_type()->associate($orderableTypeSoup);
        $orderableSoup02->save();

        $orderableSoup03 = new Orderable();
        $orderableSoup03->name = "Polévka Gazpacho";
        $orderableSoup03->quantity = "250ml";
        $orderableSoup03->price = 55.0;
        $orderableSoup03->orderable_type()->associate($orderableTypeSoup);
        $orderableSoup03->save();

        $orderableSoup04 = new Orderable();
        $orderableSoup04->name = "Dýňový krém";
        $orderableSoup04->quantity = "250ml";
        $orderableSoup04->price = 55.0;
        $orderableSoup04->orderable_type()->associate($orderableTypeSoup);
        $orderableSoup04->save();

        $orderableSoup05 = new Orderable();
        $orderableSoup05->name = "Cibulová polévka";
        $orderableSoup05->quantity = "250ml";
        $orderableSoup05->price = 55.0;
        $orderableSoup05->orderable_type()->associate($orderableTypeSoup);
        $orderableSoup05->save();
    }
}
