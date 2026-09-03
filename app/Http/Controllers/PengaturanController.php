<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PengaturanController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pengaturan', compact('users'));
    }
}
