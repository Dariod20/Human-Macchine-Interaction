<?php

namespace Database\Factories;

use App\Models\Prenotazione;
use App\Models\Tariffa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class PrenotazioneFactory extends Factory
{
    protected $model = Prenotazione::class;

    public function definition()
    {

        do{
            $arrivo = $this->faker->unique()->dateTimeBetween('2024-06-01', '2024-12-31')->format('Y-m-d');
            $partenza = Carbon::parse($arrivo)->addDays($this->faker->numberBetween(1, 3))->format('Y-m-d');


            $sovrapposizioni = Prenotazione::where('arrivo', '<=', $partenza)->where('partenza', '>=', $arrivo)->exists();
            $esatto = Prenotazione::where('arrivo', '=', $arrivo)
            ->where('partenza', '=', $partenza)
            ->exists();

        } while($sovrapposizioni || $esatto);


        // Estrai le tariffe per ciascun giorno di pernottamento e calcola il costo totale
        $prezzoTotale = Tariffa::where('giorno', '>=', $arrivo)->where('giorno', '<', $partenza)->sum('prezzo');
        // Calcoliamo il prezzo totale della prenotazione
        

        
        
        return [
            'arrivo' => $arrivo,
            'partenza' => $partenza,
            'numAdulti' => $this->faker->numberBetween(1, 4),
            'numBambini' => $this->faker->numberBetween(0, 3),
            'prezzoTotale' => $prezzoTotale,
            'nome' => $this->faker->firstName,
            'cognome' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'telefono' => $this->faker->phoneNumber,
            'stato' => $this->faker->country,
            'orarioArrivo' => $this->faker->time,
        ];
    }
}



/* 
<?php

namespace Database\Factories;

use App\Models\Prenotazione;
use Illuminate\Database\Eloquent\Factories\Factory;


 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prenotazione>

class PrenotazioneFactory extends Factory
{
    protected $model = Prenotazione::class;

    public function definition()
    {
         // Genera date casuali per arrivo e partenza
        $arrivo = $this->faker->unique()->dateTimeBetween('-30 days', 'now');
        $partenza = $this->faker->unique()->dateTimeBetween($arrivo, '+3 days');

        // Verifica se esistono prenotazioni che si sovrappongono con quelle generate
        //User::where('email', '=', Input::get('email'))->count() > 0
        $sovrapposizioni = Prenotazione::where('arrivo', '<=', $partenza)->where('partenza', '>=', $arrivo)->exists();

        while($sovrapposizioni){
            // Se esistono sovrapposizioni, ripeti il processo finché non ottieni date non sovrapposte
            $arrivo = $this->faker->dateTimeBetween('-30 days', 'now');
            $partenza = $this->faker->dateTimeBetween($arrivo, '+3 days');
            $sovrapposizioni = Prenotazione::where('arrivo', '<=', $partenza)->where('partenza', '>=', $arrivo)->exists();
        }
    
        return [
            'arrivo' => $arrivo,
            'partenza' => $partenza,
            'numAdulti' => $this->faker->numberBetween(1, 5),
            'numBambini' => $this->faker->numberBetween(0, 3),
            'prezzoTotale' => $this->faker->numberBetween(300, 600),
            'nome' => $this->faker->name(),
            'cognome' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'telefono' => $this->faker->e164PhoneNumber(),
            'stato' => $this->faker->country(),
            'orarioArrivo' => $this->faker->time(),
        ];
    }
} */




    /* public function definition(): array
    {
        return [
            'arrivo' => $this->faker->date(),
            'partenza' => $this->faker->date(),
            'numAdulti' => $this->faker->numberBetween(1,5), //1-5, bamb 0-3
            'numBambini' => $this->faker->numberBetween(0,3), //1-5, bamb 0-3
            'prezzoTotale' => $this->faker->numberBetween(300,600),
            'nome' => $this->faker->name(),
            'cognome' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'telefono' => $this->faker->e164PhoneNumber(),
            'stato' => $this->faker->country(),
            'orarioArrivo' => $this->faker->time(),
        ];
    } */


