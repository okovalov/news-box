<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsTopic;

class NewsTopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = NewsTopic::latest()->take(5)->get();

        return view('newsTopics.index', compact('active'));
    }
}
