<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $id_user = Auth::user()->id;
        $user = User::find($id_user);

        if ($user->hasRole('Juidico') || $user->hasRole('Psicologo')) {
            $count_events = Event::where('id_author', $id_user)->count();
            $count_noticias = Information::where('id_author', $id_user)->count();

            return view('admin.home', compact('count_events', 'count_noticias'));
        } else if ($user->hasRole('Usuario')) {
            return view('admin.home');
        } else {
            $count_profesionales = User::with('roles')->whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', ['Admin', 'Usuario']);
            })->count();
            $count_usuarios = User::with('roles')->whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', ['Admin', 'Juidico', 'Psicologo']);
            })->count();
            $count_events = Event::count();
            $count_noticias = Information::count();
            return view('admin.home', compact('count_profesionales', 'count_usuarios', 'count_events', 'count_noticias'));
        }
    }
}
