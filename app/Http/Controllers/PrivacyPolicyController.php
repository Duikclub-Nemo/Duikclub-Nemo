<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class PrivacyPolicyController extends Controller
{
    /**
     * Display the home page
     */
    public function __invoke(): Response
    {
        return Inertia::render('PrivacyPolicy', [

        ]);
    }
}
