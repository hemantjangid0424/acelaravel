<?php
// app/Http/Requests/ApplyNowRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Http;

class ApplyNowRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name'           => 'required|string|max:100',
            'last_name'            => 'required|string|max:100',
            'sex'                  => 'required',
            'email'                => 'required|email',
            'phone'                => 'required|string|max:20',
            'name_changed'         => 'required',
            'dob'                  => 'required|date',
            'birth_city_state'     => 'required|string',
            'service_applying_for' => 'required',
            'country_residence'    => 'required|string',
            'state_residence'      => 'required|string',
            'profession'           => 'required|string',
            'work_address'         => 'required|string',
            'marital_status'       => 'required',
            'father_name'          => 'required|string',
            'father_profession'    => 'required|string',
            'father_nationality'   => 'required|string',
            'mother_name'          => 'required|string',
            'mother_profession'    => 'required|string',
            'mother_nationality'   => 'required|string',
            'spouse_name'          => 'required_if:marital_status,married|nullable|string|max:100',
            'spouse_profession'    => 'required_if:marital_status,married|nullable|string|max:100',
            'spouse_nationality'   => 'required_if:marital_status,married|nullable|string|max:100',
            'spouse_dob'           => 'required_if:marital_status,married|nullable|date',
            'recaptcha_token'      => 'required|string',
            'port_entry_india'          => 'nullable|string|max:150',
            'port_exit_india'           => 'nullable|string|max:150',
            'reference_address_india'   => 'nullable|string',
            'reference_name_india'      => 'nullable|string|max:150',
            'reference_phone_india'     => 'nullable|string|max:20',
            'police_station_india'      => 'nullable|string|max:150',
            'emergency_contact_person'  => 'nullable|string|max:150',
            'emergency_contact_number'  => 'nullable|string|max:20',
            'sponsor_name'              => 'nullable|string|max:150',
            'sponsor_address'           => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            // ── Personal Information ─────────────────────────────────────
            'first_name.required'  => 'First name is required.',
            'first_name.string'    => 'First name must be a valid text value.',
            'first_name.max'       => 'First name must not exceed 100 characters.',

            'last_name.required'   => 'Last name is required.',
            'last_name.string'     => 'Last name must be a valid text value.',
            'last_name.max'        => 'Last name must not exceed 100 characters.',

            'sex.required'         => 'Gender is required.',
            'sex.in'               => 'Gender must be one of: Male, Female, or Transgender.',

            'email.required'       => 'Email address is required.',
            'email.email'          => 'Please enter a valid email address.',

            'phone.required'       => 'Phone number is required.',
            'phone.string'         => 'Phone number must be a valid text value.',
            'phone.max'            => 'Phone number must not exceed 20 characters.',

            'name_changed.required' => 'Please indicate whether your name has been changed.',
            'name_changed.in'       => 'Name changed must be either Yes or No.',

            'dob.required'         => 'Date of birth is required.',
            'dob.date'             => 'Please enter a valid date of birth.',

            'birth_city_state.required' => 'Birth city and state are required.',
            'birth_city_state.string'   => 'Birth city and state must be a valid text value.',

            // ── Application Details ──────────────────────────────────────
            'service_applying_for.required' => 'Please select the service you are applying for.',
            'service_applying_for.in'       => 'Service must be one of: Visa, Passport, or Immigration.',

            'country_residence.required' => 'Country of residence is required.',
            'country_residence.string'   => 'Country of residence must be a valid text value.',

            'state_residence.required'   => 'State of residence is required.',
            'state_residence.string'     => 'State of residence must be a valid text value.',

            'profession.required'        => 'Profession is required.',
            'profession.string'          => 'Profession must be a valid text value.',

            'work_address.required'      => 'Work address is required.',
            'work_address.string'        => 'Work address must be a valid text value.',

            'marital_status.required'    => 'Marital status is required.',
            'marital_status.in'          => 'Marital status must be one of: Married, Single, Divorcee, or Widower.',

            // ── Father's Information ─────────────────────────────────────
            'father_name.required'        => "Father's name is required.",
            'father_name.string'          => "Father's name must be a valid text value.",

            'father_profession.required'  => "Father's profession is required.",
            'father_profession.string'    => "Father's profession must be a valid text value.",

            'father_nationality.required' => "Father's nationality is required.",
            'father_nationality.string'   => "Father's nationality must be a valid text value.",

            // ── Mother's Information ─────────────────────────────────────
            'mother_name.required'        => "Mother's name is required.",
            'mother_name.string'          => "Mother's name must be a valid text value.",

            'mother_profession.required'  => "Mother's profession is required.",
            'mother_profession.string'    => "Mother's profession must be a valid text value.",

            'mother_nationality.required' => "Mother's nationality is required.",
            'mother_nationality.string'   => "Mother's nationality must be a valid text value.",

            // ── Spouse Information (conditional) ─────────────────────────
            'spouse_name.required_if'        => "Spouse's name is required.",
            'spouse_name.string'             => "Spouse's name must be a valid text value.",
            'spouse_name.max'                => "Spouse's name must not exceed 100 characters.",

            'spouse_profession.required_if'  => "Spouse's profession is required.",
            'spouse_profession.string'       => "Spouse's profession must be a valid text value.",
            'spouse_profession.max'          => "Spouse's profession must not exceed 100 characters.",

            'spouse_nationality.required_if' => "Spouse's nationality is required.",
            'spouse_nationality.string'      => "Spouse's nationality must be a valid text value.",
            'spouse_nationality.max'         => "Spouse's nationality must not exceed 100 characters.",

            'spouse_dob.required_if'         => "Spouse's date of birth is required.",
            'spouse_dob.date'                => "Please enter a valid date for spouse's date of birth.",

            // ── reCAPTCHA ────────────────────────────────────────────────
            'recaptcha_token.required' => 'Please complete the reCAPTCHA verification.',
            'recaptcha_token.string'   => 'Invalid reCAPTCHA token.',

            'port_entry_india.string'         => 'Port of entry must be a valid text value.',
            'port_entry_india.max'            => 'Port of entry must not exceed 150 characters.',

            'port_exit_india.string'          => 'Port of exit must be a valid text value.',
            'port_exit_india.max'             => 'Port of exit must not exceed 150 characters.',

            'reference_address_india.string'  => 'Reference address must be a valid text value.',

            'reference_name_india.string'     => 'Reference name must be a valid text value.',
            'reference_name_india.max'        => 'Reference name must not exceed 150 characters.',

            'reference_phone_india.string'    => 'Reference phone must be a valid text value.',
            'reference_phone_india.max'       => 'Reference phone must not exceed 20 characters.',

            'police_station_india.string'     => 'Police station must be a valid text value.',
            'police_station_india.max'        => 'Police station must not exceed 150 characters.',

            'emergency_contact_person.string' => 'Emergency contact name must be a valid text value.',
            'emergency_contact_person.max'    => 'Emergency contact name must not exceed 150 characters.',

            'emergency_contact_number.string' => 'Emergency contact number must be a valid text value.',
            'emergency_contact_number.max'    => 'Emergency contact number must not exceed 20 characters.',

            'sponsor_name.string'             => 'Sponsor name must be a valid text value.',
            'sponsor_name.max'                => 'Sponsor name must not exceed 150 characters.',

            'sponsor_address.string'          => 'Sponsor address must be a valid text value.',
        ];
    }

    // ── Runs AFTER rules() pass ──────────────────────────────────────────
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if (! $this->verifyCaptcha()) {
                $validator->errors()->add(
                    'recaptcha_token',
                    'Captcha verification failed. Please tick the "I\'m not a robot" box and try again.'
                );
            }
        });
    }

    private function verifyCaptcha(): bool
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => config('services.recaptcha.secret'),
            'response' => $this->input('recaptcha_token'),
            'remoteip' => $this->ip(),
        ]);

        return $response->successful() && $response->json('success') === true;
    }
}