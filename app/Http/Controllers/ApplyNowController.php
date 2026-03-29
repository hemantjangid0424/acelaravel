<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplyNowRequest;
use App\Mail\ApplicationReceived;
use App\Mail\ApplicationThankyou;
use App\Models\Application;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class ApplyNowController extends Controller
{

    public function __construct()
    {
        $this->modelObject = new Application();
    }

    public function index()
    {
        return Inertia::render('Frontend/ApplyNow');
    }

    public function submit(ApplyNowRequest $request)
    {
        try {
            $application = $this->modelObject::create($request->all());
            
            if($application){
                Mail::to(getInfoEmail())->send(new ApplicationReceived($application));
                Mail::to($application->email)->send(new ApplicationThankyou($application));
                return redirect()->back()->with('success','Thank you for your Application. we will get back to you soon..');
            } else {
                return redirect()->back()->with('error','Something Went Wrong. Please try again.');
            }
        } catch(Exception $e) {
            return redirect()->back()->with('error','Something Went Wrong. Please try again.');
        } 
    }


}
