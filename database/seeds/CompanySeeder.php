<?php

use Illuminate\Database\Seeder;
use App\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("TRUNCATE TABLE companies RESTART IDENTITY CASCADE");
        Company::create([
            'name'=>'Test company',
            'address' => 'Banglore',
            'email'=>'test_company@gmail.com',
            'contact_number'=>'876576898765',
            'status'=>'active'
        ]);
        Company::create([
            'name'=>'Test company seed',
            'address' => 'Delhi, India',
            'email'=>'seed_company@gmail.com',
            'contact_number'=>'9787343477',
            'status'=>'active'
        ]);
    }
}
