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
            'password' => 'christian',
            'role' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'Marco Rossi',
            'email' => 'marco.rossi@gmail.it',
            'password' => 'marco'
        ]);

        User::factory()->create([
            'name' => 'David Black',
            'email' => 'david.black@gmail.it',
            'password' => 'david'
        ]);
        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */

         // Popolare la tabella delle prenotazioni
         /* Prenotazione::factory()->count(10)->create()->each(function ($prenotazione) {
             // Per ogni prenotazione creata, popolare la tabella delle tariffe
             // Ottenere le date di arrivo e partenza dalla prenotazione
             $arrivo = Carbon::parse($prenotazione->arrivo);
             $partenza = Carbon::parse($prenotazione->partenza);
             
             // Calcolare i giorni di pernottamento
             $days = $partenza->diffInDays($arrivo);
             
             // Creare una tariffa per ogni giorno di pernottamento
             for ($i = 0; $i < $days; $i++) {
                 // Aggiungere $i giorni alla data di arrivo per ottenere la data della tariffa
                 $giorno = $arrivo->copy()->addDays($i);
                 
                 // Creare la tariffa associata alla prenotazione corrente
                 Tariffa::factory()->count(1)->create([
                     'giorno' => $giorno,
                     'prenotazione_id' => $prenotazione->id,
                 ]);
             }
         });

         Tariffa::factory()->count(10)->create();
 */

        $startDate = Carbon::create(2024, 06, 1);
        $endDate = Carbon::create(2024, 12, 31);
        $price = 100;

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            Tariffa::factory()->count(1)->create(['giorno' => $date, 'prezzo' => $price ]);

        }


        $users = User::where('role', 'registered_user')->get(); // Only for registered users, not for admins

        foreach($users as $user)
        {
            $this->createUserWithPersonalBookings($user);
        }

        
/*
        Prenotazione::factory()->count(1)->create([
            'arrivo' => '2024-05-08',
            'partenza' => '2024-05-10',
        ]);
        Prenotazione::factory()->count(1)->create([
            'arrivo' => '2024-05-10',
            'partenza' => '2024-05-11',
        ]);
        Prenotazione::factory()->count(1)->create([
            'arrivo' => '2024-05-11',
            'partenza' => '2024-05-14',
        ]);
          */
 
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
