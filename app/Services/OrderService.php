<?php
namespace App\Services;

use App\Models\Bookable;
use App\Models\BookableType;
use App\Models\Order;
use App\Models\Orderable;
use App\Models\OrderOrderableItem;
use App\Models\OrderStatus;

class OrderService
{
    // Every table has chairs associated with it. When looking for corresponding
    // orders, orders for the bookable itself has to be retrieved as well - hence
    // the table identifier is included as well.
    private $tableChairAssociation = [
        43 => [43,1,2,3,4,12,13,16,17,23,24,25,26],
        44 => [44,5,6,7,8,14,15,18,19,27,28,29,30],
        45 => [45,9,10,11,20,21,22],
        46 => [46,31,32,35,36],
        47 => [47,33,34,37,38],
        48 => [48,39,40],
        49 => [49,41,42],
        50 => [50]
    ];

    public function getCurrentOrderForBookable($id)
    {
        $statusCompleted = OrderStatus::where('name', 'Zaplacená')->first();

        $bookable = Bookable::find($id);
        return Order::with('bookable.bookableType')
            ->where('bookable_id', $bookable->id)
            ->where('order_status_id', '<>', $statusCompleted->id)
            ->first();
    }

    public function getCurrentOrdersForBookableGroup($id)
    {
        $statusCompleted = OrderStatus::where('name', 'Zaplacená')->first();

        return Order::with('bookable.bookableType')
        ->whereIn('bookable_id', $this->tableChairAssociation[$id])
        ->orderby('bookable_id', 'DESC')
        ->where('order_status_id', '<>', $statusCompleted->id)->get();
    }

    public function updateCurrentOrderForBookable($orderableId, $id)
    {
        // Create new record in order_orderable table liking orderable to order by id
        $order = Order::find($id);
        $orderable = Orderable::find($orderableId);

        if ($order != null && $orderable != null)
        {
            $orderItem = new OrderOrderableItem();
            $orderItem->timestamps = true;
            $orderItem->orderable_id = $orderable->id;
            $orderItem->order_id = $order->id;
            $orderItem->status = "Přijato";
            return $orderItem->save();
        }

        return false;
    }

    public function deleteCurrentOrderItemForBookable($orderItemId)
    {
        $orderItemTBD = OrderOrderableItem::find($orderItemId);
        $orderItemTBD->delete();
    }

    public function createOrderForBookable($bookableId)
    {
        $bookable = Bookable::find($bookableId);
        $newOrderStatus = OrderStatus::where('name', 'Otevřená')->first();

        $order = new Order();
        $order->order_status()->associate($newOrderStatus);
        $order->bookable()->associate($bookable);
        return $order->save();
    }

    public function closeOrder($id)
    {
        // Close order
        $closedOrderStatus = OrderStatus::where('name', 'Zaplacená')->first();
        $order = Order::find($id);
        $order->order_status()->associate($closedOrderStatus);

        // Change status to 'removed' to all the associated orderables
        OrderOrderableItem::where('order_id', $id)
            ->update(['status' => 'Sklizené']);

        return $order->save();
    }

    public function closeMultiOrder($bookableId)
    {
        $openOrderStatus = OrderStatus::where('name', 'Otevřená')->first();
        $orders = Order::whereIn('bookable_id', $this->tableChairAssociation[$bookableId])->where('order_status_id', $openOrderStatus->id)->get();
        foreach ($orders as $order)
        {
            $this->closeOrder($order->id);
        }

        return true;
    }

    public static function calculateOrderPrice($orderId)
    {
        $order = Order::find($orderId);
        $totalPrice = 0;
        foreach ($order->orderables as $orderable)
        {
            $totalPrice += $orderable->price;
        }

        return $totalPrice;
    }

    public static function calculateOrderPriceForAllBookables($bookableId)
    {
        $tableChairAssociation = [
            43 => [43,1,2,3,4,12,13,16,17,23,24,25,26],
            44 => [44,5,6,7,8,14,15,18,19,27,28,29,30],
            45 => [45,9,10,11,20,21,22],
            46 => [46,31,32,35,36],
            47 => [47,33,34,37,38],
            48 => [48,39,40],
            49 => [49,41,42],
            50 => [50]
        ];

        $openOrderStatus = OrderStatus::where('name', 'Otevřená')->first();
        $orders = Order::whereIn('bookable_id', $tableChairAssociation[$bookableId])->where('order_status_id', $openOrderStatus->id)->get();
        $totalPrice = 0;

        foreach ($orders as $order)
        {
            // For each order calculate sum of each orderable prices
            $orderables = OrderOrderableItem::where('order_id', $order->id)->get();
            foreach ($orderables as $orderable)
            {
                $totalPrice += $orderable->orderable->price;
            }
        }

        return $totalPrice;
    }

    public function getBookableOrderFlags()
    {
        $openOrderStatus = OrderStatus::where('name', 'Otevřená')->first();

        // Select all opened orders and extract their bookable_ids
        return Order::where('order_status_id', $openOrderStatus->id)
            ->pluck('bookable_id')
            ->toJson();
    }
}
?>