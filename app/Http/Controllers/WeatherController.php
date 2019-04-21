<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Weather;
use Illuminate\Support\Facades\Cache;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    /**
     * Weather Service
     *
     * @var WeatherService
     */
    protected $service;

    public function __construct(WeatherService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seconds = config('newsbox.weather.cache_expiration_seconds.location_list');

        $locationList = Cache::remember('locationList', $seconds, function () {
            return config('newsbox.weather.location_list');
        });

        return view('weather.index', compact('locationList'));
    }

    /**
     * Apin entry point for the specific weather location
     *
     * @param Request $request
     * @return Response
     */
    public function show(Request $request)
    {
        $weather = $this->service->fetchData($request->location);

        return response()->json(['data' => $weather]);
    }
}
