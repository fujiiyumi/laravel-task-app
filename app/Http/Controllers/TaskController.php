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
        Task::create([
            'title'=>$request->title,
            'content'=>$request->content,
        ]);
        return redirect()->route('tasks.index');
    }
}
