<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CertificationController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Home');
    }

    public function specialties1(): Response
    {
        return Inertia::render('Home');
    }

    public function specialties2(): Response
    {
        return Inertia::render('Home');
    }

    public function specialties3(): Response
    {
        return Inertia::render('Home');
    }

    public function skills(): Response
    {
        return Inertia::render('Home');
    }

    public function cpr(): Response
    {
        return Inertia::render('Home');
    }

}
