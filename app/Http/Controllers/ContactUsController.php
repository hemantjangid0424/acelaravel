<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactUsController extends Controller
{
    public function __construct()
    {
        $this->modelObject = new ContactUs();
    }

    public function index()
    {
        return Inertia::render('Frontend/ContactUs');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $contactUs = $this->modelObject->saveRecord($data);
        if ($contactUs['success']) {
            return redirect()->back()->with('success', 'Thank you for contacting us. Your message has been received and our team will get back to you shortly.');
        }
        return redirect()->back()->with('error', 'Something went wrong.');
    }
}
