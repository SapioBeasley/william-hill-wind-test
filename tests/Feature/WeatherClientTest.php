<?php

namespace Tests\Feature;

use Tests\TestCase;

class WeatherClientTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->weatherClient = $this->app->make('App\Lib\WeatherClient');
    }

    public function testWindByZip()
    {
        $response = $this->weatherClient->windByZip('89011');
        $response = json_decode($response);

        $this->assertObjectHasAttribute('speed', $response);
        $this->assertObjectHasAttribute('direction', $response);
    }

    public function testValidationGood()
    {
        $input = new \Request();
        $input->zipCode = 89011;

        $validate = $this->weatherClient->validateRequest($input);

        $this->assertTrue($validate);
    }

    public function testValidationFail()
    {
        $input = new \Request();

        $validate = $this->weatherClient->validateRequest($input);
        $validate = json_decode($validate);

        $this->assertFalse($validate->success);
        $this->assertEquals($validate->message, 'ZipCode was not supplied');
    }
}
