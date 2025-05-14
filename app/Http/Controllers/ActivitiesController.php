<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Activities/Index', [

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug): Response
    {
        return Inertia::render('Activities/Show', [

        ]);
    }
}
