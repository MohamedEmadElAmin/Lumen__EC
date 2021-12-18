<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->json('GET', '/api/v1/transactions', [])
            ->seeJson(['success' => true]);

        $this->json('GET', '/api/v1/transactions', ['name' => 'Sally'])
            ->seeJson(['success' => true]);

        $this->json('GET', '/api/v1/transactions', ['provider' => 'xx23123123'])
            ->seeJson(['success' => true]);

        $this->json('GET', '/api/v1/transactions', ['statusCode' => 'paid'])
            ->seeJson(['status' => "paid"]);

        $this->json('GET', '/api/v1/transactions', ['statusCode' => 'pending'])
            ->seeJson(['status' => "pending"]);

        $this->json('GET', '/api/v1/transactions', ['statusCode' => 'reject'])
            ->seeJson(['status' => "reject"]);

        $this->json('GET', '/api/v1/transactions', ['currency' => 'EGP'])
            ->seeJson(['currency' => "EGP"]);

        $this->json('GET', '/api/v1/transactions', ['amount' => '500'])
            ->seeJson(['amount' => 500]);

        $this->json('GET', '/api/v1/transactions', ['amount' => '500' , 'currency' => 'EGP'])
            ->seeJson(['amount' => 500]);

        $this->json('GET', '/api/v1/transactions', ['amount' => '500' , 'currency' => 'EGP' ,
            'provider' => 'DataProviderW' , "phone" => "00201134567890"])
            ->seeJson(['amount' => 500]);

        $this->json('GET', '/api/v1/transactions', ['amount' => '500' , 'currency' => 'EGP' ,
            'provider' => 'DataProviderW' , "phone" => "00201134567890" , "id" => 12345678])
            ->seeJson(['amount' => 500]);

        $this->json('GET', '/api/v1/transactions', ['statusCode' => 'Paid' , 'amountMax' => 45 , 'amountMin' => 300 ,
            "provider" => "DataProviderY" , "currency" => "EGP"])
            ->seeJson(['success' => true]);
    }

    public function test2()
    {
        $response = $this->call('GET', '/api/v1/transactions');
        $this->assertEquals(200, $response->status());

        $response = $this->call('GET', '/api/v1/transactions?amountMax=300');
        $this->assertEquals(200, $response->status());
    }
}
