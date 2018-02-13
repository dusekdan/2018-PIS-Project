<?php

use Illuminate\Database\Seeder;
use App\Models\Reservation;

class ReservationTableSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reservation1 = New Reservation();

        $reservation1->reservation_start_time = DateTime::createFromFormat("d. m. Y H:i", "04. 05. 2018 17:00");
        $reservation1->reservation_end_time = DateTime::createFromFormat("d. m. Y H:i", "04. 05. 2018 23:00");
        $reservation1->status = "Přijata";
        $reservation1->number_of_people = 20;
        $reservation1->customer_name = "Jan Novák";
        $reservation1->customer_email = "jan.novak@seznam.cz";
        $reservation1->note = "Oslava 70. narozenin.";
        $reservation1->reservation_key = "HU584nJn496Je5cko89FZ";

        $reservation1->save();



        $reservation2 = New Reservation();

        $reservation2->reservation_start_time = DateTime::createFromFormat("d. m. Y H:i", "30. 04. 2018 12:00");
        $reservation2->reservation_end_time = DateTime::createFromFormat("d. m. Y H:i", "30. 04. 2018 13:00");
        $reservation2->status = "Přijata";
        $reservation2->number_of_people = 1;
        $reservation2->customer_name = "Stanislav Samotný";
        $reservation2->customer_email = "s.samotny@email.cz";
        $reservation2->note = "";
        $reservation2->reservation_key = "Hh48FeR125huji99842gd";

        $reservation2->save();



        $reservation3 = New Reservation();

        $reservation3->reservation_start_time = DateTime::createFromFormat("d. m. Y H:i", "10. 05. 2018 10:00");
        $reservation3->reservation_end_time = DateTime::createFromFormat("d. m. Y H:i", "10. 05. 2018 22:00");
        $reservation3->status = "Přijata";
        $reservation3->number_of_people = 18;
        $reservation3->customer_name = "Artisan software s.r.o.";
        $reservation3->customer_email = "office@artisan-sw.cz";
        $reservation3->note = "Firemní akce.";
        $reservation3->reservation_key = "juJ458g9RF47KO6221WEw";

        $reservation3->save();


        $reservation4 = New Reservation();

        $reservation4->reservation_start_time = DateTime::createFromFormat("d. m. Y H:i", "07. 06. 2018 19:00");
        $reservation4->reservation_end_time = DateTime::createFromFormat("d. m. Y H:i", "07. 06. 2018 24:00");
        $reservation4->status = "Stornována";
        $reservation4->number_of_people = 10;
        $reservation4->customer_name = "Evžen David";
        $reservation4->customer_email = "e.david@mail.cz";
        $reservation4->note = "Posezení s přáteli";
        $reservation4->reservation_key = "bdu5969q3s578erE7vb1s";

        $reservation4->save();


        $reservation5 = New Reservation();

        $reservation5->reservation_start_time = DateTime::createFromFormat("d. m. Y H:i", "15. 05. 2018 12:00");
        $reservation5->reservation_end_time = DateTime::createFromFormat("d. m. Y H:i", "15. 05. 2018 14:00");
        $reservation5->status = "Potvrzena";
        $reservation5->number_of_people = 4;
        $reservation5->customer_name = "Filip Byznys";
        $reservation5->customer_email = "filipko.byznys@my-mail.cz";
        $reservation5->note = "Pracovní schůzka";
        $reservation5->reservation_key = "sd81v5a6vt1AV1616T8";

        $reservation5->save();


        $reservation6 = New Reservation();

        $reservation6->reservation_start_time = DateTime::createFromFormat("d. m. Y H:i", "08. 05. 2018 18:00");
        $reservation6->reservation_end_time = DateTime::createFromFormat("d. m. Y H:i", "08. 05. 2018 20:00");
        $reservation6->status = "Potvrzena";
        $reservation6->number_of_people = 2;
        $reservation6->customer_name = "Svatopluk Čech";
        $reservation6->customer_email = "svata-cech@mail.cz";
        $reservation6->note = "Večeře";
        $reservation6->reservation_key = "v46nb6VE1n2u9rtZ8E98";

        $reservation6->save();

        $reservation7 = New Reservation();

        $reservation7->reservation_start_time = DateTime::createFromFormat("d. m. Y H:i", "28. 05. 2018 20:00");
        $reservation7->reservation_end_time = DateTime::createFromFormat("d. m. Y H:i", "28. 05. 2018 24:00");
        $reservation7->status = "Zamítnuta";
        $reservation7->number_of_people = 50;
        $reservation7->customer_name = "Eva Horká";
        $reservation7->customer_email = "evca-hot@seznam.cz";
        $reservation7->note = "Rozlučkový večírek.";
        $reservation7->reservation_key = "D5HBH2entu8256D2NOM2W";

        $reservation7->save();

    }
}
