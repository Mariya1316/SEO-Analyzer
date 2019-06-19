<?php

namespace App\Http\Controllers;

class MainPageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show()
    {
        return view('main', ['url' => '']);
    }
}
