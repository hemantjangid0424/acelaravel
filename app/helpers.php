<?php

use App\Models\Service;
use Illuminate\Support\Str;

if (!function_exists('getAppName')) {
    function getAppName()
    {
        return config('app.name');
    }
}

if (!function_exists('getInfoEmail')) {
    function getInfoEmail()
    {
        return config('app.config.emails.info');
    }
}

if (!function_exists('getApplicationNumber')) {
    function getApplicationNumber($id)
    {
        return "#ACE-".Str::padLeft($id,5,'0');
    }
}

if (!function_exists('getFormattedApplicationData')) {
    function getFormattedApplicationData($data)
    {
        $data->dob = \Carbon\Carbon::parse($data->dob)->toDateString();
        $data->spouse_dob = \Carbon\Carbon::parse($data->spouse_dob)->toDateString();
        $data->sex = Str::ucfirst($data->sex);
        $data->birth_city_state = Str::ucfirst($data->birth_city_state);
        $data->service_applying_for = $data->service_applying_for;
        $data->country_residence = Str::ucfirst($data->country_residence);
        $data->state_residence = Str::ucfirst($data->state_residence);
        $data->profession = Str::ucwords($data->profession);
        $data->marital_status = Str::ucfirst($data->marital_status);
        $data->father_nationality = Str::ucfirst($data->father_nationality);
        $data->mother_nationality = Str::ucfirst($data->mother_nationality);
        $data->spouse_nationality = Str::ucfirst($data->spouse_nationality);
        return $data;
    }
}

