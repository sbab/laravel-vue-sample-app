<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash; 

use App\Models\Country;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;

class DefaultData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inserts the default countries
        $csvFile = fopen(base_path("database/data/default_countries_data.csv"), "r");
        $firstline = true;

        while (($data = fgetcsv($csvFile, null, ",")) !== FALSE) {
            if (!$firstline) {
                $currentCountry = Country::where('id', '=', $data['1'])->first();

                if ($currentCountry === null) {
                    Country::create([
                        'id' => $data['1'],
                        'name' => $data['0'],
                        'alpha_3' => $data['2'],
                        'numeric_3' => $data['3'],
                    ]);   
                } 
            }

            $firstline = false;
        }
   
        fclose($csvFile);

        //Inserts the default admin role

        $adminRole = Role::where('name', '=', 'admin')->first();

        if ($adminRole === null) {
            $adminRole = Role::create([
                'name' => 'admin'
            ]);
        }

        //Inserts the default root user

        $rootFirstEmail = config('app.root_user_first_email');
        $rootFirstPassword = config('app.root_user_first_password');
        

        $rootUser = User::where('email', '=', $rootFirstEmail)->first();
        
        if ($rootUser === null) {
            $rootUser = User::create([
                'email' => $rootFirstEmail,
                'password_hash' => Hash::make($rootFirstPassword),                
            ]);
        }

        //Assigns the admin role to the default root user if needed

        $rootAdminRole = UserRole::where([
            ['user_id', '=', $rootUser->id],
            ['role_id', '=', $adminRole->id],
        ])->first();
            
        if ($rootAdminRole === null) {
            UserRole::create([
                'user_id' => $rootUser->id,
                'role_id' => $adminRole->id,
            ]);
        }
    }
}
