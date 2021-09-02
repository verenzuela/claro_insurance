<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeds extends Seeder
{
   /**
   * Run the database seeds.
   *
   * @return void
   */
   public function run()
   {
       
     $user = new User();
     $user->setAttribute('email', 'admin@admin.com');
     $user->setAttribute('password', bcrypt('admin'));
     $user->setAttribute('name', 'Administrador');
     $user->setAttribute('phone_number', '0962981079');
     $user->setAttribute('num_docm_identity', '1759164179');
     $user->setAttribute('date_of_birth', date('y-m-d', strtotime('1982-10-26')));
     $user->setAttribute('is_admin', true);
     $user->setAttribute('city_id', 1);
     $user->save();



   }
}
