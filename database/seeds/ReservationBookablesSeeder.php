<?php

use Illuminate\Database\Seeder;
use App\Models\Bookable;
use App\Models\Reservation;
use App\Models\ReservationBookable;

class ReservationBookablesSeeder extends Seeder
{

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

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1st reservation

        $reservation1 = Reservation::
        where('id', 1)->first();

        $chairs1 = $this->tableChairAssociation[43];
        $chairs2 = $this->tableChairAssociation[46];

        for ($i = 0; $i < count($chairs1); $i++)
        {
            $bookable = Bookable::where('id', $chairs1[$i])->first();
            if ($bookable != null)
            {
                $reservationBookable = new ReservationBookable();
                $reservationBookable->reservation_id = $reservation1->id;
                $reservationBookable->bookable_id = $bookable->id;

                $reservationBookable->save();
            }
        }

        for ($i = 0; $i < count($chairs2); $i++)
        {
            $bookable = Bookable::where('id', $chairs2[$i])->first();
            if ($bookable != null)
            {
                $reservationBookable = new ReservationBookable();
                $reservationBookable->reservation_id = $reservation1->id;
                $reservationBookable->bookable_id = $bookable->id;

                $reservationBookable->save();
            }
        }




        //2nd reservation

        $reservation2 = Reservation::where('id', 2)->first();

        $chair = Bookable::where('id', 32)->first();
        $reservationBookable = new ReservationBookable();
        $reservationBookable->reservation_id = $reservation2->id;
        $reservationBookable->bookable_id = $chair->id;

        $reservationBookable->save();



        //3nd reservation

        $reservation3 = Reservation::where('id', 3)->first();

        $saloon = Bookable::where('id', 50)->first();
        $reservationBookable = new ReservationBookable();
        $reservationBookable->reservation_id = $reservation3->id;
        $reservationBookable->bookable_id = $saloon->id;

        $reservationBookable->save();



        $reservation4 = Reservation::where('id', 4)->first();

        $chairs1 = $this->tableChairAssociation[44];

        for ($i = 0; $i < count($chairs1); $i++)
        {
            $bookable = Bookable::where('id', $chairs1[$i])->first();
            if ($bookable != null)
            {
                $reservationBookable = new ReservationBookable();
                $reservationBookable->reservation_id = $reservation4->id;
                $reservationBookable->bookable_id = $bookable->id;

                $reservationBookable->save();
            }
        }



        $reservation5 = Reservation::where('id', 5)->first();

        $chairs1 = $this->tableChairAssociation[46];

        for ($i = 0; $i < count($chairs1); $i++)
        {
            $bookable = Bookable::where('id', $chairs1[$i])->first();
            if ($bookable != null)
            {
                $reservationBookable = new ReservationBookable();
                $reservationBookable->reservation_id = $reservation5->id;
                $reservationBookable->bookable_id = $bookable->id;

                $reservationBookable->save();
            }
        }



        $reservation6 = Reservation::where('id', 6)->first();

        $chairs1 = $this->tableChairAssociation[48];

        for ($i = 0; $i < count($chairs1); $i++)
        {
            $bookable = Bookable::where('id', $chairs1[$i])->first();
            if ($bookable != null)
            {
                $reservationBookable = new ReservationBookable();
                $reservationBookable->reservation_id = $reservation6->id;
                $reservationBookable->bookable_id = $bookable->id;

                $reservationBookable->save();
            }
        }




        $reservation7 = Reservation::where('id', 7)->first();

        $chairs1 = $this->tableChairAssociation[43];
        $chairs2 = $this->tableChairAssociation[44];
        $chairs3 = $this->tableChairAssociation[45];
        $chairs4 = $this->tableChairAssociation[46];
        $chairs5 = $this->tableChairAssociation[47];
        $chairs6 = $this->tableChairAssociation[48];
        $chairs7 = $this->tableChairAssociation[49];

        for ($i = 0; $i < count($chairs1); $i++)
        {
            $bookable = Bookable::where('id', $chairs1[$i])->first();
            if ($bookable != null)
            {
                $reservationBookable = new ReservationBookable();
                $reservationBookable->reservation_id = $reservation7->id;
                $reservationBookable->bookable_id = $bookable->id;

                $reservationBookable->save();
            }
        }

        for ($i = 0; $i < count($chairs2); $i++)
        {
            $bookable = Bookable::where('id', $chairs2[$i])->first();
            if ($bookable != null)
            {
                $reservationBookable = new ReservationBookable();
                $reservationBookable->reservation_id = $reservation7->id;
                $reservationBookable->bookable_id = $bookable->id;

                $reservationBookable->save();
            }
        }

        for ($i = 0; $i < count($chairs3); $i++)
        {
            $bookable = Bookable::where('id', $chairs3[$i])->first();
            if ($bookable != null)
            {
                $reservationBookable = new ReservationBookable();
                $reservationBookable->reservation_id = $reservation7->id;
                $reservationBookable->bookable_id = $bookable->id;

                $reservationBookable->save();
            }
        }


        for ($i = 0; $i < count($chairs4); $i++)
        {
            $bookable = Bookable::where('id', $chairs4[$i])->first();
            if ($bookable != null)
            {
                $reservationBookable = new ReservationBookable();
                $reservationBookable->reservation_id = $reservation7->id;
                $reservationBookable->bookable_id = $bookable->id;

                $reservationBookable->save();
            }
        }

        for ($i = 0; $i < count($chairs5); $i++)
        {
            $bookable = Bookable::where('id', $chairs5[$i])->first();
            if ($bookable != null)
            {
                $reservationBookable = new ReservationBookable();
                $reservationBookable->reservation_id = $reservation7->id;
                $reservationBookable->bookable_id = $bookable->id;

                $reservationBookable->save();
            }
        }

        for ($i = 0; $i < count($chairs6); $i++)
        {
            $bookable = Bookable::where('id', $chairs6[$i])->first();
            if ($bookable != null)
            {
                $reservationBookable = new ReservationBookable();
                $reservationBookable->reservation_id = $reservation7->id;
                $reservationBookable->bookable_id = $bookable->id;

                $reservationBookable->save();
            }
        }


        for ($i = 0; $i < count($chairs7); $i++)
        {
            $bookable = Bookable::where('id', $chairs7[$i])->first();
            if ($bookable != null)
            {
                $reservationBookable = new ReservationBookable();
                $reservationBookable->reservation_id = $reservation7->id;
                $reservationBookable->bookable_id = $bookable->id;

                $reservationBookable->save();
            }
        }

    }
}
