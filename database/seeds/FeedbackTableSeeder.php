<?php

use App\Models\Feedback;
use Illuminate\Database\Seeder;

class FeedbackTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contacts = [
            "Daniel Dušek",
            "Anna Popková",
            "David Říha",
            "Filip Kalous",
            "nedam@nic.kontakt",
            "721852555",
            "ICQ: 555666444",
            "Skype: zdenek.pohlreich"
        ];

        $texts = [
            "Dobrý den, jídlo ve Vaší restauraci je schůdný, ale obsluha tedy ani zdaleka ne. Pokaždé, když si někde objednávám hranolky, tak k tomu rád jím hořčici. Obsluha se nad tím velice nasmála, ale hořčici mi k hranolkám nepřinesla. Jsem velmi zklamán svojí návštěvou zde.",
            "Příjemná restaurace v rodinném duchu s příjemnou obsluhou a dobrým jídlem. Líbilo se mi u Vás.",
            "Rychlý internet je základem každého slušně fungujícího podniku. Vy ho nemáte.",
            "Přišel jsem hlavně kvůli exotickým jídlům, abych si zvykl svému trávicímu ústrojí před cestou do Thajska. Nebyl jsem zklamán. Jídlo dobré, ceny slušné, obsluha příjemná. 7/10.",
            "Nechutnalo mi u Vás, u Zběhlíků vaří líp. Měli byste na sobě zamakat.",
            "Dobrý den! Je u Vás možné hostovat rodinnou oslavu pro +- 50 lidí? Ozvěte se mi prosím na telefon. S pozdravem, Jaroslav Barvič.",
            "I stopped at your restaurant on my travels across Czech Republic to try out a little bit of czech cuisine and I must say: I was not disappointed. Keep the good work up guys!",
            "Poslyš šéfe, tvoje jídlo byla fakt bomba. Skoro bych ti dal i hvězdičku, kdyby ses přihlásil do naší televizní show. Ale to ty ne, žejo, bejku! Takže když už nic, tak aspoň pochvala tady. Zdenek."
        ];

        for ($i = 0 ; $i < count($contacts); $i++)
        {
            $feedback = new Feedback();
            $feedback->contact = $contacts[$i];
            $feedback->text = $texts[$i];
            $feedback->save();
        }
    }
}
