<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
	private $cities = [
		[
			'name' => 'Jakarta',
			'latlon' => ''
		],
		[
			'name' => 'Bandung',
			'latlon' => '-6.917464/107.619125'
		],
		[
			'name' => 'Semarang',
			'latlon' => '-7.005145/110.438126'
		],
		[
			'name' => 'Surabaya',
			'latlon' => '-7.257472/112.752090'
		],
		[
			'name' => 'Denpasar',
			'latlon' => '-8.670458/115.212631'
		],
	];

	// handle request without lat & lon
    public function __invoke()
    {
		$cities = $this->cities;
		$weather = $this->getWeather();
		return view('weatherview', compact('weather', 'cities'));
    }

	// handle request with lat & lon
	public function index($lat, $lon)
	{
		$cities = $this->cities;
		$weather = $this->getWeather($lat, $lon);
		return view('weatherview', compact('weather', 'cities'));
	}

	// get weather information from the API
	function getWeather($lat = false, $lon = false)
	{
		// initialize variable
		$app_id = config("owm.app_id");
		$lat = $lat ? $lat : config("owm.lat_default");
		$lon = $lon ? $lon : config("owm.lon_default");
		$lang = 'id';
		$units = 'metric';

		// the url to get weather information
		$url = "https://api.openweathermap.org/data/2.5/onecall?lat=${lat}&lon=${lon}&exclude=minutely,daily&lang=${lang}&units=${units}&appid=${app_id}";

		// execute
		$client = new \GuzzleHttp\Client(['http_errors' => false]);
		$res = $client->get($url);
		$status = $res->getReasonPhrase();
		$statusCode = $res->getStatusCode();

		if ($statusCode == 200) {		// convert json to php object when success
		    $obj = $res->getBody();
			$weather = json_decode($obj);
			return $weather;
		} elseif ($statusCode == 400) {
			return redirect('/');
		} elseif ($statusCode > 400) { 	// show error based on status code
			abort($statusCode, $status);
		} else { 						// show other errors
			abort(500, $status);
		}
	}
}
