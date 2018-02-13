<?php

use App\Models\Bookable;
use App\Models\BookableType;
use App\Models\Order;
use App\Models\Orderable;
use App\Models\OrderOrderableItem;
use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    private $orderOpen;
    private $orderPaid;
    private $typeChair;
    private $typeTable;
    private $typeSaloon;
    private $allOrderables;


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Initialize useful properties so they are accessible within whole seeder
        $this->initializeMetaInformation();

        // Create one OPEN and one CLOSED order for the first bookable chair
        $this->seedOrdersForFirstChairBookable();

        // Do the same for the first table
        $this->seedOrdersForFirstTableBookable();

        // Let's get people in the Saloon some rum
        $this->seedOrderForSaloonBookable();

        // Create some single-order items also
        $this->createOpenSingleOrderableOrder('Cappuccino', 45);
        $this->createOpenSingleOrderableOrder('Čaj čerstvý', 46);
        $this->createOpenSingleOrderableOrder('Voda - neperlivá', 47);
        $this->createOpenSingleOrderableOrder('Café latte', 48);
        $this->createOpenSingleOrderableOrder('Coca cola, točená', 41);
        $this->createOpenSingleOrderableOrder('Coca cola, točená', 42);
    }


    private function initializeMetaInformation()
    {
        $this->orderOpen = OrderStatus::where('name', 'Otevřená')->first();
        $this->orderPaid = OrderStatus::where('name', 'Zaplacená')->first();
        $this->typeChair = BookableType::where('name', 'Židle')->first();
        $this->typeTable = BookableType::where('name', 'Stůl')->first();
        $this->typeSaloon = BookableType::where('name', 'Salónek')->first();

        $this->allOrderables = Orderable::all();
    }


    private function seedOrdersForFirstChairBookable()
    {
        $cola = Orderable::where('name', 'Coca cola, točená')->first();
        $firstChair = Bookable::where('bookable_type_id', $this->typeChair->id)->first();

        // Create basic CLOSED order object for desired bookable
        // Also creation of CLOSED order should chronologically precede creation of the open order.
        $order = new Order();
        $order->order_status()->associate($this->orderPaid);
        $order->bookable()->associate($firstChair);
        $order->save();

        // Add items to the open order
        for ($i = 0; $i < 5; $i++)
        {
            $order->orderables()->attach($this->allOrderables->random());
        }

        $this->closeOrderOrderableForOrder($order->id);

        // Create basic OPEN order object for desired bookable (let's use the first chair as well)
        $order2 = new Order();
        $order2->order_status()->associate($this->orderOpen);
        $order2->bookable()->associate($firstChair);
        $order2->save();

        // Add items to the open order
        for ($i = 0; $i < 3; $i++)
        {
            $order2->orderables()->attach($this->allOrderables->random());
        }
        $order2->orderables()->attach($cola);

        $this->randomizeOrderOrderableStateForOrder($order2->id);
    }


    private function seedOrdersForFirstTableBookable()
    {
        $firstTable = Bookable::where('bookable_type_id', $this->typeTable->id)->first();

        // CLOSED order first
        $order = new Order();
        $order->order_status()->associate($this->orderPaid);
        $order->bookable()->associate($firstTable);
        $order->save();

        // Add items to the open order
        for ($i = 0; $i < 5; $i++)
        {
            $order->orderables()->attach($this->allOrderables->random());
        }

        $this->closeOrderOrderableForOrder($order->id);

        // OPEN order
        $order = new Order();
        $order->order_status()->associate($this->orderOpen);
        $order->bookable()->associate($firstTable);
        $order->save();

        // Add items to the open order
        for ($i = 0; $i < 10; $i++)
        {
            $order->orderables()->attach($this->allOrderables->random());
        }

        $this->randomizeOrderOrderableStateForOrder($order->id);
    }


    private function seedOrderForSaloonBookable()
    {
        $saloon = Bookable::where('bookable_type_id', $this->typeSaloon->id)->first();
        $rum = Orderable::where('name', 'Rum')->first();


        // Create only OPEN order for saloon (and order a whole lot of RUM)
        $order = new Order();
        $order->order_status()->associate($this->orderOpen);
        $order->bookable()->associate($saloon);
        $order->save();

        // Get rum for all the people in saloon
        for ($rumCount = 0; $rumCount < 25; $rumCount++)
        {
            $order->orderables()->attach($rum);
        }

        $this->randomizeOrderOrderableStateForOrder($order->id);
    }


    private function createOpenSingleOrderableOrder($orderableName, $bookableId)
    {
        $orderable = Orderable::where('name', $orderableName)->first();
        $bookable = Bookable::find($bookableId);

        $order = new Order();
        $order->order_status()->associate($this->orderOpen);
        $order->bookable()->associate($bookable);
        $order->save();
        $order->orderables()->attach($orderable);
        $this->randomizeOrderOrderableStateForOrder($order->id);
    }


    private function closeOrderOrderableForOrder($orderId)
    {
        OrderOrderableItem::where('order_id', $orderId)
            ->update(['status' => 'Sklizené']);
    }


    private function getRandomOrderOrderableStatus()
    {
        $statuses = ['Přijato','V přípravě','Připraveno','Servírováno','Sklizené'];
        return $statuses[mt_rand(0, count($statuses)-1)];
    }


    private function randomizeOrderOrderableStateForOrder($orderId)
    {
        $affectedOrderables = OrderOrderableItem::where('order_id', $orderId)->get();
        foreach ($affectedOrderables as $orderable)
        {
            // Get random status for each of the orderables in given order
            $status = $this->getRandomOrderOrderableStatus();
            OrderOrderableItem::where('id', $orderable->id)->update(['status' => $status]);
        }
    }
}
