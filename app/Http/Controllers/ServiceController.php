<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function details(Request $request,$url) 
    {
        $serviceObj = new \App\Models\Service;
        $service = $serviceObj->findBySlug($url);
        if(empty($service) || empty($service->status)){
            return $this->abort();
        }
        $service->canonical = route('service-details',['url' => $url]);
        if($service->image) {
            $service->image = Storage::disk('public')->url('services/'.$service->image);
        }
        return Inertia::render('Frontend/Service/Details',['service' => $service]);
    }
}
