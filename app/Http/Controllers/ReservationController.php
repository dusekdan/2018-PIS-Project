<?php

namespace App\Http\Controllers;

use App\Mail\ReservationDenied;
use App\Mail\ReservationKeyMail;
use App\Mail\ReservationStorno;
use App\Models\Reservation;
use App\Services\ReservationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function getReservationView(ReservationService $reservationService)
    {
        $currentUser = Auth::user();

        // Acquire data for the view
        $pendingReservations = $reservationService->getApplicableReservationsByStatus('Přijata');
        $historicalReservations = $reservationService->getAllReservations();
        $upcoming = $reservationService->getUpcomingReservations();

        // View read-only interface to servers
        if ($currentUser->hasRole('obsluha'))
        {
            return view('admin.servers.reservation-view',[
                    'pending' => $pendingReservations,
                    'history' => $historicalReservations,
                    'upcoming' => $upcoming
                ]);
        }

        if ($currentUser->hasAnyRole(['manager', 'kuchar', 'kancelar']))
        {

            return view('admin.shared.reservation-view', [
                'pending' => $pendingReservations,
                'history' => $historicalReservations,
                'upcoming' => $upcoming
            ]);
        }

        return view('errors.admin-subpage-error', [ 'message' => 'Nemáte dostatečné oprávnění zobrazit tuto stránku.' ]);
    }

    public function postDenyReservation(ReservationService $reservationService, $reservationId)
    {
        if (Auth::user()->hasAnyRole(['manager', 'kancelar']))
        {
            if ($reservationService->changeReservationStatus('Zamítnuta', $reservationId))
            {
                // Send mail to the customer informing about reservation cancellation
                $reservation = Reservation::find($reservationId);
                @Mail::to($reservation->customer_email)->send(new ReservationDenied());

                return redirect()->back()->with('success', 'Rezervace byla zamítnuta.');
            }
            return redirect()->back()->with('error', 'Rezervaci se nepodařilo zamítnout. Zkuste to prosím znovu.');
        }
        return view('errors.admin-subpage-error', [ 'message' => 'Nemáte dostatečné oprávnění zobrazit tuto stránku.' ]);
    }

    public function postConfirmReservation(ReservationService $reservationService, $reservationId)
    {
        if (Auth::user()->hasAnyRole(['manager', 'kancelar']))
        {
            $key = ReservationService::random_str(32);
            if ($reservationService->confirmReservation($reservationId, $key))
            {
                // Send mail with key to the customer
                $reservation = Reservation::find($reservationId);
                @Mail::to($reservation->customer_email)->send(new ReservationKeyMail($key));

                return redirect()->back()->with('success', 'Rezervace potvrzena.');
            }

            return redirect()->back()->with('error', 'Rezervaci se nepovedlo potvrdit. Zkuste to prosím znovu.');
        }
        return view('errors.admin-subpage-error', [ 'message' => 'Nemáte dostatečné oprávnění zobrazit tuto stránku.' ]);
    }

    public function postStornoReservation(ReservationService $reservationService, $reservationId)
    {
        if (Auth::user()->hasAnyRole(['manager', 'kancelar']))
        {
            if ($reservationService->changeReservationStatus('Stornována', $reservationId))
            {
                // Send mail informing the customer about storno
                $reservation = Reservation::find($reservationId);
                @Mail::to($reservation->customer_email)->send(new ReservationStorno());
                return redirect()->back()->with('success', 'Rezervace stornována.');
            }
            return redirect()->back()->with('error', 'Rezervaci se nepovedlo stornovat. Zkuste to prosím znovu.');
        }
    }
}
