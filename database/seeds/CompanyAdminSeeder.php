<?php

use Illuminate\Database\Seeder;
use App\CompanyAdmin;

class CompanyAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("TRUNCATE TABLE company_admins RESTART IDENTITY CASCADE");
        CompanyAdmin::create([
            'company_id'=>'1',
            'name'=>'Test company',
            'email'=>'user_a@email.com',
            'contact_number'=>'746874834',
            'status'=>'active'
        ]);
        CompanyAdmin::create([
            'company_id'=>'1',
            'name'=>'User b',
            'email'=>'user_b@gmail.com',
            'contact_number'=>'81934567654',
            'status'=>'active'
        ]);
        CompanyAdmin::create([
            'company_id'=>'2',
            'name'=>'User 2',
            'email'=>'user_2@gmail.com',
            'contact_number'=>'839334556',
            'status'=>'active'
        ]);
        CompanyAdmin::create([
            'company_id'=>'2',
            'name'=>'Cuse',
            'email'=>'user_c@gmail.com',
            'contact_number'=>'987654321',
            'status'=>'active'
        ]);
        CompanyAdmin::create([
            'company_id'=>'2',
            'name'=>'User 3',
            'email'=>'user_3@email.com',
            'contact_number'=>'7987756434',
            'status'=>'active'
        ]);
    }
}
