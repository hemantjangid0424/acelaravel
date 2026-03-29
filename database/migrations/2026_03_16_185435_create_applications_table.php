<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            // ── Personal Information ─────────────────────────────────────
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->enum('sex', ['male', 'female', 'transgender']);
            $table->string('email');
            $table->string('phone', 20);
            $table->boolean('name_changed')->default(false);
            $table->date('dob');
            $table->string('birth_city_state');

            // ── Application Details ──────────────────────────────────────
            $table->string('service_applying_for');
            $table->string('country_residence');
            $table->string('state_residence');
            $table->string('profession');
            $table->text('work_address');
            $table->string('marital_status');

            // ── Father's Information ─────────────────────────────────────
            $table->string('father_name');
            $table->string('father_profession');
            $table->string('father_nationality');

            // ── Mother's Information ─────────────────────────────────────
            $table->string('mother_name');
            $table->string('mother_profession');
            $table->string('mother_nationality');

            // ── Spouse Information (nullable — only required if married) ─
            $table->string('spouse_name', 100)->nullable();
            $table->string('spouse_profession', 100)->nullable();
            $table->string('spouse_nationality', 100)->nullable();
            $table->date('spouse_dob')->nullable();

            // ── India Travel Details (nullable) ──────────────────────────
            $table->string('port_entry_india')->nullable();
            $table->string('port_exit_india')->nullable();
            $table->text('reference_address_india')->nullable();
            $table->string('reference_name_india')->nullable();
            $table->string('reference_phone_india', 20)->nullable();
            $table->string('police_station_india')->nullable();

            // ── Emergency Contact (nullable) ─────────────────────────────
            $table->string('emergency_contact_person')->nullable();
            $table->string('emergency_contact_number', 20)->nullable();

            // ── Sponsor Information (nullable) ───────────────────────────
            $table->string('sponsor_name')->nullable();
            $table->text('sponsor_address')->nullable();

            // ── Meta ─────────────────────────────────────────────────────
            $table->string('ip_address', 45)->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->softDeletes();

            // ── Indexes ──────────────────────────────────────────────────
            $table->index('email');
            $table->index('service_applying_for');
            $table->index('status');
            $table->index('marital_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};