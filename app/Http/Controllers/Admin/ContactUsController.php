<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Inertia\Inertia;


class ContactUsController extends Controller
{

    public function __construct()
    {
        $this->modelObject = new ContactUs();
    }

    public function index()
    {
        $perPage = request('per_page') ?? 10;
        $contacts = $this->modelObject->getAll(['paginate' => true,'per_page' => $perPage]);
        return Inertia::render('Admin/ContactUs/List',['contacts' => $contacts]);
    }
}
