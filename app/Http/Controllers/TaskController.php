<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $status = $request->status;
        $sort = $request->sort;

        $query = Task::query();

        $query->where('user_id', auth()->id())
            ->when($keyword, function ($query, $keyword) {
                $query->where('title', 'like', "%{$keyword}%");
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when(in_array($sort, ['asc', 'desc']), function ($query) use ($sort) {
                $query->orderBy('created_at', $sort);
            });

        $tasks = $query->paginate(5)->withQueryString();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'nullable|max:1000',
            'status' => 'required|in:未着手,進行中,完了'
        ]);

        $validated['user_id'] = auth()->id();

        Task::create($validated);

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        $this->authorizeTask($task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'nullable|max:1000',
            'status' => 'required|in:未着手,進行中,完了',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $this->authorizeTask($task);

        $task->delete();
        return redirect()
            ->route('tasks.index');
    }

    private function authorizeTask(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
