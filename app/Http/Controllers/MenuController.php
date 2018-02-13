<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMenuRequest;
use App\Models\Order;
use App\Services\MenuService;
use App\Services\OrderableService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getMenuEditor(OrderableService $orderableService, MenuService $menuService)
    {
        // Check permissions
        if (Auth::user()->hasAnyRole(['kuchar', 'manager']))
        {
            // Obtain relevant objects for menu creation
            $orderables = $orderableService->getOrderablesForListing();
            $upcomingMenus = $menuService->getUpcomingMenus();
            $pastMenus = $menuService->getHistoricMenus();

            return view('admin.shared.menu-editor', ['orderables' => $orderables, 'upcomingMenus' => $upcomingMenus, 'pastMenus' => $pastMenus]);
        }
        else
        {
            return view('errors.admin-subpage-error', [ 'message' => 'Nemáte dostatečné oprávnění provést tuto operaci.' ]);
        }
    }

    public function postCreateMenu(MenuService $menuService, AddMenuRequest $request)
    {
        if ($menuService->createMenu(
            $request->input('menu-validity-start'),
            $request->input('menu-validity-end'),
            $request->input('menu-name'),
            $request->input('menu-soup'),
            $request->input('menu-meal-1'),
            $request->input('menu-meal-2'),
            $request->input('menu-meal-3')
        ))
            return redirect(route('admin.menu-editor'))->with('success', 'Menu bylo vytvořeno!');

        return redirect()->back()->with('error', 'Nepodařilo se vytvořit menu.')->withInput();
    }

    public function postDeleteMenu(MenuService $menuService, $id)
    {
        if (Auth::user()->hasAnyRole(['kuchar', 'manager']))
        {
            if ($menuService->deleteMenu($id))
                return redirect()->route('admin.menu-editor')->with('success', 'Menu smazáno!');
            return redirect()->back()->with('error', 'Nepodařilo se smazat menu. Zkuste to prosím znovu.');
        }

        return view('errors.admin-subpage-error', [ 'message' => 'Nemáte dostatečné oprávnění provést tuto operaci.' ]);
    }

    public function getEditMenu(OrderableService $orderableService, MenuService $menuService, $id)
    {
        if (Auth::user()->hasAnyRole(['kuchar', 'manager']))
        {
            $menuData = $menuService->getMenuForEdit($id);
            $orderables = $orderableService->getOrderablesForListing();
            $upcomingMenus = $menuService->getUpcomingMenus();
            $pastMenus = $menuService->getHistoricMenus();

            return view('admin.shared.menu-editor-edit', ['menu' => $menuData, 'orderables' => $orderables, 'upcomingMenus' => $upcomingMenus, 'pastMenus' => $pastMenus]);
        }

        return view('errors.admin-subpage-error', [ 'message' => 'Nemáte dostatečné oprávnění provést tuto operaci.' ]);
    }

    public function postEditMenu(MenuService $menuService, AddMenuRequest $request, $id)
    {
        if ($menuService->updateMenu(
            $id,
            $request->input('menu-validity-start'),
            $request->input('menu-validity-end'),
            $request->input('menu-name'),
            $request->input('menu-soup'),
            $request->input('menu-meal-1'),
            $request->input('menu-meal-2'),
            $request->input('menu-meal-3')
        ))
            return redirect(route('admin.menu-editor'))->with('success', 'Menu bylo upraveno!');

        return redirect()->back()->with('error', 'Nepodařilo se upravit menu.')->withInput();
    }
}
