<?php
namespace App\Services;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Orderable;
use App\Models\OrderableType;
use App\Models\OrderOrderableItem;
use App\Models\OrderStatus;

class OrderableService
{
    public function getOrderablesForListing()
    {
        $orderables = Orderable::all();
        return $orderables;
    }

    public function getOrderableTypes()
    {
        $orderableTypes = OrderableType::all();
        return $orderableTypes;
    }

    public function getOrderableForEdit($id)
    {
        return Orderable::find($id);
    }

    public function createOrderable($name, $quantity, $price, $type)
    {
        $orderableType = OrderableType::find($type);

        $orderable = new Orderable();
        $orderable->name = $name;
        $orderable->quantity = $quantity;
        $orderable->price = $price;
        $orderable->orderable_type()->associate($orderableType);

        return $orderable->save();
    }

    public function updateOrderable($id, $name, $quantity, $price, $type)
    {
        $orderableType = OrderableType::find($type);

        // Only update orderable if specified type exists (avoid database inconsistency)
        if ($orderableType)
        {
            $orderable = Orderable::find($id);
            $orderable->name = $name;
            $orderable->quantity = $quantity;
            $orderable->price = $price;
            $orderable->orderable_type()->associate($orderableType);
            return $orderable->save();
        }

        return false;
    }

    public function deleteOrderable($id)
    {
        if (!$this->hasOrderableDependencies($id))
            return Orderable::find($id)->delete();

        return false;
    }

    public function getOrderablesByStatus($status)
    {
        $orders = $this->getOpenOrderIds();
        $orderables = OrderOrderableItem::whereIn('order_id', $orders)
            ->where('status', $status)
            ->orderBy('updated_at', 'ASC')
            ->get();

        return $orderables;
    }

    public function changeOrderOrderableStatus($id, $status)
    {
        $orderable = OrderOrderableItem::find($id);
        $orderable->status = $status;
        return $orderable->save();
    }

    private function getOpenOrderIds()
    {
        $openOrderStatus = OrderStatus::where('name', 'Otevřená')->first();
        return Order::where('order_status_id', $openOrderStatus->id)
            ->pluck('id')
            ->toArray();
    }

    private function hasOrderableDependencies($id)
    {
        // Order_Orderables referencing orderable
        $ooDependency = OrderOrderableItem::where('orderable_id', $id)->get();
        if ($ooDependency->isNotEmpty())
            return true;

        // Menus referencing orderable
        $menuDependency = Menu::where('meal_1_id', $id)->orWhere('meal_2_id', $id)->orWhere('meal_3_id', $id)->get();
        if ($menuDependency->isNotEmpty())
            return true;

        return false;
    }

    public static function getDisplayElapsedTime($startTimeStamp, $compact=false, $use=null) {

        $seconds = strtotime(date("Y-m-d H:i:s")) - strtotime($startTimeStamp);

        $periods = array (
        'years'     => 31556926,
        'months'    => 2629743,
        'weeks'     => 604800,
        'days'      => 86400,
        'hours'     => 3600,
        'minutes'   => 60,
        'seconds'   => 1
        );

        $zeros = false;
        $seconds = (float)$seconds;
        $segments = array();

        foreach ($periods as $period => $value)
        {
            if ($use && strpos($use, $period[0]) === false)
                continue;

            $count = floor($seconds / $value);
            if ($count == 0 && !$zeros)
                continue;

            $key = $compact ? substr($period,0,1) : $period;
            $segments[strtolower($key)] = $count;
            $seconds = $seconds % $value;
        }

        $string = array();
        foreach ($segments as $key => $value)
        {
            $segment_name = $compact ? $key : ' '.substr($key,0,-1);
            $segment = $value.$segment_name;

            if ($compact==false && $value!=1)
                $segment .= 's';

            $string[]=$segment;
        }

        if ($compact)
        {
            $result = implode(' ', $string);
            return (empty($result) || $result == '' ) ?  '0s' : $result;
        }

        return implode(', ', $string);
    }
}