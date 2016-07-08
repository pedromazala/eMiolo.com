<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class NasaController extends Controller
{

    CONST API_URL = "https://api.nasa.gov/";
    CONST API_KEY = "REKx7L69Kg5mrSy6KkOV0bGMIiQ3ZHGu3lerYN1k";

    public function index()
    {
        return view('nasa.index');
    }
    
    public function apod()
    {
        return view('nasa.apod')
            ->with('url', self::API_URL . 'planetary/apod?api_key=' . self::API_KEY);
    }

    public function neoFeed()
    {
        return view('nasa.neo-feed')
            ->with('url', self::API_URL . 'neo/rest/v1/feed?api_key=' . self::API_KEY)
            ->with('urlJpl', 'http://ssd.jpl.nasa.gov/sbdb.cgi?sstr=');
    }
}
