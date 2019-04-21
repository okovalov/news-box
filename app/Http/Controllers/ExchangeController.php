<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use App\Services\ExchangeService;

class ExchangeController extends Controller
{
    /**
     * Exchange Service
     *
     * @var ExchangeService
     */
    protected $service;

    public function __construct(ExchangeService $service)
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
        $seconds = config('newsbox.exchange.cache_expiration_seconds.exchange_list');

        $pairsList = Cache::remember('pairsList', $seconds, function () {
            return config('newsbox.exchange.currency_pairs_list');
        });

        return view('exchange.index', compact('pairsList'));
    }

    /**
     * Apin entry point for the specific currency pair exchange rate
     *
     * @param Request $request
     * @return Response
     */
    public function show(Request $request)
    {
        $exchange = $this->service->fetchData($request->from, $request->to);

        return response()->json(['data' => $exchange]);
    }
}
