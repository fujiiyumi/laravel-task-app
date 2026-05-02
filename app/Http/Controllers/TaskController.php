<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request){
        $query=Task::where('user_id',auth()->id());
        
        if($request->filled('keyword')){
            $query->where('title','like','%'.$request->keyword.'%');
        }

        $tasks=$query->get();

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
            'user_id'=>auth()->id(),
        ]);
        return redirect()->route('tasks.index');
    }

    public function edit(Task $task){
        $this->authorizeTask($task);
        return view('tasks.edit',compact('task'));
    }

    public function update(Request $request,Task $task){
        $this->authorizeTask($task);

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
        $this->authorizeTask($task);

        $task->delete();
        return redirect()->route('tasks.index');
    }

    private function authorizeTask(Task $task){
        if($task->user_id !== auth()->id()){
            abort(403);
        }
    }
}
