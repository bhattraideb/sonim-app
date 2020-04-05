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
    public function a_company_can_be_added()
    {
        $this->withExceptionHandling();
        $this->loginWithFakeUser();

        $attributes = [
            'name'              =>  'Unit Test company',
            'address'           =>  'Banglore',
            'email'             =>  'test_company@gmail.com',
            'contact_number'    =>  '876576898765',
            'status'            =>  'active',
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
            'name'              =>  '',
            'address'           =>  'Banglore',
            'email'             =>  'test_company@gmail.com',
            'contact_number'    =>  '876576898765',
            'status'            =>  'active'
        ];
        $response = $this->post('/company/create', $attributes);
        $response->assertSessionHasErrors('name');
        $this->addToAssertionCount(1);
    }

    /** @test */
    public function a_address_is_required()
    {
        $this->withExceptionHandling();
        $this->loginWithFakeUser();

        $attributes = [
            'name'              =>   'Unit Test company',
            'address'           => '',
            'email'             =>  'test_company@gmail.com',
            'contact_number'    =>  '876576898765',
            'status'            =>  'active',
        ];
        $response = $this->post('/company/create', $attributes);
        $response->assertSessionHasErrors('address');
        $this->addToAssertionCount(1);
    }

    /** @test */
    public function a_email_is_required()
    {
        $this->withExceptionHandling();
        $this->loginWithFakeUser();

        $attributes = [
            'name'              =>  'Unit Test company',
            'address'           =>  'Banglore',
            'email'             =>  '',
            'contact_number'    => '876576898765',
            'status'            =>  'active',
        ];
        $response = $this->post('/company/create', $attributes);
        $response->assertSessionHasErrors('email');
        $this->addToAssertionCount(1);
    }

    /** @test */
    public function a_contact_number_is_required()
    {
        $this->withExceptionHandling();
        $this->loginWithFakeUser();

        $attributes = [
            'name'              =>  'Unit Test company',
            'address'           =>  'Banglore',
            'email'             =>  'test_company@gmail.com',
            'contact_number'    =>  '',
            'status'            =>  'active',
        ];
        $response = $this->post('/company/create', $attributes);
        $response->assertSessionHasErrors('contact_number');
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

    /** @test */
    public function a_company_can_be_updated()
    {
        $this->loginWithFakeUser();
        $this->withoutExceptionHandling();
        $attributes = [
            'name'              =>  'Unit Test company',
            'address'           => 'Banglore',
            'email'             =>  'test_company@gmail.com',
            'contact_number'    =>  '876576898765',
            'status'            =>  'active',
        ];
        $this->post('/company/create', $attributes);

        $company = Company::first();

        $update_attributes = [
            'name'              =>  'Company Updated',
            'address'           =>  'Banglore, India',
            'email'             =>  'updated.email@gmail.com',
            'contact_number'    =>  '7846787763',
            'status'            =>  'active',
        ];
        $response = $this->patch('/company/update/'.$company->id , $update_attributes);
        $this->assertEquals('Company Updated', Company::first()->name);
        $this->assertEquals('Banglore, India', Company::first()->address);
        $this->assertEquals('updated.email@gmail.com', Company::first()->email);
        $this->assertEquals('7846787763', Company::first()->contact_number );
    }

}
