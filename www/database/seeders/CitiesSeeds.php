<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;
use App\Models\City;

class CitiesSeeds extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {   
        /**
        *   Agregar ciudades en los estados de Venezuela
        *
        */
        $city = new City();
        $city->state_id = State::where('name', 'Distrito Capital')->value('id');
        $city->name = 'Caracas';
        $city->save();

        $city = new City();
        $city->state_id = State::where('name', 'Zulia')->value('id');
        $city->name = 'Maracaibo';
        $city->save();

        $city = new City();
        $city->state_id = State::where('name', 'Carabobo')->value('id');
        $city->name = 'Valencia';
        $city->save();


        /**
        *   Agregar ciudades en los departamentos de Colombia
        *
        */
        $city = new City();
        $city->state_id = State::where('name', 'Distrito Capital Cundinamarca')->value('id');
        $city->name = 'Bogotá';
        $city->save();

        $city = new City();
        $city->state_id = State::where('name', 'Antioquia')->value('id');
        $city->name = 'Medellín';
        $city->save();

        $city = new City();
        $city->state_id = State::where('name', 'Valle del Cauca')->value('id');
        $city->name = 'Cali';
        $city->save();



        /**
        *   Agregar ciudades en las provincias de Ecuador
        *
        */
        $city = new City();
        $city->state_id = State::where('name', 'Guayas')->value('id');
        $city->name = 'Guayaquil';
        $city->save();

        $city = new City();
        $city->state_id = State::where('name', 'Pichincha')->value('id');
        $city->name = 'Quito';
        $city->save();

        $city = new City();
        $city->state_id = State::where('name', 'Azuay')->value('id');
        $city->name = 'Cuenca';
        $city->save();
    }
}
