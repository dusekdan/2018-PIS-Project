<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Orderable;
use App\Models\OrderableType;
use App\Models\OrderOrderableItem;
use App\Models\OrderStatus;
use App\Services\OrderableService;
use App\Services\OrderService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderListingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function getOrderListing(OrderableService $orderableService)
    {
        $currentUser = Auth::user();

        // Based on the current user role, return view with orders that
        // are ordered correspondingly.

        $accepted = null;
        $ready = null;
        $beingPrepared = null;
        $served = null;
        $removed = null;
        $todays = null;
        $historic = null;


        if ($currentUser->hasRole('kuchar'))
        {
            $accepted = $orderableService->getOrderablesByStatus('Přijato');
            $beingPrepared= $orderableService->getOrderablesByStatus('V přípravě');
        }
        else if ($currentUser->hasRole('obsluha'))
        {
            $accepted = $orderableService->getOrderablesByStatus('Přijato');
            $beingPrepared= $orderableService->getOrderablesByStatus('V přípravě');
            $ready = $orderableService->getOrderablesByStatus('Připraveno');
            $served = $orderableService->getOrderablesByStatus('Servírováno');
            $removed = $orderableService->getOrderablesByStatus('Sklizené');
        }
        else if ($currentUser->hasAnyRole(['manager', 'kancelar']))
        {
            // TODO: Retrieve split to 'today' and 'historic'
            $orderStatusClosed = OrderStatus::where('name', 'Zaplacená')->first();
            $todays = Order::where('order_status_id', $orderStatusClosed->id)
                ->whereDate('created_at', '=', Carbon::today())
                ->orWhereDate('updated_at', '=', Carbon::today())->get();

            $historic = Order::where('order_status_id', $orderStatusClosed->id)
                ->whereDate('created_at', '<>', Carbon::today())
                ->orWhereDate('updated_at', '<>', Carbon::today())->paginate(15);
        }

        return view('admin.shared.order-listing', [
            'accepted' => $accepted,
            'ready' => $ready,
            'beingPrepared' => $beingPrepared,
            'served' => $served,
            'removed' => $removed,
            'role' => $currentUser->role,
            'todays' => $todays,
            'historic' => $historic
        ]);
    }

    public function postStartPreparingOrderable(OrderableService $orderableService, $id)
    {
        if (Auth::user()->hasRole('kuchar'))
        {
            if ($orderableService->changeOrderOrderableStatus($id, 'V přípravě'))
                return redirect()->back();
            else
                return view('errors.admin-subpage-error', ['message' => 'Nepovedlo se změnit stav položky. Znovu načtěte stránku a zkuste to ještě jednou prosím.']);
        }

        return view('errors.admin-subpage-error', ['message' => 'Nemáte dostatečné oprávnění provést tuto operaci.']);
    }

    public function postFinishPreparingOrderable(OrderableService $orderableService, $id)
    {
        if (Auth::user()->hasRole('kuchar'))
        {
            if ($orderableService->changeOrderOrderableStatus($id, 'Připraveno'))
                return redirect()->back();
            else
                return view('errors.admin-subpage-error', ['message' => 'Nepovedlo se změnit stav položky. Znovu načtěte stránku a zkuste to ještě jednou prosím.']);
        }

        return view('errors.admin-subpage-error', ['message' => 'Nemáte dostatečné oprávnění provést tuto operaci.']);
    }

    public function postDeliverOrderOrderable(OrderableService $orderableService, $id)
    {
        if (Auth::user()->hasRole('obsluha'))
        {
            if ($orderableService->changeOrderOrderableStatus($id, 'Servírováno'))
                return redirect()->back();
            else
                return view('errors.admin-subpage-error', ['message' => 'Nepovedlo se změnit stav položky. Znovu načtěte stránku a zkuste to ještě jednou prosím.']);
        }

        return view('errors.admin-subpage-error', ['message' => 'Nemáte dostatečné oprávnění provést tuto operaci.']);
    }

    public function postRemoveOrderOrderable(OrderableService $orderableService, $id)
    {
        if (Auth::user()->hasAnyRole(['obsluha', 'manager']))
        {
            if ($orderableService->changeOrderOrderableStatus($id, 'Sklizené'))
                return redirect()->back();
            return view('errors.admin-subpage-error', ['message' => 'Nepovedlo se změnit stav položky. Znovu načtěte stránku a zkuste to ještě jednou prosím.']);
        }

        return view('errors.admin-subpage-error', ['message' => 'Nemáte dostatečné oprávnění provést tuto operaci.']);
    }

    public function postOrderBookablePay(OrderService $orderService, $id)
    {
        if (Auth::user()->hasAnyRole(['obsluha', 'manager']))
        {
            if ($orderService->closeOrder($id))
                return redirect()->back()->with('success', 'Objednávka zaplacena a uzavřena!');
        }
        return view('errors.admin-subpage-error', ['message' => 'Nemáte dostatečné oprávnění provést tuto operaci.']);
    }

    public function postOrderBookableMultipay(OrderService $orderService, $bookableId)
    {
        if (Auth::user()->hasAnyRole(['obsluha', 'manager']))
        {
            if ($orderService->closeMultiOrder($bookableId))
                return redirect()->back()->with('success', 'Objednávka zaplacena a uzavřena!');
        }
        return view('errors.admin-subpage-error', ['message' => 'Nemáte dostatečné oprávnění provést tuto operaci.']);
    }

    public function getOrderBookable(OrderService $orderService, $id)
    {

        if (Auth::user()->hasRole('kuchar'))
            return view('errors.admin-room-plan-noaccess');

        // 42 => amount of chair bookables
        $bookableOrders = $bookableOrder = null;
        if ($id <= 42 || $id == 50)
        {
            $bookableOrder = $orderService->getCurrentOrderForBookable($id);
        }
        elseif ($id > 42)
        {
            $bookableOrders = $orderService->getCurrentOrdersForBookableGroup($id);
        }

        // Data sources for drop down list
        $types = OrderableType::all();
        $orderables = Orderable::all();

        return view('admin.shared.order-bookable', [
            'bookableId' => $id,
            'order' => $bookableOrder,
            'orders' => $bookableOrders,
            'types' => $types->toJson(),
            'orderables' => $orderables->toJson(),
        ]);
    }

    public function postOrderBookable(OrderService $orderService, UpdateOrderRequest $request, $id)
    {
        // Auth should be handled by UpdateOrderRequest
        if ($orderService->updateCurrentOrderForBookable(
            $request->input('order-item'),
            $id
        ))
            return redirect()->back();

        return redirect()->back()->with('error', 'God damn it, something failed.');
    }

    public function postDeleteOrderBookable(OrderService $orderService, Request $request)
    {
        if (Auth::user()->hasAnyRole(['obsluha', 'manager']))
        {
            $orderService->deleteCurrentOrderItemForBookable($request->input('order-item-id'));
            return redirect()->back();
        }

        return view('errors.admin-subpage-error', ['message' => 'Nemáte dostatečné oprávnění provést tuto operaci.']);
    }

    public function postCreateOrderBookable(OrderService $orderService, Request $request, $bookableId)
    {
        if (Auth::user()->hasAnyRole(['obsluha', 'manager']))
        {
            $orderService->createOrderForBookable($bookableId);
            return redirect()->back();
        }

        return view('errors.admin-subpage-error', ['message' => 'Nemáte dostatečné oprávnění provést tuto operaci.']);
    }
}
