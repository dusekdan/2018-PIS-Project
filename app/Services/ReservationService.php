<?php
/**
 * Created by PhpStorm.
 * User: Anna
 * Date: 15/04/2018
 * Time: 19:10
 */

namespace App\Services;

use App\Models\Bookable;
use App\Models\Reservation;
use App\Models\ReservationBookable;
use DateTime;

class ReservationService
{

    private $tableChairAssociation = [
        43 => [43, 1, 2, 3, 4, 12, 13, 16, 17, 23, 24, 25, 26],
        44 => [44, 5, 6, 7, 8, 14, 15, 18, 19, 27, 28, 29, 30],
        45 => [45, 9, 10, 11, 20, 21, 22],
        46 => [46, 31, 32, 35, 36],
        47 => [47, 33, 34, 37, 38],
        48 => [48, 39, 40],
        49 => [49, 41, 42]
    ];

    public function createReservation($reservationDate, $reservationTime, $reservationName, $reservationEmail, $bookables, $note)
    {
        $reservationDuration = $this->convertToDatetime($reservationDate, $reservationTime);

        if (!$this->checkReservationDate($reservationDuration))
        {
            return false;
        }

        $bookablesArray = json_decode($bookables, true);
        if (!is_array($bookablesArray))
        {
            return false;
        }

        $reservedBookables = $this->getReservedBookables($reservationDuration[0], $reservationDuration[1]);
        for ($i = 0; $i < count($reservedBookables); $i++)
        {
            if (count(array_intersect($bookablesArray, $reservedBookables[$i])) != 0)
            {
                return false;
            }

        }

        $reservation = new Reservation();
        $reservation->reservation_start_time = $reservationDuration[0];
        $reservation->reservation_end_time = $reservationDuration[1];
        $reservation->status = "Přijata";
        $reservation->number_of_people = $this->convertBookablesToPeople($bookablesArray);
        $reservation->customer_name = $reservationName;
        $reservation->customer_email = $reservationEmail;
        $reservation->note = "" . $note;

        if ($reservation->save()) {
            for ($i = 0; $i < count($bookablesArray); $i++) {
                $bookable = Bookable::find($bookablesArray[$i]);
                if ($bookable != null) {
                    $reservationBookable = new ReservationBookable();
                    $reservationBookable->reservation_id = $reservation->id;
                    $reservationBookable->bookable_id = $bookable->id;

                    if ($reservationBookable->save()) {
                        continue;
                    } else {
                        return false;
                    }
                }
            }
        } else {
            return false;
        }

        return true;
    }

    public function stornoReservation($reservationKey)
    {
        $reservation = Reservation::where([['reservation_key', $reservationKey],['status', 'Potvrzena']])->first();
        if (is_object($reservation))
            return $this->changeReservationStatus('Stornována', $reservation->id);
        else
            return false;
    }


    public function getExistingReservations($rowDate, $from, $to)
    {
        $fromDate = DateTime::createFromFormat("d. m. Y", $rowDate);
        $fromDate->setTime((int)$from, 0, 0);
        $toDate = DateTime::createFromFormat("d. m. Y", $rowDate);
        $toDate->setTime((int)$to, 0, 0);

        return $this->getReservedBookables($fromDate, $toDate);
    }

    private function checkReservationDate($reservationDuration)
    {
        if ($reservationDuration[0] == $reservationDuration[1])
            return false;

        $today = date("d. m. Y");

        if ($reservationDuration[0] < $today)
            return false;

        return true;
    }

    private function convertToDatetime($date, $time)
    {
        $times = explode(" - ", $time);

        $from = $date . " " . $times[0];
        $to = $date . " " . $times[1];

        $datetime[0] = DateTime::createFromFormat("d. m. Y H:i", $from);
        $datetime[1] = DateTime::createFromFormat("d. m. Y H:i", $to);

        return $datetime;
    }

    private function convertBookablesToPeople($bookablesArray)
    {
        $numberOfPeople = 0;
        for ($i = 0; $i < count($bookablesArray); $i++) {
            if (array_key_exists($bookablesArray[$i], $this->tableChairAssociation)) {
                // this is table

            } else {
                $numberOfPeople++;
            }
        }

        return $numberOfPeople;
    }

    public function getApplicableReservationsByStatus($status)
    {
        return Reservation::where('status', $status)->whereDate('reservation_start_time', '>=', date('Y-m-d') . ' 00:00:00')->get();
    }

    public function getUpcomingReservations()
    {
        return Reservation::whereDate('reservation_start_time', '>=', date('Y-m-d') . ' 00:00:00')
            ->where('status', 'Potvrzena')
            ->orWhere('status', 'Zamítnuta')
            ->orWhere('status', 'Stornována')
            ->get();
    }

    public function getAllReservations()
    {
        return Reservation::orderBy('created_at', 'DESC')->get();
    }

    public function confirmReservation($id, $key)
    {
        $reservation = Reservation::find($id);
        $reservation->status = 'Potvrzena';
        $reservation->reservation_key = $key;
        return $reservation->save();
    }

    public function changeReservationStatus($status, $id)
    {
        $reservation = Reservation::find($id);
        $reservation->status = $status;
        return $reservation->save();
    }

    private function checkExistingReservations($fromDate, $toDate)
    {
        $reservations = Reservation::where([
            ['reservation_start_time', '>=', $fromDate],
            ['reservation_start_time', '<', $toDate],
            ['status', '<>', 'Zamítnuta'],
            ['status', '<>', 'Stornována']])
            ->orWhere([
                    ['reservation_start_time', '<=', $fromDate],
                    ['reservation_end_time', '>', $fromDate],
                    ['status', '<>', 'Zamítnuta'],
                    ['status', '<>', 'Stornována']]
            )
            ->get();

        return $reservations;
    }

    private function getReservedBookables($fromDate, $toDate)
    {
        $existingReservations = $this->checkExistingReservations($fromDate, $toDate);

        $reservedBookables = [];

        for ($i = 0; $i < count($existingReservations); $i++) {
            $reservationId = $existingReservations[$i]->id;
            $currentBookables = ReservationBookable::where('reservation_id', $reservationId)
                ->pluck('bookable_id')->toArray();
            array_push($reservedBookables, $currentBookables);
        }

        return $reservedBookables;
    }

    /**
     * Generate a random string, using a cryptographically secure
     * pseudorandom number generator (random_int)
     *
     * For PHP 7, random_int is a PHP core function
     * For PHP 5.x, depends on https://github.com/paragonie/random_compat
     *
     * @param int $length      How many characters do we want?
     * @param string $keyspace A string of all possible characters
     *                         to select from
     * @return string
     */
    public static function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

}