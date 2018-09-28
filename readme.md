## Weather Service

The business wants a web service developed that returns current weather information for a mobile client user based on their current zipcode.

#### Constraints
- [x] Framework: Laravel 5.5 or Lumen 5.5
- [x] HTTP Library: Guzzle
- [x] Dependency Manager: Composer
- [x] Hydration: Symfony Serializer or JMS Serializer
- [x] Test Framework: PHPUnit
- [x] Coding Style Guide: PSR-2                                                             

#### Design Goals
- [x] Keep controllers skinny.
- [x] Implement an adapter/wrapper for the client class responsible for getting the weather data.
- [x] Implement the cache as a decorator for the weather client.
- [x] Bind services to an interface (not an implementation) in the service container.

#### Functional Requirements
- [x] Consume weather data from https://openweathermap.org/.
- [x] Provide an HTTP GET /wind/{zipCode} method that takes a zipcode as a required path parameter and returns a wind resource.
- [x] Validates input data.
- [x] Response format should be JSON.
- [x] Cache the resource for 15 minutes to avoid expensive calls to the OpenWeatherMap API.
- [x] Provide a CLI command that will bust the cache if needed.
- [x] Response fields should include: Wind Speed and Wind Direction

#### Unit Testing Requirements
- [x] Use mock responses from the OpenWeatherMap API.
- [x] Use mocks when interacting with the cache layer.

#### How To Run
1. Clone the repository.
2. Install dependencies: `$ composer install`
3. Update `.env` with WEATHER_API_KEY value.
4. Run the built-in web server: `$ php artisan serve`
5. The wind resource should now be accessible by running a curl command: `$ curl -x http://localhost:8000/api/v1/wind/89101`

** NOTE: All code challenges should be hosted on a publicly accessible git repository (i.e. GitHub, BitBucket, etc).
