<?php

namespace Tests\Feature;

use App\CompanyAdmin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyAdminTest extends TestCase
{
    use  RefreshDatabase;
    /** @test */
    public function a_user_can_add_company_admin()
    {
        $this->withExceptionHandling();

        $this->loginWithFakeUser();

        $attributes = [
            'company_id'    => '1',
            'name'          => 'Admin1',
            'email'         => 'user_b@gmail.com',
            'contact_number'=>'81934567654',
            'status'        => 'active'
        ];

        $response = $this->post('/company/admin/create', $attributes);
        $this->addToAssertionCount(1);
    }

    /** @test */
    public function a_user_can_delete_company_admin()
    {
        $this->withExceptionHandling();

        $this->loginWithFakeUser();
        $attributes = [
            'id' => 12,
        ];

        $response = $this->get('/company/admin/delete/', $attributes);
        $this->addToAssertionCount(1);
    }

}
