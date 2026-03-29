@extends('emails.layout')
@section('title')
    {{ getAppName() }}
@endsection

@section('hero')
    <div class="eyebrow"><span class="eyebrow-line"></span>Application Confirmed</div>
    <div class="hdr-h1">You're all set, {{ $data['first_name'] ?? 'there' }}! 🎉</div>
    <div class="hdr-p">We've received your application and our experts are on it. Expect a response within <strong
            style="color:rgba(255,255,255,.8)">1–2 business days.</strong></div>
@endsection

@section('content')
    <div class="alert a-green">
        <span class="ai">✅</span>
        <div>Your application for <strong>{{ $data['service_applying_for'] ?? 'Travel &amp; Immigration Services' }}</strong>
            has been successfully submitted. Keep this email for your records.</div>
    </div>

    {{-- App ID hero block --}}
    <div
        style="background:linear-gradient(135deg,#0e1c3a,#1a306e);border-radius:14px;padding:20px 22px;margin-bottom:26px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
        <div>
            <div
                style="font-size:9px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,.35);margin-bottom:4px">
                Your Application ID</div>
            <div style="font-size:22px;font-weight:800;color:#fff;letter-spacing:.3px">{{ getApplicationNumber($application->id) }}</div>
        </div>
    </div>

    {{-- Summary --}}

    <div class="sh" style="margin-top:0">
        <div class="sh-dot"></div>
        <div class="sh-txt">📄 Application Summary</div>
        <div class="sh-line"></div>
    </div>
    <div class="dc">
        <div class="dr">
            <div class="dk">Full Name</div>
            <div class="dv hi">{{ $application->first_name }} {{ $application->last_name }}</div>
        </div>
        <div class="dr">
            <div class="dk">Email</div>
            <div class="dv">{{ $application->email }}</div>
        </div>
        <div class="dr">
            <div class="dk">Phone</div>
            <div class="dv">{{ $application->phone }}</div>
        </div>
        <div class="dr">
            <div class="dk">Service Applied</div>
            <div class="dv hi">{{ $application->service_applying_for }}</div>
        </div>
        <div class="dr">
            <div class="dk">Submitted On</div>
            <div class="dv">{{ $application->created_at }}</div>
        </div>
    </div>

    {{-- <hr class="d"/> --}}

    {{-- Steps --}}
    {{-- <div class="sh"><div class="sh-dot"></div><div class="sh-txt">🚀 What Happens Next</div><div class="sh-line"></div></div>

@php $steps=[
  ['1','📬','Application Review','Our immigration experts review your details within 1–2 business days.'],
  ['2','📞','Advisor Consultation','A dedicated advisor contacts you to discuss your case and documents needed.'],
  ['3','📂','Document Verification','We guide you through a tailored checklist for your selected service.'],
  ['4','🚀','Application Filing','Once everything is ready, we file the official application on your behalf.'],
]; @endphp

<table width="100%" cellpadding="0" cellspacing="0">
@foreach ($steps as [$n, $icon, $title, $desc])
<tr>
  <td style="padding:0 0 16px;vertical-align:top;width:46px">
    <div class="step-num">{{ $n }}</div>
  </td>
  <td style="padding:0 0 16px 13px;vertical-align:top;border-bottom:1.5px solid #e8eaf2">
    <div style="font-size:13.5px;font-weight:700;color:#0e1c3a;margin-bottom:3px">{{ $icon }} {{ $title }}</div>
    <div style="font-size:12.5px;color:#8c96b5;line-height:1.65">{{ $desc }}</div>
  </td>
</tr>
@endforeach
</table> --}}

    {{-- <hr class="d"/> --}}

    {{-- Contact boxes --}}
    <div class="sh">
        <div class="sh-dot"></div>
        <div class="sh-txt">📞 Need Help?</div>
        <div class="sh-line"></div>
    </div>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td width="50%" style="padding-right:8px;vertical-align:top">
                <div class="cbox">
                    <div style="font-size:26px;margin-bottom:8px">📞</div>
                    <div
                        style="font-size:9.5px;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#8c96b5;margin-bottom:5px">
                        Call Us</div>
                    <a href="tel:+17323479222" style="font-size:14px;font-weight:800;color:#f47920;text-decoration:none">+1
                        732 347 9222</a>
                </div>
            </td>
            <td width="50%" style="padding-left:8px;vertical-align:top">
                <div class="cbox">
                    <div style="font-size:26px;margin-bottom:8px">✉️</div>
                    <div
                        style="font-size:9.5px;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#8c96b5;margin-bottom:5px">
                        Email Us</div>
                    <a href="mailto:{{ getInfoEmail() }}"
                        style="font-size:13px;font-weight:800;color:#f47920;text-decoration:none">{{ getInfoEmail() }}</a>
                </div>
            </td>
        </tr>
    </table>

    <hr class="d" />

    {{-- Closing --}}
    <div style="text-align:center;padding:6px 0 10px">
        <p style="font-size:13px;color:#8c96b5;line-height:1.75;max-width:380px;margin:0 auto 18px">
            Thank you for choosing <strong style="color:#f47920">{{ getAppName() }}</strong>
        </p>
        <p style="font-size:13px;color:#0e1c3a;font-weight:700">
            Warm regards,<br>
            <span style="color:#f47920">The {{ getAppName() }} Team</span>
        </p>
    </div>
@endsection
