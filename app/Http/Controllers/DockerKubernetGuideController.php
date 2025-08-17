<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DockerKubernetGuideController extends Controller
{
    public function index(Request $request)
    {
        return view('other.docker-kubernet-guideline');
    }
}