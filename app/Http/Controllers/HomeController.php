<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Display the home page
     */
    public function __invoke(): Response
    {
        return Inertia::render('Home', [

        ]);
    }

}
