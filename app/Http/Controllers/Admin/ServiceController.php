<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;


class ServiceController extends Controller
{

    public function __construct()
    {
        $this->modelObject = new Service();
    }

    public function index()
    {
        $services = $this->modelObject->getAll();
        return Inertia::render('Admin/Service/List', ['services' => $services]);
    }

    public function create()
    {
        return Inertia::render('Admin/Service/Create');
    }

    public function uploadImage(Request $request)
    {
        $image = "";
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if (!empty($service->image)) {
                Storage::disk('public')->delete('services/' . $service->image);
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            Storage::disk('public')->putFileAs(
                'services',
                $file,
                $filename
            );
            $image = $filename;
        }
        return $image;
    }

    public function store(Request $request)
    {
        $request->validate([
            'meta_title'  => ['required'],
            'meta_description'  => ['required'],
            'title'  => ['required'],
            'description'  => ['required']
        ]);
        $data = $request->all();
        $data['image'] = $this->uploadImage($request);
        $this->modelObject->saveRecord($data);
        return redirect()->route('services.index')->with('success', 'Service created Successfully.');
    }

    public function edit(string $id)
    {
        $service = $this->modelObject::findOrFail($id);
        if ($service->image) {
            $service->image = Storage::disk('public')->url('services/' . $service->image);
        }
        return Inertia::render('Admin/Service/Create', ['service' => $service]);
    }

    public function update(Request $request, string $id)
    {
        $service = $this->modelObject::findOrFail($id);
        $data = $request->all();
        $data['image'] = $this->uploadImage($request);
        $service->update($data);
        return redirect()->route('services.index')
            ->with('success', 'Updated Successfully.');
    }
}
