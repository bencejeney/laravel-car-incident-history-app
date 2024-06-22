<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Incident;
use App\Models\SearchHistory;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        $faker = Faker::create();

        $adminUser = [
            'name' => $faker->name,
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'is_premium' => true,
        ];
        DB::table('users')->insert($adminUser);

        $regularUser = [
            'name' => $faker->name,
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'is_premium' => $faker->boolean(50),
        ];
        DB::table('users')->insert($regularUser);

        // Járművek létrehozása
        $vehicle = [
            'license_plate' => $faker->unique()->regexify('[A-Z0-9]{6}'),
            'brand' => $faker->word,
            'type' => $faker->word,
            'manufacture_year' => $faker->numberBetween(2000, 2023),
            'image' => $faker->imageUrl(),
        ];
        DB::table('vehicles')->insert($vehicle);

        // Káresemények létrehozása
        $incident = [
            'location' => $faker->address,
            'datetime' => $faker->dateTimeBetween('-1 year', 'now'),
            'description' => $faker->sentence,
        ];
        DB::table('incidents')->insert($incident);

        // Keresési előzmények létrehozása
        $searchHistory = [
            'searched_license_plate' => $faker->regexify('[A-Z0-9]{6}'),
            'search_time' => $faker->dateTimeBetween('-1 month', 'now'),
            'user_id' => 2, // Minta felhasználó
        ];
        DB::table('search_histories')->insert($searchHistory);

        // Jármű - Káresemény kapcsolatok létrehozása
        DB::table('incident_vehicle')->insert([
            'incident_id' => 1,
            'vehicle_id' => 1,
        ]);
        */

        // Feltöltés néhány prémium és nem prémium felhasználóval
        $users = User::factory(5)->create();
        $adminUser = User::factory()->create([
            'name' => 'Bence Jéney',
            'email' => 'jeney.bence@gmail.com',
            'password' => Hash::make('abcd1234'),
            'is_admin' => true,
            'is_premium' => true,
        ]);

        // Feltöltés néhány járművel
        $vehicles = Vehicle::factory(10)->create();

        // Feltöltés néhány káreseménnyel, figyelembe véve a jármű-kapcsolatokat
        $incidents = Incident::factory(3)->create();
        foreach ($incidents as $incident) {
            $incident->vehicles()->attach($vehicles->random(), ['description' => 'Collision']);
        }

        // Feltöltés néhány keresési előzménnyel, figyelembe véve a felhasználó-kapcsolatokat
        $searchHistories = SearchHistory::factory(5)->create();
        foreach ($searchHistories as $searchHistory) {
            $searchHistory->user()->associate($users->random())->save();
        }

        $this->command->info('Adatbázis feltöltve teszt adatokkal.');
    }
}
