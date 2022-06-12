<?php

namespace Database\Seeders;

use App\Models\LoanPackage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoanPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loanPackage = LoanPackage::find(1);
        if (!$loanPackage) {
            $package1 = [
                'name' => 'Urgent 2k',
                'loan_score' => 10,
                'amount' => 2000,
                'percentage' => 10,
                'duration' => 7,
                'status_id' => status_active_id()
            ];

            $package2 = [
                'name' => 'Student Loan',
                'loan_score' => 10,
                'amount' => 5000,
                'percentage' => 10,
                'duration' => 14,
                'status_id' => status_active_id()
            ];

            $package3 = [
                'name' => 'Personal Loan',
                'loan_score' => 30,
                'amount' => 10000,
                'percentage' => 14,
                'duration' => 30,
                'status_id' => status_active_id()
            ];

            $package4 = [
                'name' => 'Urgent Business Loan',
                'loan_score' => 50,
                'amount' => 15000,
                'percentage' => 14,
                'duration' => 14,
                'status_id' => status_active_id()
            ];

            $package5 = [
                'name' => 'Business Loan',
                'loan_score' => 50,
                'amount' => 25000,
                'percentage' => 30,
                'duration' => 30,
                'status_id' => status_active_id()
            ];
            LoanPackage::create($package1);
            LoanPackage::create($package2);
            LoanPackage::create($package3);
            LoanPackage::create($package4);
            LoanPackage::create($package5);
        } else {
            echo("Loan Package already seeded!\n");
        }
    }
}
