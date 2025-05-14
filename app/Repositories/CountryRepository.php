<?php

namespace App\Repositories;

use App\Models\Country;

class CountryRepository
{

    /**
     * GetSelectList
     * Array for form select field
     *
     * @return array
     */
    public static function getSelectList(): array
    {
        $countries = [];
        foreach (Country::all()->sortBy('name') as $country) {
            $countries[] = array(
                'label' => $country->name,
                'value' => $country->id
            );
        }
        return $countries;
    }

}
