<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class AboutController extends Controller
{
    /**
     * Display the about page
     */
    public function about(): Response
    {
        return Inertia::render('About/About');
    }

    /**
     * Display the location page
     */
    public function location(): Response
    {
        return Inertia::render('About/Location');
    }

    /**
     * Display the membership page
     */
    public function membership(): Response
    {
        return Inertia::render('About/Membership', [
            'prices' => [
                'member' => '25,00',
                'family' => '12,50',
                'instructor' => '10,00',
                'federation_senior' => '57,90',
                'federation_junior' => '25,80',
            ]
        ]);
    }

    /**
     * Display the federation page
     */
    public function federation(): Response
    {
        return Inertia::render('About/Federation');
    }


    /**
     * Display the trail page
     */
    public function trail(): Response
    {
        return Inertia::render('About/Trail');
    }

}
