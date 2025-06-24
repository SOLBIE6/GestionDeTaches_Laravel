<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $taches = $user->taches;
        if ($user->role === 'admin') {
            $utilisateurs = \App\Models\User::with('taches')->get();
            return view('dashboard', compact('user', 'utilisateurs'));

        }

        // utilisateur normal
        return view('dashboard', compact('user', 'taches'));
    }
}
