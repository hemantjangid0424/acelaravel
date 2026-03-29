@extends('emails.layout')
@section('title')
New Application - {{getAppName()}}
@endsection
@section('hero')
    <div class="eyebrow"><span class="eyebrow-line"></span>Admin Alert</div>
    <div class="hdr-h1">New Message Received 📋</div>
    <div class="hdr-p">Submitted on {{ $application->created_at }}</div>
@endsection

@section('content')
    <div class="alert a-orange">
        <span class="ai">⚡</span>
        <div>A new <strong>Travel &amp; Immigration</strong> message has been submitted. Review all details below and
            resolve at your earliest convenience.</div>
    </div>
    <div class="dc">
        <div class="dr">
            <div class="dk">Name</div>
            <div class="dv hi">{{ $application->name ?? '—' }}</div>
        </div>
        <div class="dr">
            <div class="dk">Email</div>
            <div class="dv">{{ $application->email ?? '—' }}</div>
        </div>
        <div class="dr">
            <div class="dk">Message</div>
            <div class="dv">{{ $application->message ?? '—' }}</div>
        </div>
    </div>
@endsection
