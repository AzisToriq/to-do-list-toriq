<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Task::where('user_id', Auth::id());

        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Sort by deadline
        if ($request->filled('sort')) {
            $query->orderBy('deadline', $request->sort);
        } else {
            $query->orderByRaw("CASE 
                WHEN priority = 'high' THEN 1
                WHEN priority = 'medium' THEN 2
                ELSE 3 END")
                  ->orderBy('deadline', 'asc');
        }

        $tasks = $query->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
            'upload_file' => 'nullable|file|max:2048'
        ]);

        $filePath = null;
        if ($request->hasFile('upload_file')) {
            $filePath = $request->file('upload_file')->store('uploads', 'public');
        }

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'priority' => $request->priority,
            'upload_file' => $filePath,
            'is_completed' => false,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
            'upload_file' => 'nullable|file|max:2048'
        ]);

        $task = Task::findOrFail($id);

        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $filePath = $task->upload_file;
        if ($request->hasFile('upload_file')) {
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            $filePath = $request->file('upload_file')->store('uploads', 'public');
        }

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'priority' => $request->priority,
            'upload_file' => $filePath,
            'is_completed' => $request->has('is_completed'),
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Tugas berhasil diupdate.');
    }

    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($task->upload_file && Storage::disk('public')->exists($task->upload_file)) {
            Storage::disk('public')->delete($task->upload_file);
        }

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Tugas berhasil dihapus.');
    }
}
