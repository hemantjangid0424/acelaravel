<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;


class InquiriesController extends Controller
{

    public function __construct()
    {
        $this->modelObject = new Application();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = request('per_page') ?? 10;
        $applications = $this->modelObject->getAll(['paginate' => true,'per_page' => $perPage]);
        return Inertia::render('Admin/Inquiries/List',['inquiries' => $applications]);
    }

    public function show(string $id)
    {
        //
    }
}
