<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
        
            return view('tasks.index', [
            'tasks' => $tasks,
            ]);
        }else{
            return view('tasks.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task;

        
        return view('tasks.create',[
                'task' => $task,
            ]);
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'content' => 'required|max:255',
        'deadline' => 'required',
        'progress' => 'required',
        'priority' => 'required',
        'status' => 'required|max:10',
            ]);
        
        $task = new Task;
        $task->content = $request->content;
        $task->deadline = $request->deadline;
        $task->progress = $request->progress;
        $task->priority = $request->priority;
        $task->status = $request->status;
        $user = \Auth::user();
        $task->user_id = $user->id;
       
        $task->save();
        
        return redirect('/');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        
        if (\Auth::id() === $task->user_id) {
        return view('tasks.show',[
            'task'=>$task,
            ]);
        }else{
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        
        if (\Auth::id() === $task->user_id) {
        return view('tasks.edit', [
            'task'=>$task,
            ]);
        }else{
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
        'content' => 'required|max:255',
        'deadline' => 'required',
        'progress' => 'required',
        'priority' => 'required',
        'status' => 'required|max:10',
            ]);
        
        $task = Task::findOrFail($id);
        
        if (\Auth::id() === $task->user_id) {
        $task->content = $request->content;
        $task->deadline = $request->deadline;
        $task->progress = $request->progress;
        $task->priority = $request->priority;
        $task->status = $request->status;
        $task->save();
        return redirect('/');
        }else{
            return redirect('/');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        if (\Auth::id() === $task->user_id) {
        $task -> delete();
        }
        
        return redirect('/');
    }
}
