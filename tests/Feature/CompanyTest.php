<?php

namespace Tests\Feature;

use App\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class CompanyTest extends TestCase
{
    use  RefreshDatabase;

    /** @test */
    public function a_user_can_add_company()
    {
        $this->withExceptionHandling();

        $this->loginWithFakeUser();

        $attributes = [
            'name'=>'Unit Test company',
            'address' => 'Banglore',
            'email'=>'test_company@gmail.com',
            'contact_number'=>'876576898765',
            'status'=>'active'
        ];
        $response = $this->post('/company/create', $attributes);
        $this->assertCount(1, Company::all());
    }

    /** @test */
    public function a_name_is_required()
    {
        $this->withExceptionHandling();

        $this->loginWithFakeUser();

        $attributes = [
            'name' => '',
            'address' => 'Banglore',
            'email' => 'test_company@gmail.com',
            'contact_number' => '876576898765',
            'status' => 'active'
        ];
        $response = $this->post('/company/create', $attributes);
        $response->assertSessionHasErrors('name');
        $this->addToAssertionCount(1);
    }

    /** @test */
    public function a_user_can_delete_company()
    {
        $this->withExceptionHandling();

        $this->loginWithFakeUser();
        $attributes = [
            'id' => 5,
            ];

        $response = $this->get('/company/delete/', $attributes);
        $this->addToAssertionCount(1);
    }
}
