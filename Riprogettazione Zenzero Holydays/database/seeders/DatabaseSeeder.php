<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prenotazione;
use App\Models\Tariffa;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Christian Girardelli',
            'email' => 'c.girardelli@studenti.unibs.it',
            'password' => 'Christian20!',
            'role' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'Marco Rossi',
            'email' => 'marco.rossi@gmail.com',
            'password' => 'Marco1965!'
        ]);

        User::factory()->create([
            'name' => 'David Black',
            'email' => 'david.black@gmail.com',
            'password' => 'David300!'
        ]);

        $startDate = Carbon::create(2024, 9, 2);
        $endDate = Carbon::create(2024, 12, 31);
        $count = 0;

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $count++;
            if($count <= 4) {
                Tariffa::factory()->count(1)->create(['giorno' => $date, 'prezzo' => 70]);
            } else {
                Tariffa::factory()->count(1)->create(['giorno' => $date, 'prezzo' => 100]);
                if($count == 7) {
                    $count = 0;
                }
            }

        }


        $users = User::where('role', 'registered_user')->get(); // Only for registered users, not for admins

        foreach($users as $user)
        {
            $this->createUserWithPersonalBookings($user);
        }

        Prenotazione::factory()->create([
            'user_id' => $users[1]->id,
            'arrivo' => Carbon::create(2024, 12, 2),
            'partenza' => Carbon::create(2024, 12, 3),
            'numAdulti' => 2,
            'numBambini' => 0,
            'prezzoTotale' => 70,
            'nome' => 'Antonio',
            'cognome' => 'Ricci',
            'email' => 'antonio.ricci@gmail.com',
            'telefono' => '2135674932',
            'stato' => 'Italia',
            'orarioArrivo' => Carbon::createFromTime(15, 00)])->each(function ($prenotazione) {

            // Otteniamo le tariffe corrispondenti ai giorni della prenotazione
            $tariffe =  Tariffa::where('giorno', '>=', $prenotazione->arrivo)->where('giorno', '<', $prenotazione->partenza)->get();

            // Aggiorniamo il prenotazione_id delle tariffe corrispondenti
            foreach ($tariffe as $tariffa) {
                $tariffa->update(['prenotazione_id' => $prenotazione->id]);
            }
        });

        Prenotazione::factory()->create([
            'user_id' => $users[0]->id,
            'arrivo' => Carbon::create(2024, 12, 28),
            'partenza' => Carbon::create(2024, 12, 29),
            'numAdulti' => 2,
            'numBambini' => 0,
            'prezzoTotale' => 100,
            'nome' => 'Marco',
            'cognome' => 'Rossi',
            'email' => 'marco.rossi@gmail.com',
            'telefono' => '2135674678',
            'stato' => 'Italia',
            'orarioArrivo' => Carbon::createFromTime(16, 00)])->each(function ($prenotazione) {

            // Otteniamo le tariffe corrispondenti ai giorni della prenotazione
            $tariffe =  Tariffa::where('giorno', '>=', $prenotazione->arrivo)->where('giorno', '<', $prenotazione->partenza)->get();

            // Aggiorniamo il prenotazione_id delle tariffe corrispondenti
            foreach ($tariffe as $tariffa) {
                $tariffa->update(['prenotazione_id' => $prenotazione->id]);
            }
        });

    }

    private function createUserWithPersonalBookings($user) {

        Prenotazione::factory()->count(5)->create(['user_id' => $user->id])->each(function ($prenotazione) {
            // Otteniamo le tariffe corrispondenti ai giorni della prenotazione

            $tariffe =  Tariffa::where('giorno', '>=', $prenotazione->arrivo)->where('giorno', '<', $prenotazione->partenza)->get();

            // Aggiorniamo il prenotazione_id delle tariffe corrispondenti
            foreach ($tariffe as $tariffa) {
                $tariffa->update(['prenotazione_id' => $prenotazione->id]);
            }
        });
    }
}
