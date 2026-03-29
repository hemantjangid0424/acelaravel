@extends('emails.layout')
@section('title')
New Application - {{getAppName()}}
@endsection
@section('hero')
    <div class="eyebrow"><span class="eyebrow-line"></span>Admin Alert</div>
    <div class="hdr-h1">New Application Received 📋</div>
    <div class="hdr-p">Submitted on {{ $application->created_at }}</div>
@endsection

@section('content')

    <div class="alert a-orange">
        <span class="ai">⚡</span>
        <div>A new <strong>Travel &amp; Immigration</strong> application has been submitted. Review all sections below and
            process at your earliest convenience.</div>
    </div>

    {{-- App ID --}}
    <div
        style="background:linear-gradient(135deg,#0e1c3a,#1a306e);border-radius:14px;padding:20px 22px;margin-bottom:26px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
        <div>
            <div
                style="font-size:9px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,.35);margin-bottom:4px">
                Application ID</div>
            <div style="font-size:22px;font-weight:800;color:#fff;letter-spacing:.3px">
                {{ getApplicationNumber($application->id) }}</div>
        </div>
    </div>

    {{-- 1. PERSONAL --}}
    <div class="sh">
        <div class="sh-dot"></div>
        <div class="sh-txt">👤 Personal Information</div>
        <div class="sh-line"></div>
    </div>
    <div class="dc">
        <div class="dr">
            <div class="dk">Full Name</div>
            <div class="dv hi">{{ $application->first_name ?? '—' }} {{ $application->last_name ?? '—'}}</div>
        </div>
        <div class="dr">
            <div class="dk">Sex</div>
            <div class="dv">{{ $application->sex ?? '—' }}</div>
        </div>
        <div class="dr">
            <div class="dk">Email</div>
            <div class="dv"><a href="mailto:{{ $application->email ?? '—' }}"
                    style="color:#f47920;text-decoration:none">{{ $application->email ?? '—' }}</a></div>
        </div>
        <div class="dr">
            <div class="dk">Phone</div>
            <div class="dv">{{ $application->phone ?? '—' }}</div>
        </div>
        <div class="dr">
            <div class="dk">Date of Birth</div>
            <div class="dv">{{ \Carbon\Carbon::parse($application->dob)->toDateString() ?? '—' }}</div>
        </div>
        <div class="dr">
            <div class="dk">Name Changed?</div>
            <div class="dv">{{ $application->name_changed ? 'YES' : 'NO' }}</div>
        </div>
        <div class="dr">
            <div class="dk">City &amp; State of Birth</div>
            <div class="dv">{{ $application->birth_city_state ?? '—'}}</div>
        </div>
        <div class="dr">
            <div class="dk">Service Applying For</div>
            <div class="dv hi">{{ $application->service_applying_for ?? '—' }}</div>
        </div>
    </div>

    {{-- 2. RESIDENCE --}}
    <div class="sh">
        <div class="sh-dot"></div>
        <div class="sh-txt">🏠 Residence Information</div>
        <div class="sh-line"></div>
    </div>
    <div class="dc">
        <div class="dr">
            <div class="dk">Country of Residence</div>
            <div class="dv">{{ $application->country_residence ?? '—' }}</div>
        </div>
        <div class="dr">
            <div class="dk">State of Residence</div>
            <div class="dv">{{ $application->state_residence ?? '—' }}</div>
        </div>
        <div class="dr">
            <div class="dk">Profession</div>
            <div class="dv">{{ $application->profession ?? '—' }}</div>
        </div>
        <div class="dr">
            <div class="dk">Work Address</div>
            <div class="dv">{{ $application->work_address ?? '—' }}</div>
        </div>
    </div>

    {{-- 3. MARITAL --}}
    <div class="sh">
        <div class="sh-dot"></div>
        <div class="sh-txt">❤️ Marital Status</div>
        <div class="sh-line"></div>
    </div>
    <div class="dc">
        <div class="dr">
            <div class="dk">Status</div>
            <div class="dv"><span class="pill p-navy">{{ $application->marital_status ?? '—' }}</span></div>
        </div>
        @if (($application->marital_status ?? '') === 'Married')
            <div class="dr">
                <div class="dk">Spouse Name</div>
                <div class="dv">{{ $application->spouse_name ?? '—' }}</div>
            </div>
            <div class="dr">
                <div class="dk">Spouse Profession</div>
                <div class="dv">{{ $application->spouse_profession ?? '—' }}</div>
            </div>
            <div class="dr">
                <div class="dk">Spouse Nationality</div>
                <div class="dv">{{ $application->spouse_nationality ?? '—' }}</div>
            </div>
            <div class="dr">
                <div class="dk">Spouse Date of Birth</div>
                <div class="dv">{{ \Carbon\Carbon::parse($application->spouse_dob)->toDateString() ?? '—' }}</div>
            </div>
        @endif
    </div>

    {{-- 4. PARENTS --}}
    <div class="sh">
        <div class="sh-dot"></div>
        <div class="sh-txt">👨‍👩‍👦 Parents Information</div>
        <div class="sh-line"></div>
    </div>
    <div class="dc">
        <div class="dr">
            <div class="dk">Father's Name</div>
            <div class="dv">{{ $application->father_name ?? '—' }}</div>
        </div>
        <div class="dr">
            <div class="dk">Mother's Name</div>
            <div class="dv">{{ $application->mother_name ?? '—' }}</div>
        </div>
        <div class="dr">
            <div class="dk">Father's Profession</div>
            <div class="dv">{{ $application->father_profession ?? '—' }}</div>
        </div>
        <div class="dr">
            <div class="dk">Mother's Profession</div>
            <div class="dv">{{ $application->mother_profession ?? '—' }}</div>
        </div>
        <div class="dr">
            <div class="dk">Father's Nationality</div>
            <div class="dv">{{ $application->father_nationality ?? '—' }}</div>
        </div>
        <div class="dr">
            <div class="dk">Mother's Nationality</div>
            <div class="dv">{{ $application->mother_nationality ?? '—' }}</div>
        </div>
    </div>

    {{-- 5. TRAVEL --}}
    <div class="sh">
        <div class="sh-dot"></div>
        <div class="sh-txt">✈️ Travel Information</div>
        <div class="sh-line"></div>
    </div>
    <div class="dc">
        <div class="dr">
            <div class="dk">Port of Entry – India</div>
            <div class="dv">{{ $application->port_entry_india ?? '—' }}</div>
        </div>
        <div class="dr">
            <div class="dk">Port of Exit – India</div>
            <div class="dv">{{ $application->port_exit_india ?? '—' }}</div>
        </div>
    </div>

    {{-- 6. REFERENCE --}}
    <div class="sh">
        <div class="sh-dot"></div>
        <div class="sh-txt">📍 Reference in India</div>
        <div class="sh-line"></div>
    </div>
    <div class="dc">
        <div class="dr">
            <div class="dk">Reference Name</div>
            <div class="dv">{{ $application->reference_name_india ?? '—' }}</div>
        </div>
        <div class="dr">
            <div class="dk">Reference Address</div>
            <div class="dv">{{ $application->reference_address_india ?? '—' }}</div>
        </div>
        <div class="dr">
            <div class="dk">Reference Phone</div>
            <div class="dv">{{ $application->reference_phone_india ?? '—' }}</div>
        </div>
        <div class="dr">
            <div class="dk">Police Station</div>
            <div class="dv">{{ $application->police_station_india ?? '—' }}</div>
        </div>
    </div>

    {{-- 7. EMERGENCY --}}
    <div class="sh">
        <div class="sh-dot"></div>
        <div class="sh-txt">🚨 Emergency Contact</div>
        <div class="sh-line"></div>
    </div>
    <div class="dc">
        <div class="dr">
            <div class="dk">Contact Person</div>
            <div class="dv">{{ $application->emergency_contact_person ?? '—' }}</div>
        </div>
        <div class="dr">
            <div class="dk">Contact Number</div>
            <div class="dv">{{ $application->emergency_contact_number ?? '—' }}</div>
        </div>
    </div>

    {{-- 8. SPONSOR --}}
    <div class="sh">
        <div class="sh-dot"></div>
        <div class="sh-txt">🎗️ Sponsor Details</div>
        <div class="sh-line"></div>
    </div>
    <div class="dc">
        <div class="dr">
            <div class="dk">Sponsor Name</div>
            <div class="dv">{{ $application->sponsor_name ?? '—' }}</div>
        </div>
        <div class="dr">
            <div class="dk">Sponsor Address</div>
            <div class="dv">{{ $application->sponsor_address ?? '—' }}</div>
        </div>
    </div>
@endsection
