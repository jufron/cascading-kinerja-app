<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index ()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return view('dashboard.admin.dashboard');
        } else if ($user->hasRole('pimpinan')) {
            return view('dashboard.admin.dashboard');
        } else if ($user->hasRole('pegawai')) {
            return view('dashboard.admin.dashboard');
        } else {
            return abort(404);
        }
    }
}
