<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('News/Index', [

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug): Response
    {
        return Inertia::render('News/Show', [

        ]);
    }

}
