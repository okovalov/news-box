<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsTopic;

class NewsTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = NewsTopic::latest()
            ->take(config('newsbox.newstopic.page_size'))->get();

        return view('newsTopic.index', compact('active'));
    }
}
