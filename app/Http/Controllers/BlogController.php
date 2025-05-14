<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class BlogController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Home');
    }

    public function show(): Response
    {
        return Inertia::render('Home');
    }
}
