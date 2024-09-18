<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('General User')){
            return redirect()->route('document-management.index');
        }
        return  redirect()->route('dashboard');
    }
}
