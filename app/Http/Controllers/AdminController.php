<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard with all user accounts.
     */
    public function index()
    {
        // Vérifie que l'utilisateur est bien admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            $utilisateurs = User::all(); // ← récupère tous les comptes
            return view('admin.dashboard', compact('utilisateurs')); // ← passe-les à la vue
        }

        // Si l'accès est interdit, redirige
        return redirect()->route('/')->with('error', 'Accès non autorisé.');
    }
}
