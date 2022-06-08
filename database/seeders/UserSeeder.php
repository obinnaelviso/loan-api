<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);
        if ($user && $user->hasRole(RoleEnum::USER)) {
            echo ('Error! Database must be empty to seed! \n');
        } else {
            $john = User::create([
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'johndoe@flexpadi.com',
                'email_verified_at' => now(),
                'password' => bcrypt('1234567890'),
                'status_id' => status_active_id(),
            ]);
            $jane = User::create([
                'first_name' => 'Jane',
                'last_name' => 'Doe',
                'email' => 'janedoe@bluesinventory.com',
                'email_verified_at' => now(),
                'password' => bcrypt('1234567890'),
                'status_id' => status_active_id()
            ]);
            $john->info()->create(['status_id' => status_pending_id()]);
            $jane->info()->create(['status_id' => status_pending_id()]);
            $john->wallet()->create(['status_id' => status_active_id()]);
            $jane->wallet()->create(['status_id' => status_active_id()]);
            $john->assignRole(RoleEnum::USER);
            $jane->assignRole(RoleEnum::USER);
        }
    }
}
