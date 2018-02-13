<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendFeedbackRequest;
use App\Mail\ReservationStorno;
use App\Models\Feedback;
use App\Models\Reservation;
use App\Services\MenuService;
use Illuminate\Http\Request;
use App\Services\ReservationService;
use App\Http\Requests\AddReservationRequest;
use App\Http\Requests\GetExistingReservationsRequest;
use Illuminate\Support\Facades\Mail;

class RestaurantController extends Controller
{
    /*
     * Shows the restaurant livesite
     * */
    public function getIndex()
    {
        // Acquire menus that are currently valid.
        $menuService = new MenuService();
        $menus = $menuService->getUpcomingMenus();

        return view('public.main', ['upcomingMenus' => $menus]);
    }

    public function getReservation()
    {
        return view('public.reservation');
    }

    public function getFeedback()
    {
        return view('public.feedback');
    }

    public function postFeedback(SendFeedbackRequest $request)
    {
        $feedback = new Feedback();
        $contact = $request->input('contact');
        $text = $request->input('note');
        if (!empty($contact) && !empty($text))
        {
            $feedback->contact = $contact;
            $feedback->text = $text;
            $feedback->save();
            return redirect()->back()->with('success', 'Děkujeme, že nám pomáháte zlepšovat naše služby.');
        }

        return redirect()->back()->with('error', 'Něco se nepovedlo. Zkuste to prosím znovu.');
    }

    public function getStorno()
    {
        return view('public.storno');
    }

    public function getExistingReservations(ReservationService $reservationService, $date, $from, $to)
    {
        $existingReservations = $reservationService->getExistingReservations($date, $from, $to);
        return $existingReservations;
    }

    public function postCreateReservation(ReservationService $reservationService, AddReservationRequest $request)
    {
        if ($reservationService->createReservation(
            $request->input('reservation-date'),
            $request->input('time'),
            $request->input('customer-name'),
            $request->input('customer-email'),
            $request->input('bookables'),
            $request->input('note')
        ))
            return redirect()->back()->with('success', 'Vyčkejte na zaslání potvrzovacího emailu!');

        return redirect()->back()->with('error', 'Rezervaci se nepodařilo vytvořit.')->withInput();
    }

    public function postStornoReservation(ReservationService $reservationService, Request $reservationKey)
    {
        if ($reservationService->stornoReservation($reservationKey->input('key')))
        {
            $reservation = Reservation::where('reservation_key', $reservationKey->input('key'))->first();
            @Mail::to($reservation->customer_email)->send(new ReservationStorno());

            return redirect()->back()->with('success', 'Vaše rezervace byla úspěšně stornována!');
        }

        return redirect()->back()->with('error', 'Rezervaci se nepodařilo stornovat.')->withInput();
    }


}
