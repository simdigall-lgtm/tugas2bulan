<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PengaturanController extends Controller
{
    public function index()
    {
        $sessionUser = session('user');
        $currentLoggedUser = null;
        if (session()->has('user_id')) {
            $currentLoggedUser = User::find(session('user_id'));
        }
        if (!$currentLoggedUser && $sessionUser) {
            $currentLoggedUser = User::where('name', $sessionUser)->orWhere('email', $sessionUser)->first();
        }
        $name = $currentLoggedUser ? $currentLoggedUser->name : $sessionUser;
        $email = $currentLoggedUser ? $currentLoggedUser->email : '';
        $isKasir = (strtolower($name ?? '') === 'kasir' || str_contains(strtolower($email ?? ''), 'kasir'));

        if ($isKasir) {
            return redirect()->route('dashboard');
        }

        $users = User::all();
        return view('pengaturan', compact('users'));
    }
}
