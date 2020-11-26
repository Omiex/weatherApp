<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
		$weather = $this->getWeather();
		return view('weatherview', compact('weather'));
    }

	public function index($lat, $lon)
	{
		$weather = $this->getWeather($lat, $lon);
		return view('weatherview', compact('weather'));
	}

	function getWeather($lat = false, $lon = false)
	{
		$app_id = config("owm.app_id");
		$lat = $lat ? $lat : config("owm.lat_default");
		$lon = $lon ? $lon : config("owm.lon_default");

		$url = "https://api.openweathermap.org/data/2.5/onecall?lat=${lat}&lon=${lon}&exclude=minutely&appid=${app_id}";

		$client = new \GuzzleHttp\Client();
		$res = $client->get($url);

		if ($res->getStatusCode() == 200) {
		    $obj = $res->getBody();
			$weather = json_decode($obj);
		}
		
	    return $weather;
	}
}
