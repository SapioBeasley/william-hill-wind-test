<?php

namespace App\Lib;

use GuzzleHttp\Client;
use JMS\Serializer\SerializerBuilder;

/**
 * Class WeatherClient
 * @package App\Lib
 */
class WeatherClient
{
    /** @var \JMS\Serializer\Serializer $serializerBuilder */
    protected $serializerBuilder;

    /** @var $body */
    protected $body;

    /** @var $wind */
    protected $wind;

    /** @var CacheDecorator $cacheDecorator */
    protected $cacheDecorator;

    /**
     * WeatherClient constructor.
     * @param SerializerBuilder $serializerBuilder
     * @param CacheInterface $cacheDecorator
     */
    public function __construct(SerializerBuilder $serializerBuilder, CacheInterface $cacheDecorator)
    {
        $this->serializerBuilder = $serializerBuilder->create()->build();

        $this->cacheDecorator = $cacheDecorator;
    }

    /**
     * @param $zipCode
     * @return mixed
     */
    public function windByZip($zipCode)
    {
        $uri = '/data/2.5/weather?zip=' . $zipCode . ',us&APPID=' . env('WEATHER_API_KEY');

        return $this->cacheDecorator->remember($zipCode, 15, function () use ($uri) {
            $client = new Client([
                'base_uri' => env('WEATHER_BASE_URL')
            ]);

            $response = $client->request('GET', $uri);

            $this->setBody($response->getBody());

            $this->setWind();

            $data = [
                'speed' => $this->getWindSpeed(),
                'direction' => $this->getWindDirection()
            ];

            return $this->serializerBuilder->serialize($data, 'json');
        });
    }

    /**
     * @param $input
     * @return bool|mixed|string
     */
    public function validateRequest($input)
    {
        if (!isset($input->zipCode)) {
            return $this->serializerBuilder->serialize([
                'success' => false,
                'message' => 'ZipCode was not supplied'
            ], 'json');
        }

        return true;
    }

    /**
     * Return wind speed
     *
     * @return mixed
     */
    private function getWindSpeed()
    {
        if (!isset($this->wind->speed)) {
            return $this->wind->deg = 0;
        }

        return $this->wind->speed;
    }

    /**
     * Return wind direction in degrees
     *
     * @return mixed
     */
    private function getWindDirection()
    {
        if (!isset($this->wind->deg)) {
            return $this->wind->deg = 0.0;
        }

        return $this->wind->deg;
    }

    /**
     * @param $content
     */
    private function setBody($content)
    {
        $this->body = json_decode($content);
    }

    /**
     * Set wind information
     */
    private function setWind()
    {
        $this->wind = $this->body->wind;
    }
}