<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Services\RoleService;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function getUsers(UserService $userService, RoleService $roleService)
    {
        // Check user role is authorized
        if (Auth::user()->hasRole('manager'))
        {
            return view('admin.manager.user-management', [ 'users' => $userService->getUsersForListing(), 'roles' => $roleService->getAllRoles()]);
        }

        return view('errors.admin-subpage-error', [ 'message' => 'Nemáte dostatečné oprávnění využívat tento modul.' ]);
    }

    public function postUserDelete(UserService $userService, $id)
    {
        $currentUser = Auth::user();
        if ($currentUser->hasRole('manager'))
        {
            if($currentUser->id != $id)
            {
                if ($userService->deleteUser($id))
                    return Redirect::to(URL::previous() . "#user-list")->with('success', 'Uživatel smazán.');
                return redirect()->back()->with('error', 'Chyba. Uživatele se nepodařilo smazat.');
            }

            return redirect()->back()->with('error', 'Operace zamítnuta. Není možné smazat vlastní uživatelský účet.');
        }

        return view('errors.admin-subpage-error', ['message' => 'Operace zamítnuta. Nedostatečná oprávnění.']);
    }

    public function postCreateUser(UserService $userService, AddUserRequest $request)
    {
        if ($userService->createUser(
                $request->input('user-name'),
                $request->input('user-email'),
                $request->input('user-password'),
                $request->input('user-role')
            ))
                return Redirect::to(URL::previous() . "#user-list")->with('success', 'Uživatel vytvořen.');
            return redirect()->back()->with('error', 'Nepodařilo se přidat uživatele. Uživatel s tímto emailem již existuje.')->withInput();
    }

    public function getUserEdit(UserService $userService, RoleService $roleService, $id)
    {
        if (Auth::user()->hasRole('manager'))
        {
            $userData = $userService->getUserForEdit($id);
            return view('admin.manager.user-management-edit', ['id' => $id, 'user' => $userData, 'roles' => $roleService->getAllRoles()]);
        }

        return view('errors.admin-subpage-error', [ 'message' => 'Nemáte dostatečné oprávnění využívat tento modul.' ]);
    }

    public function postUserEdit(UserService $userService, EditUserRequest $request, $id)
    {
        if($userService->updateUser(
            $request->input('user-name'),
            $request->input('user-email'),
            $request->input('user-password'),
            $request->input('user-role'),
            $id))
            return redirect(route('admin.user-management', ['#user-list']))->with('success', 'Uživatelský účet úspěšně změněn.');

        return redirect()
                ->back()
                ->with('error', 'Nepodařilo se změnit uživatelský účet. Vyplněný email je již používán jiným účtem (a nebo selhalo spojení s DB).')
                ->withInput();
    }
}
