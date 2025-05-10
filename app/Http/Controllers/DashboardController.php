<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        // Admin-specific dashboard logic
        return view('dashboard');
    }

    public function employeeDashboard()
    {
        // Employee-specific dashboard logic
        return view('employee');
    }

    public function userDashboard()
    {
        // Client-specific dashboard logic
        return view('user');
    }
}
