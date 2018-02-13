<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(OrderService $orderService)
    {
        $orderFlags = $orderService->getBookableOrderFlags();
        return view('admin.home', ['orderFlags' => $orderFlags]);
    }

    public function getFeedbackListing()
    {
        if (Auth::user()->hasAnyRole(['manager', 'kancelar']))
        {
            // Acquire Feedback
            $feedback = Feedback::orderBy('created_at', 'DESC')->paginate(5);
            return view('admin.shared.feedback-listing', ['feedback' => $feedback]);
        }

        return view('errors.admin-subpage-error', [ 'message' => 'Nemáte dostatečné oprávnění využívat tento modul.' ]);
    }
}
