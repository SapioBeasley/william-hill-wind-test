<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\WeatherClient;

/**
 * Class WindController
 * @package App\Http\Controllers
 */
class WindController extends Controller
{
    /** @var WeatherClient $weatherClient */
    protected $weatherClient;

    /**
     * WindController constructor.
     * @param WeatherClient $weatherClient
     */
    public function __construct(WeatherClient $weatherClient)
    {
        $this->weatherClient = $weatherClient;
    }

    /**
     * @param Request $request
     * @return bool|mixed|string
     */
    public function getbByZip(Request $request)
    {
        // Validate the request
        $validate = $this->weatherClient->validateRequest($request);

        if ($validate !== true) {
            return $validate;
        }

        // Return resource
        return $this->weatherClient->windByZip($request->zipCode);
    }
}
