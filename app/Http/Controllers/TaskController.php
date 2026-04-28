<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(){
        $tasks=Task::all();
        return view('tasks.index',compact('tasks'));
    }

    public function create(){
        return view('tasks.create');
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|max:255',
            'content'=>'nullable|max:1000'
        ]);

        Task::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'user_id'=>1,
        ]);
        return redirect()->route('tasks.index');
    }

    public function edit(Task $task){
        return view('tasks.edit',compact('task'));
    }

    public function update(Request $request,Task $task){
        $request->validate([
            'title'=>'required|max:225',
            'content'=>'nullable|max:1000',
        ]);

        $task->update([
            'title'=>$request->title,
            'content'=>$request->content,
        ]);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task){
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
