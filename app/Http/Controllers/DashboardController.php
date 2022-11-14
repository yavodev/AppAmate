<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\User;
use App\Models\Event;
use App\Models\Question;
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

            $answertests = Test::get();
            $totalquestio_alerta = Question::where('category', 'alerta')->count();
            $totalquestio_urgente = Question::where('category', 'urgente')->count();
            $totalquestio_reacciona = Question::where('category', 'reacciona')->count();

            $dato = 0;
            $repuesta = '';
            $dato = 1;
            $count_alerta = 0;
            $count_urgente = 0;
            $count_reacciona = 0;
            $datainfo = [];
            foreach ($answertests as $key => $value) {
                $id_ask = $value->id_ask;
                $answer = $value->answer;

                $category = $value->find($value->id)->questionsda->category;


                if ($category == 'alerta' && $answer == 1) {
                    $count_alerta = $count_alerta + 1;
                } else if ($category == 'urgente' && $answer == 1) {
                    $count_urgente = $count_urgente + 1;
                    //
                } else if ($category == 'reacciona' && $answer == 1) {
                    $count_reacciona = $count_reacciona + 1;
                    //
                }
                /* $datainfo[] = array(
                    "data" => $array
                ); */
            }
            $array = array();
            $array['alerta'] = $count_alerta;
            $array['urgente'] = $count_urgente;
            $array['reacciona'] = $count_reacciona;
            //dd($array);
            $total_alerta = 0;
            $total_urgente = 0;
            $total_reacciona = 0;
            if ($count_alerta > $count_urgente && $count_alerta > $count_reacciona && $totalquestio_urgente > $count_urgente) {
                $repuesta = 'alerta';
            } else if ($count_reacciona > $count_urgente && $count_reacciona > $count_alerta && $totalquestio_urgente > $count_urgente) {
                $repuesta = 'reacciona';
            } else if ($count_urgente > $count_reacciona && $count_urgente > $count_alerta && $totalquestio_urgente == $count_urgente) {
                $repuesta = 'urgente';
            } else if ($count_urgente <= $count_reacciona && $count_urgente <= $count_alerta && $totalquestio_urgente == $count_urgente) {
                $repuesta = 'urgente';
            } else {
                $repuesta = 'ninguno';
            }

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
