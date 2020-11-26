<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
	// handle request without lat & lon
    public function __invoke()
    {
		$weather = $this->getWeather();
		return view('weatherview', compact('weather'));
    }

	// handle request with lat & lon
	public function index($lat, $lon)
	{
		$weather = $this->getWeather($lat, $lon);
		return view('weatherview', compact('weather'));
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
		} elseif ($statusCode > 400) { 	// show error based on status code
			abort($statusCode, $status);
		} else { 						// show other errors
			abort(500, $status);
		}
	}
}
