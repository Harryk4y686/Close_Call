<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
Use App\Mail\SampleEmail;
class MailController extends Controller
{

    public function index(Request $request)
    {
        Mail::to("CloseCall@gmail.com")->send(new SampleEmail());
        dd("Done");

    }
}
