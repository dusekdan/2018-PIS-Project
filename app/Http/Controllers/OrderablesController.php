<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddOrderableRequest;
use App\Services\OrderableService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderablesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function getIndex(OrderableService $orderableService)
    {
        // User in 'server' role should not be able to access orderables
        if (Auth::user()->hasRole('obsluha'))
            return view('errors.admin-subpage-error', [ 'message' => 'Nemáte dostatečné oprávnění využívat tento modul.' ]);

        // Fetch data for orderables view
        # TBD - fetching orderables
        # TBD - fetching related types

        return view('admin.shared.orderables-management', ['orderables' => $orderableService->getOrderablesForListing(), 'types' => $orderableService->getOrderableTypes()]);
    }

    public function postCreateOrderable(OrderableService $orderableService, AddOrderableRequest $request)
    {
        if ($orderableService->createOrderable(
            $request->input('orderable-name'),
            $request->input('orderable-quantity'),
            $request->input('orderable-price'),
            $request->input('orderable-type')
        ))
            return redirect(route('admin.orderables-management'))->with('success', 'Položka byla úspěšně přidána!');

        return redirect()->back()->with('error', 'Položku se nepodařilo přidat. Zkuste to prosím znovu.')->withInput();
    }

    public function postDeleteOrderable(OrderableService $orderableService, $id)
    {
        if (!Auth::user()->hasRole('obsluha'))
            if ($orderableService->deleteOrderable($id))
                return redirect()->back()->with('success', 'Položka byla úspěšně smazána!');
            else
                return redirect()->back()->with('error', "Položka nemůže být smazána - v systému existují závislosti vyžadující, aby tato položka zůstala v systému.");

        return view('errors.admin-subpage-error', [ 'message' => 'Operace zamítnuta. Nemáte dostatečné oprávnění provést tuto akci.' ]);
    }

    public function getEditOrderable(OrderableService $orderableService, $id)
    {
        if (Auth::user()->hasRole('obsluha'))
            return view('errors.admin-subpage-error', [ 'message' => 'Nemáte dostatečné oprávnění využívat tento modul.' ]);

        $orderableData = $orderableService->getOrderableForEdit($id);

        return view('admin.shared.orderables-management-edit', [
            'id' => $id,
            'orderable' => $orderableData,
            'orderables' => $orderableService->getOrderablesForListing(),
            'types' => $orderableService->getOrderableTypes()
        ]);
    }

    public function postEditOrderable(OrderableService $orderableService, AddOrderableRequest $request, $id)
    {
        if ($orderableService->updateOrderable(
            $id,
            $request->input('orderable-name'),
            $request->input('orderable-quantity'),
            $request->input('orderable-price'),
            $request->input('orderable-type')
        ))
            return redirect(route('admin.orderables-management'))->with('success', 'Položka byla úspěšně upravena!');

        return redirect()->back()->with('error', 'Položka nemohla být upravena. Zkuste to prosím znovu.');
    }
}
