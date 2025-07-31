<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard with upcoming tasks.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil 3 tugas terdekat berdasarkan deadline
        $tasks = Task::where('user_id', $user->id)
                    ->orderBy('deadline', 'asc') // pastikan ada kolom 'deadline' di tabel tasks
                    ->take(3)
                    ->get();

        return view('dashboard', compact('tasks'));
    }
}
