<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class SiteController extends Controller
{

    /**
     * SiteController constructor.
     */
    public function __construct()
    {
    }


    public function index()
    {
       return view('welcome');
    }
}
