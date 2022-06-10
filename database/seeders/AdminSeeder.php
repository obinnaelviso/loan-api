<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::find(1);
        if ($admin && $admin->hasRole(RoleEnum::ADMIN)) {
            echo ('Error! Database must be empty to seed! \n');
        } else {
            $user = User::create([
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@flexpadi.com',
                'email_verified_at' => now(),
                'phone' => '2348012345678',
                'phone_verified_at' => now(),
                'password' => bcrypt('1234567890'),
                'status_id' => status_active_id(),
            ]);
            $user->info()->create(['status_id' => status_pending_id()]);
            $user->wallet()->create(['status_id' => status_active_id()]);
            $user->assignRole(RoleEnum::ADMIN);
        }
    }
}
