<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\State;

class StatesSeeds extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {   

        /**
        *   Agregar estados en Venezuela
        *
        */
        $state = new State();
        $state->country_id = Country::where('name', 'Venezuela')->value('id');
        $state->name = 'Distrito Capital';
        $state->save();

        $state = new State();
        $state->country_id = Country::where('name', 'Venezuela')->value('id');
        $state->name = 'Zulia';
        $state->save();

        $state = new State();
        $state->country_id = Country::where('name', 'Venezuela')->value('id');
        $state->name = 'Carabobo';
        $state->save();


        /**
        *   Agregar estados en Colombia
        *
        */
        $state = new State();
        $state->country_id = Country::where('name', 'Colombia')->value('id');
        $state->name = 'Distrito Capital Cundinamarca';
        $state->save();

        $state = new State();
        $state->country_id = Country::where('name', 'Colombia')->value('id');
        $state->name = 'Antioquia';
        $state->save();

        $state = new State();
        $state->country_id = Country::where('name', 'Colombia')->value('id');
        $state->name = 'Valle del Cauca';
        $state->save();


        /**
        *   Agregar estados en Ecuador
        *
        */
        $state = new State();
        $state->country_id = Country::where('name', 'Ecuador')->value('id');
        $state->name = 'Guayas';
        $state->save();

        $state = new State();
        $state->country_id = Country::where('name', 'Ecuador')->value('id');
        $state->name = 'Pichincha';
        $state->save();

        $state = new State();
        $state->country_id = Country::where('name', 'Ecuador')->value('id');
        $state->name = 'Azuay';
        $state->save();
    }
}
