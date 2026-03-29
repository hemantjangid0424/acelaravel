<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        // ── Personal Information ─────────────────────────────────────
        'first_name',
        'last_name',
        'sex',
        'email',
        'phone',
        'name_changed',
        'dob',
        'birth_city_state',

        // ── Application Details ──────────────────────────────────────
        'service_applying_for',
        'country_residence',
        'state_residence',
        'profession',
        'work_address',
        'marital_status',

        // ── Father's Information ─────────────────────────────────────
        'father_name',
        'father_profession',
        'father_nationality',

        // ── Mother's Information ─────────────────────────────────────
        'mother_name',
        'mother_profession',
        'mother_nationality',

        // ── Spouse Information ───────────────────────────────────────
        'spouse_name',
        'spouse_profession',
        'spouse_nationality',
        'spouse_dob',

        // ── India Travel Details ─────────────────────────────────────
        'port_entry_india',
        'port_exit_india',
        'reference_address_india',
        'reference_name_india',
        'reference_phone_india',
        'police_station_india',

        // ── Emergency Contact ────────────────────────────────────────
        'emergency_contact_person',
        'emergency_contact_number',

        // ── Sponsor Information ──────────────────────────────────────
        'sponsor_name',
        'sponsor_address',

        // ── Meta ─────────────────────────────────────────────────────
        'ip_address',
        'status',
    ];

    protected $casts = [
        'dob'          => 'date',
        'spouse_dob'   => 'date',
        'name_changed' => 'boolean',
    ];

    public function getAll($data = [])
    {
        $records = static::query()->orderBy('id','DESC');

        if (!empty($data['paginate'])) {
            return $records
                ->paginate($data['per_page'])
                
                ->withQueryString();
        }

        return $records->get();
    }
}
